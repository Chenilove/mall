<?php

namespace App\Http\Controllers\home\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//导入收藏模型层
use App\Http\Model\Collect;
//引入Redis
use Illuminate\Support\Facades\Redis;



class IndexController extends Controller
{
    protected $cates;//商品分类
    protected $like;//猜你喜欢
    protected $cart;//购物车

    public function __construct()
    {

        //获取商品分类 getCates --获取分类函数
        $cates = IndexController::getCates();
        //猜你喜欢 getGoods --获取商品函数
        $like = IndexController::getGoods('like');
        //友情链接
        $links=DB::table("links")->where('status','=',1)->paginate(5);
        //购物车
        $cart = getCart();
        //赋值成员属性
        $this->like = $like;
        $this->cates = $cates;
        $this->links = $links;
        $this->cart = $cart;
    }
    //首页展示
    public function index()
    {
        //限时热卖 getGoods() --封装的获取商品模块函数
        $hot = IndexController::getGoods('hot');
        //进口.生鲜
        $fresh = IndexController::getGoods('fresh','AND goods.cate_id=74');
        //食品饮料
        $drink = IndexController::getGoods('drink','AND goods.cate_id=76');
        //个人美妆
        $shampoo = IndexController::getGoods('shampoo','AND goods.cate_id=78');
        //母婴玩具
        $toy = IndexController::getGoods('toy','AND goods.cate_id=80');
        //家具
        $furniture = IndexController::getGoods('furniture','AND goods.cate_id=82');
        //数码产品
        $digital = IndexController::getGoods('digital','AND goods.cate_id=73');

        //查询数据
        //轮播图
        $Rotation=DB::table("imgs")->where('status','=',1)->get();
        //公告
        $Notice=DB::table("notice")->get();
        //广告
        $Advert=DB::table("advert")->get();

        
    	//加载首页模板
    	return view('home.index.index',[
                'cates'=>$this->cates,//商品分类
                'like' =>$this->like,//猜你喜欢
                'hot'  =>$hot,//限时特卖
                'fresh'=>$fresh,//进口.生鲜
                'drink'=>$drink,//食品饮料
              'shampoo'=>$shampoo,//个人美妆
                  'toy'=>$toy,//个人美妆
            'furniture'=>$furniture,//个人美妆
              'digital'=>$digital,//数码电子
              'Rotation'=>$Rotation,//l轮播图
              'Notice'=>$Notice,//公告
              'Advert'=>$Advert,//广告
              'links'=>$this->links,//友情链接
              'cart'=>$this->cart,//购物车
            ]);
    }

    //搜索商品
    public function query(Request $request)
    {

        //准备sql语句
        $data = DB::table('goods');
        // $pattern = '/WHERE/';//正则查前面if条件有没有加where条件
        
        //判断是否搜索分类id
        if ($request->has('cates')) {
            $data = $data->where('cate_id','=',$request->input('cates'));
        }

        //判断是否搜索商品名字
        if ($request->has('query')) {
            $request->flashOnly('query',$request->input('query'));
            $data = $data->where('goods_name','like','%'.$request->input('query').'%');
        }
        //判断结束,查询所有商品
        $goods = $data->paginate(12);
        //判断数据是否为空
        if (count($goods) == 0) {
            //没有数据
            $help = '请使用更加精准的搜索 本次搜索暂无数据';
            //随便推荐几个给用户
            // $goods = IndexController::getGoods('like');
            //->orderBy('goods_id',mt_rand(1,10))
            $goods = DB::table('goods')->paginate(12);
        }else{
            $help = null;
        }
        //拿到所有图片
        foreach ($goods as $value) {
            $value->img = DB::table('picture')->where('goods_id','=',$value->goods_id)->get();
        }
        //收藏
        $collect = (array)collect::where('user_id','=',session('id'))->pluck('goods_id');
        $collect = reset($collect);
        if (count($collect) < 1) {
            $collect = [0];
        }
        //加载模板
        return view('home.index.query',[
                'cates'  =>$this->cates,//商品分类
                'goods'  =>$goods,//商品分类
                'like'   =>$this->like,//猜你喜欢
                'request'=>$request->all(),//分页用
                'help'   =>$help,//提示信息
                'links'=>$this->links,//友情链接
                'collect'=>$collect,//友情链接
                'cart'=>$this->cart,//购物车
            ]);
    }

