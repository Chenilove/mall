@extends('home.public')
@section('title','商品详情--尤洪')
@section('link')
	<link type="text/css" rel="stylesheet" href="/status/home/css/style.css" />
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="/status/admin/js/jquery-1.7.2.min.js"></script>
    <!--[if IE 6]>
    <script src="/status/home/js/iepng.js" type="text/javascript"></script>
        <script type="text/javascript">
           EvPNG.fix('div, ul, img, li, input, a'); 
        </script>
    <![endif]-->
  <!--  
    注意:地址模块的bootstrap的样式以及css是引用的网络的文件
    注意:地址模块的bootstrap的样式以及css是引用的网络的文件
    注意:地址模块的bootstrap的样式以及css是引用的网络的文件
    注意:地址模块的bootstrap的样式以及css是引用的网络的文件
    注意:地址模块的bootstrap的样式以及css是引用的网络的文件
    注意:地址模块的bootstrap的样式以及css是引用的网络的文件
    注意:地址模块的bootstrap的样式以及css是引用的网络的文件
    注意:地址模块的bootstrap的样式以及css是引用的网络的文件
  -->
  
<!-- 验证框样式 -->
<style>
  .err{
    border:1px solid red;
  }
  .cur{
    border:1px solid green;
  }
</style>
@endsection
@section('content')
<div class="i_bg bg_color">
    <!--Begin 用户中心 Begin -->
	<div class="m_content">
   		<div class="m_left">
        	<div class="left_n">管理中心</div>
            <div class="left_m">
            	<div class="left_m_t t_bg1">订单中心</div>
                <ul>
                	<li><a href="/home/myorder">我的订单</a></li>
                    <!-- <li><a href="Member_Address.html" class="now">收货地址</a></li> -->
                    <!-- <li><a href="#">缺货登记</a></li> -->
                    <!-- <li><a href="#">跟踪订单</a></li> -->
                </ul>
            </div>
            <div class="left_m">
            	<div class="left_m_t t_bg2">会员中心</div>
                <ul>
                	<li><a href="/home/details">用户信息</a></li>
                    <li><a href="/home/collection">我的收藏</a></li>
                    <!-- <li><a href="Member_Msg.html">我的留言</a></li> -->
                    <!-- <li><a href="Member_Links.html">推广链接</a></li> -->
                    <!-- <li><a href="#">我的评论</a></li> -->
                </ul>
            </div>
        </div>
		<div class="m_right">
            <p></p>
            @foreach($data as $row)
            <div class='delete'>
              <div class="mem_tit">收货地址</div>
              <div class="address" id="update">
                <div class="a_close">
                  <input type='hidden' value="{{$row->id}}">
                 <a href="javascript:void(0)"  onclick='deletes(this)'  comfirm('确定要删除么?')><img src="/status/home/images/a_close.png" /></a> 
                </div>
                <table border="0" class="add_t" align="center" style="width:98%; margin:10px auto;" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="right" width="110">收货人姓名：</td>
                      <td>{{$row->name}}</td>
                    </tr>
                    <tr>
                      <td align="right">省/市/区：</td>
                      <td>{{$row->city}}</td>
                    </tr>
                    <tr>
                      <td align="right">详细地址：</td>
                      <td>{{$row->Address}}</td>
                    </tr>
                    <tr>
                      <td align="right">手机：</td>
                      <td>{{$row->phone}}</td>
                    </tr>
                  <tr>
                      <td align="right">手机：</td>
                      <td>{{$row->code}}</td>
                    </tr>
                
                  </table>
          
                  <p align="right">
                  @if($row->status>0)
                    <a href="#" style="color:green;">默认地址</a>&nbsp; &nbsp; &nbsp; &nbsp;
                  @else
                    <a href="/home/default_address/{{$row->id}}" style="color:#ff4e00;">设为默认</a>&nbsp; &nbsp; &nbsp; &nbsp;
                  @endif 
                  <!-- 编辑按钮 -->
                    <a href="javascript:void(0)" style="color:#ff4e00;" onclick='update(this)' data-toggle="modal" data-target="#myModal-update">编辑</a>&nbsp; &nbsp; &nbsp; &nbsp; 
                  </p>
              </div>
            </div>
            
              @endforeach
            <!-- 添加地址按钮 -->
            <div class="mem_tit">
            	<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"><img src="/status/home/images/add_ad.gif" /></a>
            </div>
            
         
            


        </div>
    </div>
	<!--End 用户中心 End--> 
