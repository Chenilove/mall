@extends('admin.public')
@section('title')
管理员修改管理
@endsection
@section('content_title')
管理员修改管理
@endsection
@section('content')
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>管理员用户修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminuser/{{$info->id}}" method="post">
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">管理员名</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="username" value="{{$info->username}}"/> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">邮箱</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="email" value="{{$info->email}}"/> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">手机号</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="phone" value="{{$info->phone}}" /> 
       </div> 
      </div>  
     </div> 
     <div class="mws-button-row">
      {{method_field("PUT")}}
      {{csrf_field()}}
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section('title','后台用户修改')