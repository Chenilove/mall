@extends('home.public')
@section('title','我的收藏--尤洪')
@section('link')
	<link type="text/css" rel="stylesheet" href="/status/home/css/style.css" />
    <!--[if IE 6]>
    <script src="js/iepng.js" type="text/javascript"></script>
        <script type="text/javascript">
           EvPNG.fix('div, ul, img, li, input, a'); 
        </script>
    <![endif]-->
        
    <script type="text/javascript" src="{{asset('/status/home/js/jquery-1.8.2.min.js')}}"></script>
    <script type="text/javascript" src="/status/home/js/menu.js"></script>    
    <script type="text/javascript" src="/status/home/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="{{asset('/status/home/js/select.js')}}"></script>
    <script type="text/javascript" src="{{asset('/status/home/js/jquery-1.8.2.min.js')}}"></script>
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
            <div class="mem_tit">
              <span class="fr" style="font-size:12px; color:#55555; font-family:'宋体'; margin-top:5px;">共发现4件</span>我的收藏
            </div>
            <table border="0" class="order_tab" style="width:930px;" cellspacing="0" cellpadding="0">
              <tr>                                                                                                                                       
                <td align="center" width="420">商品名称</td>
                <td align="center" width="180">价格</td>
                <td align="center" width="270">操作</td>
              </tr>
              @foreach($collect as $row)
              <tr>
                <td style="font-family:'宋体';">
                  <div class="sm_img"><img src="{{$row->goods->img[0]->url}}" width="48" height="48" /></div>{{$row->goods->goods_name}}
                </td>
                <td align="center">￥{{$row->goods->price}}</td>
                <td align="center"><a href="{{url('/home/goods/'.$row->goods->goods_id)}}">查看详情</a>&nbsp; &nbsp;<a href="javascript:;" onclick="collection(this)">删除</a><span style="display: none">{{$row->goods->goods_id}}</span></td>
              </tr>
              @endforeach
              <tr>
                <td colspan="3">{{$collect->render()}}</td>
              </tr>
            </table>
        </div>
    </div>
  <!--End 用户中心 End--> 
@endsection
@section('js')
<script>
  //ajax收藏
  function collection(obj)
  {
    var goods_id = $(obj).next().text();
    $.get('/home/goods-collection/'+goods_id,{},function(data){

      if(data == 2){
        //取消成功
        $(obj).parents('tr').remove();
      }else{
        //请先登录
        alert('请您先登录');
        window.location.href = '/admin/adminlogin';
      }
    });
  }
</script>
@endsection