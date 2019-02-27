@extends('admin.public')
@section('title')
尤洪后台管理首页
@endsection
@section('content_title')
欢迎来到订单首页
@endsection
@section('content')
 <div class='row'>
 	<div class="col-sm-12"> 
   <section class="panel"> 
    <header class="panel-heading">
      Dynamic Table 
     <span class="tools pull-right"> <a href="javascript:;" class="fa fa-chevron-down"></a> <a href="javascript:;" class="fa fa-times"></a> </span> 
    </header>

    <div class="panel-body"> 
     <div class="adv-table"> 
      <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid"> 
       <div class="row-fluid"> 
        <div class="span6" style="float:left;margin:0px;padding:0px;"> 
         <div id="dynamic-table_length" class="dataTables_length"> 
          <label> <select class="form-control" size="1" name="dynamic-table_length" aria-controls="dynamic-table"> <option value="10" selected="selected">10</option> <option value="25">25</option> <option value="50">50</option> <option value="100">100</option> </select> records per page </label> 
         </div> 
        </div> 
        <div class="span6" style="float:right;margin:0px;padding:0px;"> 
         <div class="dataTables_filter" id="dynamic-table_filter">
         <!-- 关键词搜索 -->
         <form action="/admin/orders" method="get">
         <label> 
          <button class="btn btn-info" type='submit' style="float:right">搜索</button><input type="text" class="form-control" style="padding-right:80px; float:right;" name="keyword"  placeholder="输入订单号" value="{{$request['keyword'] or ''}}"/> 
          </label> 
          
         </form> 
          
         </div> 
        </div> 
       </div> 
       <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info"> 
        <thead> 
         <tr role="row" style="text-align:right">
          <th class="sorting" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="vertical-align: middle !important;text-align: center;" aria-label="Rendering engine: activate to sort column ascending">ID</th>
          <th class="sorting" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="vertical-align: middle !important;text-align: center;" aria-label="Browser: activate to sort column ascending">订单ID</th>
          <th class="sorting" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="vertical-align: middle !important;text-align: center;" aria-label="Platform(s): activate to sort column ascending">优惠券ID</th>
          <th class="hidden-phone sorting" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="vertical-align: middle !important;text-align: center;" aria-label="Engine version: activate to sort column ascending">用户ID</th>
 
          <th class="hidden-phone sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="vertical-align: middle !important;text-align: center;" aria-sort="descending" aria-label="CSS grade: activate to sort column ascending">收件人</th>
          <th class="hidden-phone sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="vertical-align: middle !important;text-align: center;" aria-sort="descending" aria-label="CSS grade: activate to sort column ascending">电话</th>
          <th class="hidden-phone sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="vertical-align: middle !important;text-align: center;" aria-sort="descending" aria-label="CSS grade: activate to sort column ascending">地址</th>
          <th class="hidden-phone sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="vertical-align: middle !important;text-align: center;" aria-sort="descending" aria-label="CSS grade: activate to sort column ascending">支付时间</th>
          <th class="hidden-phone sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="vertical-align: middle !important;text-align: center;" aria-sort="descending" aria-label="CSS grade: activate to sort column ascending">总金额</th>
          <th class="hidden-phone sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="vertical-align: middle !important;text-align: center;" aria-sort="descending" aria-label="CSS grade: activate to sort column ascending">状态</th>
          <th class="hidden-phone sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="vertical-align: middle !important;text-align: center;" aria-sort="descending" aria-label="CSS grade: activate to sort column ascending">操作</th>
          
         </tr> 
        </thead> 
        <tbody role="alert" aria-live="polite" aria-relevant="all">
         @foreach($data as $row)
         <tr class="gradeX odd"> 
          <td class=" "  style="vertical-align: middle !important;text-align: center;">{{$row->id}}</td> 
          <td class=" "  style="vertical-align: middle !important;text-align: center;">{{$row->order_id}}</td> 
          <td class=" "  style="vertical-align: middle !important;text-align: center;">{{$row->coupon_id}}</td> 
          <td class=""  style="vertical-align: middle !important;text-align: center;">{{$row->user_id}}</td> 
           
          <td class="center"  style="vertical-align: middle !important;text-align: center;">{{$row->oname}}</td> 
          <td class="center"  style="vertical-align: middle !important;text-align: center;">{{$row->phone}}</td> 
          <td class="center"  style="vertical-align: middle !important;text-align: center;">{{$row->address}}</td>
          <td class="center"  style="vertical-align: middle !important;text-align: center;">{{$row->pay_at}}</td>
   
          <td class="center"  style="vertical-align: middle !important;text-align: center;">{{$row->money}}</td> 
          <td class="center"  style="vertical-align: middle !important;text-align: center;">
          	<!-- 显示当前订单状态 -->
          	@switch($row->status)
          		@case(0)
          			<button class="btn btn-danger">未付款</button>
          			@break
          		@case(1)
          			<a href="/admin/orders_send/{{$row->id}}" class="btn btn-info">已付款未发货</a>
          			@break
          		@case(2)
          			<button class="btn btn-success">已发货待收货</button>
          			@break
          		@case(3)
          			<button class="btn btn-primary">已收货</button>
          			@break
              @case(4)
                <button class="btn btn-default">已失效</button>
                @break
              @case(5)
                <button class="btn btn-default">已评价</button>
                @break
          	@endswitch
          </td> 
          
          <td class="center" style="text-align:center;line-height:25px;">
          	<!-- 判断当前状态,用于决定是否可以修改订单 -->
          	<div class='btn-group-vertical'>
          	@if($row->status > 1)
          	<a href="/admin/orders/{{$row->id}}/edit" class="btn btn-warning" disabled>修改</a>
          	@else
          	<a href="/admin/orders/{{$row->id}}/edit" class="btn btn-warning">修改</a>
          	@endif
          	<a href="/admin/orders/{{$row->order_id}}" class="btn btn-primary details">订单详情</a>
          	</div>
          	
          </td> 
          
         </tr>

		
         @endforeach
        </tbody>
       </table>
       <div class="row-fluid">
        <div class="span6">
         <div class="dataTables_info" id="dynamic-table_info">
          <!-- Showing 1 to 10 of 57 entries -->
         </div>
        </div>
        <div class="span6">
         <div class="dataTables_paginate paging_bootstrap pagination">
          {{$data->appends($request)->render()}}
         </div>
        </div>
       </div>
      </div> 
     </div> 
    </div> 
   </section> 
  </div>
 </div>

  @endsection
