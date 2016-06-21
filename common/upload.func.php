<?php
	
	//setfacl -m u:apache:rwx -R /www
	
	function upload(&$info,$dir = "./uploads/",$name='pic',$size = 3000000,$allow_mime = array('image/png','image/jpeg','image/gif','image/wbmp'),$allow_ext = array("gif",'jpeg','jpg','png','bmp')){
		
		//1.观察数组
		/*echo "<pre>";
		var_dump($_FILES);
		echo "</pre>";
		*/
		$upfile = $_FILES[$name];
		
		//2.判断错误
		if($upfile['error']>0){
			switch($upfile['error']){
				case 1:
					$info = "对不起，亲亲，您的文件太大了呢，我受不了了啦，超出了php.ini当中的upload_max_filesize的值";
					return false;
				case 2:
					$info ="对不起，小亲亲，您的上传的文件超过html表单当中的限制大小，看一下下是不是有点什么问题了呢，可以修改一下下么！";
					return false;
				case 3:
					$info = '亲，是不是停电啦，为啥只有一半啊，这个我木有办法用哦，感觉好失落哦！';
					return false;
				case 4:
					$info = "亲，奴家好失落哦，肿么能这样对待伦家么，为毛没有文件！";
					return false;
				case 6:
					$info = "亲，为啥临时文件夹我找不到了呢，突然发现我已经找了好久了！";
					return false;
				case 7:
				default:
					$info = "亲亲，伦家把您的文件放不进来了，临时文件夹不可写或者是磁盘已经满了呢，突然感觉不会再爱了呢！";
					return false;
			}
		}
		
		//3.判断文件大小
		
		if($upfile['size']>$size){
			$info = "亲，您的文件太大了呢！";
			return false;
		}
		
		//4.判断文件mime类型
		if(!in_array($upfile['type'],$allow_mime)){
			$info = "亲，请检查您的文件的mime类型是否被允许，运行的类型为：".join(",",$allow_mime);
			return false;
		}
		
		//5.判断文件的扩展名
		$ext = pathinfo($upfile['name'],PATHINFO_EXTENSION);
		if(!in_array($ext,$allow_ext)){
			$info = "对不起，亲，您的文件的扩展名不被允许，允许的扩展名为：".join(",",$allow_ext);
			return false;
		}
		
		//6.新建目录
		
		if(!file_exists($dir)){
			mkdir($dir,0755,true);
		}
		
		//7.新建随机文件名
		$name = md5(time().mt_rand()).".".$ext;
		
		//8.执行移动(核心代码)
		if(is_uploaded_file($upfile['tmp_name'])){
			if(move_uploaded_file($upfile['tmp_name'],$dir."/".$name)){
				$info = "恭喜您，亲，文件上传成功，好兴奋哦！";
				//9.保存信息
				return array('name'=>$upfile['name'],'new_name'=>$name,'ext'=>$ext,'size'=>$upfile['size'],'mime'=>$upfile['type']);
			}
		}
	}
	
	
	
	
	
	