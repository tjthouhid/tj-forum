<?php
	session_start();
	// remove all session variables
	session_unset(); 
	// destroy the session 
	session_destroy();
	session_start();
	
	//Eror Page
	$_SESSION['noty_msg']="You Logged Out Successfully";
	$_SESSION['noty_type']="success";
	header("Location:../index.php");
?>