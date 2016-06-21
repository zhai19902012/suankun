<?php
	function connect($sql){
		//1.连接数据库
		$link = mysql_connect(DB_HOST,DB_USER,DB_PASS);
		
		//2.判断错误
		if(!$link){
			echo mysql_error();
			return false;
		}
		
		//3.设置字符集
		mysql_set_charset(DB_CHARSET);
		
		//4.选择数据库
		mysql_select_db(DB_NAME);
		
		//5.准备sql语句
		//6.发送sql语句
		$res = mysql_query($sql);
		
		//判断$res是否为资源类型
		if(is_resource($res)){
			//说明有结果集资源，解析
			while($row=mysql_fetch_assoc($res)){
				$data[] = $row;
			}
			mysql_free_result($res);
			mysql_close($link);
			return $data;
		}else{
			if($res){
				$count = mysql_affected_rows();
				mysql_close($link);
				//说明执行增删改成功，返回受影响行数
				return $count;
			}else{
				echo mysql_error();
				mysql_close($link);
				return false;
			}
		}
		
		//7.处理结果

		
		//8.关闭数据库连接
		
	}