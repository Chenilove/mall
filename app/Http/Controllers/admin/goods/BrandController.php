<?php

namespace App\Http\Controllers\admin\goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //判断并获取搜索关键字
        $query = $request->has('query')?$request->input('query'):'';
        $request->flashOnly('query',$query);
        //获取所有品牌
        $brand = DB::table('brand')->where('brand_name','like','%'.$query.'%')->paginate(10);
        //载入模板
        return view('admin.goods.brand',['brand'=>$brand,'request'=>$request->all()]);
    }

    /**
     * 添加品牌
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取添加参数
        $brand['brand_name'] = $request->input('brand_name');
        //文件上传
        //参数判断
        if (!$request->hasFile('img')) {
            return redirect('/admin/goods-brand')->with('error','啊偶...服务器抽风了...图片上传失败');
        }
        //文件命名
        $fileName = time().mt_rand(10000,99999);
        //获取文件后缀
        $extension = $request->file('img')->getClientOriginalExtension();
        //文件路径
        $filePath = '/upload/'.date('Y-m-d').'/'.$fileName.'.'.$extension;
        //移动文件
        $request->file('img')->move('./upload/'.date('Y-m-d').'/',$fileName.'.'.$extension);
        //赋值文件路径
        $brand['img'] = $filePath;

        //存入数据库
        if (DB::table('brand')->insert($brand)) {
            return redirect('/admin/goods-brand')->with('success','添加品牌成功');
        }else{
            //删除图片
            Storage::disk('uploads')->delete($filePath);
            return redirect('/admin/goods-brand')->with('success','添加品牌失败');
        }


    }

    /**
     * 修改品牌
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // 获取修改参数
        $brand['brand_name'] = $request->input('brand_name');
        $brand_id = $request->input('brand_id');
        //判断是否需要上传图片
        if ($request->has('img')) {
            //文件命名
            $fileName = time().mt_rand(10000,99999);
            //获取文件后缀
            $extension = $request->file('img')->getClientOriginalExtension();
            //文件路径
            $filePath = '/upload/'.date('Y-m-d').'/'.$fileName.'.'.$extension;
            //移动文件
            $request->file('img')->move('./upload/'.date('Y-m-d').'/',$fileName.'.'.$extension);
            //赋值文件路径
            $brand['img'] = $filePath;
            //获取旧图地址
            $b = DB::table('brand')->where('brand_id','=',$brand_id)->first();
            $oldImg = $b->img;
        }
        //修改数据库
        if (DB::table('brand')->where('brand_id','=',$brand_id)->update($brand)) {
            //判断并删除旧图片
            if ($request->has('img')) {
             Storage::disk('uploads')->delete($oldImg);
            }
            return redirect('/admin/goods-brand')->with('success','修改品牌成功');
        }else{
            //判断并删除新图片
            if ($request->has('img')) {
             Storage::disk('uploads')->delete($filePath);
            }
            return redirect('/admin/goods-brand')->with('error','修改品牌失败');
        }

    }

    //ajax删除 1 --成功 3 -- id为空
    public function del(Request $request)
    {
        //获取id数组
        $id = $request->input('id');
        //如果数组为空则停止代码,返回3
        if (empty($id)) {
           return 3;
        }
        //删除品牌
        foreach($id as $v){
            //删除图片
            $b = DB::table('brand')->where('brand_id','=',$v)->first();
            Storage::disk('uploads')->delete($b->img);
            //删除数据表数据
            DB::table('brand')->where('brand_id','=',$v)->delete();
        }
        return 1;
    }
}
