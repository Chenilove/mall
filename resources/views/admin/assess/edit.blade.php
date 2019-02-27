@extends('admin.public')
@section('title')
评论管理
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
添加商品评论
@endsection
@section('content')
	<!-- form表单 -->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
        <header class="panel-heading">
           添加商品评论
        </header>
        <div class="panel-body">
            <form action='/admin/assess/{{$data->id}}' method="post" role="form" class="form-horizontal adminex-form">
                <div class="form-group">
                    <label class="col-lg-2 control-label">买家评论内容:</label>
                    <div class="col-lg-10">
                       <span class="form-control"> {{$data->user_content}}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">卖家评论内容:</label>
                    <div class="col-lg-10">
                       <textarea rows="6" class="form-control" name="content"  maxlength="50" placeholder="最多不超多50个字"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        {{CSRF_field()}}
                        {{method_field('PUT')}}
                        <button class="btn btn-primary" type="submit">提交评论</button>
                        
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
