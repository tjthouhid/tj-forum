<?php 
	include 'Db.php';
	include_once 'uploads/class.upload.php';
	session_start();
	if(isset($_POST)){
		if(isset($_SESSION['user_loggedIn'])){
			$user_image=$_FILES['file'];
			$handle = new upload($user_image);

			// Set the type of files allowed
			$handle->allowed = 'image/*';
			// Overwrite the file if it already exists.
			$handle->file_overwrite = true;
			// Set the max file size.
			$handle->file_max_size = '5120000'; //5mb 
			// // Resize the image
			$handle->image_resize = true;
			// $handle->image_x = '60';
			// $handle->image_y = '60';
			$handle->image_x              = 100;
			$handle->image_ratio_y        = true;
			// New filename

			$handle->file_new_name_body = 'forum-thread-'.date("Ymdhis");

			$handle->process('../uploads/images/');
			
			if ($handle->processed) {
				$row['result']=true;
				$row['msg'] =$handle->file_dst_name;
				echo json_encode($row);
				//$data['user_image'] =$handle->file_dst_name;//.".".$handle->file_dst_name_ext;
			}else{
				
				$row['result']=false;
				$row['msg'] =$handle->error;
				echo json_encode($row);
			}
		}else{

			$row['result']=false;
			$row['msg'] ="User Not Logged In";;
			echo json_encode($row);
		}
	}else{
		//Eror Page
		$_SESSION['noty_msg']="Sorry You Have Tried To Access Protected File!";
		$_SESSION['noty_type']="error";
		header("Location:../index.php");
	}
	exit;
?>