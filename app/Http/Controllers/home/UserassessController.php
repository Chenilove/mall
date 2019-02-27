<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class UserassessController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->all());
        //接受评价传递过来的订单号以及商品id
        $oeder_code = $request->input('order_id');
        $good_id = $request->input('good_id');
        return view('home.assess.add',['order_code'=>$oeder_code,'cart'=>$this->cart,'good_id'=>$good_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //封装assess表的数据
        // dd($request->all());
        $ass['user_id'] = session('id');
        $ass['orders_id']= $request->input('order_id');
        $ass['goods_id'] = $request->input('good_id');
        $ass['created_at'] = date('Y-m-d H:i:s',time());

        //给assess表添加数据并获取插入的id
        if($id = DB::table('assess')->insertGetId( $ass )){
           //封装contents表格的数据
           $cont['aid'] = $id;
           $cont['user_content'] = $request->input('content');
           $cont['level'] = $request->input('level');

           //执行content添加数据并获取插入的id
           if($cid = DB::table('contents')->insertGetId( $cont )){
                $pic['c_id'] = $cid;
                //封装pictures表的数据
                //判断用户是否有文件上传
                if($request->hasFile('pic')){
                    //设置一个空数组用户存放图片的路径
                    $path = array();
                    //获取上传的图片并循环将图片添加到文件夹中
                    foreach($request->file('pic') as $value){
                        //初始化名字
                        $name = time()+rand(1,10000);
                        //获取文件上传后缀
                        $ext = $value->getClientOriginalExtension();
                        //移动到指定的目录下
                        $value->move("./upload/".date('Y-m-d',time())."/",$name.".".$ext);
                        $path[] = "/upload/".date('Y-m-d',time())."/".$name.".".$ext;
                    }
                    //dd($path);
                    foreach($path as $key=>$v){
                        $pic['pic'] = $v;
                        if(DB::table('pictures')->insert($pic)){
                            //echo '图片上传成功';
                        }else{
                            //如果上传失败就删除本来存好的图片
                            unlink($v);
                            //echo '图片上传失败';

                        }
                    }
                }
                //echo '评论成功';
                //修改订单的状态 
                DB::table('orders')->where('order_id','=',$request->input('order_id'))->update(['status'=>5]);
                return redirect('/');
           }else{
            //如果content表添加失败那就删除assess表的内容
            DB::table('assess')->where('id','=',$id)->delete();
            //echo '评论失败';
            return redirect('/');
           }
        }else{
            //echo '评论失败';
            return redirect('/');
        }
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
}
