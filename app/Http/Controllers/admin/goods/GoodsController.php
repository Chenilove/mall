<?php

namespace App\Http\Controllers\admin\goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
class GoodsController extends Controller
{
    /**
     * 显示商品列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取搜索分类关键字
        $cate_id = $request->has('cate')?$request->input('cate'):'';
        //获取搜索商品关键字并存入缓存
        $query = $request->has('query')?$request->input('query'):'';
        $request->flashOnly('query',$query);
        //查询商品以及它的种类品牌信息
        $goods = DB::table('goods')
                ->leftJoin('cates','goods.cate_id','=','cates.id')
                ->join('brand','goods.brand_id','=','brand.brand_id')
                ->where('goods.goods_name','like','%'.$query.'%')//搜索商品关键字
                ->paginate(9);
        //搜索分类
        if (!empty($cate_id)) {
            $goods = DB::table('goods')
                ->leftJoin('cates','goods.cate_id','=','cates.id')
                ->join('brand','goods.brand_id','=','brand.brand_id')
                ->where('cate_id','=',$cate_id)//搜索商品分类
                ->where('goods.goods_name','like','%'.$query.'%')//搜索商品关键字
                ->paginate(9);
        }
        foreach($goods as $value){
            $value->goods_img = DB::table('picture')->where('goods_id','=',$value->goods_id)->get();
        }
        //从数据库取出分类
        $cates = DB::table('cates')
                ->select(DB::raw('*,concat(path,",",id) as pth'))//排序需要拼接一个字段
                ->orderBy('pth','ASC')//分类排序
                ->get();
        //调用分类添加分隔符函数
        $cates = GoodsController::class($cates);
        //载入商品列表模板
        return view('admin.goods.goods.index',['goods'=>$goods,'query'=>$query,'cates'=>$cates,'cate_id'=>$cate_id]);
    }

    /**
     * 显示添加商品列表
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //从数据库取出分类
        $cates = DB::table('cates')
                ->select(DB::raw('*,concat(path,",",id) as pth'))//排序需要拼接一个字段
                ->orderBy('pth','ASC')//分类排序
                ->get();
        //调用分类添加分隔符函数
        $cates = GoodsController::class($cates);
        //从数据库中取出品牌
        $brand = DB::table('brand')->get();
        //从数据库取出规格与属性
        $specification = DB::table('specification')->get();
        //将规格旗下的属性取出并赋值到对象数组中
        foreach ($specification as $value) {
            $value->attr = DB::table('attribute')
                            ->where('spec_id',$value->spec_id)//每个规格旗下的属性
                            ->get();
        }
        //引入模板
        return view('admin.goods.goods.add',['cates'=>$cates,'brand'=>$brand,'specification'=>$specification]);

    }
    //分类添加分隔符函数
    public static function class($arr)
    {
        $count = 0;
        foreach($arr as $v){
            $count = count(explode(',',$v->path))-1;
            $v->name = str_repeat('----|',$count).$v->name;
        }
        return $arr;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //先判断参数数据是否正确
            //判断图片是否上传成功
            if (!$request->hasFile('img')) {
                return back()->with('error','啊偶...图片上传失败,请重新上传');
            }
            //获取所有图片
            $file = $request->file("img");
            //判断图片是否是超过4张
            if (count($file) != 4) {
                return back()->withInput()->with('error','请上传4张图片');
            }
            //判断descr商品详情描述是否为空
            if (empty($request->input('descr'))) {
                return back()->withInput()->with('error','商品描述不能为空');
            }
        //参数正确
        //获取所有参数
        $goods = $request->except('_token','pricea','priceb','img','attribute');
        // 封装参数
            //封装价格
            $pricea = $request->input('pricea');//获取小数点前面的数
            $priceb = round($request->input('priceb'),2);//获取小数点后面的数(精确到百分位)
            $goods['price'] = (float)($pricea.'.'.$priceb);//拼接并转化为浮点数
            //封装参考价格 增加60% 精确到百分位
            $goods['reference'] = round($goods['price'] * 1.6,2);
            //封装属性
            $attribute = $request->input('attribute');//获取所有属性
            $attr = implode(',',$attribute);//将属性用','连接起来
            $goods['attribute'] = $attr;//赋值
            //封装商品编号
            $goods['numbering'] = time();
            //封装上架时间
            $goods['added_time'] = time();
            //封装商品状态
            $goods['goods_status'] = 1;
            //封装商品点赞数
            $goods['like'] = 0;
        //存入商品表并获取存入后的商品ID
        $goods_id = DB::table('goods')->insertGetId($goods);
        if (!$goods_id) {
            return back()->withInput()->with('error','数据库存入失败,请重试');
        }
        //商品图片上传
        //循环存入图片
        foreach ($file as $key => $value) {
            //文件命名
            $fileName = time().mt_rand(10000,99999);
            //获取文件后缀
            $extension = $value->getClientOriginalExtension();
            //文件路径
            $filePath = '/upload/'.date('Y-m-d').'/'.$fileName.'.'.$extension;
            //移动文件
            $value->move('./upload/'.date('Y-m-d').'/',$fileName.'.'.$extension);
            //赋值文件路径和商品id给一个变量
            $img['url'] = $filePath;
            $img['goods_id'] = $goods_id;
            //存入商品图片表
            DB::table('picture')->insert($img);
        }
        //跳转回商品表
        return redirect('/admin/goods')->with('success','商品注册成功!!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //查询修改的商品
        $goods = DB::table('goods')->where('goods_id','=',$id)->first();
        //判断并修改
        if ($goods->goods_status == 0) {
            DB::table('goods')->where('goods_id','=',$id)->update(['goods_status'=>1]);
        }else{
            DB::table('goods')->where('goods_id','=',$id)->update(['goods_status'=>0]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //查出当前商品
        $goods = DB::table('goods')
                ->where('goods_id','=',$id)
                ->first();
            //价格修改
        $goods->priceb = (int)(mb_substr($goods->price*100,-2));
        $goods->pricea = (int)($goods->price - ($goods->priceb/100));
            //属性变为数组
        $goods->attr = explode(',',$goods->attribute);
        //商品图片
        $pic = DB::table('picture')
                ->where('goods_id','=',$id)
                ->get();
        $goods->pic = $pic;
        //从数据库取出分类
        $cates = DB::table('cates')
                ->select(DB::raw('*,concat(path,",",id) as pth'))//排序需要拼接一个字段
                ->orderBy('pth','ASC')//分类排序
                ->get();
        //调用分类添加分隔符函数
        $cates = GoodsController::class($cates);
        //从数据库中取出品牌
        $brand = DB::table('brand')->get();
        //从数据库取出规格与属性
        $specification = DB::table('specification')->get();
        //将规格旗下的属性取出并赋值到对象数组中
        foreach ($specification as $value) {
            $value->attr = DB::table('attribute')
                            ->where('spec_id',$value->spec_id)//每个规格旗下的属性
                            ->get();
        }
        //引入模板
        return view('admin.goods.goods.edit',['goods'=>$goods,'cates'=>$cates,'brand'=>$brand,'specification'=>$specification,'id'=>$id]);
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
        //先判断参数数据是否正确
            //获取所有图片
            $file = $request->file("img");
            //判断图片是否是超过4张或不上传
            if (count($file) != 4 && count($file) != 0) {
                return back()->with('error','请上传4张新图片或者不上传新图片');
            }
            //判断descr商品详情描述是否为空
            if (empty($request->input('descr'))) {
                return back()->with('error','商品描述不能为空');
            }
        //参数正确
        //获取所有参数
        $goods = $request->except('_token','pricea','priceb','img','attribute','_method','goods_id');
        //获取商品id
        $id = $request->input('goods_id');
        // 封装参数
            //封装价格
            $pricea = $request->input('pricea');//获取小数点前面的数
            $priceb = round($request->input('priceb'),2);//获取小数点后面的数(精确到百分位)
            $goods['price'] = (float)($pricea.'.'.$priceb);//拼接并转化为浮点数
            //封装参考价格 增加60% 精确到百分位
            $goods['reference'] = round($goods['price'] * 1.6,2);
            //封装属性
            $attribute = $request->input('attribute');//获取所有属性
            $attr = implode(',',$attribute);//将属性用','连接起来
            $goods['attribute'] = $attr;//赋值属性
        //修改商品表
        DB::table('goods')->where('goods_id','=',$id)->update($goods);
        //商品图片上传
        //判断是否上传了图片
        if ($request->hasFile('img')) {
            //删除以前的图片
            $old = DB::table('picture')->where('goods_id','=',$id)->get();
            //循环删除旧图
            if (!empty($old)) {
                foreach ($old as $value) {
                    if (is_file('.'.$value->url)) {
                        unlink('.'.$value->url);
                    }
                }
            }
            //删除数据库
            DB::table('picture')->where('goods_id','=',$id)->delete();
            //循环存入新图
            foreach ($file as $key => $value) {
                //文件命名
                $fileName = time().mt_rand(10000,99999);
                //获取文件后缀
                $extension = $value->getClientOriginalExtension();
                //文件路径
                $filePath = '/upload/'.date('Y-m-d').'/'.$fileName.'.'.$extension;
                //移动文件
                $value->move('./upload/'.date('Y-m-d').'/',$fileName.'.'.$extension);
                //赋值文件路径和商品id给一个变量
                $img['url'] = $filePath;
                $img['goods_id'] = $id;
                //存入商品图片表
                DB::table('picture')->insert($img);
            }
        }
        //跳转回商品表
        return redirect('/admin/goods')->with('success','商品修改成功!!');
    }

    //ajax搜索品牌
    function query_brand(Request $request)
    {
        $name = $request->input('brand_name');
        //从数据库中取出品牌
        $brand = DB::table('brand')
                ->where('brand_name','like','%'.$name.'%')
                ->get();
        return view('admin.goods.goods.query_brand',['brand'=>$brand]);
    }

    //ajax删除商品
    function del($id)
    {
        //开始删除
        //删除图片
        DB::table('picture')//商品图片表
            ->where('goods_id','=',$id)//该商品的图片
            ->delete();//删除
        //删除UEditor图片
            //拿到商品描述
            $goods = DB::table('goods')->where('goods_id','=',$id)->first();
            //字符串
            $descr =  $goods->descr;
            //匹配资源图片正则
            $pattern = '/<img.*?src="(.*?)".*?>/is';
            preg_match_all($pattern,$descr,$str);
            //开始循环删除图片
            foreach ($str[1] as $value) {
                //判断是否为网络地址
                $s = mb_substr($value,0,4);
                if ($s != 'http' && is_file('.'.$value)) {
                    unlink('.'.$value);//删除
                }
            }
        // 删除商品
        if (DB::table('goods')->where('goods_id','=',$id)->delete()) {
            return 1;
        }else{
            return 2;
        }
    }
}