<!-- 模态框<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">开始演示模态框</button> -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">添加地址</h4>
            </div>
            <div class="modal-body">
            <form action="/home/address" method="post" id='form'>
              <table border="0" class="add_tab" style="width:850px;"  cellspacing="0" cellpadding="0">
                <tr>
                  <td width="120" align="right">配送地区</td>
                  <td colspan="3" style="font-family:'宋体';">
                      <select class="jj sid" id='sid'>
                          <option value="0" class="select">--请选择--</option>
                      </select>
                      <span id="diqu">（必填）</span>
                      <input type="hidden" name="city">
                      
                  </td>
                </tr>
                <tr>
                  <td align="right">收货人姓名</td>
                  <td style="font-family:'宋体';"><input type="text" value="" class="add_ipt" name="name" tips="&nbsp;请填写正确的用户名"/><span>（必填）</span></td>
                  <td align="right">手机</td>
                  <td style="font-family:'宋体';"><input type="text" value="" class="add_ipt" name="phone" tips="&nbsp;请填写正确的电话"/><span>（必填）</span></td>
                </tr>
                <tr>
                  <td align="right">详细地址</td>
                  <td style="font-family:'宋体';"><input type="text" value="" class="add_ipt" name="address" tips="&nbsp;请填写正确的地址"/><span>（必填）</span></td>
                  <td align="right">邮政编码</td>
                  <td style="font-family:'宋体';"><input type="text" value="" class="add_ipt" name="code" tips="&nbsp;请填写正确的邮编"/><span></span></td>
                </tr>
            

              </table>
               {{csrf_field()}}
              
           </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="submit" class="btn btn-primary" form='form'>提交更改</button>
            </div>
        </div>
    </div>
</div>
<!-- 修改框的modal框 -->
<!-- 模态框<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">开始演示模态框</button> -->
<div class="modal fade" id="myModal-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">修改地址</h4>
            </div>
            <div class="modal-body" id="modal_edit">
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="submit" class="btn btn-primary" form='form1'>提交更改</button>
            </div>
        </div>
    </div>
</div>
<!-- 修改modal结束 -->
@endsection
@section('js')
<!-- ajax 城级联动 -->
<script>
  //第一级别获取
  $.get('/home/add_address',{'upid':0},function(data){
    //console.log(data);
    //得到的数据数组内容 我们要遍历得到里面的一个对象
    for(var i=0;i<data.length;i++){
      //console.log(data[i]).name;
      //将得到的地址名称写入到option
      var info = $('<option value="'+data[i].id+'">'+data[i].name+'</option>');
      //console.log(info);
      //将得到的option标签放入到select列表中
       $('.sid').append(info);

      
    }

    //禁止请选择被选中
    $('.select').attr('disabled',true);
  },'json');
  //其他级别内容
  //live 事件 委派 它可以帮助我们将动态生成的内容 重要选择器相同就可以有相应的事件
  $('.sid').live('change',function(){
    //现将后面的'必填'给清理掉
    $('#diqu').html('');
    //将当前对象存储起来
    obj = $(this);
    //通过id来查找下一个
    id = $(this).val();
    //清除所有其他的select
    obj.nextAll('select').remove();
    $.getJSON('/home/add_address',{'upid':id},function(data){
      if(data != ''){
        var select = $('<select class="sid"></select>');
        var option = $('<option class="select" value="0">--请选择--</option>');
        select.append(option);

        //循环输出相应城市内容
        for(var i=0;i<data.length;i++){
          //console.log(data[i].name);
          var info = $('<option value="'+data[i].id+'">'+data[i].name+'</option>');
          select.append(info);
        }
        //将select标签添加 到当前标签的后面
        obj.after(select);
      }
      
      $('.select').attr('disabled',true);
    })
  })

//表单验证开始
$('input').focus(function(){
  //添加提示信息
  tips = $(this).attr('tips');
  $(this).next('span').css({'color':'red','font-size':'12px'}).html(tips);
  //添加样式
  $(this).addClass('err');
  $(this).removeClass('cur');
});

