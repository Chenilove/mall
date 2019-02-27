<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>@yield('title')@show</title>

  <!--icheck-->
  <link href="/status/admin/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="/status/admin/js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="/status/admin/js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="/status/admin/js/iCheck/skins/square/blue.css" rel="stylesheet">
  <link href="/css/bootstrap.min.css" rel="stylesheet">

  <!--dashboard calendar-->
  <link href="/status/admin/css/clndr.css" rel="stylesheet">

  <!--Morris Chart CSS -->
  <link rel="stylesheet" href="/status/admin/js/morris-chart/morris.css">

  <!--common-->
  <link href="/status/admin/css/style.css" rel="stylesheet">
  <link href="/status/admin/css/style-responsive.css" rel="stylesheet">




  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="/status/admin/js/html5shiv.js"></script>
  <script src="/status/admin/js/respond.min.js"></script>
  <![endif]-->
  @section('link')
  @show
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="admin"><img src="/status/admin/images/logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="admin"><img src="/status/admin/images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="/status/admin/images/photos/1.png" class="media-object">
                    <div class="media-body">
                    <h4><a href="#">{{session('name')}}</a></h4>
                        <span>"Hello There..."</span>
                    </div>
                </div>
              
                <h5 class="left-nav-title"></h5>
                
                <ul class="nav nav-pills nav-stacked custom-nav">
                  <li><a href="#"><i class="fa fa-user"></i> <span>个人中心</span></a></li>
                  <li><a href="/admin/adminlogin"><i class="fa fa-sign-out"></i> <span>注销</span></a></li>
                </ul>
            </div>

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li class="active"><a href="/admin"><i class="fa fa-home"></i> <span>控制台首页</span></a></li>
                <li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>管理员帐号管理</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="/admin/adminsuser"> 管理员列表</a></li>
                        <li><a href="/admin/adminsuser/create"> 注册管理员</a></li>
                        <li><a href="/rolelist">角色列表</a></li> 
                        <li><a href="/rolelist/create">角色添加</a></li> 
                        <li><a href="/nodelist">权限列表</a></li> 
                        <li><a href="/nodelist/create">权限添加</a></li> 
                    </ul>
                </li>
                <!-- <li class=""><a href="index.html"><i class="fa fa-home"></i> <span>管理员权限</span></a></li> -->

                
