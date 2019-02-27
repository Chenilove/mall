<?php

namespace App\Http\Controllers\admin\Advert;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $Request)
    {
        //获取公告数据
        $Advert=DB::table("Advert")->paginate(5);
        //引入公告模板
        return view("admin.Advert.Index",['Advert'=>$Advert]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //广告添加
        //引入广告添加模板
        return view("admin.Advert.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   //打印下添加的数据
        //dd($request->all());
        $data=$request->only(['title','descr']);
        if ($data['descr'] == '') {
            return back()->with('error','请输入描述');
        }
        if ($data['title'] == '') {
            return back()->with('error','请输入标题');
        }
        //入库
        if (DB::table("Advert")->insert($data)) {
            return redirect("/Advert")->with("success",'数据添加成功');
        }else{
            return redirect("Advert/create")->with("error",'数据添加失败');
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
        
        //获取需要修改的代码
        $info=DB::table("Advert")->where("id",'=',$id)->first();
        //加载模板
        return view("admin.Advert.edit",['info'=>$info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   //获取修改提交过来的数据
        //dd($request->all());
        $data=$request->except(['_token','_method']);
        if ($data['descr'] == '') {
            return back()->with('error','请输入描述');
        }
        if ($data['title'] == '') {
            return back()->with('error','请输入标题');
        }
        //执行修改 入库
        if(DB::table("Advert")->where("id",'=',$id)->update($data)){
            return redirect("/Advert")->with("success","修改成功");
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
          //执行删除
        if(DB::table("Advert")->where("id",'=',$id)->delete()){
            return redirect("/Advert")->with('success','删除成功');
        }else{
            return redirect("/Advert")->with('error','删除失败');
        }
    }
}
