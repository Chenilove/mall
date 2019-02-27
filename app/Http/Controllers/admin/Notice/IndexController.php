<?php

namespace App\Http\Controllers\Admin\Notice;

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
        $Notice=DB::table("Notice")->paginate(5);
        //引入公告模板
        return view("admin.Notice.Index",['Notice'=>$Notice]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //引入添加公告模板
        return view("admin.Notice.add");
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
        $data=$request->only(['title','descr','tishi']);
        if ($data['tishi'] == '') {
            return back()->with('error','请输入提示');
        }
        if ($data['title'] == '') {
            return back()->with('error','请输入标题');
        }
        if ($data['descr'] == '') {
            return back()->with('error','请输入标题');
        }
        //入库
        if (DB::table("Notice")->insert($data)) {
            return redirect("/Notice")->with("success",'数据添加成功');
        }else{
            return redirect("Notice/create")->with("error",'数据添加失败');
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
        $info=DB::table("Notice")->where("id",'=',$id)->first();
        //加载模板
        return view("admin.Notice.edit",['info'=>$info]);
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
        //获取需要修改数据
        $info=DB::table("Notice")->where("id","=",$id)->first();
        if ($data['tishi'] == '') {
            return back()->with('error','请输入提示');
        }
        if ($data['title'] == '') {
            return back()->with('error','请输入标题');
        }
        if ($data['descr'] == '') {
            return back()->with('error','请输入标题');
        }
        // echo $info->descr;
        preg_match_all('/<img.*?src="(.*?)".*?>/is',$info->descr,$arr);
        // 获取数据
        // dd($request->all());
        $data=$request->except(['_token','_method']);
        //执行修改
        if(DB::table("Notice")->where("id",'=',$id)->update($data)){
           if (isset($arr[1])) {
               //遍历
               foreach ($arr[1] as $key => $v) {
                   unlink(".".$v);
               }
           }
            return redirect("/Notice")->with('success','修改成功');
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
        //echo $id;
        //执行删除
        $info=DB::table("Notice")->where("id",'=',$id)->first();
        //echo $info->descr;
        preg_match_all('/<img.*?src="(.*?)".*?>/is',$info->descr,$arr);
        // echo "<per>";
        // var_dump($arr);
        // 执行删除
        if(DB::table("Notice")->where("id",'=',$id)->delete()){
            //有图片删图片
            if (isset($arr[1])) {
                //删除百度编辑器上传的图片
                foreach ($arr[1] as $key => $v) {
                     $s=substr($v,-3);
                    if($s=="jpg"){
                        unlink(".".$v);
                    }
                    
                }
                return redirect("/Notice")->with("success",'删除成功');
            }
        }
    }
}
