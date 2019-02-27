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
                <td width="15%">订单号</td>
                <td width="25%">下单时间</td>
                <td width="15%">订单总金额</td>
                <td width="20%">订单状态</td>
                <td width="25%">操作</td>
              </tr>
              @foreach($data as $row)
              <tr>
                <td><font color="#ff4e00">{{$row->order_id}}</font></td>
                <td>{{$row->created_at}}</td>
                <td>{{$row->money}}</td>
                @switch($row->status)
                  @case(0)
                      <td>未付款</td>
                      @break
                  @case(1)
                      <td>待发货</td>
                      @break
                  @case(2)
                      <td>待收货</td>
                      @break
                  @case(3)
                      <td>待评价</td>
                      @break
                  @case(4)
                      <td>已失效</td>
                      @break
                  @case(5)
                      <td>已评价</td>
                      @break
                  @endswitch
                <td>
                  @if($row->status == 0)
                  <a href="/pays/{{$row->order_id}}" style="color:red;">立即付款</a>
                  @endif
                  @if($row->status == 2)
                  <a href="/home/confirm/{{$row->order_id}}" style="color:green;">确认收货</a>
                  @endif
                  <a href="/home/myorder/{{$row->order_id}}">订单详情</a>
                </td>
              </tr>
              @endforeach
            </table>      
        </div>
    </div>
	<!--End 用户中心 End--> 
@endsection