<!--  -->
                </li>
                <li class=""><a href="/admin/cates"><i class="fa fa-filter"></i> <span>商品分类管理</span></a></li>
                <li class="menu-list"><a href=""><i class="fa fa-shopping-cart"></i> <span>商品管理</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="/admin/goods"> 商品列表</a></li>
                        <li><a href="/admin/goods/create"> 添加商品</a></li>
                        <li><a href="/admin/goods-attr"> 规格属性管理</a></li>
                        <li><a href="/admin/goods-brand"> 品牌管理</a></li>
                    </ul>
                </li>
                <li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>订单管理</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="/admin/orders"> 查看订单</a></li>
                    </ul>
                </li>
                <li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>评价列表</span></a>
                    <ul class="sub-menu-list">
                         <li><a href="/admin/assess">评价列表</a></li>
                    </ul>
                </li>
                <li class="menu-list"><a href=""><i class="fa fa-bullhorn"></i> <span>公告管理</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="/Notice"> 公告列表</a></li>
                        <li><a href="/Notice/create"> 添加公告</a></li>
                    </ul>
                </li>

                <li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>轮播图管理</span></a>
                    <ul class="sub-menu-list">
                         <li><a href="/Rotation"> 轮播图列表</a></li>
                        <li><a href="/Rotation/create"> 添加轮播图</a></li>
                    </ul>
                </li>

                <li class="menu-list"><a href=""><i class="fa fa-bullhorn"></i> <span>友情链接管理</span></a>
                <ul class="sub-menu-list">
                        <li><a href="/Tips"> 友情链接列表</a></li>
                        <!-- <li><a href="/Tips/create">友情链接添加</a></li> -->
                </ul>
                </li>
                <li class="menu-list"><a href=""><i class="fa fa-bullhorn">
                </i> <span>广告管理</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="/Advert"> 广告列表</a></li>
                        <li><a href="/Advert/create"> 广告添加</a></li>
                    </ul>
                </li>
              
                <li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>站内信</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="/Mali"> 查看站内信</a></li>
                        <li><a href="/Mali/create"> 添加站内信</a></li>
                    </ul>
                </li>
                

            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- left side end-->
    
    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->
            <!--search start-->
            <form class="searchform" action="index.html" method="post">
                <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
            </form>
            <!--search end-->

            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu">
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-tasks"></i>
                            <span class="badge">8</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">You have 8 pending task</h5>
                            <ul class="dropdown-list user-list">
                                <li class="new">
                                    <a href="#">
                                        <div class="task-info">
                                            <div>Database update</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning">
                                                <span class="">40%</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="#">
                                        <div class="task-info">
                                            <div>Dashboard done</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar" class="progress-bar progress-bar-success">
                                                <span class="">90%</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div>Web Development</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 66%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="66" role="progressbar" class="progress-bar progress-bar-info">
                                                <span class="">66% </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div>Mobile App</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 33%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="33" role="progressbar" class="progress-bar progress-bar-danger">
                                                <span class="">33% </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div>Issues fixed</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar">
                                                <span class="">80% </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="new"><a href="">See All Pending Task</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge">5</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">You have 5 Mails </h5>
                            <ul class="dropdown-list normal-list">
                                <li class="new">
                                    <a href="">
                                        <span class="thumb"><img src="/status/admin/images/photos/user1.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">John Doe <span class="badge badge-success">new</span></span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="thumb"><img src="/status/admin/images/photos/user2.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Jonathan Smith</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="thumb"><img src="/status/admin/images/photos/user3.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Jane Doe</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="thumb"><img src="/status/admin/images/photos/user4.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Mark Henry</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="thumb"><img src="/status/admin/images/photos/user5.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Jim Doe</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="new"><a href="">Read All Mails</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="badge">4</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">Notifications</h5>
                            <ul class="dropdown-list normal-list">
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">Server #1 overloaded.  </span>
                                        <em class="small">34 mins</em>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">Server #3 overloaded.  </span>
                                        <em class="small">1 hrs</em>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">Server #5 overloaded.  </span>
                                        <em class="small">4 hrs</em>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">Server #31 overloaded.  </span>
                                        <em class="small">4 hrs</em>
                                    </a>
                                </li>
                                <li class="new"><a href="">See All Notifications</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="/status/admin/images/photos/1.png" alt="" />
                            {{session('name')}}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="#"><i class="fa fa-user"></i> 个人信息</a></li>
                            <!-- <li><a href="#"><i class="fa fa-cog"></i>  Settings</a></li> -->
                            <li><a href="/admin/adminlogin"><i class="fa fa-sign-out"></i> 退出</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--notification menu end -->

        </div>
        <!-- header section end-->
        <!-- page heading start-->
        <div class="page-heading">
            <h3>
                @section('content_title')  
                @show
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li class="active"> 您的上次登录时间是<b>2018年10月6日</b> 这是您的第<b>106</b>次登录</li>
            </ul>
            <div class="state-info">
                <section class="panel">
                    <div class="panel-body">
                        <div class="summary">
                            <span>yearly expense</span>
                            <h3 class="red-txt">$ 45,600</h3>
                        </div>
                        <div id="income" class="chart-bar"></div>
                    </div>
                </section>
                <section class="panel">
                    <div class="panel-body">
                        <div class="summary">
                            <span>yearly  income</span>
                            <h3 class="green-txt">$ 45,600</h3>
                        </div>
                        <div id="expense" class="chart-bar"></div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page heading end-->
        <!-- 页面内容开始 body wrapper start-->
        <div class="wrapper">
            <!-- 判断错误 -->
            @if(session('error'))
            <div class="alert alert-block alert-danger fade in"> 
               <button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button> 
               <strong>{{session('error')}}</strong> 
            </div> 
            @endif
            <!-- 判断成功 -->
            @if(session('success'))
            <div class="alert alert-success fade in"> 
           <button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button> 
           <strong>{{session('success')}}</strong> 
           </div>
            @endif
            @section('content')
            @show
        </div>
        <!-- 页面内容结束 body wrapper end-->
        <!--footer section start-->
        <footer>
            2018 &copy; 本项目最终解释权 by <a href="http://www.cxfmall.com/" target="_blank">二期项目小组-李陈阮陈</a>
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<!-- <script src='/js/bootstrap.min.js'></script> -->
<script src="/status/admin/js/jquery-1.10.2.min.js"></script>
<script src="/status/admin/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/status/admin/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/status/admin/js/bootstrap.min.js"></script>
<script src="/status/admin/js/modernizr.min.js"></script>
<script src="/status/admin/js/jquery.nicescroll.js"></script>

<!--easy pie chart-->
<script src="/status/admin/js/easypiechart/jquery.easypiechart.js"></script>
<script src="/status/admin/js/easypiechart/easypiechart-init.js"></script>

<!--Sparkline Chart-->
<script src="/status/admin/js/sparkline/jquery.sparkline.js"></script>
<script src="/status/admin/js/sparkline/sparkline-init.js"></script>

<!--icheck -->
<script src="/status/admin/js/iCheck/jquery.icheck.js"></script>
<script src="/status/admin/js/icheck-init.js"></script>

<!-- jQuery Flot Chart-->
<script src="/status/admin/js/flot-chart/jquery.flot.js"></script>
<script src="/status/admin/js/flot-chart/jquery.flot.tooltip.js"></script>
<script src="/status/admin/js/flot-chart/jquery.flot.resize.js"></script>


<!--Morris Chart-->
<script src="/status/admin/js/morris-chart/morris.js"></script>
<script src="/status/admin/js/morris-chart/raphael-min.js"></script>

<!--Calendar-->
<script src="/status/admin/js/calendar/clndr.js"></script>
<script src="/status/admin/js/calendar/evnt.calendar.init.js"></script>
<script src="/status/admin/js/calendar/moment-2.2.1.js"></script>
<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore./status/admin/js/1.5.2/underscore-min.js"></script> -->

<!--common scripts for all pages-->
<script src="/status/admin/js/scripts.js"></script>

<!--Dashboard Charts-->
<script src="/status/admin/js/dashboard-chart-init.js"></script>
<script color="0,0,0" opacity="0.5" count="99" src="https://cdn.bootcss.com/canvas-nest.js/1.0.1/canvas-nest.js" type="text/javascript" charset="utf-8"></script>
@section('js')
@show

</body>
</html>
