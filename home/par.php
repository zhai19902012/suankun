<?php
	include "./public/header.php";
	//加载配置文件
	include "../config/config.inc.php";
	
	//加载函数文件
	include "../common/connect.func.php";

	$id = $_GET['id'];

	
	$sql = "select * from ".DB_PREFIX."article where id=".$id;
	//下一篇
	$sql1="select * from ".DB_PREFIX."article where id>$id order by id asc limit 0,1";
	//上一篇
	$sql2="select * from ".DB_PREFIX."article where id<$id order by id desc limit 0,1";
	$data = connect($sql);
	$data1 = connect($sql1);
	$data2 = connect($sql2);
?>
<!-- start top_bg -->

<div class="wrap">
<div class="top_bg1">
		<img src="./resource/images/4.png" />
</div>
</div>
<!-- start main -->
<div class="wrap">
<div class="main">
		<div class="row details"><!-- start details -->
		<?php
		
			
			foreach($data as $v){
		?>
		<h3><?php echo $v['title']?></h3>
		<div class="content_left"><?php echo $v['content']?></div>
		<?php
			}
		?>
		<div class="read_more">
			<table>
				<tr >
					<td align="center" class="page" colspan="12">
        
        	<?php
        	if($data2==null){
        			echo "";
        		}else{
        		foreach ($data2 as  $value) {
        		
       		?>
        		<a href="?id=<?php echo $value['id']?>">上一篇</a>
        	<?php
        		}
        	}		
        	?>
        	
        	<?php
        		if($data1==null){
        			echo "";
        		}else{
        			foreach ($data1 as  $val){
        			
	        		
       		?>
        	<a href="?id=<?php echo $val['id']?>">下一篇</a>
        	<?php
        			}
        		}	
        	?>
        	
        	<a href="javascript:history.go(-1);">返回</a>
        
        	
        
        
        	</td>
				</tr>

			</table>
		</div>
	</div><!-- end  details -->
		<div class="clear"></div>
	</div>
</div>
<?php
	include "./public/footer.php";
?>