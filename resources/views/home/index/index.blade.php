@extends('home.public')
@section('title')
尤洪 买你所买
@endsection
@section('link')
<link type="text/css" rel="stylesheet" href="/status/home/css/style.css" />
    <!--[if IE 6]>
    <script src="/status/home/js/iepng.js" type="text/javascript"></script>
        <script type="text/javascript">
           EvPNG.fix('div, ul, img, li, input, a'); 
        </script>
    <![endif]-->    
    <script type="text/javascript" src="/status/home/js/jquery-1.11.1.min_044d0927.js"></script>
    <script type="text/javascript" src="/status/home/js/jquery.bxslider_e88acd1b.js"></script>
    
    <script type="text/javascript" src="/status/home/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/status/home/js/menu.js"></script>    
        
    <script type="text/javascript" src="/status/home/js/select.js"></script>
    
    <script type="text/javascript" src="/status/home/js/lrscroll.js"></script>
    
    <script type="text/javascript" src="/status/home/js/iban.js"></script>
    <script type="text/javascript" src="/status/home/js/fban.js"></script>
    <script type="text/javascript" src="/status/home/js/f_ban.js"></script>
    <script type="text/javascript" src="/status/home/js/mban.js"></script>
    <script type="text/javascript" src="/status/home/js/bban.js"></script>
    <script type="text/javascript" src="/status/home/js/hban.js"></script>
    <script type="text/javascript" src="/status/home/js/tban.js"></script>
    
    <script type="text/javascript" src="/status/home/js/lrscroll_1.js"></script>
    
