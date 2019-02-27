<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//导入Orders模型类
use App\Model\Orders;

//导入DB类
use DB;

//导入表单验证类
use App\Http\Requests\AdminOrdersedit;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取关键词
        $keyword = $request->input('keyword');
        //var_dump($keyword);
        //获取列表数据
        $data = Orders::where('order_id','like','%'.$keyword.'%')->orderBy('status','asc')->paginate(3);
        //$data = Orders::all();
        //dd($data);
        return view('Admin.orders.index',['data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接受购物车提交的订单信息
        $data = $request->only(['order','dizhi','coupon_id']);
        // dd($data);
        if (!$request->has('order')) {
            // return back()->with('error','下单错误,请选择一个商品');
            // session('error','下单错误,请选择一个商品');
            return redirect('/home/cart')->with('error','下单错误,请选择一个商品');
        }
        if (!$request->has('dizhi')) {
            // return back()->with('error','请选择一个地址');
            // session('error','请选择一个地址');
            return redirect('/home/cart')->with('error','请选择一个地址');
        }
        //生成订单号
        $data['order_id'] = time()+rand(1,10000);
        //计算总价 暂时没有商品数据 测试数据
        $allprice =  $request->total; //订单总价
      
        //遍历出地址
        $address = DB::table('address')->where('id','=',$data['dizhi'])->first();
        $arr = array();
        $arr = explode(',',$address->city);
        $list = '';
        foreach($arr as $value){
            $rows= DB::table('district')->where('id','=',$value)->first();
            $list .= $rows->name;
        }
        $address->city = $list;

        //根据传递过来的购物车信息,封装订单信息.准备一个空数组来房信息
        $create = array();
        $create['order_id'] = $data['order_id']; //订单id
        $create['coupon_id'] = $data['coupon_id']; //优惠券id
        $create['user_id'] = session('id');  //用户id 暂时没有 测试数据
        $create['money'] = $allprice;  //订单总金额  
        $create['status'] = 0;  //订单状态 
        $create['oname'] = $address->name;  //收件人 
        $create['phone'] = $address->phone;  //电话 
        $create['address'] = $address->city.$address->Address;  //地址 
        $create['created_at'] = date('Y-m-d H:i:s',time());  //订单时间 
       
         

        //执行添加 如果添加成功再添加订单详情表
        if($id = DB::table('orders')->insertGetId($create)){
            //根据传递过来的购物车商品id将商品添加到订单详情表中同时要删除购物车中的商品清单
            foreach($data['order'] as $v){
                $cart_id = DB::table('cart_list')->where('id','=',$v)->first();
                $details['orders_id'] = $data['order_id']; //订单号
                $details['goods_id'] = $cart_id->goods_id;  //商品id
                $details['num'] = $cart_id->num;  //商品数量
                $details['price'] = DB::table('goods')->where('goods_id','=',$cart_id->goods_id)->first()->price;  //此处商品的价格还没有 暂时用测试数据
                $details['type'] = $cart_id->type;  //此处商品的配置还没有 暂时用测试数据
                //执行订单详情表的添加  如果添加失败就删除订单表
                if(!DB::table('details')->insert($details)){
                    DB::table('orders')->where('id','=',$id)->delete();
                }else{
                    //将提交订单的购物车id删除 也就是清除已经提价的购物车
                    DB::table('cart_list')->where('id','=',$v)->delete();
                }

            }
            //封装订单信息
            $ordermessage['ordercode'] =  $data['order_id']; //订单号
            $ordermessage['name'] =  '阮民'; //订单名称
            $ordermessage['fee'] =  0.1; //订单金额 此处是测试数据
            $ordermessage['des'] = '谨慎付款'; //订单描述

            

            return view('Home.Cart.BuyCar_Three',['ordermessage'=>$ordermessage]);
        }
        
        // dd($create);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //通过模型查询得到订单详情表的数据
        $data = Orders::find($id)->info;
        foreach($data as $row){
            //dd($row->goods_id);
            //根据商品id获取商品的信息
            $arr = DB::table('goods')
            ->join('picture','goods.goods_id','=','picture.goods_id')
            ->select('goods.goods_name','picture.url')
            ->where('goods.goods_id','=',$row->goods_id)
            ->groupBy('picture.goods_id')
            ->get();
            $row->goods_id = $arr;
        }
        //var_dump($arr);die;
        //将数据分配到模板中
        return view('Admin.Orders.details',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        //查找到需要修改的信息
        $data = DB::table('orders')->where('id','=',$id)->first();
        //dd($data);
        //将需要的信息分配到模板中
        return view('Admin.Orders.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminOrdersedit $request, $id)
    {
        //筛选数据
        $data = $request->except(['_token','_method']);
        //dd($data);
        //执行修改
        $bool = Orders::where('id','=',$id)->update($data);
        //dd($bool);
        if($bool){
            return redirect('/admin/orders')->with('success','修改成功');
        }else{
            return redirect("/admin/orders/".$id."/edit")->with('error','修改失败');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
        
        
    }

    public function send($id)
    {
       // dd($id);
       //修改订单的状态
       DB::table('orders')->where('id','=',$id)->update(['status'=>2]);
       return redirect('/admin/orders');
    }


    

}
