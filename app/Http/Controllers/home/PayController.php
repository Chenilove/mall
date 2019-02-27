<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
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
        //
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
    //调用支付接口方法
    public function pays($id)
    {
        //获取传递过来的订单Code
        //dd($id);
        //封装支付接口数据
        $ordercode = $id;
        $name = '阮民';
        $fee = 0.01;
        $des = '小心支付';

        //同时将订单号存入session
        session(['ordercode'=>$id]);
        pays($ordercode,$name,$fee,$des);
    }

     //通知界面
     public function returnurl(){
        //支付完成后 修改订单的状态以及支付时间
        //获取支付订单的id  如果订单状态修改失败改怎么办
        $ordercode = $session('ordercode');
        if(DB::table('orders')->where('order_id','=',$ordercode)->update(['status'=>1,'pay_at'=>date('Y-m-d H:i:s',time())])){
            echo "支付成功";
        }else{
            echo '支付失败';
        }
        
     }
}