    //商品详情
    public function goods($id,Request $request)
    {
        //获取这个商品
        $goods = DB::table('goods')->where('goods_id','=',$id)->first();
        //获取商品所有评论 --先走缓存服务器
        $assess = DB::table('assess')
                ->join('contents','assess.id','=', 'contents.aid')//连接内容表
                ->join('users','assess.user_id','=','users.id')
                ->select(
                    'assess.user_id'            //删选字段
                    ,'assess.orders_id'
                    ,'assess.goods_id'
                    ,'contents.id'
                    // ,'contents.aid'
                    , 'contents.level'
                    ,'contents.user_content'
                    , 'business_content'
                    ,'users.username'
                    ,'assess.created_at')
                ->where('goods_id','=',$id)//当前的商品评论
                ->paginate(5);
        //评论的图片
        foreach ($assess as $value) {
            $value->img = DB::table('pictures')
                        ->where('c_id','=',$value->id)
                        ->limit(4)
                        ->pluck('pic');
        }
        //收藏
        $collect = (array)collect::where('user_id','=',session('id'))->pluck('goods_id');
        $collect = reset($collect);
        if (count($collect) < 1) {
            $collect = [0];
        }
        //如果该商品不存在
        if (count($goods) == 0) {
            //没有数据
            $help = '该商品不存在或者已下架,请先看看别的商品吧';
            //随便推荐几个给用户
            $goods = DB::table('goods')->paginate(12);
            //拿到所有图片
            foreach ($goods as $value) {
                $value->img = DB::table('picture')->where('goods_id','=',$value->goods_id)->get();
            }
            //加载模板
            return view('home.index.query',[
                    'cates'  =>$this->cates,//商品分类
                    'goods'  =>$goods,//商品分类
                    'like'  =>$this->like,//猜你喜欢
                    'request'=>$request->all(),//分页用
                    'help'   =>$help,//提示信息
                    'links'=>$this->links,//友情链接
                    'assess'=>$assess,//评论
                    'cart'=>$this->cart,//购物车
                    'collect'=>$collect,//购物车
                ]);
        }
        //查看是否有缓存
        if (empty(Redis::get('goods'.$id))) {
            //获取商品数据后,获取商品图片
            $goods->img = DB::table('picture')    
                        ->where('goods_id','=',$goods->goods_id)
                        ->get();
            //获取规格属性
            $arr = explode(',',$goods->attribute);
            //获取属性
            $attr = DB::table('attribute')
                    ->whereIn('attr_id',$arr)
                    ->get();
            //获取所有规格
            foreach ($attr as $value) {
                $spec_id[] = $value->spec_id;
            }
            //规格去重
            $spec_id = array_unique($spec_id);
            //获取规格下的属性
            foreach ($spec_id as $value) {
                $spec[$value] = DB::table('attribute')
                                ->where('spec_id','=',$value)
                                ->whereIn('attr_id',$arr)
                                ->get();
            }
            //现在的spec是一个三维数组,只有规格id没有规格名,获取规格名
            foreach ($spec as $key => $value) {
                $spec = DB::table('specification')
                        ->where('spec_id','=',$key)
                        ->first();
                $goods->spec[$spec->spec_name] = $value;
            }
            //存入redis缓存
            Redis::setex('goods'.$id,12,json_encode($goods));
        }else{
            $goods = json_decode(Redis::get('goods'.$id));
        }
        //猜你喜欢
        $like = IndexController::getGoods('like');
        //品牌
        $brand = json_decode(Redis::get('brand'.$goods->brand_id));
        if (empty($brand)) {
           $brand = DB::table('brand')->where('brand_id','=',$goods->brand_id)->first();
           Redis::setex('brand'.$goods->brand_id,15,json_encode($brand));
        }


        //载入模板
        return view('home.index.goods',[
                'cates'  =>$this->cates,//商品分类
                'goods'  =>$goods,//商品分类
                'brand'  =>$brand,//商品品牌
                'like'  =>$like,//猜你喜欢
                'links'=>$this->links,//友情链接
                'assess'=>$assess,//评论
                'collect'=>$collect,//评论
                'cart'=>$this->cart,//购物车
            ]);
    }

