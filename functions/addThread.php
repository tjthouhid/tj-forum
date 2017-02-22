<?php 
	include 'Db.php';
	session_start();
	
	if(isset($_POST)){
		if(isset($_SESSION['user_loggedIn'])){
		
			$data['thread_title']=$_POST['thread_title'];
			$data['thread_description']=$_POST['thread_description'];
			$data['user_id']=$_SESSION['user_id'];
			$data['topic_id']=$_POST['topic_id'];
			
			
		
				
				$db = new Db();
				//$dbPrefix=$db->dbPrefix();

				$ins=$db->insert($data,"threads");
				if($ins->type=="success"){
					$_SESSION['noty_msg']="Thread Insert Successfully";
					$_SESSION['noty_type']="success";
					header("Location:../index.php");
				}else{
					$_SESSION['noty_msg']="Please Try Again Later!";
					$_SESSION['noty_type']="error";
					header("Location:../new_thread.php");
				}
			}else{
				//Eror Page
				$_SESSION['noty_msg']="Sorry You Are Not Logged In!";
				$_SESSION['noty_type']="error";
				header("Location:../index.php");
			}
			
	
		
		

	}else{
		//Eror Page
		$_SESSION['noty_msg']="Sorry You Have Tried To Access Protected File!";
		$_SESSION['noty_type']="error";
		header("Location:../index.php");
	}
	
?>