<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>密码重置</title>
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
    
    
<title>尤洪</title>
</head>
<body>  
<!--Begin Header Begin-->
<div class="soubg">
  <div class="sou">
        <span class="fr">
                    <span class="fl">你好，请<a href="/homelogin">登录</a>&nbsp;<a href="/homeregister/create" style="color:#ff4e00;">免费注册</a></span>
            <span class="fl">|&nbsp;关注我们：</span>
            <span class="s_sh"><a href="#" class="sh1">新浪</a><a href="#" class="sh2">微信</a></span>
            <span class="fr">|&nbsp;<a href="#">手机版&nbsp;<img src="/status/home/images/s_tel.png" align="absmiddle" /></a></span>
        </span>
    </div>
</div>
<!--End Header End--> 
<!--Begin Login Begin-->
<div class="log_bg">  
    <div class="top">
        <div class="logo"><a href="Index.html"><img src="/status/home/images/logo.png" /></a></div>
    </div>
  <div class="regist">
      <div class="log_img"><img src="/status/home/images/l_img.png" width="611" height="425" /></div>
    <div class="reg_c">
          <form action="/doreset" id="" method="post">
            <table border="0" style="width:420px; font-size:14px; margin-top:20px;" cellspacing="0" cellpadding="0">
              <tr height="50" valign="top">
                <td width="95">&nbsp;</td>
                <td>
                  <span class="fl" style="font-size:24px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;密码重置</span>
                    <span class="fr">不想修改密码，去<a href="/homelogin" style="color:#ff4e00;">登录</a></span>
                </td>
              </tr>
              <tr>
                <td></td>
                <td ><font color="red">@if(session('error')){{session('error')}}@endif</font></td>
              </tr>
              <tr height="50">
                <td align="right">
                <font color="#ff4e00">*</font>&nbsp;新密码 &nbsp;</td>
                <td>
                <input type="password" name="password" name="password" class="l_pwd" />
                </td>
              </tr>
              <tr height="50">

                <td align="right"><font color="#ff4e00">*</font>&nbsp;确认新密码 &nbsp;</td>
                <td><input type="password" name="repassword" class="l_pwd" /></td>
              </tr>
              <tr>
              </tr>
              <tr height="60">
                <td>&nbsp;</td>
                <td>
                  {{csrf_field()}}
                  <input type="hidden" name="id" value="{{$id}}">
                  <input type="submit" value="重置密码" class="log_btn" />
                </td>
              </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!--End Login End--> 
<!--Begin Footer Begin-->
<div class="btmbg">
    <div class="btm">
        备案/许可证编号：蜀ICP备12009302号-1-www.dingguagua.com   Copyright © 2015-2018 尤洪商城网 All Rights Reserved. 复制必究 , Technical Support: Dgg Group <br />
        <img src="/status/home/images/b_1.gif" width="98" height="33" /><img src="/status/home/images/b_2.gif" width="98" height="33" /><img src="/status/home/images/b_3.gif" width="98" height="33" /><img src="/status/home/images/b_4.gif" width="98" height="33" /><img src="/status/home/images/b_5.gif" width="98" height="33" /><img src="/status/home/images/b_6.gif" width="98" height="33" />
    </div>      
</div>
<!--End Footer End -->    

</body>


<!--[if IE 6]>
<script src="//letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
</html>
