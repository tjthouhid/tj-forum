<?php 
include 'Db.php';
session_start();
if(isset($_SESSION['user_loggedIn'])){
	$select="<option value='0'>Select Topic</option>";
	$topic_id=$_POST['topic_id'];

	$db = new Db();
	$connection = $db-> connect();
	$dbPrefix=$db->dbPrefix();
	$table_name=$dbPrefix."topics";
	$sql="SELECT * FROM ".$table_name." Where deleted='0'";
	$result=$connection->query($sql);	
	if($result->num_rows>0){
		
		while ($obj = $result->fetch_object()){
			
			if($obj->topic_id==$topic_id){
				$selected="selected";
			}else{
				$selected="";
			}
			$select.="<option value='".$obj->topic_id."' ".$selected.">".$obj->topic_title."</option>";
		}
	}
	echo $select;
}else{
	echo "false";
	exit;
}

?>