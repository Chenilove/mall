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
@endsection
@section('content_title')
商品分类列表
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
<!-- 显示警告信息 -->
<div class="alert alert-warning fade in">
	<button type="button" class="close close-sm" data-dismiss="alert">
	<i class="fa fa-times"></i>
	</button>
	<strong>温馨提示!</strong> 您好 禁用父级分类后 其子类也将不显示 并且为了页面简洁性 超过3级的分类将无法显示
</div>
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
		<header class="panel-heading">
			<div class="btn-group">
				<a href="/admin/cates" class="btn btn-info" type="button">
                	<i class="fa fa-mail-reply-all"></i> 首级
                </a>                
                <button class="btn btn-success" type="button" onclick="history.back()">
                	<i class="fa fa-mail-reply"></i> 返回
                </button>
			</div>
				<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#addModal">
					<i class="fa fa-plus"></i> 添加商品分类
				</button>
        <!-- 添加分类模态框（Modal start） -->
		<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title" id="myModalLabel">添加商品分类</h4>
		            </div>
		            <div class="modal-body">
		            	<div class="row">
					    <div class="col-lg-12">
					        <!-- 模态框主体 -->
					        <section class="panel">
					        <header class="panel-heading">
					                            添加商品分类
					        </header>
					        <div class="panel-body">
					            <form action='/admin/cates' method="post" role="form" class="form-horizontal adminex-form" id="form" enctype="multipart/form-data">
					                <div class="form-group">
					                    <label class="col-lg-2 control-label" for="f-name">分类名称</label>
					                    <div class="col-lg-10">
					                        <input type="text" name="name"  id="f-name" class="form-control" accept="image/jpeg" style="max-width: 200px">
					                        <p class="help-block" id="add_help">
												<strong>温馨提示:</strong>输入您所需要的分类
					                        </p>
					                    </div>
					                </div>
					                <div class="form-group">
					                    <label class="col-lg-2 control-label">父级分类</label>
					                    <div class="col-lg-10">
					                        <select name="pid">
					                        <option value="0">--无父级分类--</option>
					                        @foreach($add as $value)
					                            <option value="{{$value->id}}">{{$value->name}}</option>
					                        @endforeach
					                        </select>
					                        <p class="help-block">
					                        	
					                        </p>
					                    </div>
					                </div>
					                <div class="form-group">
					                    <label class="col-lg-2 control-label">是否上架</label>
					                    <div class="col-lg-10">
					                        <input type="checkbox" name="status" id="status" checked />
					                        <label for="status">是否上架</label>
					                        <p class="help-block">
					                            <!-- Aha you gave a wrong info -->
					                        </p>
					                    </div>
					                </div>
					                <div class="form-group">
					                    <label class="col-lg-2 control-label">分类图标</label>
					                        <label for="add_img" class="btn btn-info"><i class="fa fa-picture-o"></i>&nbsp;&nbsp;上传图片</label><input type="file" name="img" accept="image/*" style="display:none" id="add_img" onchange="displayImg(this)"><br><img src="" style="max-width: 560px">	
					                        <p class="help-block" id="add_file">
					                            <!-- Aha you gave a wrong info -->
					                        </p>
					                </div>
					            {{CSRF_field()}}
					            </form>
					        </div>
					        </section>
					    </div>
					</div>
		            </div>
		            <div class="modal-footer">
		            	<button type="submit" class="btn btn-primary" form='form'>确认添加</button>
		                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		            </div>
		        </div><!-- /.modal-content -->
		    </div><!-- /.modal -->
		</div>
		<!-- 添加分类模态框结束（Modal end） -->
		<span class="tools pull-right">
		<a href="javascript:;" class="fa fa-chevron-down"></a>
		<a href="javascript:;" class="fa fa-times"></a>
		</span>
		</header>
		<div class="panel-body" style="display: block;">
			<table class="table table-hover general-table table-striped">
			<thead>
			<tr>
				<th>
					ID
				</th>
				<th class="hidden-phone">
					分类名称
				</th>
				<th>
					分类图标
				</th>
				<th>
					分类状态
				</th>
				<th>
					操作
				</th>
			</tr>
			</thead>
			<tbody>
			@foreach($cates as $v)
			<tr>
				<td class="hidden-phone">{{$v->id}}</td>
				<td><h4 style="color:black"><b>{{$v->name}}</b></h4></td>
				<td>
					<img src="{{$v->img}}" alt="图标已经不存在了" width="40px">
				</td>
				<td>
					<div class="testswitch">
						<input class="testswitch-checkbox" id="onoffswitch{{$v->id}}" type="checkbox" @if($v->status == 1) checked  @endif>  
						<label class="testswitch-label" for="onoffswitch{{$v->id}}">
							<span class="testswitch-inner" data-on="ON" data-off="OFF"></span>
							<span class="testswitch-switch"></span>
						</label>
					</div>
				</td>
				<td>
					@if($v->child == true)
					<a href="/admin/cates?pid={{$v->id}}" class="btn btn-info" title="查看子分类">
                        <i class="fa fa-eye"></i>
                    </a>
					@endif
					<button type="button" class="btn btn-danger" onclick="del(this) " title="删除">
						<i class="fa fa-trash-o"></i>
					</button>
					<button class="btn btn-warning" onclick='editCates(this)' type="button" data-toggle="modal" data-target="#editModal" title="修改">
					<i class="fa fa-magic"></i>
				</button>
				</td>
			</tr>
			
			@endforeach
		<!-- 修改分类模态框（Modal start） -->
		<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title" id="editModalLabel">修改商品分类</h4>
		            </div>
		            <div class="modal-body">
		            	<div class="row">
					    <div class="col-lg-12">
					        <!-- 模态框主体 -->
					        <section class="panel">
					        <header class="panel-heading">
					                            修改商品分类
					        </header>
					        <div class="panel-body">
					            <form action='/admin/cates-e' method="post" role="form" class="form-horizontal adminex-form" id="editForm" enctype="multipart/form-data">
					                <div class="form-group">
					                    <label class="col-lg-2 control-label" for="edit_name">分类名称</label>
					                    <div class="col-lg-10">
					                        <input type="text" name="name"  id="edit_name" class="form-control" style="max-width: 200px">
					                        <p class="help-block" id="edit_help">
												<strong>温馨提示:</strong>输入您修改后的分类
					                        </p>
					                    </div>
					                </div>
					                <div class="form-group">
					                    <label class="col-lg-2 control-label">父级分类</label>
					                    <div class="col-lg-10">
					                        <select name="pid">
					                        <option value="0" class="edit_pid">--无父级分类--</option>
					                        @foreach($add as $value)
					                            <option value="{{$value->id}}" class="edit_pid">{{$value->name}}</option>
					                        @endforeach
					                        </select>
					                        <p class="help-block">
					                            <!-- Aha you gave a wrong info -->
					                        </p>
					                    </div>
					                </div>
					                <div class="form-group">
					                    <label class="col-lg-2 control-label">是否上架</label>
					                    <div class="col-lg-10">
					                        <input type="checkbox" name="status" id="status" checked />
					                        <label for="status">是否上架</label>
					                        <p class="help-block">
					                            <!-- Aha you gave a wrong info -->
					                        </p>
					                    </div>
					                </div>
					                <div class="form-group">
					                    <label class="col-lg-2 control-label">分类图标</label>
					                        <label for="edit_img" class="btn btn-info"><i class="fa fa-picture-o"></i>&nbsp;&nbsp;上传图片</label>
					                        <input type="file" name="img" accept="image/*" style="display:none" id="edit_img" onchange="displayImg(this)"><br><img src="" style="max-width: 560px">
					                        <p class="help-block">

					                            <!-- Aha you gave a wrong info -->
					                        </p>
					                </div>
					            {{CSRF_field()}}
					            <input type="hidden" name="id" id="hidden_id" value="">
					            </form>
					        </div>
					        </section>
					    </div>
					</div>
		            </div>
		            <div class="modal-footer">
		            	<button type="submit" class="btn btn-primary" form='editForm'>确认添加</button>
		                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		            </div>
		        </div><!-- /.modal-content -->
		    </div><!-- /.modal -->
		</div>
		<!-- 修改分类模态框结束（Modal end） -->
			<tr>
				<td colspan="5">
				<div style="float:right">
					{{$cates->render()}}
				</div>
					
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		</section>
	</div>
