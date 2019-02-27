<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//商城前台
Route::group([],function(){
	//商城首页
	Route::get('/','home\index\IndexController@index');

	////////////////////////////////////////////////
	// 登录注册页面/////////////////////////////////
	//前台注册
	Route::resource("/homeregister","home\RegisterController");
	// 
	//用户详情/////////////////////////////////////////////////////////////////////////////////////////////
	Route::resource("/home/details","home\DetailsController");
	//注销
	Route::get("/User_logout","Home\LoginController@logout");
	
	//测试邮件发送
	Route::get("/send","home\RegisterController@send");
	//测试邮件发送2
	Route::get("/send1","home\RegisterController@send1");
	//激活
	Route::get("/jihuo","home\RegisterController@jihuo");
	//验证码
	Route::get("/code","home\RegisterController@code");

	//前台登录//////////////////////
	Route::resource("/homelogin","Home\LoginController");

	Route::get("/forget","Home\LoginController@forget");

	Route::post("/doforget","Home\LoginController@doforget");

	// 重置密码//////////////////////
	Route::get("/reset","Home\LoginController@reset");
	Route::post("/doreset","Home\LoginController@doreset");


	//商品搜索
	Route::get('/home/query','home\index\IndexController@query');
	//商品详情
	Route::get('/home/goods/{id}','home\index\IndexController@goods');
	//ajax商品收藏/取消
	Route::get('/home/goods-collection/{id}','home\index\IndexController@collection');
	//我的收藏
	Route::get('/home/collection','home\index\CollectController@index');

	//公告内容
	Route::get('/gg','home\index\IndexController@notice');
	//友情链接
	Route::get('/advert','home\index\IndexController@advert');
	//添加友情链接
	Route::post('/advert-store','home\index\IndexController@advert_store');

	//购物车模块
	Route::resource('/home/cart','home\CartController');
	//购物车减
	Route::get('/home/cart-jian/{id}','home\CartController@jian');
	//购物车加
	Route::get('/home/cart-add/{id}','home\CartController@add');
	//购物车删除
	Route::get('/home/ajax_cartdelete','home\CartController@cartdelete');
	//确认结算
	Route::post('/home/order_confirm','home\CartController@order_confirm');
	//地址
	Route::resource('/home/address','home\AddressController');
	//设置为默认地址
	Route::get('/home/default_address/{id}','home\AddressController@default_address');
	//地址删除
	Route::get('/home/deletes','home\AddressController@deletes');
	//地址AJAX修改
	Route::get('/home/update_address','home\AddressController@updates');
	//地址AJAX添加选项(一级select选项)
	Route::get('/home/add_address','home\AddressController@add_address');

	//前台我的订单
	Route::resource('/home/myorder','home\MyorderController');
	//确认订单
	Route::get('/home/confirm/{id}','home\MyorderController@confirm');
	//取消订单
	Route::get('/home/myorder_cancel/{id}','home\MyorderController@cancel');

	//用户评论
	Route::resource('/home/userassess','home\UserassessController');
});

	//订单模块
	Route::resource('/admin/orders','Admin\OrdersController');
	//支付宝接口调用
	Route::get("/pays/{id}","Home\PayController@pays");
	//通知给客户端的界面
	Route::get("/returnurl","Home\PayController@returnurl");

	// 后台登录和退出
	Route::resource("admin/adminlogin","admin\adminlogin\AdminLoginController");
	
//商城后台
Route::group(['middleware'=>'adminlogin'],function(){
	//后台首页
	Route::get('/admin','admin\index\IndexController@index');

	//后台管理员管理
	Route::resource("/admin/adminsuser","admin\adminuser\AdminuserController");

	///////////会员管理/////////////////////////////////
	//会员详情
	Route::resource("/user","admin\user\UsersController");
	//会员收货地址
	Route::get("/useraddress/{id}","admin\user\UsersController@address");

	// 管理员账号管理////////////////////////////////////
	//分配角色
	Route::get("/adminrole/{id}","admin\adminuser\AdminuserController@rolelist");
	//保存角色
	Route::post("/saverole","admin\adminuser\AdminuserController@saverole");
	//角色管理
	Route::resource("/rolelist","admin\adminuser\RolelistController");
	//分配权限
	Route::get("/auth/{id}","admin\adminuser\RolelistController@auth");
	//保存权限
	Route::post("/saveauth","admin\adminuser\RolelistController@saveauth");
	//权限管理
	Route::resource("/nodelist","admin\adminuser\NodelistController");


	////////////////////////////////////////////////////////////////////////////////
	// 商品分类管理 //
	////////////////////////////////////////////////////////////////////////////////
	Route::resource('/admin/cates','admin\cates\CatesController');
	//ajax删除分类
	Route::post('/admin/cates-d','admin\cates\CatesController@delete');	
	//执行修改分类
	Route::post('/admin/cates-e','admin\cates\CatesController@editCate');

	////////////////////////////////////////////////////////////////////////////////
	// 商品管理 //
	////////////////////////////////////////////////////////////////////////////////
	//品牌列表
	Route::resource('/admin/goods','admin\goods\GoodsController');
	//ajax品牌搜索
	Route::get('/admin/goods-query-brand','admin\goods\GoodsController@query_brand');
	//ajax删除商品
	Route::post('/admin/goods-del/{id}','admin\goods\GoodsController@del');
	//商品属性管理
	Route::resource('/admin/goods-attr','admin\goods\AttributeController');
	//ajax删除规格属性
	Route::post('/admin/goods-attr-del','admin\goods\AttributeController@del');
	//品牌管理
	Route::resource('/admin/goods-brand','admin\goods\BrandController');
	//ajax删除品牌
	Route::post('/admin/goods-brand-del','admin\goods\BrandController@del');

	//发货操作
	Route::get('/admin/orders_send/{id}','Admin\OrdersController@send');
	
	
	//评价模块
	Route::resource('/admin/assess','Admin\AssessController');

	//后台公告模块
	Route::resource('Notice','admin\Notice\IndexController');
	//后台轮播图模块
	Route::resource('Rotation','admin\Rotation\IndexController');
	//后台广告模块
	Route::resource('Advert','admin\Advert\IndexController');
	//友情链接模块
	Route::resource('Tips','admin\LinK\IndexController');
	//后台站内信模块
	Route::resource('Mali','admin\Mali\IndexController');

});
