<?php

session_start();
	//判断是否登陆，如果已经登陆才允许进入到该界面，否则跳转到登陆界面
	if(empty($_SESSION['admin']['islogin'])||$_SESSION['admin']['islogin']!=1){
		//用户没有登录
		header("location:./login.php");
		exit;
	}

	header("content-type:text/html;charset=utf-8");
		//1.接收数据
		include "../config/config.inc.php";
		include "../common/connect.func.php";
	
		$id = $_POST['id'];
		//2.查询判断在cms_profile表当中是否拥有对应的用户信息
		$sql = "select uid from cms_profile where uid=".$id;
		$data = connect($sql);
		
		//3.如果有，执行update更新
		if(is_array($data)){
		
			//执行文件上传
			//加载上传头像文件
			include "../common/upload.func.php";
			$data = upload($info,'../resource/uploads/pic/','pic');
		 	
			//加载剪裁文件
			include "../common/cut.func.php";
			cut("../resource/uploads/pic/".$data['new_name'],236,65,721,546);
			
			
			//加载缩放文件,三次缩略
			include "../common/thumb.func.php";
			thumb("../resource/uploads/pic/cut_".$data['new_name'],120,120,"big_");
			thumb("../resource/uploads/pic/cut_".$data['new_name'],100,100,"middle_");
			thumb("../resource/uploads/pic/cut_".$data['new_name'],120,120,"small_");
		
			$_POST['pic'] = $data['new_name'];
		
			unset($_POST['id']);
			unset($_POST['username']);
			foreach($_POST as $key=>$val){
				$set .= $key."='".$val."',";
			}
			$set = rtrim($set,",");
			
			//update
			$sql = "update ".DB_PREFIX."profile set ".$set." where uid=".$id;
			$affected = connect($sql);
			if($affected){
				echo "<script>alert('恭喜您，修改成功！')</script>";
				echo "<script>window.location.href='userlist.php'</script>";
			}else{
				echo "<script>alert('对不起，修改失败！')</script>";
				echo "<script>window.location.href='userlist.php'</script>";
			}
		}
		
		//4.如果没有，执行insert插入
		if(is_null($data)){
			unset($_POST['id']);
			unset($_POST['username']);
			$_POST['uid'] = $id;
			$keys = implode(",",array_keys($_POST));
			$values = "'".join("','",array_values($_POST))."'";
			//insert
			$sql = "insert into ".DB_PREFIX."profile($keys) values($values)";
			$affected = connect($sql);
			if($affected){
				echo "<script>alert('恭喜您，修改成功！')</script>";
				echo "<script>window.location.href='userlist.php'</script>";
			}else{
				echo "<script>alert('对不起，修改失败！')</script>";
				echo "<script>window.location.href='userlist.php'</script>";
			}
		}