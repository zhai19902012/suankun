<?php
	/*$width = 100;
	$height = 40;
	$type = 2; //0---纯数字  1-纯字母（大小写字母）  2---数字+字母（大小写）
	$length = 4;//验证字符数
	*/
	
	function vcode($width=100,$height=40,$type=0,$length=4){
		//1.创建画布资源
		$img = imagecreatetruecolor($width,$height);
		
		//2.分配颜色
		//背景色 #ffffff  #000000
		function qys($img){
			return imagecolorallocate($img,mt_rand(130,255),mt_rand(130,255),mt_rand(130,255));
		}
		
		//前景色
		function sys($img){
			return imagecolorallocate($img,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120));
		}
		
		//3.操作图像
			//1.先将画布填充为浅颜色
			imagefilledrectangle($img,0,0,$width,$height,qys($img));
		
			//2.需要准备随机字符串
			switch($type){
				case 0://纯数字
					$str = join(array_rand(range(0,9),$length));
					break;
				case 1://大小写字母
					$str = array_merge(range('a','z'),range('A','Z'));//合并成52个元素的数组
					shuffle($str);//将这个数组打乱
					$str = join(array_rand(array_flip($str),$length));
					break;
				case 2://产生数字+大小写字母的字符串
				default:
					$str = substr(str_shuffle(join(array_merge(range(0,9),range('a','z'),range('A','Z')))),0,$length);
					break;
			}
		
			//3.将字符串$str依次写入到画布当中
			for($i=0;$i<$length;$i++){
				imagettftext($img,20,mt_rand(-45,45),mt_rand(($width/$length)*$i+5,($width/$length)*($i+1)-15),mt_rand(20,$height-10),sys($img),'../common/MSYH.TTF',$str[$i]);
				//echo $str[$i];//将字符集当做数组处理
			}
			
			//4.加干扰素
			//1.加点
			for($i=0;$i<100;$i++){
				imagesetpixel($img,mt_rand(0,$width),mt_rand(0,$height),sys($img));
			}
			//2.加一些线段
			for($i=0;$i<3;$i++){
				imageline($img,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),sys($img));
			}
		
		//4.通知浏览器
		header("content-type:image/png");
		
		//5.显示图片
		imagepng($img);
		
		//6.回收资源
		imagedestroy($img);
		
		//返回字符串
		return $str;
	}
	