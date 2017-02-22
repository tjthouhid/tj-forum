<?php 
	include 'Db.php';
	session_start();
	
	if(isset($_POST)){
		if(isset($_SESSION['user_loggedIn'])){
		
			$data['comment_detail']=$_POST['commentDetail'];
			
			
			$where['comment_id']=$_POST['commentId'];
			
			
		
				
				$db = new Db();
				//$dbPrefix=$db->dbPrefix();

				$ins=$db->update($data,"comments",$where);
				if($ins->type=="success"){
					$row['msg']="Comment Inserted Successfully";
					$row['result']="true";
					echo json_encode($row);
				}else{
					$row['msg']="Please Try Again Later!";
					$row['result']="false";
					echo json_encode($row);
				}
			}else{
				//Eror Page
				$row['msg']="Sorry You Are Not Logged In!";
				$row['result']="false";
				echo json_encode($row);
			}
			exit;
			
	
		
		

	}else{
		//Eror Page
		$_SESSION['noty_msg']="Sorry You Have Tried To Access Protected File!";
		$_SESSION['noty_type']="error";
		header("Location:../index.php");
	}
	
?>