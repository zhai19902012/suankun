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

		$id = $_POST['id'];
		//2.查询判断在cms_top表当中是否拥有对应的用户信息
		$sql="select id from cms_article where id=".$id;
	
		$data = connect($sql);
		
		if(is_array($data)){
			unset($_POST['name']);
			foreach($_POST as $key=>$val){
				$set .= $key."='".$val."',";
			}
			 $set = rtrim($set,",");
			//update
			$sql = "update ".DB_PREFIX."article set ".$set." where id=".$id;
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
	
