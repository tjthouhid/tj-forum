<?php 
	include 'Db.php';
	session_start();
	
	if(isset($_POST)){
		if(isset($_SESSION['user_loggedIn'])){
			$data['topic_title']=$_POST['topicName'];
			$data['user_id']=$_SESSION['user_id'];

			$db = new Db();
			//$dbPrefix=$db->dbPrefix();

			$ins=$db->insert($data,"topics");
			if($ins->type=="success"){
				$row['result']=$ins->last_row;
				echo json_encode($row);
			}else{
				
				$row['result']="false";
				echo json_encode($row);
			}
			
		}else{
			$row['result']="false";
			echo json_encode($row);
		}
		
		
		
		exit;
		
		

	}else{
		//Eror Page
		$_SESSION['noty_msg']="Sorry You Have Tried To Access Protected File!";
		$_SESSION['noty_type']="error";
		header("Location:../index.php");
		exit;
	}
	
?>