<?php
	header('content-type:text/html;charset=utf-8');
	session_start();
	
	include "../config/config.inc.php";
	include "../common/connect.func.php";
	
	//接收参数
	$username=$_POST['username'];
	$password=$_POST['password'];

	$password=md5($password);
	//判断用户名密码是否正确
	$sql="select * from ".DB_PREFIX."user where username='$username' and password='$password'";
	
	$data=connect($sql);

	if(!empty($data)){
		//3.如果正确，进行登录处理
		$_SESSION['admin']['islogin']=1;
		$_SESSION['admin']['username']=$username;
		$_SESSION['admin']['id']=$data[0]['id'];
		
		header('location:index.php');
		
	}else{
		//4.如果不正确，跳回到登陆界面
		echo "<script>alert('对不起，亲，用户名或者密码不正确')</script>";
		echo "<script>window.location.href='login.php'</script>";
	
	}
	
	
	