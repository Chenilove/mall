@extends('admin.public')
@section('title','商品规格管理')
@section('content_title','商品规格管理')
@section('link')
<!--  <link href="/status/admin/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="/status/admin/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="/status/admin/js/data-tables/DT_bootstrap.css" />

  <link href="/status/admin/css/style.css" rel="stylesheet">
  <link href="/status/admin/css/style-responsive.css" rel="stylesheet"> -->
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
            规格属性列表
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
							@if(!empty(old('query')))
							<a href="/admin/goods-attr" class="btn btn-success">
								<i class="fa fa-mail-reply"></i>
								&nbsp;返回
							</a>
							@endif
							<button class="btn btn-danger" data-toggle="modal" data-target="#myModal">
								<i class="fa fa-plus"></i> 
								&nbsp;添加商品规格
							</button>
							</div>
					</div>
						<div class="span6" style="float: right">
							<div class="dataTables_filter" id="dynamic-table_filter">
								<form action="/admin/goods-attr" method="get"  role='form' class="form-inline" id="query">
									<font style="vertical-align: inherit;"><b>搜索: </b></font>
									<input type="text" name="query" class="form-control" value="{{old('query')}}" placeholder="查询规格名(字母区分大小写)">
									<input type="submit" class="btn btn-info" value="搜索" form="query">
								</form>
							</div>
						</div>
					</div>
					<table class="display table table-bordered table-striped dataTable table-hover" id="dynamic-table" aria-describedby="dynamic-table_info">
					<thead>
					<tr role="row">
						<th class="sorting" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="width: 180px;" aria-label="Rendering engine: activate to sort column ascending">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">选择</font></font>
						</th>
						<th class="sorting" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="width: 267px;" aria-label="Browser: activate to sort column ascending">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">规格ID</font></font>
						</th>
						<th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="width: 249px;" aria-sort="descending" aria-label="Platform(s): activate to sort column ascending">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">规格名称</font></font>
						</th>
						<th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="width: 249px;" aria-sort="descending" aria-label="Platform(s): activate to sort column ascending">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">操作</font></font>
						</th>
					</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all" id="tbodys">
					@foreach($spec as $row)
					<tr class="gradeC" onclick="clicks(this)">
						<td style="display:none">{{$row->spec_id}}</td>
						<td class=" ">
								<input type="checkbox" value="{{$row->spec_id}}" style="zoom:250%" id="checkk" onclick="clickd(this)">
							</div>
						</td>
						<td class=" ">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$row->spec_id}}</font></font>
						</td>
						<td class=" ">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><h4 style="color:black"><b>{{$row->spec_name}}</b></h4></font></font>
						</td>
						<td class=" ">
							@if($row->display)
								<a href="/admin/goods-attr?spec_id={{$row->spec_id}}" class="btn btn-info" title="查看属性">
									<i class="fa fa-eye"></i>
								</a>
							@endif
							<button class="btn" title="添加子属性" data-toggle="modal" data-target="#child_Modal" onclick="addChild(this)">
								<i class="fa fa-female"></i>
							</button>
							<span style="display:none">{{$row->spec_id}}</span><span style="display:none">{{$row->spec_name}}</span><button class="btn btn-warning" title="修改" data-toggle="modal" data-target="#edit_Modal" onclick="edit_speccification(this)">
								<i class="fa fa-pencil"></i>
							</button>
						</td>
					</tr>
					@endforeach

					<tr class="gradeC">
						<td colspan="4">
							<div class="btn-group">
								<button class="btn btn-success" onclick='clickAll()'>全选</button>
								<button class="btn btn-warning" onclick="notClickAll()">全不选</button>
								<button class="btn btn-success" onclick="inverses()">反选</button>
							</div>		
								<button class="btn btn-danger" onclick='dels()'>批量删除</button>					
						</td>
					</tr>
					</tbody>
					</table>
					<div class="row-fluid">
						<!-- <div class="span6">
							<div class="dataTables_info" id="dynamic-table_info">
								<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">显示57个参赛作品中的1到10个</font></font>
							</div>
						</div> -->
						<div class="span6">
							<div class="dataTables_paginate paging_bootstrap pagination">
								<ul>
									{{$spec->appends($request)->render()}}
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
<!-- 以下均是模态框 -->
<!-- 添加模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">添加规格</h4>
            </div>
            <div class="modal-body">	
				<form role="form" action="/admin/goods-attr" method="post" id="add_form" onsubmit="return getValidate(this)">
					<div class="form-group">
						<label for="exampleInputEmail1">规格名</label>
						<input type="text" name="spec_name" class="form-control" id="exampleInputEmail1" placeholder="输入您所需要的规格" onblur=" validate(this) ">
						<p class="help-block" id="add_help">
							<strong>温馨提示:</strong>输入您所需要的规格
						</p>
					</div>
					{{CSRF_field()}}
				</form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form='add_form'>提交</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!-- 添加子属性模态框（Modal） -->
