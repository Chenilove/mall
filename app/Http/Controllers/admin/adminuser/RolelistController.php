<?php

namespace App\Http\Controllers\admin\Adminuser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class RolelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取角色信息
        $role=DB::table("role")->get();
        //加载模板 分配数据
        return view("Admin.Rolelist.index",['role'=>$role]);
    }

    //分配权限
    public function auth($id){
        //获取当前角色
        $role=DB::table("role")->where("id",'=',$id)->first();
        //获取所有的权限
        $auth=DB::table("node")->get();
        //获取当前角色已有的权限列表
        $data=DB::table("role_node")->where("rid",'=',$id)->get();
        //判断
        if(count($data)){
            //遍历
            foreach($data as $v){
                $nids[]=$v->nid;
            }
            //加载分配权限的列表
            return view("Admin.Rolelist.auth",['role'=>$role,'auth'=>$auth,'nids'=>$nids]);
        }else{
            return view("Admin.Rolelist.auth",['role'=>$role,'auth'=>$auth,'nids'=>array()]);

        }
        
    }

    //保存权限
    public function saveauth(Request $request){
        //向role_node 表插入数据 rid 角色id  nid 节点id
        $rid=$request->input("rid");
        $nids=$_POST['nids'];
        //删除当前角色已有的权限信息
        DB::table("role_node")->where("rid",'=',$rid)->delete();
        //遍历
        foreach($nids as $key=>$value){
            //入库操作
            $data['rid']=$rid;
            $data['nid']=$value;
            //插入
            DB::table("role_node")->insert($data);
        }

        return redirect("/rolelist")->with('success','权限分配成功');

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
