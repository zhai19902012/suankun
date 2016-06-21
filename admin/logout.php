<?php
	session_start();
	
	$_SESSION['admin']=array();
	
	header('location:login.php');