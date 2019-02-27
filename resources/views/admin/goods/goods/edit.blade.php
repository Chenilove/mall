@extends('admin.public')
@section('title','商品修改')
@section('content_title','商品修改')
@section('link')
    <link href="http://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/status/radio/css/htmleaf-demo.css">
    <link rel="stylesheet" type="text/css" href="/status/radio/css/build.css">
@endsection

@section('content')
<!-- 显示成功信息 -->
@if(session('success'))
<div class="alert alert-success fade in">
    <button type="button" class="close close-sm" data-dismiss="alert">
    <i class="fa fa-times"></i>
    </button>
    <strong>操作成功!</strong> {{session('success')}} 
</div>
@endif
<!-- 显示失败信息 -->
@if(session('error'))
<div class="alert alert-block alert-danger fade in">
    <button type="button" class="close close-sm" data-dismiss="alert">
    <i class="fa fa-times"></i>
    </button>
    <strong>操作失败!</strong> {{session('error')}}
</div>
@endif
<div class="row">
    <div class="col-md-12">
        <section class="panel">
        <header class="panel-heading">
            商品修改
        </header>
        <form action="/admin/goods/{{$id}}" method="post" role="form" style="max-width: 800px" enctype="multipart/form-data" onsubmit="return validateCommit()">
        <div class="panel-body">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">商品参数</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="goods_name">商品名 : </label>
                            <input type="text" class="form-control" name="goods_name" id="goods_name" onblur="validateName()" value="{{$goods->goods_name}}">
                             <p class="help-block">
                                请输入您的商品名
                            </p>
                        </div>
                        <br>
                        <div class="form-group form-inline">
                            <label for="goods_price">商品价格 : </label>
                            <input type="number" class="" name="pricea" id="pricea" style="max-width: 100px"  value="{{$goods->pricea}}" onblur='validatePrica()' required> <font style="font-size: 22px"><font color="black">.</font></font> <input type="text" class="" name="priceb" id="priceb" style="max-width: 100px"  value="{{$goods->priceb}}" pattern="^[0-9]{2}$"  onblur='validatePriceb()' required> 
                            <font style="font-size: 18px"> &nbsp;&nbsp;<font color="black">$</font></font>
                            <p class="help-block" id="price-helpa"> 
                                <!-- 请输入您的商品价格,只保留2位小数 -->
                            </p>
                             <p class="help-block" id="price-helpb"> 
                                
                            </p>
                            <p class="help-block" id="price-helpa"> 
                                请输入您的商品价格,只保留2位小数
                            </p>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="goods_cate">商品分类 : </label>
                            <select name="cate_id" id="goods_cate">
                                @foreach($cates as $row)
                                    <option value="{{$row->id}}" @if($row->id == $goods->cate_id) selected @endif>{{$row->name}}</option>
                                @endforeach
                            </select>
                             <p class="help-block"> 
                                <!-- 请选择一个商品分类 -->
                            </p>
                        </div>
                        <br>
                        <div class="form-group form-inline">
                            <label for="stock">商品库存 : </label>
                            <input type="number" class="form-control" name="stock" id="stock" onblur="validateName()" value="{{$goods->stock}}" required>  <font color="black"> &nbsp;&nbsp;件</font>
                             <p class="help-block">
                                <!-- 请输入您的商品库存 -->
                            </p>
                        </div>
                        <div class="form-group form-inline">
                            <label for="weight">商品重量 : </label>
                            <input type="number" class="form-control" name="weight" id="weight" onblur="validateName()" value="{{$goods->weight}}" required>  <font color="black"> &nbsp;&nbsp;g</font>
                             <p class="help-block">
                                <!-- 请输入您的商品重量 -->
                            </p>
                        </div>
                        <br>
                        <div class="form-group form-inline">
                            <label for="country">产地/国家 : </label>
                            <input type="text" class="form-control" name="country" id="country" onblur="validateCountry()" value="{{$goods->country}}" required>
                             <p class="help-block">
                                请输入您的商品产地/国家
                            </p>
                        </div>
                    </div>
                </div>
                <br>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title form-inline">
                            商品品牌
                            <label style="float: right"><button type="button" class="btn btn-danger" style="max-width: 80px;float: right" onclick="queryBrand(this)">搜索品牌</button><input type="text" class="form-control" style="max-width: 180px;float: right"></label>
                        </h3>
                        <br>
                    </div>
                    <div class="panel-body">
                        <div class="form-group" style="overflow: auto;max-height: 120px" id="query_brand">
                            @foreach($brand as $row)
                            <label>
                                <input type="radio" name="brand_id" id="brand_id" value="{{$row->brand_id}}" @if($row->brand_id == $goods->brand_id) checked @endif>
                                <font>{{$row->brand_name}}</font>
                                <img src="{{$row->img}}" alt="图片缺失" width="50px">
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr>
                <br>
                <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        商品属性选择
                    </h3>
                </div>
                <div class="panel-body form-inline" style="color: black;overflow: auto;max-height: 200px">
                @foreach($specification as $row)
                    <hr>
                    <span style="font-size: 25px">{{$row->spec_name}}:</span> 
                    @foreach($row->attr as $v)
                    <label>
                        <input type="checkbox" name="attribute[]" class="form-control" value="{{$v->attr_id}}" @if(in_array($v->attr_id,$goods->attr)) checked @endif>{{$v->attr_name}}
                    </label>
                    @endforeach
                @endforeach
                </div>
                <br>
                <hr>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            商品图片
                        </h3>
                    </div>
                    <div class="panel-body" style="color: black;overflow: auto;max-height: 200px">
                        <label for="goods_img" class="btn btn-info btn-block"><i class="fa fa-picture-o"></i>&nbsp;&nbsp;&nbsp;上传商品图片</label>
                        <input type="file" name="img[]" style="display: none" id="goods_img" onchange="validateImg()" multiple>
                        <p class="help-block">
                            请上传4张图片,已选择0张图片
                        </p>
                        <p class="help-block">
                        @foreach($goods->pic as $p)
                            <img src="{{$p->url}}" width="80px">
                        @endforeach
                        </p>
                    </div>
                </div>
                <br>
                <hr>
                <!-- UEditor百度编辑器 -->
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">商品详情描述:</h3>
                    </div>
                    <div class="panel-body">
                        <script id="editor" type="text/plain" name="descr" style="width:700px;height:500px;">{!!$goods->descr!!}
                        </script>
                    </div>
                </div>
        </div>
    <!-- </div> -->
        <button type="submit" class="btn btn-primary">确认修改</button>
        {{CSRF_field()}}
        {{method_field('put')}}
        <input type="hidden" name="goods_id" value="{{$id}}">
        </form>
    <!-- </div> -->
    </section>
    </div>
</div>
@endsection
@section('js')
<!-- 验证js -->
<script src='/status/admin/js/validate-e.js'></script>
<!-- UEditor百度编辑器 -->
<script type="text/javascript" charset="utf-8" src="/status/UEditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/status/UEditor/ueditor.all.min.js">
</script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加
    载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/status/UEditor/lang/zh-cn/zh-cn.js">
</script>
<script type="text/javascript">
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接
    // 调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');
</script>
@endsection