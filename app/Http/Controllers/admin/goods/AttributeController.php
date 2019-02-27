<?php

namespace App\Http\Controllers\admin\goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AttributeController extends Controller
{
    /**
     * 显示模板
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //判断并获取搜索关键字
        $query = $request->has('query')?$request->input('query'):'';
        $request->flashOnly('query',$query);
        //判断遍历的是规格还是属性
        if ($request->has('spec_id')) {
            //查询当前规格的属性
            $spec_id = $request->input('spec_id');
            $attribute = DB::table('attribute')->where('spec_id','=',$spec_id)->where('attr_name','like','%'.$query.'%')->paginate(9);
            //引入属性列表模板
            return view('admin.goods.attribute',['attr'=>$attribute,'spec_id'=>$spec_id,'request'=>$request->all()]);
        }else{
            //查询所有规格
            $specification = DB::table('specification')->where('spec_name','like','%'.$query.'%')->paginate(9);
            //判断每条是否存有子属性
            foreach ($specification as $key=>$value) {
                if (count(DB::table('attribute')->where('spec_id','=',$value->spec_id)->get())) {
                    //存在子属性赋值一个true;
                    $value->display = true;
                }else{
                    $value->display = false;
                }
            }
            //引入规格列表模板
            return view('admin.goods.specification',['spec'=>$specification,'request'=>$request->all()]);
        }
        
    }

    /**
     * 添加属性或规格
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取参数
        $result = $request->except('_token');
        //判断是添加规格还是子属性
        if ($request->has('spec_id')) {
            //添加属性
            if (DB::table('attribute')->insert($result)) {
                return redirect('/admin/goods-attr?spec_id='.$result['spec_id'])->with('success','属性添加成功~');
            }else{
                return redirect('/admin/goods-attr?spec_id='.$result['spec_id'])->with('error','属性添加失败!');

            }
        }else{
            //添加规格
            if (DB::table('specification')->insert($result)) {
                return redirect('/admin/goods-attr')->with('success','规格添加成功~');
            }else{
                return redirect('/admin/goods-attr')->with('error','规格添加失败!');

            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //判断是修改规格还是属性
        if ($request->has('attr_id')) {
            //获取修改参数
            $attr_id = $request->input('attr_id');
            $result = $request->except('_token','attr_id','_method','spec_id');
            $spec_id = $request->input('spec_id');
            //修改属性
            $bool = DB::table('attribute')->where('attr_id','=',$attr_id)->update($result);
            if ($bool) {
                return redirect('/admin/goods-attr?spec_id='.$spec_id)->with('success','属性修改成功~');
            }else{
                return redirect('/admin/goods-attr?spec_id='.$spec_id)->with('error','属性添加失败!');
            }
        }else{
            //获取修改参数
            $spec_id = $request->input('spec_id');
            $result = $request->except('_token','spec_id','_method');
            //修改规格
            $bool = DB::table('specification')->where('spec_id','=',$spec_id)->update($result);
            if ($bool) {
                return redirect('/admin/goods-attr')->with('success','规格修改成功~');
            }else{
                return redirect('/admin/goods-attr')->with('error','规格添加失败!');
            }
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
        //判断是删除规格还是属性
        if ($request->has('attr')) {
            //删除属性
            foreach($id as $v){
                DB::table('attribute')->where('attr_id','=',$v)->delete();
            }
            return 1;
        }else{
            //删除规格
            foreach($id as $v){
                //删除子属性
                $a = DB::table('attribute')->where('spec_id','=',$v)->delete();
                
                //删除规格
                DB::table('specification')->where('spec_id','=',$v)->delete();
            }
            return 1;
        }
    }

}
