@extends('home.public')
@section('title','商品详情--尤洪')
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
            <div class="mem_tit">我的订单</div>
            <table border="0" class="order_tab" style="width:930px; text-align:center; margin-bottom:30px;" cellspacing="0" cellpadding="0">
              <tr>                                                                                                                                                    
                <td width="10%">订单号</td>
                <td width="50%">商品</td>
                <td width="10%">类型</td>
                <td width="10%">价格</td>
                <td width="8%">数量</td>
                <td width="12%">操作</td>
              </tr>
              @foreach($list as $row)
              <tr>
                <td><font color="#ff4e00">{{$row->orders_id}}</font></td>
                <td style="text-align:left;"><image src="{{$row->url}}" height="100px"><span>{{$row->goods_name}}</span></td>
                <td>{{$row->type}}</td>
                <td>{{$row->price}}</td>
                <td>{{$row->num}}</td>
             
                <td>
                  @if($status == 3)
                  <form action='/home/userassess/create' method="get">
                  <input type="hidden" name='order_id' value="{{$row->orders_id}}">
                  <input type="hidden" name='good_id' value="{{$row->goods_id}}">
                  <input type="submit"  value="立即评价">
                  </form>
                  @endif
                  @if($status > 3 && $status != 4)
                  <form action='/home/userassess/create' method="get">
                  <input type="hidden" name='order_id' value="{{$row->orders_id}}">
                  <input type="hidden" name='good_id' value="{{$row->goods_id}}">
                  <input type="submit"  value="追评">
                  </form>
                  @endif
                </td>
              </tr>
              @endforeach
              <tr>
                 <td colspan="6" style="text-align:center;">
                @if($status <= 1)
                    <a href="/home/myorder_cancel/{{$row->orders_id}}">取消订单</a>
                @endif
                    <a href="/home/myorder">返回</a>
                 </td> 
              </tr>
            </table>      
        </div>
    </div>
  <!--End 用户中心 End--> 
@endsection