@endsection
@section('content')
<!--Begin Menu Begin-->
<div class="menu_bg">
	<div class="menu">
    	<!--Begin 商品分类详情 Begin-->    
    	<div class="nav">
        	<div class="nav_t">全部商品分类</div>
            <div class="leftNav ">
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
<div class="i_bg bg_color">
	<div class="i_ban_bg">
		<!--Begin Banner Begin-->
    	<div class="banner">    	
            <div class="top_slide_wrap">
                <ul class="slide_box bxslider">
                @foreach($Rotation as $row)
                    <li> 
                        <a href="{{$row->url}}">{!!$row->pic!!}</a>
                    </li>
                @endforeach
                </ul>
                <div class="op_btns clearfix">
                    <a href="#" class="op_btn op_prev"><span></span></a>
                    <a href="#" class="op_btn op_next"><span></span></a>
                </div>        
            </div>
        </div>
        <script type="text/javascript">
        //var jq = jQuery.noConflict();
        (function(){
            $(".bxslider").bxSlider({
                auto:true,
                prevSelector:jq(".top_slide_wrap .op_prev")[0],nextSelector:jq(".top_slide_wrap .op_next")[0]
            });
        })();
        </script>
        <!--End Banner End-->
        <div class="inews">
        	<div class="news_t">
            	<span class="fr"><a href="#">更多 ></a></span>新闻资讯
            </div>
            <ul>
                @foreach($Notice as $row)
                <li><span>[{{$row->tishi}}]</span><a href="/gg/?id={{$row->id}}">{{$row->title}}</a></li>
                @endforeach
            </ul>
            <div class="charge_t">
            	话费充值<div class="ch_t_icon"></div>
            </div>
            <form>
            <table border="0" style="width:205px; margin-top:10px;" cellspacing="0" cellpadding="0">
              <tr height="35">
                <td width="33">号码</td>
                <td><input type="text" value="" class="c_ipt" /></td>
              </tr>
              <tr height="35">
                <td>面值</td>
                <td>
                	<select class="jj" name="city">
                      <option value="0" selected="selected">100元</option>
                      <option value="1">50元</option>
                      <option value="2">30元</option>
                      <option value="3">20元</option>
                      <option value="4">10元</option>
                    </select>
                    <span style="color:#ff4e00; font-size:14px;">￥99.5</span>
                </td>
              </tr>
              <tr height="35">
                <td colspan="2"><input type="submit" value="立即充值" class="c_btn" /></td>
              </tr>
            </table>
            </form>
        </div>
    </div>
    <!--Begin 热门商品 Begin-->
    <div class="content mar_10">
    	<div class="h_l_img">
        	<div class="img"><a href="/home/goods/{{$like[0]->goods_id}}"><img src="{{$like[0]->img[2]->url}}" width="188" height="188" /></a></div>
            <div class="pri_bg">
                <span class="price fl">￥{{$like[0]->price}}</span>
                <span class="fr">16R</span>
            </div>
        </div>
        <div class="hot_pro">        	
        	<div id="featureContainer">
                <div id="feature">
                    <div id="block">
                        <div id="botton-scroll">
                            <ul class="featureUL">
                            @foreach($like as $row)
                                <li class="featureBox">
                                    <div class="box">
                                    	<div class="h_icon"><img src="{{$row->img[0]->url}}
                                        " width="50" height="50" /></div>
                                        <div class="imgbg">
                                        	<a href="/home/goods/{{$row->goods_id}}"><img src="{{$row->img[1]->url}}" width="160" height="136" /></a>
                                        </div>                                        
                                        <div class="name">
                                        	<a href="/home/goods/{{$row->goods_id}}">
                                            <h2>{{$row->brand_name}}</h2>
                                            {{$row->goods_name}}
                                            </a>
                                        </div>
                                        <div class="price">
                                            <font>￥<span>{{$row->price}}</span></font> &nbsp; 26R
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                    <a class="h_prev" href="javascript:void();">Previous</a>
                    <a class="h_next" href="javascript:void();">Next</a>
                </div>
            </div>
        </div>
    </div>
    <!--Begin 限时特卖 Begin-->
    <div class="i_t mar_10">
    	<span class="fl">限时特卖</span>
        <span class="i_mores fr"><a href="#">更多</a></span>
    </div>
    <div class="content">
    	<div class="i_sell">
            <div id="imgPlay">
                <ul class="imgs" id="actor">
                @foreach($hot[0]->img as $i)
                    <li><a href="/home/goods/{{$i->goods_id}}"><img src="{{$i->url}}" width="211" height="357" /></a></li>
                @endforeach
                </ul>
                <div class="previ">上一张</div>
                <div class="nexti">下一张</div>
            </div>        
        </div>
        <div class="sell_right">
        	<div class="sell_1">
            	<div class="s_img"><a href="/home/goods/{{$hot[1]->goods_id}}"><img src="{{$hot[1]->img[1]->url}}" width="185" height="155" /></a></div>
            	<div class="s_price">￥<span>{{round($hot[1]->price)}}</span></div>
                <div class="s_name">
                	<h2><a href="/home/goods/{{$hot[1]->goods_id}}">{{$hot[1]->goods_name}}</a></h2>
                    倒计时：<span class="hours">10</span> 时 <span class="minute">00</span> 分 <span class="second">00</span> 秒
                </div>
            </div>
            <div class="sell_2">
            	<div class="s_img"><a href="/home/goods/{{$hot[2]->goods_id}}"><img src="{{$hot[2]->img[1]->url}}" width="185" height="155" /></a></div>
            	<div class="s_price">￥<span>{{round($hot[2]->price)}}</span></div>
                <div class="s_name">
                	<h2><a href="/home/goods/{{$hot[2]->goods_id}}">{{$hot[2]->goods_name}}</a></h2>
                    倒计时：<span class="hours">10</span> 时 <span class="minute">00</span> 分 <span class="second">00</span> 秒
                </div>
            </div>
            <div class="sell_b1">
            	<div class="sb_img"><a href="/home/goods/{{$hot[3]->goods_id}}"><img src="{{$hot[3]->img[1]->url}}" width="242" height="356" /></a></div>
            	<div class="s_price">￥<span>{{round($hot[3]->price)}}</span></div>
                <div class="s_name">
                	<h2><a href="/home/goods/{{$hot[3]->goods_id}}">{{$hot[3]->goods_name}}</a></h2>
                    倒计时：<span class="hours">10</span> 时 <span class="minute">00</span> 分 <span class="second">00</span> 秒
                </div>
            </div>
            <div class="sell_3">
            	<div class="s_img"><a href="/home/goods/{{$hot[4]->goods_id}}"><img src="{{$hot[4]->img[1]->url}}" width="185" height="155" /></a></div>
            	<div class="s_price">￥<span>{{round($hot[4]->price)}}</span></div>
                <div class="s_name">
                	<h2><a href="/home/goods/{{$hot[4]->goods_id}}">{{$hot[4]->goods_name}}</a></h2>
                    倒计时：<span class="hours">10</span> 时 <span class="minute">00</span> 分 <span class="second">00</span> 秒
                </div>
            </div>
            <div class="sell_4">
            	<div class="s_img"><a href="/home/goods/{{$hot[5]->goods_id}}"><img src="{{$hot[5]->img[1]->url}}" width="185" height="155" /></a></div>
            	<div class="s_price">￥<span>{{round($hot[5]->price)}}</span></div>
                <div class="s_name">
                	<h2><a href="/home/goods/{{$hot[5]->goods_id}}">{{$hot[5]->goods_name}}</a></h2>
                    倒计时：<span class="hours">10</span> 时 <span class="minute">00</span> 分 <span class="second">00</span> 秒
                </div>
            </div>
            <div class="sell_b2">
            	<div class="sb_img"><a href="/home/goods/{{$hot[6]->goods_id}}"><img src="{{$hot[6]->img[1]->url}}" width="242" height="356" /></a></div>
            	<div class="s_price">￥<span>{{round($hot[6]->price)}}</span></div>
                <div class="s_name">
                	<h2><a href="/home/goods/{{$hot[6]->goods_id}}">{{$hot[6]->goods_name}}</a></h2>
                    倒计时：<span class="hours">10</span> 时 <span class="minute">00</span> 分 <span class="second">00</span> 秒
                </div>
            </div>
        </div>
    </div>
    <!--End 限时特卖 End-->
    <div class="content mar_20">
        @foreach($Advert as $row)
         @if($row->id==4)
         {!!$row->descr!!}
         @endif
         @endforeach
    </div>
    <!-- <div class="content mar_20">
    	<img src="/status/home/images/mban_1.jpg" width="1200" height="110" />
    </div> -->
           <!--Begin 数码家电 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">1F</span>
        <span class="fl">数码家电</span>                                
        <!-- <span class="i_mores fr"><a href="#">手机</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">苹果</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">华为手机</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">洗衣机</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">数码配件</a></span> -->                                               
    </div>
    <div class="content">
        <div class="tel_left">
            <div class="tel_ban">
                <div id="imgPlay6">
                    <ul class="imgs" id="actor6">
                    @foreach($digital[0]->img as $i)
                        <li><a href="/home/goods/{{$digital[0]->goods_id}}"><img src="{{$i->url}}" width="211" height="286" /></a></li>
                    @endforeach
                    </ul>
                    <div class="prev_t">上一张</div>
                    <div class="next_t">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <a href="javascript:viod(0)">价格:</a> <a href="javascript:viod(0)">{{round($digital[0]->price)}}<b>￥</b></a><br>
                    <a href="javascript:viod(0)">重量:</a> <a href="javascript:viod(0)">{{$digital[0]->weight}} g</a><br>
                    <a href="javascript:viod(0)">产地:</a> <a href="javascript:viod(0)">{{$digital[0]->country}}</a><br>
                    <a href="javascript:viod(0)">喜爱:</a> <a href="javascript:viod(0)">{{$digital[0]->like}}人</a><br>
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                @foreach($digital as $row)
                <li>
                    <div class="name"><a href="/home/goods/{{$row->goods_id}}">{{$row->goods_name}}</a></div>
                    <div class="price">
                        <font>￥<span>{{$row->price}}</span></font> &nbsp; 26R
                    </div>
                    <div class="img"><a href="/home/goods/{{$row->goods_id}}"><img src="{{$row->img[0]->url}}" width="185" height="155" /></a></div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="/home/query?cates=73"><img src="/status/home/images/tel_b1.jpg" width="260" height="220" /></a></li>
                <li><a href="/home/query?cates=73"><img src="/status/home/images/tel_b2.jpg" width="260" height="220" /></a></li>
            </ul>
        </div>
    </div>    
    <!--End 数码家电 End-->
	<!--Begin 进口 生鲜 Begin-->
    <div class="i_t mar_10">
    	<span class="floor_num">2F</span>
    	<span class="fl">进口 <b>·</b> 生鲜</span>                
        <!-- <span class="i_mores fr"><a href="#">进口咖啡</a>&nbsp; &nbsp; &nbsp; <a href="#">进口酒</a>&nbsp; &nbsp; &nbsp; <a href="#">进口母婴</a>&nbsp; &nbsp; &nbsp; <a href="#">新鲜蔬菜</a>&nbsp; &nbsp; &nbsp; <a href="#">新鲜水果</a></span> -->
    </div>
    <div class="content">
    	<div class="fresh_left">
        	<div class="fre_ban">
            	<div id="imgPlay1">
                    <ul class="imgs" id="actor1">
                    @foreach($fresh[8]->img as $i)
                        <li><a href="/home/goods/{{$fresh[8]->goods_id}}"><img src="{{$i->url}}" width="211" height="286" /></a></li>
                    @endforeach
                    </ul>
                    <div class="prevf">上一张</div>
                    <div class="nextf">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
            	<div class="fresh_txt_c">
                    <a href="javascript:viod(0)">价格:</a> <a href="javascript:viod(0)">{{round($fresh[8]->price)}}<b>￥</b></a><br>
                    <a href="javascript:viod(0)">重量:</a> <a href="javascript:viod(0)">{{$fresh[8]->weight}} g</a><br>
                    <a href="javascript:viod(0)">产地:</a> <a href="javascript:viod(0)">{{$fresh[8]->country}}</a><br>
                	<a href="javascript:viod(0)">喜爱:</a> <a href="javascript:viod(0)">{{$fresh[8]->like}}人</a><br>
                </div>
            </div>
        </div>
        <div class="fresh_mid">
        	<ul>
                @foreach($fresh as $row)
            	<li>
                	<div class="name"><a href="/home/goods/{{$row->goods_id}}">{{$row->goods_name}}</a></div>
                    <div class="price">
                    	<font>￥<span>{{$row->price}}</span></font> &nbsp; 26R
                    </div>
                    <div class="img"><a href="/home/goods/{{$row->goods_id}}"><img src="{{$row->img[0]->url}}" width="185" height="155" /></a></div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
        	<ul>
            	<li><a href="/home/query?cates=69"><img src="/status/home/images/fre_b1.jpg" width="260" height="220" /></a></li>
                <li><a href="/home/query?cates=69"><img src="/status/home/images/fre_b2.jpg" width="260" height="220" /></a></li>
            </ul>
        </div>
    </div>    
    <!--End 进口 生鲜 End-->
    <div class="content mar_20">
        @foreach($Advert as $row)
         @if($row->id==6)
         {!!$row->descr!!}
         @endif
         @endforeach    
    </div>  
    
    <!--Begin 个人美妆 Begin-->
    <div class="i_t mar_10">
    	<span class="floor_num">3F</span>
    	<span class="fl">个人美妆</span>                                
        <!-- <span class="i_mores fr"><a href="#">洗发护发</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">面膜</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">洗面奶</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">香水</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">沐浴露</a></span>   -->              
    </div>
    <div class="content">
    	<div class="make_left">
        	<div class="make_ban">
            	<div id="imgPlay3">
                    <ul class="imgs" id="actor3">
                    @foreach($shampoo[0]->img as $i)
                        <li><a href="/home/goods/{{$shampoo[0]->goods_id}}"><img src="{{$i->url}}" width="211" height="286" /></a></li>
                    @endforeach
                    </ul>
                    <div class="prev_m">上一张</div>
                    <div class="next_m">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
            	<div class="fresh_txt_c">
                	<a href="javascript:viod(0)">价格:</a> <a href="javascript:viod(0)">{{round($shampoo[0]->price)}}<b>￥</b></a><br>
                    <a href="javascript:viod(0)">重量:</a> <a href="javascript:viod(0)">{{$shampoo[0]->weight}} g</a><br>
                    <a href="javascript:viod(0)">产地:</a> <a href="javascript:viod(0)">{{$shampoo[0]->country}}</a><br>
                    <a href="javascript:viod(0)">喜爱:</a> <a href="javascript:viod(0)">{{$shampoo[0]->like}}人</a><br>
                </div>
            </div>
        </div>
        <div class="fresh_mid">
        	<ul>
            	@foreach($shampoo as $row)
                <li>
                    <div class="name"><a href="/home/goods/{{$row->goods_id}}">{{$row->goods_name}}</a></div>
                    <div class="price">
                        <font>￥<span>{{$row->price}}</span></font> &nbsp; 26R
                    </div>
                    <div class="img"><a href="/home/goods/{{$row->goods_id}}"><img src="{{$row->img[0]->url}}" width="185" height="155" /></a></div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
        	<ul>
            	<li><a href="/home/query?cates=78"><img src="/status/home/images/make_b1.jpg" width="260" height="220" /></a></li>
                <li><a href="/home/query?cates=78"><img src="/status/home/images/make_b2.jpg" width="260" height="220" /></a></li>
            </ul>
        </div>
    </div>    
    <!--End 个人美妆 End-->
    <div class="content mar_20">
    	<img src="/status/home/images/mban_1.jpg" width="1200" height="110" />
    </div>
    <!--Begin 母婴玩具 Begin-->
    <div class="i_t mar_10">
    	<span class="floor_num">4F</span>
    	<span class="fl">母婴玩具</span>                                
        <!-- <span class="i_mores fr"><a href="#">营养品</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">孕妈背带裤</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">儿童玩具</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">婴儿床</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">喂奶器</a></span>  -->                              
    </div>
    <div class="content">
    	<div class="baby_left">
        	<div class="baby_ban">
            	<div id="imgPlay4">
                    <ul class="imgs" id="actor4">
                    @foreach($toy[0]->img as $i)
                        <li><a href="/home/goods/{{$toy[0]->goods_id}}"><img src="{{$i->url}}" width="211" height="286" /></a></li>
                    @endforeach
                    </ul>
                    <div class="prev_b">上一张</div>
                    <div class="next_b">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
            	<div class="fresh_txt_c">
                	<a href="javascript:viod(0)">价格:</a> <a href="javascript:viod(0)">{{round($toy[0]->price)}}<b>￥</b></a><br>
                    <a href="javascript:viod(0)">重量:</a> <a href="javascript:viod(0)">{{$toy[0]->weight}} g</a><br>
                    <a href="javascript:viod(0)">产地:</a> <a href="javascript:viod(0)">{{$toy[0]->country}}</a><br>
                    <a href="javascript:viod(0)">喜爱:</a> <a href="javascript:viod(0)">{{$toy[0]->like}}人</a><br>
                </div>
            </div>
        </div>
        <div class="fresh_mid">
        	<ul>
            	@foreach($toy as $row)
                <li>
                    <div class="name"><a href="/home/goods/{{$row->goods_id}}">{{$row->goods_name}}</a></div>
                    <div class="price">
                        <font>￥<span>{{$row->price}}</span></font> &nbsp; 26R
                    </div>
                    <div class="img"><a href="/home/goods/{{$row->goods_id}}"><img src="{{$row->img[0]->url}}" width="185" height="155" /></a></div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
        	<ul>
            	<li><a href="/home/query?cates=80"><img src="/status/home/images/baby_b1.jpg" width="260" height="220" /></a></li>
                <li><a href="/home/query?cates=80"><img src="/status/home/images/baby_b2.jpg" width="260" height="220" /></a></li>
            </ul>
        </div>
    </div>    
    <!--End 母婴玩具 End-->
    <!--Begin 家居生活 Begin-->
    <div class="i_t mar_10">
    	<span class="floor_num">5F</span>
    	<span class="fl">家居生活</span>                                
        <!-- <span class="i_mores fr"><a href="#">床上用品</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">家纺布艺</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">餐具</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">沙发</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">汽车用品</a></span> -->                                              
    </div>
    <div class="content">
    	<div class="home_left">
        	<div class="home_ban">
            	<div id="imgPlay5">
                    <ul class="imgs" id="actor5">
                    @foreach($furniture[0]->img as $i)
                        <li><a href="/home/goods/{{$furniture[0]->goods_id}}"><img src="{{$i->url}}" width="211" height="286" /></a></li>
                    @endforeach
                    </ul>
                    <div class="prev_h">上一张</div>
                    <div class="next_h">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
            	<div class="fresh_txt_c">
                	<a href="javascript:viod(0)">价格:</a> <a href="javascript:viod(0)">{{round($furniture[0]->price)}}<b>￥</b></a><br>
                    <a href="javascript:viod(0)">重量:</a> <a href="javascript:viod(0)">{{$furniture[0]->weight}} g</a><br>
                    <a href="javascript:viod(0)">产地:</a> <a href="javascript:viod(0)">{{$furniture[0]->country}}</a><br>
                    <a href="javascript:viod(0)">喜爱:</a> <a href="javascript:viod(0)">{{$furniture[0]->like}}人</a><br>
                </div>
            </div>
        </div>
        <div class="fresh_mid">
        	<ul>
            	@foreach($furniture as $row)
                <li>
                    <div class="name"><a href="/home/goods/{{$row->goods_id}}">{{$row->goods_name}}</a></div>
                    <div class="price">
                        <font>￥<span>{{$row->price}}</span></font> &nbsp; 26R
                    </div>
                    <div class="img"><a href="/home/goods/{{$row->goods_id}}"><img src="{{$row->img[0]->url}}" width="185" height="155" /></a></div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
        	<ul>
            	<li><a href="/home/query?cates=82"><img src="/status/home/images/home_b1.jpg" width="260" height="220" /></a></li>
                <li><a href="/home/query?cates=82"><img src="/status/home/images/home_b2.jpg" width="260" height="220" /></a></li>
            </ul>
        </div>
    </div>    
    <!--End 家居生活 End-->
    <div class="content mar_20">
        @foreach($Advert as $row)
         @if($row->id==5)
         {!!$row->descr!!}
         @endif
         @endforeach    
    </div>  
    <!--Begin 食品饮料 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">6F</span>
        <span class="fl">食品饮料</span>                                
        <!-- <span class="i_mores fr"><a href="#">咖啡</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">休闲零食</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">饼干糕点</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">冲饮谷物</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">营养保健</a></span> -->
    </div>
    <div class="content">
        <div class="food_left">
            <div class="food_ban">
                <div id="imgPlay2">
                    <ul class="imgs" id="actor2">
                    @foreach($drink[0]->img as $i)
                        <li><a href="/home/goods/{{$drink[0]->goods_id}}"><img src="{{$i->url}}" width="211" height="286" /></a></li>
                    @endforeach
                    </ul>
                    <div class="prev_f">上一张</div>
                    <div class="next_f">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <a href="javascript:viod(0)">价格:</a> <a href="javascript:viod(0)">{{round($drink[0]->price)}}<b>￥</b></a><br>
                    <a href="javascript:viod(0)">重量:</a> <a href="javascript:viod(0)">{{$drink[0]->weight}} g</a><br>
                    <a href="javascript:viod(0)">产地:</a> <a href="javascript:viod(0)">{{$drink[0]->country}}</a><br>
                    <a href="javascript:viod(0)">喜爱:</a> <a href="javascript:viod(0)">{{$drink[0]->like}}人</a><br>
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                @foreach($drink as $row)
                <li>
                    <div class="name"><a href="/home/goods/{{$row->goods_id}}">{{$row->goods_name}}</a></div>
                    <div class="price">
                        <font>￥<span>{{$row->price}}</span></font> &nbsp; 26R
                    </div>
                    <div class="img"><a href="/home/goods/{{$row->goods_id}}"><img src="{{$row->img[0]->url}}" width="185" height="155" /></a></div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="/home/query?cates=76"><img src="/status/home/images/food_b1.jpg" width="260" height="220" /></a></li>
                <li><a href="/home/query?cates=76"><img src="/status/home/images/food_b2.jpg" width="260" height="220" /></a></li>
            </ul>
        </div>
    </div>    
    <!--End 食品饮料 End-->
    <!--Begin 猜你喜欢 Begin-->
    <div class="i_t mar_10">
    	<span class="fl">猜你喜欢</span>
    </div>    
    <div class="like">        	
        <div id="featureContainer1">
            <div id="feature1">
                <div id="block1">
                    <div id="botton-scroll1">
                        <ul class="featureUL">
                            @foreach($like as $row)
                                <li class="featureBox">
                                    <div class="box">
                                        <div class="h_icon"><img src="{{$row->img[0]->url}}
                                        " width="50" height="50" /></div>
                                        <div class="imgbg">
                                            <a href="/home/goods/{{$row->goods_id}}"><img src="{{$row->img[1]->url}}" width="160" height="136" /></a>
                                        </div>                                        
                                        <div class="name">
                                            <a href="/home/goods/{{$row->goods_id}}">
                                            <h2>{{$row->brand_name}}</h2>
                                            {{$row->goods_name}}
                                            </a>
                                        </div>
                                        <div class="price">
                                            <font>￥<span>{{$row->price}}</span></font> &nbsp; 26R
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <a class="l_prev" href="javascript:void();">Previous</a>
                <a class="l_next" href="javascript:void();">Next</a>
            </div>
        </div>
    </div>
    <!--End 猜你喜欢 End-->
    <br>
    <dl style="float: left;margin-left: 400px;">
        <a class="btn btn-danger" href="/advert" style="color: white">友情链接申请</a>
        @foreach($links as $row)
        <a href="{{$row->url}}">{{$row->name}}</a>
        @endforeach
    </dl>
    <br>
@endsection
@section('js')
<script>
var second = 35000;//秒数
    $(function(){
        timeer = setInterval(function(){
        second--;
         //小时数
        var h = Math.floor(second / (60 * 60));
        //分钟
        var m = Math.floor((second%(60*60)) / 60);
        //秒
        var s = second % 60;
        //赋值
        $('.hours').text(h);
        $('.minute').text(m);
        $('.second').text(s);
    },1000);
    })
</script>
@endsection
