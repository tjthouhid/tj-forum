<?php 
	session_start();
	
	//Eror Page
	$_SESSION['noty_msg']="You are not authorized to Access This page";
	$_SESSION['noty_type']="error";
	header("Location:../index.php");
?>