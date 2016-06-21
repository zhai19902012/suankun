<?php
	include "./public/header.php";

	//加载配置文件
	include "../config/config.inc.php";
	
	//加载函数文件
	include "../common/connect.func.php";

function replaceHtmlAndJs($document)
{
     $document = trim($document);
     if (strlen($document) <= 0) {
      return $document;
     }
     $search = array ("'<script[^>]*?>.*?</script>'si",  // 去掉 javascript
                   "'<[\/\!]*?[^<>]*?>'si",          // 去掉 HTML 标记
             //   "'([\r\n])[\s]+'",                // 去掉空白字符
             "'&(quot|#34);'i",                // 替换 HTML 实体
          "'&(amp|#38);'i",
          "'&(lt|#60);'i",
          "'&(gt|#62);'i",
          "'&(nbsp|#160);'i"
          );                    // 作为 PHP 代码运行
     $replace = array ("",
           "",
          // "\1",
           "\"",
           "&",
           "<",
           ">",
           ""
          );
     return @preg_replace ($search, $replace, $document);
}

	//分页
	
	//1.设置页大小
	$page_size = 4;
	
	//2.计算记录总数
	$sql = "select count(*) as c from ".DB_PREFIX."article where tid=1 ";
	$count = connect($sql);
	$count = $count[0]['c'];
	
	//判断总数
	if($count==0){
		echo "没有记录";
	}else{
	
	//3.计算总页数
	$page_count = ceil($count/$page_size);
	
	//4.获取当前页码
	$page_num = empty($_GET['page'])?1:$_GET['page'];
	
	//5.过滤越界
	if($page_num<1){
		$page_num = 1;
	}
	
	if($page_num>$page_count){
		$page_num = $page_count;
	}
	
	//6.组装limit子句
	
	$limit = " limit ".($page_num-1)*$page_size.",".$page_size;

	

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
		<div class="blog">
			<div class="col-md-8 blog_left">
			<ul>
	       		<li><a href="./skill.php">技术</a><span>|</span></li>
	       		<li><a href="./act.php">活动</a><span style="color:#ffffff;">|</span></li>
	       </ul>
			<?php

				$sql = "select * from ".DB_PREFIX."article where tid=1 order by ptime desc".$where.$limit;
				$data = connect($sql);
		

				foreach($data as $val){
			?>
				<h4><span><a href="./par.php?id=<?php echo $val['id']?>"><?php 
						if( strlen($val['title'])>60){
							echo mb_substr(replaceHtmlAndJs($val['title']),0,32,'utf-8')."...";
						}else{
							echo mb_substr(replaceHtmlAndJs($val['title']),0,32,'utf-8');
						}
				?></a><b>日期:<?php echo date("Y-m-d",$val['ptime'])?></b></span></h4>
				<div class="content_left content_font"><p>&nbsp;&nbsp;&nbsp;<?PHP
						if( strlen($val['content'])>300){
					 echo mb_substr(replaceHtmlAndJs($val['content']),0,300,'utf-8')."...";

					}else{
						 echo mb_substr(replaceHtmlAndJs($val['content']),0,300,'utf-8');
					}

				 ?></p></div>
			
				<div class="read_more">
					<a href="./par.php?id=<?php echo $val['id']?>"><button class="btn_style">查看更多...</button></a>
				</div>
			<?php
				}
			}
			?>
			<div class="read_more">
			<table>
			<tr style="color:#555555;">
				<td align="center" class="page" colspan="12">
        	<a href='?page=1<?php echo $link?>'>首页</a>
        	
        	<?php
        		if($page_num==1){
        			echo "第一页";
        		}else{


        	?>
        	<a href="?page=<?php echo $page_num-1 ?><?php echo $link?>">上一页</a>
		<?php
			}
		?>
		<?php
        		if($page_num==$page_count){
        			echo "最后一页";
        		}else{


        	?>
        	<a href="?page=<?php echo $page_num+1 ?><?php echo $link?><?php echo $link?>">下一页</a>
        <?php
			}
		?>
        	<a href='?page=<?php echo $page_count ?><?php echo $link?>'>尾页</a>
        	
        	本页共<?php echo ($page_num==$page_count&&$count%$page_size!=0)?($count%$page_size):$page_size ?>条
        总共<?php echo $count ?>条
        	共<?php echo $page_count ?>页
        	
        	当前第<?php echo $page_num ?>页
        	</td>
			</tr>
			</table>
		</div>
			</div>

			
		</div>
		 <div class="cont-grid-img img_style">
	     			 <h3><b>名师专题<span> / MESSAGE</span></b></h3>

				 <div class="abo">
	     		<a><img src="./resource/images/名师图片.jpg" alt=""></a>
	     		</div>
	     	</div>
		<div class="clear"></div>
	</div>
</div>
<?php
	include "./public/footer.php";
