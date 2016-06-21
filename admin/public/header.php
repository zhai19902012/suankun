<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>三坤投资后台管理系统</title>
<link rel="stylesheet" type="text/css" href="./resource/css/style.css" />
<!-- jQuery file -->
<script src="./resource/js/jquery.min.js"></script>
<script src="./resource/js/jquery.tabify.js" type="text/javascript" charset="utf-8"></script>
<!--富文本编辑器-->
<script charset="utf-8" src="./resource/kindeditor/kindeditor.js"></script> 
<script charset="utf-8" src="./resource/kindeditor/lang/zh_CN.js"></script>

 <script> 
         var editor;          
    KindEditor.ready(function(K) {                  
    editor = K.create('#editor_id');         
    }); 
</script>
<script type="text/javascript">
var $ = jQuery.noConflict();
$(function() {
$('#tabsmenu').tabify();
$(".toggle_container").hide(); 
$(".trigger").click(function(){
	$(this).toggleClass("active").next().slideToggle("slow");
	return false;
});
});
</script>
</head>
<body>
<!-- start header -->
<div class="header_bg">
<div class="wrap">
    <div class="header">
        <div class="logo">
            <a href="index.php" class="logo_1"><img style="height:90px;" src="./resource/images/logo.png" alt=""/> </a>
           
        </div>
        <div class="social-icons">  
           欢迎您回来<?php echo $_SESSION['admin']['username']?>,<a href="./userset.php" class="settings">用户设置</a> <a href="logout.php" class="logout">退出</a> 
          
        </div>
        <div class="clear"></div>
    </div>
</div>
</div>
<!-- start header -->
<div class="header_btm">
<div class="wrap">
     <div id="nav">
        <ul>
            <li><a href="./index.php">首页</a></li>
            <li><a href="./useradd.php">添加管理员</a></li>
            <li><a href="./userlist.php">管理员列表</a></li>
            <li><a href="artadd.php">添加内容</a></li>
            <li><a href="./artlist.php">内容列表</a></li>
        </ul>
    </div>
  
</div>

</div>
<div id="panelwrap">
	<div class="center_content"> 
	<div id="right_wrap">
    <div id="right_content"> 
	
	
	
	
	
	
	