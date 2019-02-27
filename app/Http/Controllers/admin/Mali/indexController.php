<?php

namespace App\Http\Controllers\admin\Mali;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class indexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //获取友情链接数据
        $Mali=DB::table("mali")->paginate(5);
        //引入友情链接模板
        return view("admin.Mali.Index",['Mali'=>$Mali]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //添加模板
        return view("admin.Mali.add");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data=$request->except(['_token']);
        //入库
        if (DB::table("Mali")->insert($data)) {
            return redirect("/Mali")->with("success",'数据添加成功');
        }else{
            return redirect("Mali/create")->with("error",'数据添加失败');
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
        //执行删除
        if (DB::table("Mali")->where("id",'=',$id)->delete()) {
            return redirect("/Mali")->with('success','删除成功');
        }else{
            return redirect("/Mali")->with('error','删除失败');
        }
    }
}
