@extends('admin.public')
@section('title')
尤洪后台管理首页
@endsection

@section('content_title')
欢迎来到后台首页
@endsection
@section('content')
<a href="/admin/orders"><i class="fa fa-reply btn btn-success"></i></a> 
 <div class="panel-body"> 
   <table class="table table-bordered"> 
    <thead> 
     	<tr>
	        <th>订单号</th>
            <th>商品名称</th>
	        <th>商品图片</th>
	        <th>数量</th>
	        <th>单价</th>
	        <th>属性</th>
        </tr>
    </thead> 
    <tbody> 
     	 @foreach($data as $key=>$row)
        <tr>
            <td>{{$row->orders_id}}</td>
            <td>
            @foreach($row->goods_id as $v)
                {{$v->goods_name}}
            
            </td>
            <td><image src="{{$v->url}}" width="50px"></td>
            @endforeach
            <td>{{$row->num}}</td>
            <td>{{$row->price}}</td>
            <td>{{$row->type}}</td>
        </tr>
        @endforeach
    </tbody> 
   </table> 
  </div>
@endsection