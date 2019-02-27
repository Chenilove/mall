@extends('home.public')
@section('title','商品搜索--尤洪')
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
                                    <a href='{{ asset("/home/query?cates={$v->id}") }}'>{{$v->name}}</a>|
                                    @endforeach
                                @endforeach
                                </div>
                            </div>
                            <div class="zj_r">
                                <a href="#"><img src="{{asset('/status/home/images/n_img1.jpg')}}" width="236" height="200" /></a>
                                <a href="#"><img src="{{asset('/status/home/images/n_img2.jpg')}}" width="236" height="200" /></a>
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
    <!--[if IE 6]>
    <script src="/status/home/js/iepng.js" type="text/javascript"></script>
        <script type="text/javascript">
           EvPNG.fix('div, ul, img, li, input, a'); 
        </script>
    <![endif]-->
    
	
	<!-- 分页样式 -->
	<style>
	        #pull_right{
            text-align:center;
        }
        .pull-right {
            /*float: left!important;*/
        }
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }
        .pagination > li {
            display: inline;
        }
        .pagination > li > a,
        .pagination > li > span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #428bca;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .pagination > li:first-child > a,
        .pagination > li:first-child > span {
            margin-left: 0;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }
        .pagination > li:last-child > a,
        .pagination > li:last-child > span {
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }
        .pagination > li > a:hover,
        .pagination > li > span:hover,
        .pagination > li > a:focus,
        .pagination > li > span:focus {
            color: #2a6496;
            background-color: #eee;
            border-color: #ddd;
        }
        .pagination > .active > a,
        .pagination > .active > span,
        .pagination > .active > a:hover,
        .pagination > .active > span:hover,
        .pagination > .active > a:focus,
        .pagination > .active > span:focus {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #428bca;
            border-color: #428bca;
        }
        .pagination > .disabled > span,
        .pagination > .disabled > span:hover,
        .pagination > .disabled > span:focus,
        .pagination > .disabled > a,
        .pagination > .disabled > a:hover,
        .pagination > .disabled > a:focus {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
        .clear{
            clear: both;
        }
    </style>


@endsection
@section('content')
<!-- <div class="i_bg"> -->
	<!-- <div class="postion">
	<span class="fl">全部 &gt; 美妆个护 &gt; 香水 &gt; </span>
	<span class="n_ch">
	<span class="fl">品牌：<font>香奈儿</font></span>
	<a href="#"><img src="/status/home/images/s_close.gif"></a>
	</span>
</div>
 -->
	<!--Begin 筛选条件 Begin--><!-- <div class="content mar_10">
<table border="0" class="choice" style="width:100%; font-family:'宋体'; margin:0 auto;" cellspacing="0" cellpadding="0">
<tbody>
<tr valign="top">
	<td width="70">
				&nbsp; 品牌：
	</td>
	<td class="td_a">
		<a href="#" class="now">香奈儿（Chanel）</a><a href="#">迪奥（Dior）</a><a href="#">范思哲（VERSACE）</a><a href="#">菲拉格慕（Ferragamo）</a><a href="#">兰蔻（LANCOME）</a><a href="#">爱马仕（HERMES）</a><a href="#">卡文克莱（Calvin Klein）</a><a href="#">古驰（GUCCI）</a><a href="#">宝格丽（BVLGARI）</a><a href="#">阿迪达斯（Adidas）</a><a href="#">卡尔文·克莱恩（CK）</a><a href="#">凌仕（LYNX）</a><a href="#">大卫杜夫（Davidoff）</a><a href="#">安娜苏（Anna sui）</a><a href="#">阿玛尼（ARMANI）</a><a href="#">娇兰（Guerlain）</a>
	</td>
</tr>
<tr valign="top">
	<td>
				&nbsp; 价格：
	</td>
	<td class="td_a">
		<a href="#">0-199</a><a href="#" class="now">200-399</a><a href="#">400-599</a><a href="#">600-899</a><a href="#">900-1299</a><a href="#">1300-1399</a><a href="#">1400以上</a>
	</td>
</tr>
<tr>
	<td>
				&nbsp; 类型：
	</td>
	<td class="td_a">
		<a href="#">女士香水</a><a href="#">男士香水</a><a href="#">Q版香水</a><a href="#">组合套装</a><a href="#">香体走珠</a><a href="#">其它</a>
	</td>
</tr>
<tr>
	<td>
				&nbsp; 香型：
	</td>
	<td class="td_a">
		<a href="#">浓香水</a><a href="#">香精Parfum香水</a><a href="#">淡香精EDP淡香水</a><a href="#">香露EDT</a><a href="#">古龙水</a><a href="#">其它</a>
	</td>
</tr>
</tbody>
</table>
</div>
 -->
	<!--End 筛选条件 End-->
<div class="content mar_20">
<div class="l_history">
	<div class="his_t">
		<span class="fl">猜你喜欢</span>
		<!-- <span class="fr"><a href="#">清空</a></span> -->
	</div>
	<ul>
		@foreach($like as $row)
		<li>
			<div class="img">
				<a href="/home/goods/{{$row->goods_id}}"><img src="{{$row->img[0]->url}}" width="185" height="162"></a>
			</div>
			<div class="name">
				<a href="/home/goods/{{$row->goods_id}}">{{$row->goods_name}}</a>
			</div>
			<div class="price">
				<font>￥<span>{{$row->price}}</span></font> &nbsp; 18R
			</div>
		</li>
		@endforeach
	</ul>
</div>
<div class="l_list">
	<!-- <div class="list_t">
		<span class="fl list_or">
		<a href="#" class="now">默认</a>
		<a href="#">
		<span class="fl">库存</span>
		<span class="i_up">库存从低到高显示</span>
		<span class="i_down">库存从高到低显示</span>
		</a>
		<a href="#">
		<span class="fl">价格</span>
		<span class="i_up">价格从低到高显示</span>
		<span class="i_down">价格从高到低显示</span>
		</a>
		<a href="#">新品</a>
		</span>
		<span class="fr">共发现{{count($goods)}}件</span>
	</div> -->
	<div class="list_c">
		<ul class="cate_list">
			@foreach($goods as $row)
			<li>
				<div class="img">
					<a href="/home/goods/{{$row->goods_id}}"><img src="{{$row->img[0]->url}}" width="210" height="185"></a>
				</div>
				<div class="price">
					<font>￥<span>{{$row->price}}</span></font> &nbsp; 26R
				</div>
				<div class="name">
					<a href="/home/goods/{{$row->goods_id}}">{{$row->goods_name}}</a>
				</div>
				<div class="carbg">
					<a href="javascript:void(0)" class="ss"  
					@if(in_array($row->goods_id,$collect)) style='background:url(/status/home/images/heart_h.png) no-repeat 10px center' @else style='background:url(/status/home/images/heart.png) no-repeat 10px center' @endif onclick="collection(this)"  
					>收藏</a><span style="display:none">{{$row->goods_id}}</span>
					<a href="{{url('/home/goods/'.$row->goods_id)}}" class="j_car">查看详情</a>
				</div>
			</li>
			@endforeach
		</ul>
		<div class="pages">
			<!-- <a href="#" class="p_pre">上一页</a><a href="#" class="cur">1</a><a href="#">2</a><a href="#">3</a>...<a href="#">20</a><a href="#" class="p_pre">下一页</a> -->
			<div id="pull_right">
		        <div class="pull-right">
		          {!!$goods->appends($request)->render()!!}
		        </div>
		 	</div>
		</div>
	</div>
</div>
</div>
<!--Begin Footer Begin -->
<div class="b_btm_bg bg_color">
<div class="b_btm">
	<table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
	<tbody>
	<tr>
		<td width="72">
			<img src="/status/home/images/b1.png" width="62" height="62">
		</td>
		<td>
			<h2>正品保障</h2>
					正品行货  放心购买
		</td>
	</tr>
	</tbody>
	</table>
	<table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
	<tbody>
	<tr>
		<td width="72">
			<img src="/status/home/images/b2.png" width="62" height="62">
		</td>
		<td>
			<h2>满38包邮</h2>
					满38包邮 免运费
		</td>
	</tr>
	</tbody>
	</table>
	<table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
	<tbody>
	<tr>
		<td width="72">
			<img src="/status/home/images/b3.png" width="62" height="62">
		</td>
		<td>
			<h2>天天低价</h2>
					天天低价 畅选无忧
		</td>
	</tr>
	</tbody>
	</table>
	<table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
	<tbody>
	<tr>
		<td width="72">
			<img src="/status/home/images/b4.png" width="62" height="62">
		</td>
		<td>
			<h2>准时送达</h2>
					收货时间由你做主
		</td>
	</tr>
	</tbody>
	</table>
</div>
</div>
<div class="b_nav">
<dl>
	<dt><a href="#">新手上路</a></dt>
	<dd><a href="#">售后流程</a></dd>
	<dd><a href="#">购物流程</a></dd>
	<dd><a href="#">订购方式</a></dd>
	<dd><a href="#">隐私声明</a></dd>
	<dd><a href="#">推荐分享说明</a></dd>
</dl>
<dl>
	<dt><a href="#">配送与支付</a></dt>
	<dd><a href="#">货到付款区域</a></dd>
	<dd><a href="#">配送支付查询</a></dd>
	<dd><a href="#">支付方式说明</a></dd>
</dl>
<dl>
	<dt><a href="#">会员中心</a></dt>
	<dd><a href="#">资金管理</a></dd>
	<dd><a href="#">我的收藏</a></dd>
	<dd><a href="#">我的订单</a></dd>
</dl>
<dl>
	<dt><a href="#">服务保证</a></dt>
	<dd><a href="#">退换货原则</a></dd>
	<dd><a href="#">售后服务保证</a></dd>
	<dd><a href="#">产品质量保证</a></dd>
</dl>
<dl>
	<dt><a href="#">联系我们</a></dt>
	<dd><a href="#">网站故障报告</a></dd>
	<dd><a href="#">购物咨询</a></dd>
	<dd><a href="#">投诉与建议</a></dd>
</dl>
<div class="b_tel_bg">
	<a href="#" class="b_sh1">新浪微博</a>
	<a href="#" class="b_sh2">腾讯微博</a>
	<p>
            服务热线：
		<br>
		<span>400-123-4567</span>
	</p>
</div>
<div class="b_er">
	<div class="b_er_c">
		<img src="/status/home/images/er.gif" width="118" height="118">
	</div>
	<img src="/status/home/images/ss.png">
</div>
</div>
<div class="btmbg">
<div class="btm">
        	备案/许可证编号：蜀ICP备12009302号-1-www.dingguagua.com   Copyright © 2015-2018 尤洪商城网 All Rights Reserved. 复制必究 , Technical Support: Dgg Group 
	<br>
	<img src="/status/home/images/b_1.gif" width="98" height="33"><img src="/status/home/images/b_2.gif" width="98" height="33"><img src="/status/home/images/b_3.gif" width="98" height="33"><img src="/status/home/images/b_4.gif" width="98" height="33"><img src="/status/home/images/b_5.gif" width="98" height="33"><img src="/status/home/images/b_6.gif" width="98" height="33">
</div>
</div>
<!--End Footer End -->
</div>
@endsection
@section('js')
    <script type="text/javascript" src="/status/home/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="/status/home/js/menu.js"></script>    
	<script type="text/javascript" src="/status/home/js/lrscroll_1.js"></script>
	<script type="text/javascript" src="/status/home/js/n_nav.js"></script>
    <script type="text/javascript" src="/status/home/js/jquery-1.8.2.min.js"></script>
<script>
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
