<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//引入DB类
use DB;

class AddressController extends Controller
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

        $this->cart = $cart;
    }

    public function index()
    {
        //获取目前用户已经添加的地址
        $data = DB::table('address')->where('user_id','=',session('id'))->orderBy('status', 'desc')->get();
        //将地址遍历出来
        foreach($data as $key=>$v){
            $arr = array();
             $list = '';
            $arr = explode(',',$v->city);
            foreach($arr as $value){
                $rows= DB::table('district')->where('id','=',$value)->first();
                $list .= $rows->name;
                $v->city = $list;
            }
        }
        return view('Home.address.index_Address',['data'=>$data,'cart'=>$this->cart]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Home.address.add_Address',['cart'=>$this->cart]);
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
        $data = $request->except(['_token']);
        //dd($data);
        //封装地址表的数据
        $data['user_id'] = session('id');
        //添加
        if(DB::table('address')->insert($data)){
            return redirect('/home/address');
        }else{
            echo '地址添加失败';
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
        //dd($id);
        //dd($request->all());
        //将不要的值排除掉
        $data = $request->except(['_token','_method']);
        //执行修改
        if(DB::table('address')->where('id','=',$id)->update($data)){
            return redirect('/home/address');
        }else{
            return redirect('/home/address');
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
        //
    }
    //Ajax地址查找
    public function add_address(Request $request)
    {
        //接受upid值
        $upid = $request->input('upid');
        //echo $upid;
        $data = DB::table('district')->where('upid','=',$upid)->get();
        echo json_encode($data);


    }
    //设置默认地址
    public function default_address($id)
    {
       //根据用户id,将他的地址状态全部变为0 此处测试用户id为1
       DB::table('address')->where('user_id','=',session('id'))->update(['status'=>0]);
       //将选中的地址变为默认地址
       DB::table('address')->where('id','=',$id)->update(['status'=>1]);

       return redirect('/home/address');
    }
    //Ajax地址删除
    public function deletes(Request $request)
    {   //获取需要删除的id
        $id = $request->input('id');
        if(DB::table('address')->where('id','=',$id)->delete()){
            echo 1;
        }

    }
    //Ajax修改
    public function updates(Request $request)
    {
        //获取需要修改的id
        $id = $request->input('id');
        //echo $id;
        //查找需要修改地址的信息
        $data = DB::table('address')->where('id','=',$id)->first();

        //准备空数组存放具体的省市县district ID号
        $arr = array();
        //准备另一个空数组存放具体的省市县名称
        $arr1 = array();
        $arr = explode(',',$data->city);
        foreach($arr as $key=>$value){
            $row = DB::table('district')->where('id','=',$value)->first();
            $arr1[]=$row->name;
        }
        //省的地址单独存放
        $arr3 = array();
        $key = $arr[0];
        $v = $arr1[0];
        $arr3[$key] = $v;
        //删除各自的省份 因为合并后是索引数组,在删除会破坏索引结构,所以合并前删除
        array_shift($arr);
        array_shift($arr1);
        //新生成一个以城市ID号为键名,name为值的新数组并把省的去除掉
        $new = array_combine($arr,$arr1);
        //返回页面
        return view('home.address.add_ajax',['data'=>$data,'id'=>$id,'new'=>$new,'arr3'=>$arr3,'cart'=>$this->cart]);
    }

  
}
