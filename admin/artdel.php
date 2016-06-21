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
	$id=$_REQUEST['id'];
	
	if(is_array($id)){
		$id=implode(',',$id);
	}
	
	//sql语句
	$sql="delete from cms_article where id in(".$id.")";
	
	$affected=connect($sql);
	
	//处理结果
	if($affected){
		header('content-type:text/html;charset=utf-8');
		echo "<script>alert('恭喜您，删除成功')</script>";
		echo "<script>window.location.href='artlist.php'</script>";
	}else{
		header('content-type:text/html;charset=utf-8');
		echo "<script>alert('对不起，删除失败')</script>";
		echo "<script>window.location.href='artlist.php'</script>";
	}