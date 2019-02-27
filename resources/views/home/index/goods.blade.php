@extends('home.public')
@section('title','商品详情--尤洪')
   
@section('nav')
<!--Begin Menu Begin-->
<div class="menu_bg">
	<div class="menu">
    	<!--Begin 商品分类详情 Begin-->    
    	<div class="nav">
        	<div class="nav_t">全部商品分类</div>
            <div class="leftNav none">
                <ul>   
                <?php $num=0 ?>
                <!-- 数字(垃圾模板页面需要一个变量,无逻辑关系,可无视) -->
                @foreach($cates as $value)
                    <li>
                    	<div class="fj">
                        	<span class="n_img">
                            <span>
                                <img src="{{$value->img}}"/></span>
                            </span>
                            <span class="fl">{{$value->name}}</span>
                        </div>
                        <div class="zj" style="top:{{$num}}px;">
                        {{$num = $num-40}}
                            
                            <div class="zj_l">
                                <div class="zj_l_c">
                                @foreach($value->dev as $val)
                                    <h2>{{$val->name}}</h2>
                                    @foreach($val->dev as $v)
                                    <a href="/home/query?cates={{$v->id}}">{{$v->name}}</a>|
                                    @endforeach
                                @endforeach
                                </div>
                            </div>
                            <div class="zj_r">
                                <a href="#"><img src="/status/home/images/n_img1.jpg" width="236" height="200" /></a>
                                <a href="#"><img src="/status/home/images/n_img2.jpg" width="236" height="200" /></a>
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>            
            </div>
        </div>  
        <!--End 商品分类详情 End-->                                                     
    	<ul class="menu_r">                                                                                                                                               
        	<li><a href="/">首页</a></li>
            
        </ul>
        <div class="m_ad">中秋送好礼！</div>
    </div>
</div>
<!--End Menu End--> 
@endsection
@section('link')
	<link type="text/css" rel="stylesheet" href="/status/home/css/style.css" />
	<link rel="stylesheet" type="text/css" href="/status/home/css/ShopShow.css" />
    <link rel="stylesheet" type="text/css" href="/status/home/css/MagicZoom.css" />
    <!--[if IE 6]>
    <script src="/status/home/js/iepng.js" type="text/javascript"></script>
        <script type="text/javascript">
           EvPNG.fix('div, ul, img, li, input, a'); 
        </script>
    <![endif]-->
    <style>
    	.tsSelectImg:hover{
			cursor:pointer;
    	}
    </style>
    @endsection
