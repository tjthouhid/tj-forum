<?php
include 'Db.php';
session_start();
if(isset($_POST['login'])){
	$db = new Db();
	$connection = $db-> connect();
	$user_name=$_POST['user_name'];
	$user_password=$_POST['user_password'];
	$static_salt='asdfasdfqwertyuiop123ABC_tjfurum';
	$mypassword=hash('sha512', $user_password . $static_salt);
	$dbPrefix=$db->dbPrefix();
	$table_name=$dbPrefix."users";
	$sql="SELECT * FROM ".$table_name." Where user_name='$user_name' && user_password='$mypassword' && deleted='0' Limit 1";
	$result=$connection->query($sql);
	
	if($result->num_rows>0){
	
		
		while ($obj = $result->fetch_object()){

			if($obj->user_status=='inactive'){
				//Eror Page
				$_SESSION['noty_msg']="Sorry Your Account is Inactive";
				$_SESSION['noty_type']="error";
				header("Location:../login.php");
			}else{
				$_SESSION['user_id']=$obj->user_id;
				$_SESSION['user_name']=$obj->user_fname." ".$obj->user_lname;
				$_SESSION['user_image']=$obj->user_image;
				$_SESSION['user_loggedIn']=true;
				//Eror Page
				$_SESSION['noty_msg']="You Logged in Successfully";
				$_SESSION['noty_type']="success";
				header("Location:../index.php");
			}
			
		}
		
	}else{
		//Eror Page
		$_SESSION['noty_msg']="Sorry Wrong UserName/Password!";
		$_SESSION['noty_type']="error";
		header("Location:../login.php");
	}
}else{
	//Eror Page
	$_SESSION['noty_msg']="Sorry You Have Tried To Access Protected File!";
	$_SESSION['noty_type']="error";
	header("Location:../index.php");
}


?>