<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//引入
use DB;

class CartController extends Controller
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
        //根据用户
        $data = DB::table('cart_list')
        ->join('goods','cart_list.goods_id','=','goods.goods_id')
        ->join('picture','goods.goods_id','=','picture.goods_id')
        ->select('cart_list.*','goods.goods_name','goods.price','picture.url')
        ->where('cart_list.user_id','=',session('id')) //此处填写用户ID 测试数据
        ->groupBy('picture.goods_id')
        ->get();
        //dd($data);

        //加载列表模板
        return view('home.Cart.index',['data'=>$data,'cart'=>$this->cart]);
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
        if (!session('id')) {
            return redirect('/homelogin');
        }
        //获取属性 (集合)
        $type = $request->except(['_token','goods_id']);
        
        //封装购物车表信息 
        $data['user_id'] = session('id'); //用户id为测试数据
        $data['num'] = 1; //购物车默认数量是1
        $data['goods_id']=$request->input('goods_id');  //商品id
        //空字符串用户存拼接好的属性
        $string = '';
        //遍历产品属性并连接成字符串
        foreach($type as $list){
            $string .= $list;
        }
        $data['type'] = $string; //商品属性
        
        
        //执行添加判断购物车,之前是否添加过这个商品
        $bool = DB::table('cart_list')
                ->where('user_id','=',$data['user_id'])
                ->where('goods_id','=',$data['goods_id'])
                ->where('type','=',$data['type'])
                ->first();
        if($bool){
            //将之前的数量执行自增
            $num = $bool->num + 1;
            //如果存在那就加1
            DB::table('cart_list')->where('id','=',$bool->id)->update(['num'=>$num]);
        }else{
            //如果之前没有加过 那就执行添加
            //执行添加
            DB::table('cart_list')->insert($data);
        }

        return redirect('/home/cart');
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
        
    }
    //数量减
    public function jian($id)
    {
       $list = DB::table('cart_list')->where('id','=',$id)->first();
       $num = $list->num;
       $num--;
       if($num<1){
        $num = 1;
       }
      DB::table('cart_list')->where('id','=',$id)->update(['num'=>$num]);
      return redirect('/home/cart');
    }
    //数量加
    public function add($id)
    {
      $list = DB::table('cart_list')->where('id','=',$id)->first();
       $num = $list->num;
       $num++;
       if($num>10){
        $num = 10;
       }
      DB::table('cart_list')->where('id','=',$id)->update(['num'=>$num]);
      return redirect('/home/cart');
    }

    //Ajax删除
    public function cartdelete(Request $request){
        $id = $request->input('id');
        //执行删除
        $bool = DB::table('cart_list')->where('id','=',$id)->delete();
        if($bool){
            echo 1;
        }else{
            echo 0;
        }
    }
    //确认订单方法
    public function order_confirm(Request $request){
        //dd($request->input('orders'));
        //接受购物车提交的订单信息
        $data = $request->only('orders');
        if(!empty($data)){
            //如果选择有选择商品在执行订单添加
            //设置一个空数组
            $arr = array();
            foreach($data['orders'] as $v){
                $arr[] = DB::table('cart_list')
                ->join('goods','cart_list.goods_id','=','goods.goods_id')
                ->join('picture','goods.goods_id','=','picture.goods_id')
                ->select('cart_list.*','goods.goods_name','goods.price','picture.url')
                ->where('cart_list.user_id','=',session('id')) //此处填写用户ID 测试数据
                ->where('cart_list.id','=',$v)
                ->groupBy('picture.goods_id')
                ->get(); 
            }
            // foreach ($arr as $value) {
            //     if (count($value)<1) {
            //         echo '<script>alert("啊偶,订单好像没有了")</script>';
            //         echo "<meta http-equiv='refresh' content='3;url=./'>";
            //         return;
            //     }
            // }
            $total = 0; //总价
            /*echo '<pre>';
            var_dump($arr);die;*/
            //根据用户id查找出他的所有地址
            $addresses = DB::table('address')->where('user_id','=',session('id'))->orderBy('status','desc')->get();

            //将实际地址遍历出来 
            foreach($addresses as $k=>$v){
                $arr1 = array();
                $str = '';
                $arr1 = explode(',',$v->city);
                foreach($arr1 as $value){
                    $str .= DB::table('district')->where('id','=',$value)->first()->name;

                }
                $v->city = $str;
            }
             /*var_dump($addresses);
             exit;*/
            return view('Home.Cart.BuyCar_Two',['arr'=>$arr,'addresses'=>$addresses,'total'=>$total,'cart'=>$this->cart]);
        }else{
            //没有选择商品,直接调回购物车首页
            return redirect('/home/cart');   
        }   
    }

}
