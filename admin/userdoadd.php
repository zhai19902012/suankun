<?php	
session_start();
	//判断是否登陆，如果已经登陆才允许进入到该界面，否则跳转到登陆界面
	if(empty($_SESSION['admin']['islogin'])||$_SESSION['admin']['islogin']!=1){
		//用户没有登录
		header("location:./login.php");
		exit;
	}

	//加载文件
	//1.加载配置文件
	include "../config/config.inc.php";
	
	//2.加载函数文件
	include "../common/connect.func.php";


	//1。接收参数
	$username=$_POST['username'];
	$password=$_POST['password'];
	$repass=$_POST['repass'];
	
	//2.判断用户名及密码是否为空
	if(empty($username)||empty($password)){
		header("content-type:text/html;charset=utf-8");
		echo "<script>alert('用户名或密码不能为空')</script>";
		echo "<script>window.location.href='useradd.php'</script>";
		exit;
	}
	
	//3.判断两次密码是否一致
	if($password!=$repass){
		header("content-type:text/html;charset=utf-8");
		echo "<script>alert('两次密码输入不一致')</script>";
		echo "<script>window.location.href='useradd.php'</script>";
		exit;
	}
	
	//4.处理数据
	$password=md5($password);
	//$rtime=time();
	$rtime=$_SERVER['REQUEST_TIME'];
	$rip=ip2long($_SERVER['REMOTE_ADDR']);
	
	//5.准备sql语句
	$sql="insert into ".DB_PREFIX."user(username,password,rtime,rip) values('$username','$password','$rtime','$rip')";
	//6.调用函数connect,来发送sql语句
	$affected = connect($sql);
	
	//7.处理结果
	if($affected){
		header('content-type:text/html;charset=utf-8');
		echo "<script>alert('恭喜您，添加成功')</script>";
		echo "<script>window.location.href='userlist.php'</script>";
	}else{
		header('content-type:text/html;charset=utf-8');
		echo "<script>alert('对不起，添加失败')</script>";
		echo "<script>window.location.href='useradd.php'</script>";
	}