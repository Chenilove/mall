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
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>轮播图添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/Rotation" method="post"> 
     <div class="mws-form-inline">  
      <div class="mws-form-row"> 
       <label class="mws-form-label">图片</label> 
       <div class="mws-form-item"> 
      <script id="editor" type="text/plain" name="pic" style="width:800px;height:500px;">
        </script>
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">状态</label> 
       <select class="large" name="status">
          <option value="0">--请选择--</option>
          <option value="1">发布</option>
          <option value="0">下架</option>
       </select> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">跳转地址</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="url"/"> 
       </div> 
      </div>  
     <div class="mws-button-row">
      {{csrf_field()}}
      <input type="submit" value="添加" class="btn btn-danger" /> 
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