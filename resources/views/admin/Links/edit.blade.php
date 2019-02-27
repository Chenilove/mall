@extends('admin.public')
@section('title')
尤洪后台管理首页                                                                                               
@endsection

@section('content_title')
欢迎来到后台首页
@endsection
@section('content')
<html>
 <head>
<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
 </head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>友情链接修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/Tips/{{$info->id}}" method="post">
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">网站名称</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="name" value="{{$info->name}}"/> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">跳转地址</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="url" value="{{$info->url}}" /> 
       </div> 
      </div> 

       <div class="mws-form-row"> 
       <label class="mws-form-label">网站邮箱</label> 
       <div class="mws-form-item"> 
        <input type="texe" class="large" name="email" value="{{$info->email}}"/> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">网站介绍</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="details" value="{{$info->details}}"/> 
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
      {{method_field('PUT')}}
      <input type="submit" value="提交修改" class="btn btn-danger" /> 
      <input type="reset" value="重置" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection