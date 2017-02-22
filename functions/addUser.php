<?php 
	include 'Db.php';
	include_once 'uploads/class.upload.php';
	session_start();
	
	if(isset($_POST['signup'])){
		
		$data['user_fname']=$_POST['user_fname'];
		$data['user_lname']=$_POST['user_lname'];
		$data['user_name']=$_POST['user_name'];
		$data['user_email']=$_POST['user_email'];
		$password=$_POST['user_password'];
		$static_salt='asdfasdfqwertyuiop123ABC_tjfurum';
		$mypassword=hash('sha512', $password . $static_salt);
		$data['user_password']=$mypassword;

		$data['user_status']="active";

		// Uploading Image
		$user_image=$_FILES['user_image'];

		$handle = new upload($user_image);

		// Set the type of files allowed
		$handle->allowed = 'image/*';
		// Overwrite the file if it already exists.
		$handle->file_overwrite = true;
		// Set the max file size.
		$handle->file_max_size = '2147483648';
		// Resize the image
		$handle->image_resize = true;
		$handle->image_x = '60';
		$handle->image_y = '60';
		// New filename

		$handle->file_new_name_body = 'forum-user-'.date("Ymdhis");

		$handle->process('../uploads/');
		
		if ($handle->processed) {
			$data['user_image'] = $handle->file_dst_name;//.".".$handle->file_dst_name_ext;
			
			$db = new Db();
			//$dbPrefix=$db->dbPrefix();

			$ins=$db->insert($data,"users");
			if($ins->type=="success"){
				$_SESSION['noty_msg']="User Resister Successfully";
				$_SESSION['noty_type']="success";
				header("Location:../index.php");
			}else{
				$_SESSION['noty_msg']="Please Try Again Later!";
				$_SESSION['noty_type']="error";
				header("Location:../signup.php");
			}
			
		}else{
			//error
			$_SESSION['noty_msg']="Wrong Image File!";
			$_SESSION['noty_type']="error";
			header("Location:../signup.php");
		}
		
		

	}else{
		//Eror Page
		$_SESSION['noty_msg']="Sorry You Have Tried To Access Protected File!";
		$_SESSION['noty_type']="error";
		header("Location:../index.php");
	}
	
?>