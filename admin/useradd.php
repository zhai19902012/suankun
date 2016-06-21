<?php
session_start();
    //判断是否登陆，如果已经登陆才允许进入到该界面，否则跳转到登陆界面
    if(empty($_SESSION['admin']['islogin'])||$_SESSION['admin']['islogin']!=1){
        //用户没有登录
        header("location:./login.php");
        exit;
    }

	include "./public/header.php";
?>

	<ul id="tabsmenu" class="tabsmenu">
        <li class="active"><a href="#tab1">会员管理</a></li>
    </ul>
    <div id="tab1" class="tabcontent">
 
        <div class="form">
            <form action="userdoadd.php" method="post">
            <div class="form_row">
            <label>用户名:</label>
            <input type="text" class="form_input" name="username" />
            </div>
             
            <div class="form_row">
            <label>密码:</label>
            <input type="password" class="form_input" name="password" />
            </div>
            
             <div class="form_row">
            <label>确认密码:</label>
            <input type="password" class="form_input" name="repass" />
            </div>
   
            <div class="form_row">
            <input type="submit" class="form_submit" value="会员注册" />
            </div> 
            </form>
            <div class="clear"></div>
        </div>
    </div>

<?php
	include "./public/footer.php";
?>