</div>
@endsection
@section('js')
<script>
	//验证名字函数 obj --表单对象id  help --提示框
function getVilidate(obj,helps,files,bool)
{
		var name = $('#'+obj).val();

		if (name == '' || name == undefined || name == null) {
			$('#'+helps).html('<span style="color:red"><strong>温馨提示:</strong>请输入类名</span>');
			return false;
		}
		var pattern = new RegExp("[~'!@#$%^&*()-+_=:></`]");
		if (pattern.test(name)) {
			$('#'+helps).html('<span style="color:red"><strong>温馨提示:</strong>非法字符!</span>');
			return false;
		}else{
			$('#'+helps).html('<span style="color:green"><strong>温馨提示:</strong>验证通过~</span>');
		}

		//获取文件
		var file = $("#"+files).val();
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


	//js验证表单
		//验证添加表单
	$('#f-name').blur(function(){
		getVilidate('f-name','add_help');
		//验证名字
		
	});
	$('#form').submit(function(){
		//判断名字,文件
		return getVilidate('f-name','add_help','add_img',true);
	});

		//验证修改表单
	$('#edit_name').blur(function(){
		getVilidate('edit_name','edit_help');
		//验证名字
		
	});
	$('#editForm').submit(function(){
		//判断名字,文件
		return getVilidate('edit_name','edit_help','edit_img',false);
	});





	//ajax修改商品状态
	$('.testswitch-checkbox').click(function(){
		//获取当前行
		var row = $(this).parents('tr');
		//获取商品id
		var id = $(row).find('td:first').html();
		$.get('/admin/cates/'+id,{},function(data){});
	});
	//ajax删除商品分类
	var del = function(obj)
	{
		//获取当前行
		var row = $(obj).parents('tr');
		//获取商品id
		var id = $(row).find('td:first').html();
		if (confirm('您好 确定要删除此分类吗')) {
			$.post('/admin/cates-d',{'id':id},function(data){
				if (parseInt(data) == 2) {
					alert('您好 该分类下存有子类,请先删除子类');
				}else{
					$(row).remove();
				}
			})		
		}
		
	}

	// edit_name
	// edit_pid
	//ajax显示修改模板
	function editCates(obj)
	{
		//获取当前行
		var row = $(obj).parents('tr');
		//获取商品名称
		var name = $(row).children().eq(1).text();
		//获取商品id
		var id = $(row).find('td:first').html();
		//将名称和id插入表单
		$('#edit_name').val(name);
		$('#hidden_id').val(id);
	}

	//显示图片函数
	function displayImg(obj)
	{
		//显示图片对象
		var img0 = $(obj).next().next();
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
<script color="0,0,0" opacity="0.5" count="99" src="https://cdn.bootcss.com/canvas-nest.js/1.0.1/canvas-nest.js" type="text/javascript" charset="utf-8"></script>

@endsection
