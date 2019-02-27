@extends('admin.public')
@section('title')
尤洪后台管理首页                                                                                               
@endsection

@section('content_title')
欢迎来到后台首页
@endsection
@section('content')
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>友情链接添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/Tips" method="post">
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">网站名称</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="name"/> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">跳转地址</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="url"/> 
       </div> 
      </div> 

       <div class="mws-form-row"> 
       <label class="mws-form-label" type='emali'>网站邮箱</label> 
       <div class="mws-form-item"> 
        <input type="texe" class="large" name="email" /> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">网站介绍</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="details" /> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">网站状态</label> 
       <select class="large" name="status">
          <option value="">--请选择--</option>
          <option value="1">发布</option>
          <option value="0">下架</option>
       </select> 
      </div>   
     </div> 
     <div class="mws-button-row">
      {{csrf_field()}} 
      <input type="submit" value="提交" class="btn btn-danger" /> 
      <input type="reset" value="重置" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection