<?php 
include 'Db.php';
$user_email=$_POST['checkUserEmail'];
$db = new Db();
$dbPrefix=$db->dbPrefix();
$connection = $db-> connect();
$tbl_name=$dbPrefix."users";
$sql="SELECT user_id from ".$tbl_name." where user_email='$user_email'";
$result=$connection->query($sql);

//echo $result->num_rows;
if($result->num_rows>0){
		echo "true";	  
}else{
	echo "false";	    
}
  exit;
?>