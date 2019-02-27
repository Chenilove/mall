<?php

namespace App\Http\Controllers\admin\Adminuser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//导入DB
use DB;
//导入Hash
use Hash;

class AdminuserController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取管理员列表
        $adminuser=DB::table('admin_users')->paginate(3);
        //加载模板
        return view("admin.adminuser.indexadmin",['adminuser'=>$adminuser]);
    }

    //分配角色
    public function rolelist($id){
        //获取后台管理员id
        //获取管理员信息
        $info=DB::table("admin_users")->where("id",'=',$id)->first();
        //获取角色信息
        $role=DB::table("role")->get();
        //获取当前管理员已有的角色信息
        $data=DB::table("user_role")->where("uid","=",$id)->get();
        // var_dump($data);
        //判断
        if(count($data)){
            //遍历
            foreach($data as $v){
                $rids[]=$v->rid;
            }
            //加载分配角色的模板
            return view("admin.adminuser.rolelist",['info'=>$info,'role'=>$role,'rids'=>$rids]);
        }else{
           //加载分配角色的模板
            return view("admin.adminuser.rolelist",['info'=>$info,'role'=>$role,'rids'=>array()]); 
        }
        // echo $id;  
    }
    //保存角色
    public function saverole(Request $request){
        // echo "这是保存角色";
        //向user_role 数据表插入数据 uid 用户id  rid  角色id
        //获取uid
        $uid=$request->input('uid');
        //获取分配的角色信息
        $rids=$_POST['rids'];
        // echo $uid;
        // var_dump($rids);
        //删除当前用户以前的角色
        DB::table("user_role")->where("uid","=",$uid)->delete();
        //遍历
        foreach($rids as $key=>$value){
            $data['rid']=$value;
            $data['uid']=$uid;
            //入库操作
            DB::table("user_role")->insert($data);
        }
        return redirect("/admin/adminsuser")->with('success','角色分配成功');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加模板
        return view("admin.adminuser.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取所有的参数
        // dd($request->all());
        $data=$request->except('_token');
        //密码加密
        $data['password']=Hash::make($data['password']);
        // dd($data);
        //入库
        if(DB::table("admin_users")->insert($data)){
            return redirect("/admin/adminsuser")->with('success','添加成功');
            // return redirect('/admin/adminsuser')->with('message', 'Message sent!');
        }else{
            return redirect("/admin/adminsuser/create")->with('error','添加失败');
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
        //管理员修改
        
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
        if(DB::table("admin_users")->where("id",'=',$id)->delete()){
            return redirect("admin/adminsuser")->with('success','删除成功');
        }else{
            return redirect("admin/adminsuser")->with('error','删除失败');
        }
    }
}

