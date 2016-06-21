<?php
	
	function thumb($name,$w,$h,$prefix='thumb_'){
	
		//1.获取相关参数，计算比例
		
		$info = getinfo($name);
		
		$width = $info['width'];
		$height = $info['height'];
		$res = $info['res'];
		
		//2.判断图片是横图还是竖图
		if($width>$height){
			//横图
			$bl = $height/$width;
			$h = $w*$bl;
		}else{
			//竖图
			$bl = $width/$height;
			$w = $h*$bl;
		}
		
		//3.创建一个画布，画布的宽高为要缩放的宽和高
		$img = imagecreatetruecolor($w,$h);
		
		//4.开始将大图等比例缩放至该画布当中
		imagecopyresampled($img,$res,0,0,0,0,$w,$h,$width,$height);
		
		//5.获取扩展名，生成新文件名，保存图像
		$ext = pathinfo($name,PATHINFO_EXTENSION);
		//$rand_name = $prefix.md5(time().mt_rand()).".".$ext;
		$name=dirname($name)."/".$prefix.basename($name);
		
		switch(strtolower($ext)){
			case 'jpg':
			case 'jpeg':
			case 'jpe':
				imagejpeg($img,$name);
				break;
			case 'png':
				imagepng($img,$name);
				break;
			case 'gif':
				imagegif($img,$name);
				break;
			case 'bmp':
			case 'wbmp':
				imagewbmp($img,$name);
				break;
		}
		
		//销毁资源
		imagedestroy($img);
		imagedestroy($res);
	}
	
	
	
	
	
	
	
	