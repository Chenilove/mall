<?php

namespace App\Http\Controllers\admin\cates;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
class CatesController extends Controller
{
    
    /**
     * 添加父子类分隔符函数
     * @param   二维数组
     * @return  二维数组
     */
    public static function class($arr)
    {
        $count = 0;
        foreach ($arr as $key => $value) {

            $count = count(explode(',',$value->path))-1;
            $value->name = str_repeat('----|',$count).$value->name;
        }
        return $arr;
    }
    /**
     * 显示分类列表/添加分类
     *
     * @return 分类列表模板
     */
    public function index(Request $request)
    {
        //默认查看顶级分类,通过传参判断是否在查看子分类
        $pid = empty($request->input('pid'))?0:$request->input('pid');

        //查询分类列表
        $cates = DB::table('cates')
                ->select(DB::raw(' *,concat(path,",",id) as pth'))
                ->where('pid','=',$pid)
                ->orderBy('pth','ASC')
                ->paginate(8);

        //查询所有列表分类并给分类加分隔符(添加分类用)
        $addCates = DB::table('cates')
                ->select(DB::raw(' *,concat(path,",",id) as pth'))
                ->orderBy('pth','ASC')
                ->get();
            //添加分隔符
            CatesController::class($addCates);

        //查看有没有子分类,有子分类child属性得到一个true ,没有则是false,用于前台判断
        foreach ($cates as $key=>$value) {
            if (count(DB::table('cates')->where('pid','=',$value->id)->get())) {
                $value->child = true;
            }else{
                $value->child = false;
            }
        }
        //加载商品分类表格模板,将列表数组传递过去
        //$cates --分类列表 $addCates--添加分类时的分类列表
        return view('admin.cates.cates',['cates'=>$cates,'add'=>$addCates]);
    }

    /**
     * 进行添加分类操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //取得表单提交的参数
        $cate = $request->except('_token');
        //文件上传
        //参数判断
        if (!$request->hasFile('img')) {
            return redirect('/admin/cates')->with('error','啊偶...服务器抽风了...图片添加失败');
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
        $cate['img'] = $filePath;
        //判断是否勾选了status字段,没有勾选则是下架,勾选了则是上架
        if (empty($cate['status'])) {
            $cate['status'] = 0;
        }else{
            $cate['status'] = 1;
        }
        //判断pid是否为0,0即使顶级分类,不是0,则查询它的父级分类,将父级的path和pid拼接起来,得到一个path路径
        if ($cate['pid'] == 0) {
            $cate['path'] = 0;
        }else{
            $parent = DB::table('cates')->where('id','=',$cate['pid'])->first();
            $cate['path'] = $parent->path.','.$cate['pid'];
        }
        //存入数据库,并判断存入是否成功
        if ( DB::table('cates')->insert($cate)) {
            return redirect('/admin/cates')->with('success','分类添加成功~');
        }else{
            //删除文件
            Storage::disk('uploads')->delete($filePath);
            return redirect('/admin/cates')->with('error','啊偶...服务器抽风了...添加失败');
        }
    }

    /**
     * ajax修改商品状态
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //查询该分类
        $status = DB::table('cates')->where('id','=',$id)->first();
        if ($status->status == 0) {
            DB::table('cates')->where('id','=',$id)->update(['status'=>1]);
        }else{
            DB::table('cates')->where('id','=',$id)->update(['status'=>0]);
        }
    }

    /**
     * ajax删除分类
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        //获取删除分类id
        $id =  $request->input('id');
        //查看是否有子分类
        if (count(DB::table('cates')->where('pid','=',$id)->get())) {
            //int 2 ---代表存有子分类
            echo 2;
        }else{
            //执行删除  int 1 ---代表删除成功
            // 删除图片
            $cate = DB::table('cates')->where('id','=',$id)->first();
            // echo $cate['img'];
            Storage::disk('uploads')->delete($cate->img);
            // unlink($cate->img);
            DB::table('cates')->where('id','=',$id)->delete();
            echo 1;
        }
    }    
    /**
        执行修改分类
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCate(Request $request)
    {
        //获取修改分类的参数
        $cate = $request->except('_token','id');
        //获取修改分类的id
        $id = $request->input('id');
        //判断pid和id是否一致,一致则阻止修改,因为自己不能当自己的爸爸
        if ($id == $cate['pid']) {
            return redirect('/admin/cates')->with('error','分类修改失败...不能修改自己为父类');
        }
        //文件上传
        //参数判断,如果有文件则修改,无文件无需修改
        if ($request->hasFile('img')) {
            //文件命名
            $fileName = time().mt_rand(10000,99999);
            //获取文件后缀
            $extension = $request->file('img')->getClientOriginalExtension();
            //新文件路径
            $newFilePath = './upload/'.date('Y-m-d').'/'.$fileName.'.'.$extension;
            //移动文件
            $request->file('img')->move('./upload/'.date('Y-m-d').'/',$fileName.'.'.$extension);
            //赋值新文件路径
            $cate['img'] = $newFilePath;
            //获取旧文件路径,修改成功后将删除此文件
            $oldCate = DB::table('cates')->where('id','=',$id)->first();
            $oldFilePath = $oldCate->img;
        }
        
        //判断是否勾选了status字段,没有勾选则是下架,勾选了则是上架
        if (empty($cate['status'])) {
            $cate['status'] = 0;
        }else{
            $cate['status'] = 1;
        }
        //判断pid是否为0,0即使顶级分类,不是0,则查询它的父级分类,将父级的path和pid拼接起来,得到一个path路径
        if ($cate['pid'] == 0) {
            $cate['path'] = 0;
        }else{
            $parent = DB::table('cates')->where('id','=',$cate['pid'])->first();
            $cate['path'] = $parent->path.','.$cate['pid'];
        }
        //执行修改,并判断修改是否成功Storage::disk('uploads')->delete($cate->img);
        if ( DB::table('cates')->where('id','=',$id)->update($cate)) {
            //修改成功删除旧图片
            if ($request->hasFile('img')) {
                Storage::disk('uploads')->delete($oldFilePath);
                return redirect('/admin/cates')->with('success','分类修改成功~已删除新图片');
            }else{
                return redirect('/admin/cates')->with('success','分类修改成功~');
            }

        }else{
            //修改失败删除新图片
            if ($request->hasFile('img')) {
                Storage::disk('uploads')->delete($newFilePath);
                return redirect('/admin/cates')->with('error','分类修改失败...已删除旧图片');
            }else{
                return redirect('/admin/cates')->with('error','分类修改失败...');
            }
        }
    }



}