@section('content')
<div class="i_bg">
	<div class="postion">
    	<!-- <sp	an class="fl">全部 > 美妆个护 > 香水 > 迪奥 > 迪奥真我香水</span> -->
    </div>    
    <div class="content">
    	                    
        <div id="tsShopContainer">
            <div id="tsImgS">
	            <a href="{{$goods->img[0]->url}}" class="MagicZoom" id="MagicZoom">
	            	<img class="pcdetails img" src="{{$goods->img[0]->url}}" width="390" height="390" />
	            </a>
            </div>
            <div id="tsPicContainer">
                <div id="tsImgSArrL"></div>
            	<div>
                	@foreach($goods->img as$row)
                    <li onmouseenter="clickIMG(this)" rel="MagicZoom" class="tsSelectImg" style="float:left;margin-left: 15px"><img src="{{$row->url}}" tsImgS="{{$row->url}}" width="79" height="79" /></li>
                    @endforeach
                </div>
                <div id="tsImgSArrR"></div>
            </div>
            <!-- <img class="MagicZoomLoading" width="16" height="16" src="/status/home/images/loading.gif" alt="Loading..." />				 -->
        </div>
        <form action="{{url('/home/cart')}}" method="post">
        {{CSRF_field()}}
        <div class="pro_des">
        	<div class="des_name">
            	<p class="pctitle">{{$goods->goods_name}}</p>
                “开业巨惠，不光低价，“真”才靠谱！
            </div>
            <div class="des_price">
            	本店价格：<b>￥{{$goods->price}}</b><br />
                消费积分：<span>28R</span>
            </div>
            @foreach($goods->spec as $key=>$value)
            <div class="des_choice">
            	<span class="fl">{{$key}}：</span>
                <ul>
                <?php $first=true ?>
                	@foreach($value as $v)
                	<label onclick="clicked(this)">
	                	<!-- <li class="checked"> -->
	                	<li class="@if($first) checked <?php $first=false ?> @endif">
		                	{{$v->attr_name}}
		                	<div class="ch_img">
		                		<input type="radio" name="{{$key}}" value="{{$v->attr_name}}" style="display: none" checked>
		                	</div>
                		</li>
                	</label>
                	@endforeach
                </ul>
            </div>
            @endforeach
            <div class="des_share">
            	<div class="d_sh">
                	分享
                    <div class="d_sh_bg">
                    	<!-- <a href="#"><img src="/status/home/images/sh_1.gif" /></a> -->
                        <a onclick="shareTo('qzone')"><img src="/status/home/images/sh_2.gif" /></a>
                        <a onclick="shareTo('sina')"><img src="/status/home/images/sh_3.gif" /></a>
                    </div>
                </div>
                 <!-- onclick="ShowDiv('MyDiv','fade')" -->
                <div class="d_care" @if(in_array($goods->goods_id,$collect)) style='background:url(/status/home/images/heart_h.png) no-repeat 10px center' @else style='background:url(/status/home/images/heart.png) no-repeat 10px center' @endif onclick='collection(this)'>
                    &nbsp;&nbsp;
                    <a>收藏商品</a>
                </div><span style="display: none">{{$goods->goods_id}}</span>
            </div>
            <div class="des_join">
            	<!-- <div class="j_nums"> -->
                	<!-- <input type="text" value="1" name="" class="n_ipt" /> -->
                    <!-- <input type="button" value="" onclick="addUpdate(jq(this));" class="n_btn_1" /> -->
                    <!-- <input type="button" value="" onclick="jianUpdate(jq(this));" class="n_btn_2" />    -->
                <!-- </div> -->
                <!-- <span class="fl"><a onclick="ShowDiv_1('MyDiv1','fade1')"><img src="/status/home/images/j_car.png" /></a></span> -->
                <span class="fl"><button type="submit" class="btn btn-danger btn-lg" ><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;&nbsp;加入购物车</button></span>
                <!-- <img src="/status/home/images/j_car.png" /> -->
            </div>  
            <input type="hidden" name="goods_id" value="{{$goods->goods_id}}"> 
            </form>         
        </div>    
        
        <div class="s_brand">
        	<div class="s_brand_img"><img src="{{$brand->img}}" width="188" height="132" /></div>
            <div class="s_brand_c">
                <!-- <a href="/home/brand/{{$brand->brand_id}}">进入品牌专区</a> -->
                {{$brand->brand_name}}
            </div>
        </div>    
        
        
    </div>
    <div class="content mar_20">
    	<div class="l_history">
        	<div class="fav_t">用户还喜欢</div>
        	<ul>
        	@foreach($like as $row)
            	<li>
                    <div class="img"><a href="/home/goods/{{$row->goods_id}}"><img src="{{$row->img[0]->url}}" width="185" height="162" /></a></div>
                	<div class="name"><a href="/home/goods/{{$row->goods_id}}">{{$row->goods_name}}</a></div>
                    <div class="price">
                    	<font>￥<span>{{$row->price}}</span></font> &nbsp; 18R
                    </div>
                </li>
               @endforeach
        	</ul>
        </div>
        <div class="l_list">        	
            <div class="des_border">
                <div class="des_tit">
                	<ul>
                    	<li class="current"><a href="#p_attribute">商品属性</a></li>
                        <li><a href="#p_details">商品详情</a></li>
                        <li><a href="#p_comment">商品评论</a></li>
                    </ul>
                </div>
                <div class="des_con" id="p_attribute">
                	
                	<table border="0" align="center" style="width:100%; font-family:'宋体'; margin:10px auto;" cellspacing="0" cellpadding="0">
                      <tr>
                        <td>商品名称：{{$goods->goods_name}}</td>
                        <td>商品编号：{{$goods->numbering}}</td>
                        <td>品牌： {{$brand->brand_name}}</td>
                        <td>上架时间：{{date($goods->added_time)}} </td>
                      </tr>
                      <tr>
                        <td>商品毛重：{{$goods->weight}}</td>
                        <td>商品产地：{{$goods->country}}</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>                                               
                                            
                        
                </div>
          	</div>  
            
            <div class="des_border" id="p_details">
                <div class="des_t">商品详情</div>
                <div class="des_con">
                	{!!$goods->descr!!}
                    
                </div>
          	</div>  
            
            <div class="des_border" id="p_comment">
            	<div class="des_t">商品评论</div>
                
                <!-- <table border="0" class="jud_tab" cellspacing="0" cellpadding="0"> -->
                  <!-- <tr>
                    <td width="175" class="jud_per">
                    	<p>80.0%</p>好评度
                    </td>
                    <td width="300">
                    	<table border="0" style="width:100%;" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="90">好评<font color="#999999">（80%）</font></td>
                            <td><img src="/status/home/images/pl.gif" align="absmiddle" /></td>
                          </tr>
                          <tr>
                            <td>中评<font color="#999999">（20%）</font></td>
                            <td><img src="/status/home/images/pl.gif" align="absmiddle" /></td>
                          </tr>
                          <tr>
                            <td>差评<font color="#999999">（0%）</font></td>
                            <td><img src="/status/home/images/pl.gif" align="absmiddle" /></td>
                          </tr>
                        </table>
                    </td>
                    <td width="185" class="jud_bg">
                    	 购买过雅诗兰黛第六代特润精华露50ml的顾客，在收到商品才可以对该商品发表评论 -->
                    <!-- </td>
                    <td class="jud_bg">您可对已购买商品进行评价<br /><a href="/home/myorder"><img src="/status/home/images/btn_jud.gif" /></a></td>
                  </tr>
                </table> -->
                
                
                				
                <table border="0" class="jud_list" style="width:100%; margin-top:30px;" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                        <th width="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;用户</th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;买家晒图</th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;买家评论</th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;卖家回复</th>
                    </tr>
                    @foreach($assess as $row)
                      <tr valign="top">
                        <td width="160"><img src="/status/home/images/peo1.jpg" width="20" height="20" align="absmiddle" />&nbsp;{{$row->username}}</td>
                        <!-- <td width="180">
                        	颜色分类：<font color="#999999">粉色</font> <br />
                            型号：<font color="#999999">50ml</font>
                        </td> -->
                        <td>
                            @foreach($row->img as $i)
                                <img src="{{$i}}" width="50px">
                            @endforeach
                        </td>
                        <td>
                        	{{$row->user_content}} <br />
                            <font color="#999999">{{$row->created_at}}</font>
                        </td>
                        <td>
                            {{$row->business_content}} <br />
                            <font color="#999999">{{$row->created_at}}</font>
                        </td>
                      </tr>
                    @endforeach
                </table>

                	
                    
                <div class="pages">
                    {{$assess->render()}}
                </div>
                
          	</div>
            
            
        </div>
    </div>
    
    
    <!--Begin 弹出层-收藏成功 Begin-->
    <!-- <div id="fade" class="black_overlay"></div>
    <div id="MyDiv" class="white_content">             
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv('MyDiv','fade')"><img src="/status/home/images/close.gif" /></span>
            </div>
            <div class="notice_c">
           		
                <table border="0" align="center" style="margin-top:;" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td width="40"><img src="/status/home/images/suc.png" /></td>
                    <td>
                    	<span style="color:#3e3e3e; font-size:18px; font-weight:bold;">您已成功收藏该商品</span><br />
                    	<a href="#">查看我的关注 >></a>
                    </td>
                  </tr>
                  <tr height="50" valign="bottom">
                  	<td>&nbsp;</td>
                    <td><a href="#" class="b_sure">确定</a></td>
                  </tr>
                </table>
                    
            </div>
        </div>
    </div>     -->
    <!--End 弹出层-收藏成功 End-->
    
    
    <!--Begin 弹出层-加入购物车 Begin-->
    <!-- <div id="fade1" class="black_overlay"></div>
    <div id="MyDiv1" class="white_content">             
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv_1('MyDiv1','fade1')"><img src="/status/home/images/close.gif" /></span>
            </div>
            <div class="notice_c">
           		
                <table border="0" align="center" style="margin-top:;" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td width="40"><img src="/status/home/images/suc.png" /></td>
                    <td>
                    	<span style="color:#3e3e3e; font-size:18px; font-weight:bold;">宝贝已成功添加到购物车</span><br />
                    	购物车共有1种宝贝（3件） &nbsp; &nbsp; 合计：1120元
                    </td>
                  </tr>
                  <tr height="50" valign="bottom">
                  	<td>&nbsp;</td>
                    <td><a href="#" class="b_sure">去购物车结算</a><a href="#" class="b_buy">继续购物</a></td>
                  </tr>
                </table>
                    
            </div>
        </div>
    </div>     -->
    <!--End 弹出层-加入购物车 End-->
