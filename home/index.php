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
	//查询最新的10条内容
	//1.只准备标题
	$sql = "select a.id,a.title,a.ptime,t.name from ".DB_PREFIX."article as a left join ".DB_PREFIX."top as t on a.tid=t.id order by ptime desc limit 12 ";
	
	$act = connect($sql);
	
	
?>
<!-- start slider -->
<div class="slider_bg">
<div class="wrap">
	 <div class="slider">
	      	<div class="slider-wrapper theme-default">
	            <div id="slider" class="nivoSlider">
	                <img src="./resource/images/poster5.png"  alt="" />
	                <img src="./resource/images/poster2.png"  alt="" />
	                <img src="./resource/images/poster3.png"  alt="" />
	                <img src="./resource/images/poster4.png" alt="" />
	                <img src="./resource/images/poster1.png"  alt="" />
	            </div>
	        </div>
   	</div>
</div>
</div>
<!-- start main -->
<div class="wrap">
	<div class="main">
		
		<!-- start grids_of_3 -->
		<div class="grids_of_3">
			<div class="grid1_of_3" >
				
				<h3><span>关于我们</span><a href="./about.php"><img src="./resource/images/more.png"/></a></h3>
				<div class="grid1_of_3_img">
				<img src="./resource/images/d (4).JPG" alt=""/>
				</div>
				<div class="about">

				&nbsp;&nbsp;&nbsp;&nbsp;重庆三坤投资管理有限公司是于2014年在获得工商部门合法审批同意后于中国西南核心之都——重庆成立的一家新兴投资管理类公司，注册资本为1000万 公司的投资、业务团队有着丰厚的从业经验，管理层具备丰富的公司管理和运营经验，公司主要投资管理人皆具备高度的金融专业知识...<a href="./about.php">详细>>></a>
				</div>
			</div>
			<div class="grid1_of_4">
				<h3><span>名师专题</span><a href="message.php"><img src="./resource/images/more.png"/></a></h3>
				<div class="grid1_of_4_title">
					<ul>
						<?php
							foreach($act as $data){
						?>
						<li><b>▶</b>
						<a href="./par.php?id=<?php echo $data['id']?>">[<?php echo $data['name']?>]
						<?php 
							
						if( strlen($data['title'])>30){
							echo mb_substr(replaceHtmlAndJs($data['title']),0,14,'utf-8')."...";
						}else{
							echo mb_substr(replaceHtmlAndJs($data['title']),0,14,'utf-8');
						}
				
						?>
						</a><span><?php echo date("Y/m/d",$data['ptime']) ?></span></li>
					<?php
							}	
					?>
					
					</ul>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="grid1_of_3 grid1_of_3_1" >
				
				<h3><span>联系我们</span><a href="./contact_us.php"> <img src="./resource/images/more.png"/></a></h3>
				<div class="grid1_of_3_img ">
				<img src="./resource/images/201082110122882199.jpg" alt=""/>
				</div>
				<div class="about">
				<ul>
					<li>地址:重庆江北观音桥未来国际36层</li>
					<li>座机:023-67716664</li>
					<li>电话:18223089117 13370763636</li>
					<li>邮箱:553274925@qq.com</li>
					<li>网站:<a href="http://www.cq-sk.com">http://www.cq-sk.com</a></li>
					<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=553274925&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:553274925:51" alt="免费咨询" title="免费咨询"/></a>
					<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=553274925&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:553274925:51" alt="免费咨询" title="免费咨询"/></a>
				</ul>
				</div>
			</div>
			<div class="clear"></div>
		</div>
			
	</div>
</div>
	<!-- start top_bg -->

<div class="wrap">
<div class="top_bg">
	<img src="./resource/images/bb.png" />
</div>
</div>
<div class="wrap">
<div class="main">
<h3 style="font-size:1.5em;font-weight:bold;border-bottom:1px solid #ccc;color:#474747;"><b>常见问题<span style="color:#474747;"></span></b></h3>
		<div class="blog">
			
				
				<div class="blog_para">
					<p class="para font_color">Q   股票配资的含义是什么?有什么意义?</p>
					<br/>
					<p class="para">&nbsp;&nbsp;&nbsp;&nbsp;A    股票配资也叫股票融资，很多投资者具有良好的盈利能力和风险控制能力，但受到自有资金不足的限制无法充分发挥自己的能力。而解决这一问题最直接的方法就是放大操作资金。股票配资就是为具备丰富炒股经验及风险控制能力的股民朋友提供放大其资金放大效     益的业务。意义在于：1、放大了收益、减低了风险；学到了知识，得到了服务；2、花费同样的时间，同样的精力，获取多倍的收益；3、牛市来临，不会因为急用资金而错失盈利机会；4、行情转机，不会因为缺少资金而错失补仓良机；5、危机来临，风险实时把     控，有效保住利润；6、融资额度高，5-10倍杠杆，无抵押无担保。
