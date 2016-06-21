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
        <li class="active"><a href="#tab1">设置</a></li>
    </ul>
    <div id="tab1" class="tabcontent">
        <div class="form">
            <form action="setdoadd.php" method="post">
             <input type="hidden" name="id" value="<?php echo $_SESSION['admin']['id']?>" />
            <div class="form_row">
            <label>原始密码密码:</label>
            <input type="password" class="form_input" name="password" />
            </div>
             
            <div class="form_row">
            <label>新密码:</label>
            <input type="password" class="form_input" name="newpassword" />
            </div>
            
             <div class="form_row">
            <label>确认新密码:</label>
            <input type="password" class="form_input" name="nrepass" />
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