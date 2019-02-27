@extends('home.public')
@section('title','购物车--尤洪')
@section('link')
	<link type="text/css" rel="stylesheet" href="/status/home/css/style.css" />
    <!--[if IE 6]>
    <script src="/status/home/js/iepng.js" type="text/javascript"></script>
        <script type="text/javascript">
           EvPNG.fix('div, ul, img, li, input, a'); 
        </script>
    <![endif]-->
        
    <script type="text/javascript" src="/status/home/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/status/home/js/menu.js"></script>    
        
	<script type="text/javascript" src="/status/home/js/select.js"></script>
        
@endsection   
@section('content')
<div class="i_bg bg_color">
    <!--Begin 用户中心 Begin -->
	<div class="m_content">
        <div class="m_left">
            <div class="left_n">管理中心</div>
            <div class="left_m">
                <div class="left_m_t t_bg1">订单中心</div>
                <ul>
                    <li><a href="/home/myorder">我的订单</a></li>
                    <!-- <li><a href="Member_Address.html" class="now">收货地址</a></li> -->
                    <!-- <li><a href="#">缺货登记</a></li> -->
                    <!-- <li><a href="#">跟踪订单</a></li> -->
                </ul>
            </div>
            <div class="left_m">
                <div class="left_m_t t_bg2">会员中心</div>
                <ul>
                    <li><a href="/home/details">用户信息</a></li>
                    <li><a href="/home/collection">我的收藏</a></li>
                    <!-- <li><a href="Member_Msg.html">我的留言</a></li> -->
                    <!-- <li><a href="Member_Links.html">推广链接</a></li> -->
                    <!-- <li><a href="#">我的评论</a></li> -->
                </ul>
            </div>
        </div>
		<div class="m_right">
            <p></p>
            <div class="mem_tit">我的评论</div>
           	<form action='/home/userassess' method="post"  enctype="multipart/form-data">
            <table border="0" style="width:880px; margin-top:20px;"  cellspacing="0" cellpadding="0">
                <tr height="45">
                    <td align="right">服务评价 &nbsp; &nbsp;</td>
                    <td>
                        
                        <select name="level" class="add_ipt" style="width:290px;">
                            <option value="1">极差评</option>
                            <option value="2">差评</option>
                            <option value="3">中评</option>
                            <option value="4">好评</option>
                            <option value="5" selected>极好评</option>
                        </select>
                    </td>
                </tr>
              <tr valign="top" height="110">
                <td align="right">评价内容 &nbsp; &nbsp;</td>
                <td style="padding-top:5px;"><textarea class="add_txt" name="content" maxlength="50"  placeholder="最多不超多50个字"></textarea></td>
              </tr>

              <tr height="45">
                <td align="right">上传图片 &nbsp; &nbsp;</td>
                <td><input type="file" name="pic[]" multiple/></td>
              </tr>
              <tr height="50">
                <td>&nbsp;</td>
                <td style="line-height:20px;">
                	<font color="#ff4e00">小提示：</font><br />
                    您可以上传以下格式的图片：gif、jpg、png
                </td>
              </tr>
              {{CSRF_field()}}
              <!-- 添加隐藏域 存储订单ID -->
              <input type='hidden' name="order_id" value="{{$order_code}}">
              <input type='hidden' name="good_id" value="{{$good_id}}">
              <tr height="50" valign="bottom">
                <td>&nbsp;</td>
                <td><input type="submit" value="提交评论" class="btn_tj" /></td>
              </tr>
            </table>
            </form>
        </div>
    </div>
	<!--End 用户中心 End--> 
@endsection