</p><hr/><p class="para font_color" >Q   如何选择配资公司？</p><br/>
<p class="para "> &nbsp;&nbsp;&nbsp;&nbsp;A   由于配资行业是最近几年才兴起的，完全根据市场经济供求所产生的需求，没有任何业内标准，配资公司的生存根本在于自律及诚信，在进行配资的时候，要选择诚信、保障、专业的公司。
     选择配资公司有以下几个建议：
      1、亲临现场，眼见为实。亲自去公司现场看看，公司是否真实存在，员工数量，营业执照，注册资本；
      2、客户口碑，成立时间。是否有配资老客户，口碑如何；
      3、现场实操，安全可靠。最好的办法就是自己去配资公司办公室操盘，配资公司都允许客户驻场操作。这样客户可以紧盯配资公司，减少资金存放风险。</p><hr/>
<p class="para font_color" >Q    股票配资合作流程？</p><br/>
<p class="para ">&nbsp;&nbsp;&nbsp;&nbsp;A    第一步：问询（对公司业务内容进行电话咨询或登录公司网站查询，客户应了解清楚操作流程及收费标准）；
     第二步：公司洽谈（客户上门洽谈，进一步了解公司实力，并配合客户查看经营证照）；
     第三步：签订合同（主动告知客户协议中注意事项，解答客户相关疑问）；
     第四步：账户交割（问询客户对账户详细需求，收取保证金，配合财务部交割账户）；
     第五步：跟踪服务（对客户疑难问题尽量解答详细。不得接受客户协议以外馈赠，不得增加服务费用）；
     第六步：解约还款（积极配合客户转账取款，协助风控部做好账目核对工作）。
</p><hr/>
					<div class="clear"></div>
				</div>
			 </div>
			</div>
		</div>
</div>


<div class="wrap">
<h3 style="font-size:1.5em;font-weight:bold;border-bottom:1px solid #ccc;color:#474747;"><b>友情链接<span style="color:#474747;"></span></b></h3>
		<ul id="flexiselDemo3">
			<li><a href="http://www.gpcxw.com/"><img src="./resource/images/爱股网.png" style="height:60px;"/></a></li>
			<li><a href="http://www.baidu.com/"><img src="./resource/images/百度.png" style="height:60px;"/></a></li>
			<li><a href="http://www.caijing.com.cn/"><img src="./resource/images/财经网.png" style="height:60px;"/></a></li>
			<li><a href="http://www.hexun.com/"><img src="./resource/images/和讯网.png" style="height:60px;"/></a></li>
			<li><a href="http://www.jrj.com.cn/"><img src="./resource/images/金融界.png" style="height:60px;"/></a></li>
			<li><a href="http://www.koubei.com/"><img src="./resource/images/口碑网.png" style="height:60px;"/></a></li>
			<li><a href="http://www.ce.cn/"><img src="./resource/images/中国经济网.png" style="height:60px;"/></a></li>
			<li><a href="http://www.xtwebtc.com/"><img src="./resource/images/莘彤网络.png" style="height:60px;"/></a></li>
		</ul>
	<script type="text/javascript">
$(window).load(function() {
	$("#flexiselDemo1").flexisel();
	$("#flexiselDemo2").flexisel({
		enableResponsiveBreakpoints: true,
    	responsiveBreakpoints: { 
    		portrait: { 
    			changePoint:480,
    			visibleItems: 1
    		}, 
    		landscape: { 
    			changePoint:640,
    			visibleItems: 2
    		},
    		tablet: { 
    			changePoint:768,
    			visibleItems: 3
    		}
    	}
    });

	$("#flexiselDemo3").flexisel({
		visibleItems: 5,
		animationSpeed: 1000,
		autoPlay: true,
		autoPlaySpeed: 3000,    		
		pauseOnHover: true,
		enableResponsiveBreakpoints: true,
    	responsiveBreakpoints: { 
    		portrait: { 
    			changePoint:480,
    			visibleItems: 1
    		}, 
    		landscape: { 
    			changePoint:640,
    			visibleItems: 2
    		},
    		tablet: { 
    			changePoint:768,
    			visibleItems: 3
    		}
    	}
    });
    
});
</script>

</div>

<?php
	include "./public/footer.php";
