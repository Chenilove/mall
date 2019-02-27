@extends('admin.public')
@section('title','商品管理')
@section('content_title','商品列表')
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
/* //descr图片不超出 */
#descr_img img{
	max-width: 820px;
}
</style>	
@endsection
@section('content')
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
	<div class="col-sm-12">
		<section class="panel">
		<header class="panel-heading"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
            商品列表
		</font></font><span class="tools pull-right">
		<a href="javascript:;" class="fa fa-chevron-down"></a>
		<a href="javascript:;" class="fa fa-times"></a>
		</span>
		</header>
		<div class="panel-body" style="display: block;">
			<div class="adv-table">
				<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
					<div class="row-fluid">
					<div class="span6" style="float: left">
							<div id="dynamic-table_length" class="dataTables_length"" >
							@if(!empty($query))
							<a href="/admin/goods" class="btn btn-info"><i class="fa fa-mail-reply"></i>&nbsp;返回</a>
							@endif
							<a href="/admin/goods/create" class="btn btn-success">
								<i class="fa fa-plus"></i> 
								&nbsp;注册商品
							</a>
							</div>
					</div>
						<div class="span6" style="float: right">
							<div class="dataTables_filter" id="dynamic-table_filter">
								<form action="/admin/goods" method="get"  role='form' class="form-inline" id="query">
									<font style="vertical-align: inherit;"><b>搜索: </b></font>
									<select name="cate">
										<option value="">--全部--</option>
										@foreach($cates as $v)
										<option value="{{$v->id}}" @if($cate_id == $v->id) selected @endif>{{$v->name}}</option>
										@endforeach
									</select>
									<input type="text" name="query" class="form-control" value="{{old('query')}}" placeholder="查询商品名(字母区分大小写)">
									<input type="hidden" name="" value="">
									<input type="submit" class="btn btn-info" value="搜索" form="query">
								</form>
							</div>
						</div>
					</div>
				<table class="display table table-bordered table-striped dataTable table-hover" id="dynamic-table" aria-describedby="dynamic-table_info">
					<thead>
					<tr role="row">
						<th class="sorting" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="width: 267px;" aria-label="Browser: activate to sort column ascending">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">商品名</font></font>
						</th>
						<th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="width: 249px;" aria-sort="descending" aria-label="Platform(s): activate to sort column ascending">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">种类</font></font>
						</th>
						<th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="width: 249px;" aria-sort="descending" aria-label="Platform(s): activate to sort column ascending">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">品牌</font></font>
						</th>
						<th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="width: 249px;" aria-sort="descending" aria-label="Platform(s): activate to sort column ascending">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">价格</font></font>
						</th>
						<th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="width: 249px;" aria-sort="descending" aria-label="Platform(s): activate to sort column ascending">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">图片</font></font>
						</th>
						<th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="width: 249px;" aria-sort="descending" aria-label="Platform(s): activate to sort column ascending">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">状态</font></font>
						</th>
						<th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="width: 249px;" aria-sort="descending" aria-label="Platform(s): activate to sort column ascending">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">操作</font></font>
						</th>
					</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all" id="tbodys">
					@foreach($goods as $row)
					<tr class="gradeC">
						<td style="display:none">{{$row->goods_id}}</td>
						<td>
							<div style="overflow: auto;max-height: 80px">
								<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$row->goods_name}}</font></font>
							</div>
						</td>
						<td>
							<div style="overflow: auto;max-height: 80px">
								<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$row->name}}</font></font>
							</div>
						</td>
						<td>
							<div style="overflow: auto;max-height: 80px">
								<img src="{{$row->img}}" title="{{$row->brand_name}}" width="100px">
							</div>
						</td>
						<td>
							<div style="overflow: auto;max-height: 80px">
								<del><b><i>{{$row->reference}} $</i></b></del><br>
								<strong style="font-size: 22px">{{$row->price}} $</strong> 
							</div>
						</td>
						<td>
							<div style="overflow: auto;max-height: 80px">
								@foreach($row->goods_img as $img)
								<img src="{{$img->url}}" title="{{$row->goods_name}}" width="100px">
								@endforeach
							</div>
						</td>
						<td align="center" valign="middle">
							<div class="testswitch">
								<input class="testswitch-checkbox" id="onoffswitch{{$row->goods_id}}" onclick="edit_status(this)" type="checkbox" @if($row->goods_status == 1) checked  @endif oncl>  
								<label class="testswitch-label" for="onoffswitch{{$row->goods_id}}">
									<span class="testswitch-inner" data-on="ON" data-off="OFF"></span>
									<span class="testswitch-switch"></span>
								</label>
							</div>
						</td>
						<td>
							<div class="btn-group-vertical">
								<button class="btn btn-info"  data-toggle="modal" data-target="#goods_Modal{{$row->goods_id}}"><i class="fa fa-eye"></i> 查看详情</button>
								<a href="/admin/goods/{{$row->goods_id}}/edit" class="btn btn-warning"><i class="fa fa-pencil"></i> 修改</a>
								<button class="btn btn-danger" onclick="del(this)"><i class="fa fa-trash-o"></i> 删除</button>
							</div>
							
						</td>
					</tr>
					
					@endforeach
					</tbody>
				</table>
					@foreach($goods as $row)
					<!-- 商品详情模态框（Modal） -->
					<div class="modal fade" id="goods_Modal{{$row->goods_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					    <div class="modal-dialog modal-lg">
					        <div class="modal-content">
					            <div class="modal-header">
					                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                <h4 class="modal-title" id="myModalLabel">查看商品详情</h4>
					            </div>
					            <div class="modal-body">	
									<table class="display table table-bordered table-striped dataTable table-hover" id="dynamic-table" aria-describedby="dynamic-table_info" >
					<tbody role="alert" aria-live="polite" aria-relevant="all" id="tbodys">
					<tr class="gradeC" onclick="">
						<th>
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">商品编号</font></font>
						</th>
						<td>
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$row->numbering}}</font></font>
						</td>
					</tr>
					<tr>
						<th>
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">商品点赞</font></font>
						</th>
						<td>
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$row->like}} 赞</font></font>
						</td>
					</tr>
					<tr>
						<th>
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">商品重量</font></font>
						</th>
						<td>
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$row->weight}}</font></font>
						</td>
					</tr>
					<tr>
						<th>
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">上架时间</font></font>
						</th>
						<td>
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{date('Y-m-d h:i:s',$row->added_time)}}</font></font>
						</td>
					</tr>
					<tr>
						<th>
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">产地/国家</font></font>
						</th>
						<td>
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$row->country}}</font></font>
						</td>
					</tr>
					<tr>
						<th colspan="2">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">商品描述</font></font>
						</th>
					</tr>
					<tr>
						<td colspan="2">
						<div style="max-width: 820px" id="descr_img">
							{!!$row->descr!!}
						</div>
							
						</td>
					</tr>
					</tbody>
				</table>
					            </div>
					            <div class="modal-footer">
					                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					            </div>
					        </div><!-- /.modal-content -->
					    </div><!-- /.modal -->
					</div>
					@endforeach
					<div class="row-fluid">
						<div class="span6">
							<div class="dataTables_paginate paging_bootstrap pagination">
								<ul>
								<!-- 分页 -->
								</ul>
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
@section('js')
<script>
//商品ajax删除
function del(obj)
{
	if (confirm('您确定要删除已注册的商品吗')) {
		//获取tr标签和商品id
	    var tr = $(obj).parents('tr');
	    var id = $(tr).find('td:first').text();

	    //ajax删除商品
	    $.post('/admin/goods-del/'+id,{},function(data){
	    	if (data == 1) {
	    		$(tr).remove();
	    	}else if(data == 2){
	    		alert('删除失败......');
	    	}
	    });
	}
}

//ajax修改商品状态
function edit_status(obj)
{
	//获取id
	var id = $(obj).parents('tr').find('td:first').text();
	//ajax修改商品状态
	$.get('/admin/goods/'+id,{},function(){});
}
</script>
@endsection