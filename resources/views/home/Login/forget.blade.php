<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="/status/home/css/style.css" />  
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
<title>忘记密码</title>
</head>
<body>
<div class="soubg">
  <div class="sou">
        <span class="fr">
          <span class="fl">你好，请<a href="/homelogin">登录</a>&nbsp;<a href="/homeregister/create" style="color:#ff4e00;">免费注册</a> </span>
            <span class="fl">|&nbsp;关注我们：</span>
            <span class="s_sh"><a href="#" class="sh1">新浪</a><a href="#" class="sh2">微信</a></span>
            <span class="fr">|&nbsp;<a href="#">手机版&nbsp;<img src="/status/home/images/s_tel.png" align="absmiddle" /></a></span>
        </span>
    </div>
</div>
<div class="log_bg">
    <div class="top">
        <div class="logo"><a href="http://www.o2oproject.com/"><img src="/status/home/images/logo.png" /></a></div>
    </div>
  <div class="login">
      <div class="log_img"><img src="/status/home/images/l_img.png" width="611" height="425" /></div>
    <div class="log_c">
          <form action="/doforget" id="" method="post">
            <table border="0" style="width:370px; font+-size:14px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr height="50" valign="top">
                <td width="55">&nbsp;</td>
                <td>
                  <span class="fl" style="font-size:24px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;忘记密码</span>
                    <span class="fr">还没有商城账号,<a href="/homeregister/create" style="color:#ff4e00;">立即注册</a></span>
                </td>
              </tr>
              <tr>
                <td></td>
                <td ><font color="red">@if(session('error')){{session('error')}} @endif</font></td>
              </tr>
              <tr height="70">
                <td>邮&nbsp; &nbsp; 箱</td>
                <td>
                  <!-- <input type="text" value="" class="l_user" /> -->
                  <input type="email" name="email" value="" class="l_user" /> 
                </td>
              </tr>
              <tr height="60">
                <td>&nbsp;</td>+
                <td>
                {{csrf_field()}}
                <input type="submit" value="找回密码" class="log_btn" />
                </td>
              </tr>
            </table>
            </form>
        </div>
    </div>
</div>  
<div class="btmbg">
    <div class="btm">
        备案/许可证编号：蜀ICP备12009302号-1-www.dingguagua.com   Copyright © 2015-2018 尤洪商城网 All Rights Reserved. 复制必究 , Technical Support: Dgg Group <br />
        <img src="/status/home/images/b_1.gif" width="98" height="33" /><img src="/status/home/images/b_2.gif" width="98" height="33" /><img src="/status/home/images/b_3.gif" width="98" height="33" /><img src="/status/home/images/b_4.gif" width="98" height="33" /><img src="/status/home/images/b_5.gif" width="98" height="33" /><img src="/status/home/images/b_6.gif" width="98" height="33" />
    </div>      
</div>
</body>
</html>

<!DOCTYPE html>
html'
