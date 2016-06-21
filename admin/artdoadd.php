<?php 
session_start();
	//判断是否登陆，如果已经登陆才允许进入到该界面，否则跳转到登陆界面
	if(empty($_SESSION['admin']['islogin'])||$_SESSION['admin']['islogin']!=1){
		//用户没有登录
		header("location:./login.php");
		exit;
	}

	//加载配置文件
	include "../config/config.inc.php";
	
	//加载函数文件
	include "../common/connect.func.php";
	
	//接收数据
	$title=$_POST['title'];
	$content=$_POST['content'];
	$tid=$_POST['tid'];
	$ptime=$_SERVER['REQUEST_TIME'];
	
	//判断
	if(empty($title)){
		header('content-type:text/html;charset=utf-8');
		echo "<script>alert('标题不能为空')</script>";
		echo "<script>window.location.href='artadd.php'</script>";
	}
	
	if(empty($tid)){
		header('content-type:text/html;charset=utf-8');
		echo "<script>alert('文章分类不能为空')</script>";
		echo "<script>window.location.href='artadd.php'</script>";
	}
	if(empty($content)){
		header('content-type:text/html;charset=utf-8');
		echo "<script>alert('内容不能为空')</script>";
		echo "<script>window.location.href='artadd.php'</script>";
	}
	
	
	//sql语句
	$sql="insert into cms_article(title,content,ptime,tid) values('$title','$content','$ptime','$tid')";

	$affected=connect($sql);
	if($affected){
		header('content-type:text/html;charset=utf-8');
		echo "<script>alert('恭喜您，添加成功')</script>";
		echo "<script>window.location.href='artlist.php'</script>";
	}else{
		header('content-type:text/html;charset=utf-8');
		echo "<script>alert('对不起，添加失败')</script>";
		echo "<script>window.location.href='artadd.php'</script>";
	}
	