<?php

namespace App\Http\Controllers\Admin\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
//引入表单校验请求类 use 导入
use App\Http\Requests\AdminUserInsert;
//引入模型类
use App\Models\Userss;
//引入自定义类A
use A;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取搜索参数
        $k=$request->input("keywords");
        $k1=$request->input("keywordss");
        //通过模型类Userss 获取会员列表 分页和搜索
        $user=Userss::where("username",'like',"%".$k."%")->where('email','like',"%".$k1."%")->paginate(3);
        return view("Admin.Users.index",['user'=>$user,'request'=>$request->all()]);

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
    public function store(AdminUserInsert $request)
    {
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // echo "会员详情";
        //获取会员关联的会员详情数据
        $userinfo=Userss::find($id)->info;
        // dd($userinfo);
        //加载模板 分配数据
        return view("Admin.Users.info",['userinfo'=>$userinfo]);
    }

    public function address($id){
        // echo "this is address";
        //获取会员关联的会员收货地址
        $address=Userss::find($id)->useraddress;
        // dd($address);
        //加载模板 分配数据
        return view("Admin.Users.address",['address'=>$address]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // echo $id;
        if(Userss::where("id",'=',$id)->delete()){
            return redirect("/adminuser")->with('success','删除成功');
        }else{
            return redirect("/adminuser")->with('error','删除失败');
        }
    }

    public function del(Request $request){
        $id=$request->input("id");
        // echo $id;
        if(DB::table("users")->where("id",'=',$id)->delete()){
            echo 1;
        }else{
            echo 0;
        }
    }

    //调用自定义函数 fun()
    public function func(){
        fun();
    }

    //调用自定义类文件
    public function cc(){
        //实例化类A
        $a=new A();
        //调用方法
        $a->weixinpays();
    }

    public function message(){
        sendsphone('18235148655');
    }
}
