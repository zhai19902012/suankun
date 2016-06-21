<?php 

session_start();
	//判断是否登陆，如果已经登陆才允许进入到该界面，否则跳转到登陆界面
	if(empty($_SESSION['admin']['islogin'])||$_SESSION['admin']['islogin']!=1){
		//用户没有登录
		header("location:./login.php");
		exit;
	}

	//加载头文件
	include "./public/header.php";
	
	//加载配置文件
	include "../config/config.inc.php";
	
	//加载函数文件
	include "../common/connect.func.php";
	
	//接收数据
	$id=$_GET['id'];
	
	//sql语句
	  $sql="select a.id,a.content,a.title,a.ptime,t.name from ".DB_PREFIX."article as a left join ".DB_PREFIX."top as t on a.tid=t.id where a.id=".$id ;
	$data=connect($sql);
	
	
?>

<ul id="tabsmenu" class="tabsmenu">
        <li class="active"><a href="#tab1">内容管理</a></li>
    </ul>
    <div id="tab1" class="tabcontent">
      
        <div class="form">
            <form action="artdomod.php" method="POST">
            <div class="form_row">
            <label>类别:</label>

         <?php 
            	foreach($data as $key=>$val){
				
            ?>
            <input type="hidden" name="id" value="<?php echo $val['id']?>" />
            <input type="text" class="form_input" name="name" value="<?php echo $val['name'] ?> " />
            </div>
            
	            <div class="form_row">
	            <label>标题:</label>
	            <input type="text" class="form_input" name="title" value="<?php echo $val['title']?>" />
	            </div>
	   
	            <div class="form_row">
	            <label>内容:</label>
	            <textarea  id="editor_id" class="form_textarea" name="content"><?php echo $val['content']?></textarea>
	            </div>
 
	         <?php 
	         	}
	         ?>
            
             
            <div class="form_row">
            <input type="submit" class="form_submit" value="修改" />
            </div> 
            <div class="clear"></div>
            </form>
        </div>
    </div>
    
<?php 
	//加载脚文件
	include "./public/footer.php";
?>