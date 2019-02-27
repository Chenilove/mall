<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class MyorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $cart;

    public function __construct()
    {

        //购物车
        $cart = getCart();
        //赋值成员属性
        $this->cart = $cart;
    }

    public function index()
    {
        //个人订单列表
        //根据用户的id查出来个人的所有订单信息  用户的id为测试数据!!!!!!!!
        $data = DB::table('orders')->where('user_id','=',session('id'))->orderBy('status','asc')->get();
        //如果有订单信息才会显示页面
        if($data){
            return view('home.myorder.index',['data'=>$data,'cart'=>$this->cart]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //dd($id);
        //查找出订单的状态
        $status = DB::table('orders')->where('order_id','=',$id)->first()->status;
       // $list = array();
        //找出商品的全部信息 1个订单id 多个商品 一个商品多个图片
        $list = DB::table('orders')
        ->join('details','orders.order_id','=','details.orders_id')
        ->join('goods','details.goods_id','=','goods.goods_id')
        ->join('picture','goods.goods_id','=','picture.goods_id')
        ->select('details.orders_id','goods.goods_name','goods.goods_id','details.price','details.num','details.type','picture.url')
        ->where('orders.order_id','=',$id)
        ->groupBy('goods.goods_id')
        ->get();
       //var_dump($list);die;
        

        return view('home.Myorder.orderdetails',['list'=>$list,'status'=>$status,'cart'=>$this->cart]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //确认收货
    public function confirm($id){
        //修改订单的状态
        DB::table('orders')->where('order_id','=',$id)->update(['status'=>3]);
        return redirect('/home/myorder');
    }

    //取消订单
    public function cancel($id)
    {
        //dd($id);
        //修改订单的状态
        DB::table('orders')->where('order_id','=',$id)->update(['status'=>4]);
        //调回首页
        return redirect('/home/myorder');
    }
}
