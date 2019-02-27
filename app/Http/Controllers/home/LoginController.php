<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Mail;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //退出
        $request->session()->pull('id');
        //跳转
        return redirect("/homelogin/create");

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载登录模板
        return view("Home.Login.login");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行登录
        $email=$request->input('email');
        $password=$request->input('password');
        //检测邮箱
        $row=DB::table("users")->where("email",'=',$email)->first();
        // dd($row);
        // echo "<pre>";
        // var_dump($row);die;
        if(count($row)){
            //检测密码
            if(Hash::check($password,$row->password)){
                //状态值检测
                if($row->status==2){
                    //将会员的信息存储在session里
                    session(['id'=>$row->id]);
                    session(['username'=>$row->username]);

                    // echo "登录成功";
                    return redirect("/");
                }else{
                    return back()->with('error','用户没有激活');

                }
            }else{
                return back()->with('error','密码有误');

            }
        }else{
                return back()->with('error','邮箱有误');
        }
    }
    //邮件测试发送  $id,$token,$mail 接收方
    public function sendMail($id,$token,$mail){
        // Home.Register.a 模板  ['id'=>$id,'token'=>$token] 分配参数 
        // $message 消息生成器
        //在闭包函数内部不能直接使用闭包函数外部的变量  如果想使用 use 导入
        Mail::send('Home.Login.a',['id'=>$id,'token'=>$token],function($message)use($mail){
            $message->to($mail);
            $message->subject('密码重置');
        });
        return true;
    }
    public function forget(){
        return view("Home.Login.forget");
    }
    public function doforget(Request $request){
        //获取email
        $email=$request->input('email');
        //获取数据库的数据
        $info=DB::table("users")->where("email",'=',$email)->first();
        //发送邮件找回密码
        $res=$this->sendMail($info->id,$info->token,$email);
        if($res){
            echo "重置密码的邮件已经发送成功,请登录邮箱重置密码";
        }
    }

    //重置密码
    public function reset(Request $request){
        // echo $request->input('id').":".$request->input('token');
        $id=$request->input('id');
        $info=DB::table("users")->where("id","=",$id)->first();
        $token=$request->input('token');
        // 对比 加载密码重置模板
        if($token==$info->token){
            return view("Home.Login.reset",['id'=>$id]);
        }
    }

    public function doreset(Request $request){
        $id=$request->input('id');
        $data['password']=Hash::make($request->input('password'));
        $data['token']=rand(1,10000);
        //执行密码修改
        if(DB::table("users")->where("id",'=',$id)->update($data)){
            return redirect("/homelogin/create");
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
        //
    }

    public function logout(Request $request){
        //注销
        $request->session()->pull('id');
        
        $request->session()->pull('username');
        return redirect("/");
    }
}
