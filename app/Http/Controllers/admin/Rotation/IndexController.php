<?php

namespace App\Http\Controllers\Admin\Rotation;

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
        //获取数据
        $Rotation=DB::table("imgs")->paginate(3);
        //引入轮播图模板
        return view("admin.Rotation.Index",['Rotation'=>$Rotation]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加轮播图模板
        return view("admin.Rotation.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行添加
        //dd($request->all());
        //入库
        $data=$request->only(['pic','status','url']);
        //入库
        if (DB::table("imgs")->insert($data)) {
            return redirect("/Rotation")->with("success",'数据添加成功');
        }else{
            return redirect("Rotation/create")->with("error",'数据添加失败');
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
        $info=DB::table("imgs")->where("id",'=',$id)->first();
        //加载模板
        return view("admin.Rotation.edit",['info'=>$info]);
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
        $info=DB::table("imgs")->where("id","=",$id)->first();
        // echo $info->pic;
        preg_match_all('/<img.*?src="(.*?)".*?>/is',$info->pic,$arr);
        // 获取数据
        // dd($request->all());
        $data=$request->except(['_token','_method']); 
        //执行修改
        if(DB::table("imgs")->where("id",'=',$id)->update($data)){
           if (isset($arr[1])) {
               //遍历
               foreach ($arr[1] as $key => $v) {
                   unlink(".".$v);
               }
           }
            return redirect("/Rotation")->with('success','修改成功');
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
        $info=DB::table("imgs")->where("id",'=',$id)->first();
        //echo $info->descr;
        preg_match_all('/<img.*?src="(.*?)".*?>/is',$info->pic,$arr);
        // echo "<per>";
        // var_dump($arr);
        // 执行删除
        if(DB::table("imgs")->where("id",'=',$id)->delete()){
            //有图片删图片
            if (isset($arr[1])) {
                //删除百度编辑器上传的图片
                foreach ($arr[1] as $key => $v) {
                     $s=substr($v,-3);
                    if($s=="jpg"){
                        unlink(".".$v);
                    }
                    
                }
                return redirect("/Rotation")->with("success",'删除成功');
            }
        }
    }
}
