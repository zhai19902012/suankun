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

   
    //分页
    
    //1.设置页大小
    $page_size = 5;
    
    //2.计算记录总数
    $sql = "select count(*) as c from ".DB_PREFIX."article".$where;
    $count = connect($sql);
    $count = $count[0]['c'];
    
    //判断总数
    if($count==0){
        echo "木有记录";
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
<h2><span style="font-size:14px;">内容列表
</h2> 
<form action="artdel.php" method="post">
<table id="rounded-corner">
    <thead>
    	<tr>
        	<th></th>
            <th>ID</th>
            <th>标题</th>
          
            <th>所属类别</th>
            <th>发表时间</th>
            <th>编辑</th>
            <th>删除</th>
        </tr>
    </thead>
         <tfoot>
        <style>
            .page a{
                color:#272822;
            }
        </style>
        <tr>
            <td align="center" class="page" colspan="12">
            <a href="?page=1<?php echo $link?>">首页</a>
            <span>|</span>
            <a href="?page=<?php echo $page_num-1 ?><?php echo $link?>">上一页</a>
            <span>|</span>
            <a href="?page=<?php echo $page_num+1 ?><?php echo $link?><?php echo $link?>">下一页</a>
            <span>|</span>
            <a href="?page=<?php echo $page_count ?><?php echo $link?>">尾页</a>
            <span>|</span>
            本页共<?php echo ($page_num==$page_count&&$count%$page_size!=0)?($count%$page_size):$page_size ?>条
            <span>|</span>
            总共<?php echo $count ?>条
            <span>|</span>
            共<?php echo $page_count ?>页
            <span>|</span>
            当前第<?php echo $page_num ?>页
            </td>
        </tr>
    </tfoot>
    <tbody>
    	<?php 
            //准备sql语句
            $sql="select a.id,a.content,a.title,a.ptime,t.name from ".DB_PREFIX."article as a left join ".DB_PREFIX."top as t on a.tid=t.id order by ptime desc".$where.$limit;
   
             $data=connect($sql);

    		foreach ($data as $val){

    	?>
    	<tr class="odd">
        	<td><input type="checkbox" name="id[]" value="<?php echo $val['id']?>" /></td>
            <td><?php echo $val['id'] ?></td>
            <td><?php echo mb_substr($val['title'],0,10,'utf-8') ?></td>
            <td><?php echo $val['name'] ?></td>
           <td><?php echo date('Y-m-d',$val['ptime']) ?></td>
            <td><a href="artmod.php?id=<?php echo $val['id']?>"><img src="./resource/images/edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="artdel.php?id=<?php echo $val['id']?>"><img src="./resource/images/trash.gif" alt="" title="" border="0" /></a></td>
        </tr>
    	<?php 
    		}
        }
    	?>
    </tbody>
</table>

	<div class="form_sub_buttons">
    <input type="submit" style="border:0;font-weight: bold;padding:8px 12px 8px 12px;margin:10px 10px 0 0;-webkit-border-radius: 4px;" class="button red" value="批量删除" />
    </div>  
</form>
<?php 
	include "./public/footer.php";	
?>