@endsection
@section('js')
	<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/status/home/js/menu.js"></script>    
	<script type="text/javascript" src="/status/home/js/lrscroll_1.js"></script>   
	<script type="text/javascript" src="/status/home/js/n_nav.js"></script>
    <script type="text/javascript" src="/status/home/js/MagicZoom.js"></script>
    <script type="text/javascript" src="/status/home/js/num.js">
    	var jq = jQuery.noConflict();
    </script>
    <!-- <script type="text/javascript" src="/status/home/js/p_tab.js"></script> -->
    <script type="text/javascript" src="/status/home/js/shade.js"></script>
	<!-- <script src="/status/home/js/ShopShow.js"></script> -->
	<!-- <script type="text/javascript" src="/status/home/js/jquery-1.8.2.min.js"></script> -->
    <!-- <script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script> -->
	<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<script>
	function clickIMG(obj)
	{
		var src = $(obj).find('img').attr('src');
		$('#tsImgS').find('a').attr('href',src).find('img').attr('src',src);
	}
	function clicked(obj)
	{
		$(obj).siblings().children('li').removeClass();
		$(obj).find('li').addClass('checked');
	}

    //一键分享
    function shareTo(stype){
    var ftit = '';
    var flink = '';
    var lk = '';
    //获取文章标题
    ftit = $('.pctitle').text();
    //获取网页中内容的第一张图片
    flink = $('.pcdetails img').eq(0).attr('src');
    if(typeof flink == 'undefined'){
        flink='';
    }
    //当内容中没有图片时，设置分享图片为网站logo
    if(flink == ''){
        lk = 'http://'+window.location.host+'/static/images/logo.png';
    }
    //如果是上传的图片则进行绝对路径拼接
    if(flink.indexOf('/upload/') != -1) {
        lk = 'http://'+window.location.host+flink;
    }
    //百度编辑器自带图片获取
    if(flink.indexOf('ueditor') != -1){
        lk = flink;
    }
    //qq空间接口的传参
    if(stype=='qzone'){
        window.open('https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+document.location.href+'?sharesource=qzone&title='+ftit+'&pics='+lk+'&summary='+document.querySelector('meta[name="description"]').getAttribute('content'));
    }
    //新浪微博接口的传参
    if(stype=='sina'){
        window.open('http://service.weibo.com/share/share.php?url='+document.location.href+'?sharesource=weibo&title='+ftit+'&pic='+lk+'&appkey=2706825840');
    }
    //qq好友接口的传参
    if(stype == 'qq'){
        window.open('http://connect.qq.com/widget/shareqq/index.html?url='+document.location.href+'?sharesource=qzone&title='+ftit+'&pics='+lk+'&summary='+document.querySelector('meta[name="description"]').getAttribute('content')+'&desc=尤洪 --买你所买 ');
    }
    //生成二维码给微信扫描分享，php生成，也可以用jquery.qrcode.js插件实现二维码生成
    if(stype == 'wechat'){
        window.open('http://zixuephp.net/inc/qrcode_img.php?url=http://zixuephp.net/article-1.html');
    }
}

//ajax收藏
    function collection(obj)
    {
        var goods_id = $(obj).next().text();
        $.get('/home/goods-collection/'+goods_id,{},function(data){
            if (data == 1) {
                //收藏成功
                $(obj).css('background','url(/status/home/images/heart_h.png) no-repeat 10px center');
                alert('收藏成功');
            }else if(data == 2){
                //取消成功
                $(obj).css('background','url(/status/home/images/heart.png) no-repeat 10px center')
                alert('已取消收藏');
            }else{
                //请先登录
                alert('请您先登录');
                window.location.href = '/homelogin';
            }
        });
    }
</script>
@endsection