@extends('admin.public')
@section('title','商品品牌管理')
@section('content_title','商品品牌管理')
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
            品牌列表
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
							<a href="/admin/goods-brand" class="btn btn-success">
								<i class="fa fa-mail-reply"></i>
								&nbsp;返回
							</a>
							@endif
							<button class="btn btn-danger" data-toggle="modal" data-target="#myModal">
								<i class="fa fa-plus"></i> 
								&nbsp;添加品牌
							</button>
							</div>
					</div>
						<div class="span6" style="float: right">
							<div class="dataTables_filter" id="dynamic-table_filter">
								<form action="/admin/goods-brand" method="get"  role='form' class="form-inline" id="query">
									<font style="vertical-align: inherit;"><b>搜索: </b></font>
									<input type="text" name="query" class="form-control" value="{{old('query')}}" placeholder="查询品牌名(字母区分大小写)">
									<input type="submit" class="btn btn-info" value="搜索" form="query">
								</form>
							</div>
						</div>
					</div>
					<table class="display table table-bordered table-striped dataTable table-hover" id="dynamic-table" aria-describedby="dynamic-table_info">
					<thead>
					<tr role="row">
						<th class="sorting" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="width: 100px;" aria-label="Rendering engine: activate to sort column ascending">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">选择</font></font>
						</th>
						<th class="sorting" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="width: 70px" aria-label="Browser: activate to sort column ascending">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">品牌ID</font></font>
						</th>
						<th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="width: 249px;" aria-sort="descending" aria-label="Platform(s): activate to sort column ascending">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">品牌图片</font></font>
						</th>
						<th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="width: 249px;" aria-sort="descending" aria-label="Platform(s): activate to sort column ascending">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">品牌名称</font></font>
						</th>
						<th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" style="width: 249px;" aria-sort="descending" aria-label="Platform(s): activate to sort column ascending">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">操作</font></font>
						</th>
					</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all" id="tbodys">
					@foreach($brand as $row)
					<tr class="gradeC" onclick="clicks(this)">
						<td style="display:none">{{$row->brand_id}}</td>
						<td class=" ">
								<input type="checkbox" value="{{$row->brand_id}}" style="zoom:250%" id="checkk" onclick="clickd(this)">
							</div>
						</td>
						<td class=" ">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$row->brand_id}}</font></font>
						</td>
						<td class=" ">
							<img src="{{$row->img}}" alt="图片已经不存在了哦" width="80px">
						</td>
						<td class=" ">
							<font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><h4 style="color:black"><b>{{$row->brand_name}}</b></h4></font></font>
						</td>
						<td class=" ">
							<span style="display:none">{{$row->brand_id}}</span><span style="display:none">{{$row->brand_name}}</span><button class="btn btn-warning" title="修改" data-toggle="modal" data-target="#edit_Modal" onclick="edit_brand(this)">
								<i class="fa fa-pencil"></i>
							</button>
						</td>
					</tr>
					@endforeach

					<tr class="gradeC">
						<td colspan="5">
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
									{{$brand->appends($request)->render()}}
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
                <h4 class="modal-title" id="myModalLabel">添加品牌</h4>
            </div>
            <div class="modal-body">	
				<form role="form" action="/admin/goods-brand" method="post" id="add_form" onsubmit="return getValidate(this,true)"  enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputEmail1">品牌名</label>
						<input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="输入您所需要的品牌" onblur=" validate(this) ">
						<p class="help-block">
							<strong>温馨提示:</strong>输入您所需要的品牌
						</p>
						<input type="file" name="img" id="add_img" style="display: none" accept="image/*" onchange='displayImg(this)'><img src="" style="max-width: 560px">
						<br /><br />
						<label for="">品牌图片</label><br />
						<label class="btn btn-info" for="add_img"><i class="fa fa-picture-o"></i>&nbsp;&nbsp;图片上传</label>
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
<!-- 修改模态框（Modal） -->
<div class="modal fade" id="edit_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">修改品牌</h4>
            </div>
            <div class="modal-body">	
				<form role="form" action="/admin/goods-brand/2" method="post" id="edit_form" onsubmit="return getValidate(this)"  enctype="multipart/form-data">
					<div class="form-group">
						<label>品牌名</label>
						<input type="text" name="brand_name" class="form-control" id="edit_input" placeholder="输入您所需要修改的品牌" onblur=" validate(this) " value="">
						<p class="help-block">
							<strong>温馨提示:</strong>输入您所需要修改的品牌
						</p>
						<input type="file" name="img" id="edit_img" style="display: none" accept="image/*" onchange="displayImg(this)"><img src="" style="max-width: 560px">
						<br /><br />
						<label for="">品牌图片</label><br />
						<label class="btn btn-info" for="edit_img"><i class="fa fa-picture-o"></i>&nbsp;&nbsp;图片上传</label>
					</div>
					<input type="hidden" name="brand_id" id="edit_id" value="">
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
	if (confirm('您确定要删除该品牌吗')) {
		$.post('/admin/goods-brand-del',{'id':id},function(data){
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

//验证工具函数 obj --表单对象id  bool --true 文件不能为空 false 文件可以为空
function validate(obj,bool)
{
		var name = $(obj).val();
		var help = $(obj).next();

		if (name == '' || name == undefined || name == null) {
			$(help).html('<span style="color:red"><strong>温馨提示:</strong>请输入品牌名</span>');
			return false;
		}
		var pattern = new RegExp("[~'!@#$%^&*()-+_=:></`]");
		if (pattern.test(name)) {
			$(help).html('<span style="color:red"><strong>温馨提示:</strong>非法字符!</span>');
			return false;
		}else{
			$(help).html('<span style="color:green"><strong>温馨提示:</strong>验证通过~</span>');
		}

		//获取文件
		var file = $(obj).next().next().val();
		//判断文件是否为空
		if (file == "" || file == null || file == undefined) {
			//判断文件可以为空吗
			if (bool) {
				alert("请选择要上传的文件");
	        	return false
			}else{
				return true;
			}
		}else{
			//检验文件类型是否正确
			//js正则对像
		    var exec = (/[.]/.exec(file)) ? /[^.]+$/.exec(file.toLowerCase()) : '';
		    if (exec == "jpg" || exec == 'jpeg' || exec == 'png' || exec == 'gif') {
		        return true;
		    }else{
		    	alert("抱歉,暂时只支持jpg、jpeg、png、gif图片");
		        return false;
		    }
		}
}
// 提交按钮验证
function getValidate(obj,bool)
{
	//无bool值代表是修改,有bool值代表是添加
	if (bool == undefined || bool == '' || bool == null) {
		bool = false;
	}
	//获取表单对象
	var obj = $(obj).find('input:first');
	//调用验证工具函数
	return validate(obj,bool);
}
//修改品牌时,添加原始数据
function edit_brand(obj)
{
	//获取品牌名
	var name = $(obj).prev().text();
	var id = $(obj).prev().prev().text();
	//将品牌名写入修改框里
	$('#edit_input').val(name);
	$('#edit_id').val(id);
}
//显示图片函数
function displayImg(obj)
{
	//显示图片对象
	var img0 = $(obj).next();
	//实例化js文件读取函数
	var fs = new FileReader();
	//fs处理图片url
    fs.readAsDataURL(obj.files[0]);
    // fs一但完成加载,在这里修改图片的地址属性  
    fs.onload = function() {
        $(img0).attr("src",fs.result) ;
    };  
} 
</script>
@endsection