    //ajax商品收藏
    public function collection($id,Request $request)
    {
        //判断用户是否登录了
        if (!$request->session()->has('id')) {
            return 3;
        }
        //获取用户id
        $collection['goods_id'] = $id;
        $collection['user_id'] = session('id');
        //首先判断是否收藏了
        $a = DB::table('collection')
                ->where('goods_id','=',$id)//商品名相同
                ->where('user_id','=',$collection['user_id'])//用户id相同
                ->first();//查看全部
        if (count($a) < 1) {
            //未收藏 --添加
            DB::table('collection')->insert($collection);
            return 1;
        }else{
            //已经收藏 --删除
            DB::table('collection')->where('coll_id','=',$a->coll_id)->delete();
            return 2;
        }
    }

    //公告
    public function notice(Request $request)
    {
        //公告
        $id=$request->id;
        //用id获取单条数据
        $info=DB::table("notice")->where("id","=",$id)->first();
        return view('home.notice',[
                'info'=>$info,
                'links'=>$this->links
            ]);
    }
    //友情链接申请
    public function advert()
    {
        $links=DB::table("links")->get();

        return view('home.advert',['links'=>$this->links]);
    }
    //执行添加
    public function advert_store(Request $request)
    {
        $links = $request->except('_token');
        $links['status'] = 0;

        if (DB::table('links')->insert($links)) {
            echo '<script>alert("申请成功,请等待后台审核")</script>';
            return redirect('/');
        }else{
            echo '<script>alert("申请失败,请重试")</script>';
            return redirect('/');
        }
    }









    /**
     * 以下为帮助函数 HelpFunction
     */
    
    //无限递归分类函数 $pdi --父级id
    public static function getClassification($pid)
    {
        //查询父级id下所有子类id(除被禁用的)且限制取出10条
        $cate = DB::table('cates')->where('pid','=',$pid)->where('status','=',1)->limit(10)->orderBy('id')->get();
        //循环将子类添加到父类的dev里
        foreach ($cate as $value) {
            $value->dev = self::getClassification($value->id);
        }
        //返回递归分类后的数组
        return $cate;
    }

    //获取分类
    public static function getCates()
    {
        $cates = json_decode(Redis::get('cates'));
        //判断是否有缓存
        if (empty($cates)) {
            //调用无限递归分类函数
            $cates = IndexController::getClassification(0);
            //存入缓存
            Redis::setex('cates',12,json_encode($cates));
        }
        //返回分类对象
        return $cates;

    }

    //获取首页商品模块函数  $name -- 商品模块名字  where --新增的where条件
    public static function getGoods($name,$where='')
    {
        //获取redis缓存
        $data = json_decode(Redis::get($name));
        //无缓存查询数据库
        if (empty($data)) {
            //sql语句
            $sql = "SELECT * FROM goods,brand WHERE goods.brand_id = brand.brand_id {$where} ORDER BY RAND() LIMIT 9";
            //执行sql语句 获取商品
            $data = DB::select($sql);
            //循环获取商品图片
            foreach ($data as $value) {
                $value->img = DB::table('picture')->where('goods_id','=',$value->goods_id)->get();
            }
            //存入redis缓存服务器
            Redis::setex($name,12,json_encode($data));
        }
        //返回数据
        return $data;
    }

    
    
}
