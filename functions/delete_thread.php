<?php 
	include 'Db.php';
	session_start();
	
	if(isset($_GET)){
		if(isset($_SESSION['user_loggedIn'])){
		
			$data['deleted']=1;
			
			
			$where['thread_id']=$_GET['id'];
			$where['user_id']=$_SESSION['user_id'];
			
			
		
				
				$db = new Db();
				//$dbPrefix=$db->dbPrefix();

				$ins=$db->update($data,"threads",$where);

				if($ins->type=="success"){
					if($ins->last_row>0){
						$where2['thread_id']=$_GET['id'];
						$ins2=$db->update($data,"comments",$where2);
						$_SESSION['noty_msg']="Thread Deleted Successfully!";
						$_SESSION['noty_type']="success";
						header("Location:../index.php");
					}else{
						$_SESSION['noty_msg']="Sorry You Are Not Allowed to Delete another User's Thread!";
						$_SESSION['noty_type']="error";
						header("Location:../index.php");
					}
						
				}else{
					$_SESSION['noty_msg']="Sorry You Are Not Allowed to Delete another User's Thread!";
					$_SESSION['noty_type']="error";
					header("Location:../index.php");
				}
			}else{
				//Eror Page
				$_SESSION['noty_msg']="Sorry You are not Logged In!";
				$_SESSION['noty_type']="error";
				header("Location:../index.php");
			}
			exit;
			
	
		
		

	}else{
		//Eror Page
		$_SESSION['noty_msg']="Sorry You Have Tried To Access Protected File!";
		$_SESSION['noty_type']="error";
		header("Location:../index.php");
	}
	
?>