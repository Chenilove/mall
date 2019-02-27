<?php

namespace App\Http\Controllers\home\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//导入模型层
use App\Http\Model\Collect;
use DB;
class CollectController extends Controller
{
    /**
     * 展示我的收藏
     */
    public function index()
    {
    	//获取当前用户的所有收藏
    	$collect = Collect::where('user_id',session('id'))->paginate(6);
        foreach ($collect as $value) {
            //获取商品
            $value->goods = DB::table('goods')->where('goods_id','=',$value->goods_id)->first();
            //获取图片
            $value->goods->img = DB::table('picture')->where('goods_id','=',$value->goods->goods_id)->get();

        }
        //载入模板
		return view('home.collection.collect',['collect'=>$collect]);
    }
}
