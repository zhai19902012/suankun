<?php
session_start();
	//判断是否登陆，如果已经登陆才允许进入到该界面，否则跳转到登陆界面
	if(empty($_SESSION['admin']['islogin'])||$_SESSION['admin']['islogin']!=1){
		//用户没有登录
		header("location:./login.php");
		exit;
	}


	header("content-type:text/html;charset=utf-8");
	//加载配置文件
	include "../config/config.inc.php";
	
	//加载函数文件
	include "../common/connect.func.php";
	//接收参数，使用$_REQUEST即可接收get数组，又可接收post数组
	$id = $_REQUEST['id'];
	//判断$id的类型，即可判断出当前操作是get传参还是post提交
	//id为数组，那么就是post提交
	//id为字符串，那么就是get传参
	if(is_array($id)){
		//post提交
		$id = implode(",",$id);
	}

	//1.接收参数
	//$id = $_GET['id'];

	//对用户执行删除
	$sql = "delete from cms_user where id in(".$id.")";
	
	//发送sql
	$affected = connect($sql);
	
	//判断结果
	if($affected){
		//接着删除cms_profile表当中的记录
		$sql = "delete from cms_profile where uid in(".$id.")";
		//执行发送
		connect($sql);
		//输出结果
		echo "<script>alert('恭喜您，删除成功！');</script>";
		echo "<script>window.location.href='userlist.php'</script>";
	}else{
		echo "<script>alert('对不起，删除失败！');</script>";
		echo "<script>window.location.href='userlist.php'</script>";
	}
	