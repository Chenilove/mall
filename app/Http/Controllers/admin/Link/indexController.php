<?php

namespace App\Http\Controllers\admin\Link;

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
        //引入模板
        
        //获取友情链接数据
        $Tips=DB::table("links")->paginate(5);
        //引入友情链接模板
        return view("admin.links.Index",['Tips'=>$Tips]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加模板
        return view("admin.links.add");
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   //获取添加的数据
        //dd($request->all());
        $data=$request->except(['_token']);
        $data['status'] = 0;
        //入库
        if (DB::table("links")->insert($data)) {
            return redirect("/Tips")->with("success",'数据添加成功');
        }else{
            return redirect("Tips/create")->with("error",'数据添加失败');
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
        $info=DB::table("links")->where("id",'=',$id)->first();
        //加载模板
        return view("admin.links.edit",['info'=>$info]);
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
        //dd($request->all());
        $data=$request->except(['_token','_method']);
        $data['status'] = 0;
        //执行修改 入库
        if(DB::table("links")->where("id",'=',$id)->update($data)){
            return redirect("/Tips")->with("success","修改成功");
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
        if(DB::table("links")->where("id",'=',$id)->delete()){
            return redirect("/Tips")->with('success','删除成功');
        }else{
            return redirect("/Tips")->with('error','删除失败');
        }
    }
}
