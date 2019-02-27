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
    <span>站内信内容添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/Mali" method="post">
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">标题</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="title"/> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">内容</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="content"/> 
       </div> 
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