<div class="modal fade" id="child_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">添加属性</h4>
            </div>
            <div class="modal-body">	
				<form role="form" action="/admin/goods-attr" method="post" id="add_child_form" onsubmit="return getValidate(this)">
					<div class="form-group">
						<label for="exampleInputEmail1">属性名</label>
						<input type="text" name="attr_name" class="form-control" id="exampleInputEmail1" placeholder="输入您所需要的属性" onblur=" validate(this) ">
						<p class="help-block" id="add_help">
							<strong>温馨提示:</strong>输入您所需要的属性
						</p>
						<input type="hidden" name="spec_id" value="" id="add_child_input">
					</div>
					{{CSRF_field()}}
				</form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form='add_child_form'>提交</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!-- 修改规格模态框（Modal） -->
<div class="modal fade" id="edit_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">修改规格</h4>
            </div>
            <div class="modal-body">	
				<form role="form" action="/admin/goods-attr/2" method="post" onsubmit="return getValidate(this)" id="edit_form">
					<div class="form-group">
						<label for="exampleInputEmail1">规格名</label>
						<input type="text" name="spec_name" class="form-control" id="edit_input" placeholder="输入您所需要的属性" onblur=" validate(this) ">
						<p class="help-block" id="add_help">
							<strong>温馨提示:</strong>输入您所需要的规格
						</p>
						<input type="hidden" name="spec_id" value='' id="edit_id">
							
					</div>
					{{CSRF_field()}}
					{{method_field('put')}}
				</form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form='edit_form'>提交</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
@endsection
@section('js')
<script>
//轮循点击表格触发复选框
function clicks(obj)
{
	var checkbox = $(obj).find(':checkbox');
	checkbox.attr('checked',!checkbox.attr('checked'));
}
//点不了checkbox bug修复
function clickd(obj)
{
	$(obj).attr('checked',!$(obj).attr('checked',));
}

//全选
function clickAll()
{
	$('#tbodys').find(':checkbox').each(function(){
		$(this).attr('checked',true);
	});
}
//全不选
function notClickAll()
{
	$('#tbodys').find(':checkbox').each(function(){
		$(this).attr('checked',false);
	});
}
//反选
function inverses()
{
	$('#tbodys').find(':checkbox').each(function(){
		$(this).attr('checked',!$(this).attr('checked'));
	});
}
//ajax批量删除
function dels()
{
	var id = [];
	//查找选中的数据id,并赋值到一个数组里
	$('#tbodys').find(':checked').each(function(){
		id.push($(this).parents('tr').find('td:first').text());
	});
	//判断如果未选择则提示
	if (id == null || id == undefined || id == '' || id.length == 0) {
		alert('请选择至少一项');
		return false;
	}
	if (confirm('您确定要删除该规格吗(包括其下的子属性!!!)')) {
		$.post('/admin/goods-attr-del',{'id':id},function(data){
			// /判断状态码 1 --成功 3 --数组为空
			if (data == 3) {
				alert('请选择至少一项');
				return false;
			}else if(data == 1){
				//循环遍历数组
				for (var i = 0; i < id.length; i++) {
					a = $('#tbodys').find('input[value='+id[i]+']').parents('tr').remove();
				}
			}
		});
	}
}

//验证名字工具函数 obj --表单对象id  help --提示框
function validate(obj)
{
		var name = $(obj).val();
		var help = $(obj).next();

		if (name == '' || name == undefined || name == null) {
			$(help).html('<span style="color:red"><strong>温馨提示:</strong>请输入规格名</span>');
			return false;
		}
		var pattern = new RegExp("[~'!@#$%^&*()-+_=:></`]");
		if (pattern.test(name)) {
			$(help).html('<span style="color:red"><strong>温馨提示:</strong>非法字符!</span>');
			return false;
		}else{
			$(help).html('<span style="color:green"><strong>温馨提示:</strong>验证通过~</span>');
			return true;
		}
}
// 提交按钮验证
function getValidate(obj)
{
	//获取表单对象
	var obj = $(obj).find('input:first');
	//调用验证工具函数
	return validate(obj);
}
//添加子属性时,添加id
function addChild(obj)
{
	var id = $(obj).parents('tr').find('td:first').text();
	$('#add_child_input').val(id);
}
//修改规格时,添加原始数据
function edit_speccification(obj)
{
	//获取规格名
	var name = $(obj).prev().text();
	var id = $(obj).prev().prev().text();
	//将规格名写入修改框里
	$('#edit_input').val(name);
	$('#edit_id').val(id);
}
</script>
@endsection