//收件人验证
$("input[name='name']").blur(function(){
  //获取用户名
  name = $(this).val();
  //正则匹配 match匹配不到返回null
  if(name.match(/^[\u4e00-\u9fa5]{2,4}$/)==null){
    $(this).next('span').css({'color':'red','font-size':'12px'}).html(' *用户名为2-4位的汉字');
    //添加样式
    $(this).addClass('err');
    //给常量赋值,用户后面的提交判断
    NAME = false;
  }else{
    $(this).next('span').css({'color':'green','font-size':'12px'}).html(' 用户名正确');
    //添加样式
    $(this).addClass('cur');
    //给常量赋值,用户后面的提交判断
    NAME = true;
  }
})

//手机号验证
$("input[name='phone']").blur(function(){
  // alert(1);
  //获取手机号
  phone = $(this).val();
  //正则匹配 match
  if(phone.match(/^((13[0-9])|(14[0-9])|(15[0-9])|(17[0-9])|(18[0-9]))\d{8}$/)==null){
    $(this).next('span').css({'color':'red','font-size':'12px'}).html(' *手机号格式不正确');
    //添加样式
    $(this).addClass('err');
    //给常量赋值,用户后面的提交判断
    PHONE = false;
  }else{
    $(this).next('span').css({'color':'green','font-size':'12px'}).html(' 手机号正确');
    //添加样式
    $(this).addClass('cur');
    //给常量赋值,用户后面的提交判断
    PHONE = true;
  }
});
//地址验证
$("input[name='address']").blur(function(){
  // alert(1);
  //获取手机号
  address = $(this).val();
  //正则匹配 match
  if(address.match(/^[\u4e00-\u9fa5_a-zA-Z0-9]{1,30}$/) == null){
    $(this).next('span').css({'color':'red','font-size':'12px'}).html(' *地址不能为空');
    //添加样式
    $(this).addClass('err');
    //给常量赋值,用户后面的提交判断
    ADDRESS = false;
  }else{
    $(this).next('span').css({'color':'green','font-size':'12px'}).html(' 地址格式正确');
    //添加样式
    $(this).addClass('cur');
    //给常量赋值,用户后面的提交判断
    ADDRESS = true;
  }
});
//邮政编码验证
$("input[name='code']").blur(function(){
  // alert(1);
  //获取邮编号码
  code = $(this).val();
  //正则匹配 match
  if(code.match(/^\d{1,6}$/) == null){
    $(this).next('span').css({'color':'red','font-size':'12px'}).html(' *地址不能为空');
    //添加样式
    $(this).addClass('err');
    //给常量赋值,用户后面的提交判断
    CODE = false;
  }else{
    $(this).next('span').css({'color':'green','font-size':'12px'}).html(' 地址格式正确');
    //添加样式
    $(this).addClass('cur');
    //给常量赋值,用户后面的提交判断
    CODE = true;
  }
})
//表单验证结束
  //获取选中的数据提交到操作页面
  $(':submit').click(function(){
    arr = [];
    $('.sid').each(function(){
      opdata = $(this).find('option:selected').val();
      //如果opdata为空不能提交并提示
      console.log($(this).find('option:selected'));
      if(opdata != 0 && opdata != ''){
        arr.push(opdata);
        OPDATA = true;
      }else{
        $('#diqu').css({'color':'red','font-size':'12px'}).html(' *地区不能为空');
        OPDATA = false;
      }
    })
    //绑定提交事件
    $('#form').submit(function(){
      if( OPDATA && NAME && PHONE && ADDRESS && CODE){
        return true;
      }else{
        return false;
      }
    })
    //将得到的数组直接赋值给隐藏域的value即可
    $('input[name=city]').val(arr);
  })
</script>
<!-- Ajax删除 -->
<script>
function deletes(obj){
   if(confirm('确定要删除么?')){
    id = $(obj).prev().val();
    //alert(id);
    $.get('/home/deletes',{id:id},function(data){
      if(data==1){
        //将自己删除
        $(obj).parents('.delete').remove();
      }
    })
   }  
}
/*Ajax修改*/
function update(obj){
  //alert(1);
  //找到需修改的地址ID
  id = $(obj).parents('.delete').find(':hidden').val();
  //console.log(id);
  //将id传递到php页面处理
  $.get('/home/update_address',{id:id},function(data){
    //alert(data);
    //此处必须要替换 而不是添加 如果是添加就会重叠
    $('#modal_edit').html(data);
  });
}


</script>
<!--[if IE 6]>
<script src="//letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
@endsection