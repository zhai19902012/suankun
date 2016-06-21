<?php

session_start();
	//判断是否登陆，如果已经登陆才允许进入到该界面，否则跳转到登陆界面
	if(empty($_SESSION['admin']['islogin'])||$_SESSION['admin']['islogin']!=1){
		//用户没有登录
		header("location:./login.php");
		exit;
	}

	include "./public/header.php";

	//1.查询用户的相关数据 cms_user cms_profile
	
	//加载配置文件
	include "../config/config.inc.php";
	
	//加载函数文件
	include "../common/connect.func.php";
	
	//接收数据
	$id = $_GET['id'];
	
	//准备sql语句
	$sql = "select u.username,p.truename,p.age,p.sex,p.edu,p.signed,p.pic,p.email,p.address,p.telephone from cms_profile as p right join cms_user as u on u.id=p.uid where u.id=".$id;
	
	//发送sql语句
	$user = connect($sql);
	
	$user = $user[0];
		
	//2.将相关数据显示到表单当中
?>	
	<ul id="tabsmenu" class="tabsmenu">
        <li class="active"><a href="#tab1">会员管理</a></li>
    </ul>
    <div id="tab1" class="tabcontent">
        <h3>会员信息修改</h3>
		<form action="userdomod.php" method="post" enctype="multipart/form-data">
        <div class="form">
			<div class="form_row">
            <label>UID:</label>
            <input type="text" class="form_input" name="id" value="<?php echo $id ?>" style="border:0;background:none;" readonly />
            </div>
			
			<div class="form_row">
            <label>用户名:</label>
            <input type="text" class="form_input" name="username" value="<?php echo $user['username'] ?>" style="border:0;background:none;" readonly />
            </div>
			
            <div class="form_row">
            <label>真实姓名:</label>
            <input type="text" class="form_input" name="truename" value="<?php echo $user['truename'] ?>" />
            </div>
			
			<div class="form_row">
            <label>年龄:</label>
            <input type="text" class="form_input" name="age" value="<?php echo $user['age'] ?>" />
            </div>
			
			<div class="form_row">
            <label>性别:</label>
			<?php
				foreach($radio_sex as $key=>$item){
					if($user['sex']==$key){
						$checked = "checked";
					}else{
						$checked = "";
					}
			?>
					<input type="radio" class="form_radio" name="sex" value="<?php echo $key?>" <?php echo $checked ?> /><?php echo $item?>
            <?php
				}
			?>
            </div>
             
            <div class="form_row">
            <label>Email:</label>
            <input type="text" class="form_input" name="email" value="<?php echo $user['email'] ?>" />
            </div>
            
            <div class="form_row">
            <label>学历:</label>
            <select class="form_select" name="edu">
			<?php
				foreach($option_edu as $key=>$item){
					if($user['edu']==$key){
						$selected = "selected";
					}else{
						$selected = "";
					}
			?>
					<option value="<?php echo $key?>" <?php echo $selected ?>><?php echo $item?></option>
			<?php
				}
			?>
            </select>
            </div>
            
             <div class="form_row">
            <label>个性签名:</label>
            <textarea class="form_textarea" name="signed"><?php echo $user['signed'] ?></textarea>
            </div>
			
			<div class="form_row">
            <label>地址:</label>
            <input type="text" class="form_input" name="address" value="<?php echo $user['address'] ?>" />
            </div>
			
			<div class="form_row">
            <label>电话:</label>
            <input type="text" class="form_input" name="telephone" value="<?php echo $user['telephone'] ?>" />
            </div>
			
			<div class="form_row">
            <label>头像:</label>
            <input type="file" class="form_input" name="pic"style="border:0;background:none;" />
            </div>
			
			<div class="form_row">
            <label>当前头像:</label>
            <img src="../resource/uploads/pic/small_cut_<?php echo $user['pic'] ?>" width="70" height="70" />
            </div>
			
            <div class="form_row">
            <input type="submit" class="form_submit" value="修改" />
            </div> 
            <div class="clear"></div>
        </div>
		</form>
    </div>
<?php
	//3.提交操作userdomod.php
	include "./public/footer.php";