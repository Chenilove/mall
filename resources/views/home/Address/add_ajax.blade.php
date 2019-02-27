<form action="/home/address/{{$id}}" method="post" id='form1'>
  <table border="0" class="add_tab" style="width:850px;"  cellspacing="0" cellpadding="0">
    <tr>
      <td width="120" align="right">配送地区</td>
      <td colspan="3" style="font-family:'宋体';">

        @foreach($arr3 as $newkey=>$newvalue)
          <select class="jj sid_update" >
              <option value="{{$newkey}}" id="select" selected>{{$newvalue}}</option>
          </select>
        @endforeach
        @foreach($new as $keys=>$values)
            <select>
             <option value="{{$keys}}" selected>{{$values}}</option>
           </select>
        @endforeach
        <span id="diqu1">（必填）</span>
          <input type="hidden" name="city">
        
      </td>
    </tr>
    <tr>
      <td align="right">收货人姓名</td>
      <td style="font-family:'宋体';"><input type="text" value="{{$data->name}}" class="add_ipt" name="name" tips="&nbsp;请填写正确的用户名"/><span>（必填）</span></td>
      <td align="right">手机</td>
      <td style="font-family:'宋体';"><input type="text" value="{{$data->phone}}" class="add_ipt" name="phone" tips="&nbsp;请填写正确的电话"/><span>（必填）</span></td>
    </tr>
    <tr>
      <td align="right">详细地址</td>
      <td style="font-family:'宋体';"><input type="text" value="{{$data->Address}}" class="add_ipt" name="address" tips="&nbsp;请填写正确的地址"/><span>（必填）</span></td>
      <td align="right">邮政编码</td>
      <td style="font-family:'宋体';"><input type="text" value="{{$data->code}}" class="add_ipt" name="code" tips="&nbsp;请填写正确的邮编"/><span></span></td>
    </tr>
  </table>
    {{csrf_field()}}
    {{method_field('PUT')}}              
       
</form>
            
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
       $('.sid_update').append(info);
    }

    //禁止请选择被选中
    $('#select').attr('disabled',true);
  },'json');
  //其他级别内容
  //live 事件 委派 它可以帮助我们将动态生成的内容 重要选择器相同就可以有相应的事件
  $('.sid_update').live('change',function(){
    //现将后面的'必填'给清理掉
    $('#diqu1').html('');
    //将当前对象存储起来
    obj = $(this);
    //通过id来查找下一个
    id = $(this).val();
    // //清除所有其他的select
    // obj.nextAll('select').remove();
    $.getJSON('/home/add_address',{'upid':id},function(data){
      if(data != ''){
        var select = $('<select class="sid_update"></select>');
        var option = $('<option class="select" value="0">--请选择--</option>');
        select.append(option);

        //循环输出相应城市内容
        for(var i=0;i<data.length;i++){
          //console.log(data[i].name);
          var info = $('<option value="'+data[i].id+'">'+data[i].name+'</option>');
          select.append(info);
        }
        //清除所有其他的select
        obj.nextAll('select').remove();
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
    $('.sid_update').each(function(){
      opdata = $(this).find('option:selected').val();
      //此处判断为排除添加模态中--请选择--的value值0,他会干扰修改模态框中select的选择;
      if(opdata != 0){
        arr.push(opdata);
        OPDATA = true;
      }else{
        $('#diqu1').css({'color':'red','font-size':'12px'}).html(' *地区不能为空');
        OPDATA = false;
      }
    })
    //绑定提交事件
    $('#form1').submit(function(){
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