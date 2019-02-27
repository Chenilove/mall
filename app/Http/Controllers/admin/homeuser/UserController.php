<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        //获取数据总条数
        $tot=DB::table("users")->count();
        //每页显示的数据条数
        $rev=3;
         //获取数据最大页
        $maxpage=ceil($tot/$rev);
        //获取参数page
        $page=$request->input('page');
        //判断
        if(empty($page)){
            $page=1;
        }
        //获取偏移量
        $offset=($page-1)*$rev;
        //准备sql
        $sql="select * from users limit {$offset},{$rev}";
        //执行sql
        $data=DB::select($sql);
        //检测为Ajax请求
        if($request->ajax()){
            // echo $page;exit;
            //单独加载模板 把Ajax 当前页数据分配过去
            return view("Admin.Adminuserss.test",['data'=>$data]);
        }
        // echo $page;
        // echo $maxpage;
        $pp=array();
        //遍历
        for($i=1;$i<=$maxpage;$i++){
            $pp[$i]=$i;
        }

        // var_dump($pp);

        //加载模板
        return view("Admin.Adminuserss.index",['pp'=>$pp,'data'=>$data]);
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
}
