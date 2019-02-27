<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入DB类
use DB;

class AssessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //三表联查  原生sql语句查询
        $data = DB::select('SELECT
        `assess`.`user_id`,`assess`.`orders_id`,`assess`.`goods_id`,`contents`.`id`, `contents`.`aid`,
        `contents`.`level`,
        `contents`.`user_content`,
        `business_content`
        FROM
            `assess`
        INNER JOIN `contents` ON `assess`.`id` = `contents`.`aid`');
        // dd($data);
        //查找出图片的路径地址
        foreach ($data as $v){
            //将与用户评论相关的图片当做一个字段添加到$v中
            $v->img = DB::table('pictures')->where('c_id','=',$v->id)->pluck('pic');
        }

        //dd($data);die;
        //评价列表
        return view('Admin.assess.index' ,['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //导入添加模板
        return view('Admin.assess.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //封装assess表的数据
        $ass['user_id'] = 12;
        $ass['orders_id']= 1234;
        $ass['goods_id'] = 12;
        $ass['created_at'] = date('Y-m-d H:i:s',time());

        //给assess表添加数据并获取插入的id
        if($id = DB::table('assess')->insertGetId( $ass )){
           //封装contents表格的数据
           $cont['aid'] = $id;
           $cont['user_content'] = $request->input('content');
           $cont['level'] = 5;

           //执行content添加数据并获取插入的id
           if($cid = DB::table('contents')->insertGetId( $cont )){
                $pic['c_id'] = $cid;
                //封装pictures表的数据
                //判断用户是否有文件上传
                if($request->hasFile('pic')){
                    //设置一个空数组用户存放图片的路径
                    $path = array();
                    //获取上传的图片并循环将图片添加到文件夹中
                    foreach($request->file('pic') as $value){
                        //初始化名字
                        $name = time()+rand(1,10000);
                        //获取文件上传后缀
                        $ext = $value->getClientOriginalExtension();
                        //移动到指定的目录下
                        $value->move("./uploads/".date('Y-m-d',time())."/",$name.".".$ext);
                        $path[] = "/uploads/".date('Y-m-d',time())."/".$name.".".$ext;
                    }
                    //dd($path);
                    foreach($path as $key=>$v){
                        $pic['pic'] = $v;
                        if(DB::table('pictures')->insert($pic)){
                            echo '图片上传成功';
                        }else{
                            //如果上传失败就删除本来存好的图片
                            unlink($v);
                            echo '图片上传失败';

                        }
                    }
                }
                echo '评论成功';
           }else{
            //如果content表添加失败那就删除assess表的内容
            DB::table('assess')->where('id','=',$id)->delete();
            echo '评论失败';
           }
        }else{
            echo '评论失败';
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
        //dd($id);
        //根据id 修改用户评论
        $data =  DB::table('contents')->where('id','=',$id)->first();
        return view('Admin.assess.edit',['data'=>$data]);
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
        //dd($request->input('content'));
        //执行修改
        DB::table('contents')->where('id','=',$id)->update(['business_content'=>$request->input('content')]);
        return redirect('/admin/assess');
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
