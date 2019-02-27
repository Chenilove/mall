<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>login</title>
<link rel="stylesheet" type="text/css" href="/status/adminlogin/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="/status/adminlogin/css/demo.css" />
<!--必要样式-->
<link rel="stylesheet" type="text/css" href="/status/adminlogin/css/component.css" />

<!--[if IE]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body>
		<div class="container demo-1">
			<div class="content">
				<div id="large-header" class="large-header">
					<canvas id="demo-canvas"></canvas>
					<div class="logo_box">
						<h3>尤洪后台管理欢迎您</h3>
						<h5 align="center">请先登入</h5>
						 @if(session('error'))
                    	{{session('error')}}
                		@endif
						<form action="/admin/adminlogin" method="post">
							<div class="input_outer">
								<span class="u_user"></span>
								<input name="name" class="text required" style="color: #FFFFFF !important" type="text" placeholder="请输入账户">
							</div>
							<div class="input_outer">
								<span class="us_uer"></span>
								<input name="password" class="text required" style="color: #FFFFFF !important; position:absolute; z-index:100;"value="" type="password" placeholder="请输入密码">
							</div>
							<div class="mb2" align="center">
								{{csrf_field()}}
								<button type="submit" class="act-but submit"  style="color: #FFFFFF">登录</button>
								<!-- <input type="submit" value="登入" class=" btn btn-lg" align="center"> -->
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!-- /container -->
		<script src="/status/adminlogin/js/TweenLite.min.js"></script>
		<script src="/status/adminlogin/js/EasePack.min.js"></script>
		<script src="/status/adminlogin/js/rAF.js"></script>
		<script src="/status/adminlogin/js/demo-1.js"></script>
		<!-- <script color="0,0,0" opacity="0.5" count="99" src="https://cdn.bootcss.com/canvas-nest.js/1.0.1/canvas-nest.js" type="text/javascript" charset="utf-8"></script> -->
		<div style="text-align:center;">
</div>
	</body>
</html>