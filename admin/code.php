<?php
	session_start();
	include "../common/vcode.func.php";
	
	$_SESSION['admin']['code'] = vcode(220,35);