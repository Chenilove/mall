@extends('admin.public')
@section('title')
商品分类管理
@endsection
@section('link')
<style>
.testswitch {
    position: relative;
    float: left; 
    width: 90px;
    margin: 0;
    -webkit-user-select:none; 
    -moz-user-select:none; 
    -ms-user-select: none;
}
 
.testswitch-checkbox {
    display: none;
}
 
.testswitch-label {
    display: block; 
    overflow: hidden; 
    cursor: pointer;
    border: 2px solid #999999; 
    border-radius: 20px;
}
 
.testswitch-inner {
    display: block; 
    width: 200%; 
    margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
 
.testswitch-inner::before, .testswitch-inner::after {
    display: block; 
    float: right; 
    width: 50%; 
    height: 30px; 
    padding: 0; 
    line-height: 30px;
    font-size: 14px; 
    color: white; 
    font-family: 
    Trebuchet, Arial, sans-serif; 
    font-weight: bold;
    box-sizing: border-box;
}
 
.testswitch-inner::after {
    content: attr(data-on);
    padding-left: 10px;
    background-color: #00e500; 
    color: #FFFFFF;
}
 
.testswitch-inner::before {
    content: attr(data-off);
    padding-right: 10px;
    background-color: #EEEEEE; 
    color: #999999;
    text-align: right;
}
 
.testswitch-switch {
    position: absolute; 
    display: block; 
    width: 22px;
    height: 22px;
    margin: 4px;
    background: #FFFFFF;
    top: 0; 
    bottom: 0;
    right: 56px;
    border: 2px solid #999999; 
    border-radius: 20px;
    transition: all 0.3s ease-in 0s;
}
 
.testswitch-checkbox:checked + .testswitch-label .testswitch-inner {
    margin-left: 0;
}
 
.testswitch-checkbox:checked + .testswitch-label .testswitch-switch {
    right: 0px; 
}

</style>

    <script src="js/prefixfree.min.js"></script>	

@endsection
@section('content_title')
订单修改
@endsection
@section('content')
<!-- 插入表单验证错误提示信息 -->
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
	<!-- form表单 -->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
        <header class="panel-heading">
            订单修改
        </header>
        <div class="panel-body">
            <form action='/admin/orders/{{$data->id}}' method="post" role="form" class="form-horizontal adminex-form">
                <div class="form-group">
                    <label class="col-lg-2 control-label" for="f-name">收件人</label>
                    <div class="col-lg-10">
                        <input type="text" name="oname"  id="f-name" class="form-control" style="max-width: 200px" value="{{$data->oname}}">
                        <p class="help-block">
                            <!-- Successfully done -->
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label" for="f-name">电话</label>
                    <div class="col-lg-10">
                        <input type="text" name="phone"  id="f-name" class="form-control" style="max-width: 200px" value="{{$data->phone}}">
                        <p class="help-block">
                            <!-- Successfully done -->
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label" for="f-name">地址</label>
                    <div class="col-lg-10">
                        <input type="text" name="address"  id="f-name" class="form-control" style="max-width: 200px" value="{{$data->address}}">
                        <p class="help-block">
                            <!-- Successfully done -->
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        {{CSRF_field()}}
                        {{method_field('PUT')}}
                        <button class="btn btn-primary" type="submit">确认修改</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="/admin/orders" class="btn btn-success">返回</a>
                        
                    </div>
                </div>
            </form>
        </div>
        </section>
    </div>
</div>
@endsection
@section('js')
<script>
    
</script>
@endsection
