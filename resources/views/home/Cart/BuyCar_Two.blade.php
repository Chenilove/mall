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
    
    
    <script type="text/javascript" src="/status/home/js/menu.js"></script>    
                
    <script type="text/javascript" src="/status/home/js/n_nav.js"></script>   
    
    <script type="text/javascript" src="/status/home/js/select.js"></script>
    
    <script type="text/javascript" src="/status/home/js/num.js">

        var jq = jQuery.noConflict();
    </script>     
    
    <script type="text/javascript" src="/status/home/js/shade.js"></script>
    <script type="text/javascript" src="/status/home/js/jquery-1.8.2.min.js"></script>
    <!-- 
        注意::::这个样式消除radio单选框的点点的
        注意::::这个样式消除radio单选框的点点的
        注意::::这个样式消除radio单选框的点点的
        注意::::这个样式消除radio单选框的点点的
     -->
    <style>
        /*input[type="radio"] {
            display: none;
        }*/
    </style> 
@endsection
@section('content')
<div class="i_bg">  
    <div class="content mar_20">
        <img src="/status/home/images/img2.jpg" />        
    </div>
    
    <!--Begin 第二步：确认订单信息 Begin -->
    <div class="content mar_20">
        <div class="two_bg">
            <div class="two_t">
                <span class="fr"><!-- <a href="#">修改</a> --></span>商品列表
            </div>
            <form action="/admin/orders" method="post">
                <table border="0" class="car_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="car_th" width="550">商品名称</td>
                    <td class="car_th" width="140">属性</td>
                    <td class="car_th" width="140">单价</td>
                    <td class="car_th" width="150">购买数量</td>
                    <td class="car_th" width="130">小计</td>
                  </tr>
                  @if($arr)
                  @foreach($arr as $row)
                  <tr>
                  <input type="hidden" name="order[]" value="{{$row[0]->id}}">
                    <td>
                        <div class="c_s_img"><img src="{{$row[0]->url}}" width="73" height="73" /></div>
                       {{$row[0]->goods_name}}
                    </td>
                    <td align="center">{{$row[0]->type}}</td>
                    <td align="center" style="color:#ff4e00;">{{$row[0]->price}}</td>
                    <td align="center">{{$row[0]->num}}</td>
                    <td align="center">{{$row[0]->num*$row[0]->price}}</td>
                    <input type="hidden" value="{{$total += $row[0]->num * $row[0]->price}}">
                  </tr>
                  @endforeach
                  @endif
                  <tr>
                    <td colspan="5" align="right" style="font-family:'Microsoft YaHei';">
                        <span style="color:red;">总计:&nbsp;{{$total or 0}}元</span>
                        <input type="hidden" name="total" value="{{$total}}"> 
                    </td>
                  </tr>
                   
                </table>
                
                <div class="two_t">
                    <span class="fr"><a href="/home/address">地址管理</a></span>收货人信息
                    @if(session('error'))
                    <span>{{session(error)}}</span>
                    @endif
                </div>
                
                @foreach($addresses as $rows)
                    <div style="float:left;margin-left:40px;margin-top:30px;" class="addresses" onclick='select(this)'>
                       @if($rows->status == 1)
                        <input type="radio" name="dizhi" value="{{$rows->id}}" checked>
                        @else
                        <input type="radio" name="dizhi" value="{{$rows->id}}">
                        @endif
                       
                        <table border="0" class="peo_tab" style="padding:0px;width:500px;float:left;" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="p_td" width="80" style="text-align:center;padding:0px;">收件人</td>
                            <td width="80" style="text-align:center;padding:0px;">{{$rows->name}}</td>
                            <td class="p_td" width="50" style="text-align:center;padding:0px;">电话</td>
                            <td width="50" style="text-align:center;padding:0px;">{{$rows->phone}}</td>
                            <td class="p_td" style="text-align:center;padding:0px;" width="60">邮政编码</td>
                            <td style="text-align:center;padding:0px;" width="50">{{$rows->code}}</td>
                          </tr>
                          <tr>
                            <td class="p_td" style="text-align:center;padding:0px;">省/市/(区)县</td>
                            <td style="text-align:center;padding:0px;" colspan="5">{{$rows->city}}</td>
                            
                          </tr>
                          <tr>
                            <td class="p_td" style="text-align:center;padding:0px;">详细地址</td>
                            <td style="text-align:center;padding:0px;position:relative;" colspan="5">
                                {{$rows->Address}}
                                @if($rows->status == 1) 
                                <span style="display:inline-block;width:50px;position:absolute;right:0px;background-color:#ccc;color:white;text-align:center;font-size: 12px;padding:0px;">默认</span>
                                @endif
                            </td>
                          </tr>
                          
                        </table>
                    </div>
                @endforeach
               
                
                <div class="two_t">
                   
                </div>
                <div class="two_t">
                    支付方式
                </div>
                <ul class="pay">
                    <li class="checked">余额支付<div class="ch_img"></div></li>
                    <li>银行亏款/转账<div class="ch_img"></div></li>
                    <li>货到付款<div class="ch_img"></div></li>
                    <li>支付宝<div class="ch_img"></div></li>
                </ul>
                
              
                
                
                <div class="two_t">
                    其他信息
                </div>
                <table border="0" class="car_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="145" align="right" style="padding-right:0;"><b style="font-size:14px;">使用红包：</b></td>
                    <td>
                        <span class="fl" style="margin-left:50px; margin-right:10px;">选择已有红包</span>
                        <select class="jj" name="coupon_id">
                          <option value="0" selected="selected">请选择</option>
                          <option value="1">50元</option>
                          <option value="2">30元</option>
                          <option value="3">20元</option>
                          <option value="4">10元</option>
                        </select>
                        <span class="fl" style="margin-left:50px; margin-right:10px;">或者输入红包序列号</span>
                        <span class="fl"><input type="text" value="" class="c_ipt" style="width:220px;" />
                        <span class="fr" style="margin-left:10px;"><input type="submit" value="验证红包" class="btn_tj" /></span>
                    </td>
                  </tr>
                  <tr valign="top">
                    <td align="right" style="padding-right:0;"><b style="font-size:14px;">订单附言：</b></td>
                    <td style="padding-left:0;"><textarea class="add_txt" style="width:860px; height:50px;"></textarea></td>
                  </tr>
            
                </table>
                
                <table border="0" style="width:900px; margin-top:20px;" cellspacing="0" cellpadding="0">
                  <!-- <tr>
                    <td align="right">
                        该订单完成后，您将获得 <font color="#ff4e00">1815</font> 积分 ，以及价值 <font color="#ff4e00">￥0.00</font> 的红包 <br />
                        商品总价: <font color="#ff4e00">￥1815.00</font>  + 配送费用: <font color="#ff4e00">￥15.00</font>
                    </td>
                  </tr> -->
                  <tr height="70">
                    <td align="right">
                        <b style="font-size:14px;">应付款金额：<span style="font-size:22px; color:#ff4e00;">{{$total.'元'}}</span></b>
                    </td>
                  </tr>
                  {{csrf_field()}}
                  <tr height="70">
                    <td align="right"> <input type="image" src="/status/home/images/btn_sure.gif" width="150" height="40"/></td>
                  </tr>
                </table>
            </form>
            
            
        </div>
@endsection
@section('js')
 <script>
    //将默认选中的radio框边变绿色
    $('input:checked').parents('.addresses').css('border','2px dashed green');


    function select(obj){
        $('.addresses').css('border','none');
        $('input[name="dizhi"]').attr('checked',false);
        $(obj).css('border','2px dashed green');
        $(obj).find('input:radio').attr('checked',true);
    }
    
</script>
@endsection
