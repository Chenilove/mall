@extends('home/public')

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
<div class="m_right">
            <p></p>     
            
            <div class="mem_tit">
                申请友情链接
            </div>
            <form action="/advert-store" method="post" onsubmit="return gets()">
            {{csrf_field()}}
            <table border="0" class="mem_tab" style="width:930px; margin-bottom:30px;" cellspacing="0" cellpadding="0">
              <tbody><tr>
                <!-- td class="ma_a" colspan="2" style="padding:12px 50px;">
                    <span class="fl" style="color:#ff4e00; font-size:14px;">会员余额：<b>￥ 1000元</b></span>
                    <span class="fr"><a href="#">账户明细</a>|<a href="#">提现记录</a></span>        
                </td> -->
              </tr>
              <tr>                                                                                                                                                    
                <td width="150" class="tx_l">网站名称</td>                                                                                                                                         
                <td width="680"><input type="text" name="name" value="" class="tx_ipt" onblur="validate(this)" id="wzm"><p class="help-block"></p></td>
              </tr>
              <tr>
                <td class="tx_l">网址</td>
                <td><input type="text" onblur="validate(this)" name="url" value="" class="tx_ipt"><p class="help-block" id="url"></p></td>
              </tr>
              <tr>
                <td class="tx_l">电子邮件</td>
                <td><input type="email" name="email" value="" class="tx_ipt"></td>
              </tr>
              <tr>
                <td class="tx_l">网站介绍</td>
                <td><input type="text" onblur="validate(this)" name="details" value="" class="tx_ipt" id='descr'><p class="help-block"></p></td>
              </tr>
              <tr height="70">
                <td colspan="10" align="center">
                    <input type="submit" value="提交申请" class="btn_tj"> 
                    &nbsp; &nbsp; 
                    <input type="reset" value="重置信息" class="btn_tj">
                </td>
              </tr>
            </tbody>
            </table>
            </form>
            <div class="m_right">
            <p></p>
            <div class="mem_tit">友情链接展示</div>
            <table border="0" class="order_tab" style="width:930px; text-align:center; margin-bottom:30px;" cellspacing="0" cellpadding="0">
              <tbody>

            <ul class="link_list">
                    @foreach($links as $row)
                    <li><a href="https://{{$row->url}}" target="_blank">{{$row->name}}</a></li>
                    @endforeach
            </ul>
            </tbody>
            </table>
        </div>
        </div>
@endsection
@section('js')
<script>
    function validate(obj)
    {
        var name = $(obj).val();
        var help = $(obj).next();
        if (name == '' || name == undefined || name == null) {
            $(help).html('<span style="color:red"><strong>温馨提示:</strong>请不要为空</span>');
            return false;
        }
        var pattern = new RegExp("[~'!@#$%^&*()-+_=:></`]");
        if (pattern.test(name)) {
            $(help).html('<span style="color:red"><strong>温馨提示:</strong>非法字符!</span>');
            return false;
        }else{
            $(help).html('<span style="color:green"><strong>温馨提示:</strong>验证通过~</span>');
            return true;
        }
    }
    //表单提交
    function gets()
    {
        var name = $('#wzm');
        var url = $('#url');
        var descr = $('#descr');
        if (validate(name) && validata(url) && validate(descr)) {
            return true;
        }else{
            return false;
        }
        
    }
</script>
@endsection