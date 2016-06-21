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
	$id = $_POST['id'];
	$oldpassword=$_POST['password'];
	$password=$_POST['newpassword'];
	$repass=$_POST['nrepass'];

	//2.判断及密码是否为空
	if(empty($oldpassword)){
		header("content-type:text/html;charset=utf-8");
		echo "<script>alert('原始密码不能为空')</script>";
		echo "<script>window.location.href='useradd.php'</script>";
		exit;
	}

	//2.判断及新密码是否为空
	if(empty($password)){
		header("content-type:text/html;charset=utf-8");
		echo "<script>alert('新密码不能为空')</script>";
		echo "<script>window.location.href='useradd.php'</script>";
		exit;
	}
	
	$sql="select * from  cms_user where id=".$id;
	$data = connect($sql);
	$oldpassword = md5($oldpassword);
	//2.判断用户名及密码是否为空
	if($data[0]['password']!=$oldpassword){
		header("content-type:text/html;charset=utf-8");
		echo "<script>alert('原始密码错误')</script>";
		echo "<script>window.location.href='useradd.php'</script>";
		exit;
	}else{
		//3.判断两次密码是否一致
		if($password!=$repass){
			header("content-type:text/html;charset=utf-8");
			echo "<script>alert('两次密码输入不一致')</script>";
			echo "<script>window.location.href='useradd.php'</script>";
			exit;
		}

			$password=md5($password);

				//$rtime=time();
			$rtime=$_SERVER['REQUEST_TIME'];
			$rip=ip2long($_SERVER['REMOTE_ADDR']);
			//update
			$sql = "update ".DB_PREFIX."user set password='$password',rtime='$rtime',rip='$rip' where id=".$id;
			
			$affected = connect($sql);
	
			if($affected){
				header("content-type:text/html;charset=utf-8");
				echo "<script>alert('恭喜您，修改成功！')</script>";
				echo "<script>window.location.href='artlist.php'</script>";
			}else{
				header("content-type:text/html;charset=utf-8");
				echo "<script>alert('对不起，修改失败！')</script>";
				echo "<script>window.location.href='artlist.php'</script>";
			}
	}
	
