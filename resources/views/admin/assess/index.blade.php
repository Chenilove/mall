@extends('admin.public')
@section('title')
尤洪后台管理首页
@endsection

@section('content_title')
欢迎来到后台首页
@endsection
@section('content')

<div class="col-sm-12"> 
   <section class="panel"> 
    <header class="panel-heading no-border">
      订单评价详情表 
     <span class="tools pull-right"> <a href="javascript:;" class="fa fa-chevron-down"></a> <a href="javascript:;" class="fa fa-times"></a> </span> 
    </header> 
    <div class="panel-body"> 
     <table class="table table-bordered"> 
      <thead> 
       <tr> 
        <th>ID</th> 
        <th>用户ID</th> 
        <th>订单ID</th> 
        <th>图片</th> 
        <th>等级</th> 
        <th>用户评价内容</th> 
        <th>商家回复内容</th> 
        <!-- <th>状态</th>  -->
        <th>操作</th> 
       </tr> 
      </thead> 
      <tbody>
      @foreach($data as $row) 
       <tr> 
        <td>{{$row->id}}</td> 
        <td>{{$row->user_id}}</td> 
        <td>T{{$row->orders_id}}</td> 
        <td>
          @if(count($row->img)>0)
            @foreach($row->img as $v)
            <image src="{{$v}}" width="50px">
            @endforeach
          @endif
        </td> 
        <td>{{$row->level}}</td> 
        <td>{{$row->user_content}}</td> 
        <td>{{$row->business_content or ''}}</td> 
        <!-- <td>1</td>  -->
        <td>
          @if(empty($row->business_content))
          <a href="/admin/assess/{{$row->id}}/edit">回复</a>
          @else
          <span>已回复</span>
          @endif
        </td> 
       </tr> 
      @endforeach
      </tbody> 
     </table> 
    </div> 
   </section> 
  </div>  

@endsection