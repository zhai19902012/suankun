<?php 
session_start();
	//判断是否登陆，如果已经登陆才允许进入到该界面，否则跳转到登陆界面
	if(empty($_SESSION['admin']['islogin'])||$_SESSION['admin']['islogin']!=1){
		//用户没有登录
		header("location:./login.php");
		exit;
	}

	include "./public/header.php";
	
	//加载配置文件
	include "../config/config.inc.php";
	
	//加载函数文件
	include "../common/connect.func.php";
	
	//准备sql语句
	
	$sql = "select id,name from ".DB_PREFIX."top";
	
	$data=connect($sql);
	
	
?>
    <ul id="tabsmenu" class="tabsmenu">
        <li class="active"><a href="#tab1">内容管理</a></li>
    </ul>
    <div id="tab1" class="tabcontent">
        <div class="form">
            <form action="artdoadd.php" method="post">
            <div class="form_row">
            <label>类别:</label>
            <select class="form_select" name="tid">
            	<option>请选择</option>
	            <?php 
	            	foreach($data as $art){
						//查询当前顶级分类下的所有二级分类
						$sql = "select id,name from ".DB_PREFIX."top where id=".$art['id'];
						$son = connect($sql);
	            ?>
            	
	           <?php 
		           foreach($son as $c){
		           	echo '<option value="'.$c['id'].'">'.$c['name'].'</option>';
		           }
	            }	
	            ?>
            </select>
            </div>
             
            <div class="form_row">
            <label>标题:</label>
            <input type="text" class="form_input" name="title" />
            </div>
   
             <div class="form_row">

            <label>内容:</label>
            <textarea id="editor_id" class="form_textarea" name="content"></textarea>
            </div>
            
           
            
            
            <div class="form_row">
            <input type="submit" class="form_submit" value="添加" />
            </div> 
            </form>
            <div class="clear"></div>
        </div>
    </div>

<?php 
	include "./public/footer.php";
?>