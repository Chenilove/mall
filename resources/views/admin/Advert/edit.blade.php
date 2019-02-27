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
 <script type="text/javascript" charset="utf-8" src="/status/UEditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/status/UEditor/ueditor.all.min.js">
</script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加
载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/status/UEditor/lang/zh-cn/zh-cn.js">
</script>
 <body>
 <!-- 显示失败信息 -->
@if(session('error'))
<div class="alert alert-block alert-danger fade in">
  <button type="button" class="close close-sm" data-dismiss="alert">
  <i class="fa fa-times"></i>
  </button>
  <strong>操作失败!</strong> {{session('error')}}
</div>
@endif
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>公告修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/Advert/{{$info->id}}" method="post">
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">公告标题</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="title"/ value="{{$info->title}}">
        </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">内容</label> 
       <div class="mws-form-item"> 
        <script id="editor" type="text/plain" name="descr" style="width:800px;height:500px;">{!!$info->descr!!}
        </script>
       </div> 
      </div>
     <div class="mws-button-row">
      {{csrf_field()}}
      {{ method_field('PUT') }}
      <input type="submit" value="提交修改" class="btn btn-danger" /> 
      <input type="reset" value="重置" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
 <script type="text/javascript">
//实例化编辑器
//建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接
// 调用UE.getEditor('editor')就能拿到相关的实例
var ue = UE.getEditor('editor');
</script>
</html>
@endsection




























