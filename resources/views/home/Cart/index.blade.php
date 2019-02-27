@extends('home.public')
@section('title','购物车--尤洪')
@section('link')
    <link type="text/css" rel="stylesheet" href="/status/home/css/style.css" />
    <!-- <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!--[if IE 6]>
    <script src="/status/home/js/iepng.js" type="text/javascript"></script>
        <script type="text/javascript">
           EvPNG.fix('div, ul, img, li, input, a'); 
        </script>
    <![endif]-->
    <!-- // <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script type="text/javascript" src="/status/home/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/status/home/js/menu.js"></script>    
        
    <script type="text/javascript" src="/status/home/js/select.js"></script>
    <script type="text/javascript" src="/status/home/js/jquery-1.8.2.min.js"></script>

@endsection
@section('content')
<div class="i_bg">  
    <div class="content mar_20">
        <img src="/status/home/images/img1.jpg" />        
    </div>
    <!-- 没有选择商品提示 -->
             
    @if(session('error'))
    <br>
    <div style="float:left;margin-left: 100px">
        <h3 style="color: red">{{session('error')}}</h3>
    </div> 
    <br>
    @endif
    <!--Begin 第一步：查看购物车 Begin -->
    <form action="/home/order_confirm" method="post">
    <div class="content mar_20">
        <table border="0" class="car_tab" style="width:1200px; margin-bottom:50px;" cellspacing="0" cellpadding="0" id="DataTables_Table_1">
          <tr>
            <td class="car_th" width="90"><input type="checkbox" class="allchoose" value='0'>全选</td>
            <td class="car_th" width="420">商品名称</td>
            <td class="car_th" width="140">规格</td>
            <td class="car_th" width="140">单价</td>
            <td class="car_th" width="150">购买数量</td>
            <td class="car_th" width="130">小计</td>
            <td class="car_th" width="150">操作</td>
          </tr>

          <!-- 第一个产品 -->
        @foreach($data as $row)
          <tr>
            <td><input type="checkbox" name="orders[]" onclick="zongji(this)" value="{{$row->id}}"></td>
            <td>
                <div class="c_s_img"><img src="{{$row->url}}" width="73" height="73" /></div>
                {{$row->goods_name}}
            </td>
            <td align="center">{{$row->type}}</td>
            <td align="center" style="color:#ff4e00;">{{$row->price}}</td>
            <td align="center">
                <div class="c_num" style="width:86px;">
                    <a href="/home/cart-jian/{{$row->id}}" class="car_btn_1"></a>
                    <input type="text" value="{{$row->num}}" name="" class="car_ipt" />  
                    <a href="/home/cart-add/{{$row->id}}" class="car_btn_2"></a>
                </div>
            </td>
            <td align="center" style="color:#ff4e00;" class="xiaoji">{{$row->price*$row->num}}</td>
            <td align="center"><a onclick="ShowDiv(this)">删除</a>&nbsp; &nbsp;<!-- <a href="#">加入收藏</a> --></td>
          </tr>
        @endforeach
        
          
          <tr height="70">
            <td colspan="7" style="font-family:'Microsoft YaHei'; border-bottom:0;">
                <!-- <label class="r_rad"></label> --><label class="r_txt"><button class="allnochoose" style="color:#555555;">全不选</button></label>
                <!-- <label class="r_txt" ><a onclick="ShowDiv('MyDiv','fade')">删除</a></label> -->
                <span class="fr">商品总价：<b style="font-size:22px; color:#ff4e00;" id="total">0元</b></span>
            </td>
          </tr>
          <tr valign="top" height="150">
            <td colspan="7" align="right">
            {{csrf_field()}}
                <a href="/" style="display:inline-block;width:120px;height:45px;"><img src="/status/home/images/buy1.gif" /></a>
                &nbsp; &nbsp; 
                <input type="submit" style="padding:0px;width:160px;height:45px;background-color:#ff4e00;color:white;border:1px solid #cccccc; font-size:20px;" value="确认结算">
            </td>
          </tr>
        </table>
        
    </div>
    </form>
    <!--End 第一步：查看购物车 End--> 
    
@endsection
@section('js')
<script>
    //全选
    $(".allchoose").click(function(){    
        //console.log($("#DataTables_Table_1").find("tr"));
        total1 = 0;
        $("#DataTables_Table_1").find("tr").each(function(){
            $(this).find(":checkbox").attr("checked",true);
        });     
    });
    //全不选
    $('.allnochoose').click(function(){
        $("#DataTables_Table_1").find("tr").each(function(){
            $(this).find(":checkbox").attr("checked",false);
        });  
    });

    //单独点击商品计算总价
    function zongji(obj){
        //alert(1);
        total = 0;
        $('input[name="orders[]"]').each(function(){
            if($(this).attr('checked')){
                xiaoji = $(this).parents('tr').find('.xiaoji').html();
               total += parseFloat(xiaoji); //将字符串转为整型
            }
            
        })
        
         //console.log(total);
         $('#total').html(total+'元');
    }

    //点击全选时 计算总价
    $(".allchoose").click(function(){  
        //alert(1);
        $('input[name="orders[]"]').each(function(){
            xiaoji1 = $(this).parents('tr').find('.xiaoji').html();
            //console.log(xiaoji1);
            total1 += parseFloat(xiaoji1); //将字符串转整型
        })
         $('#total').html(total1+'元');
    })

    //默认装状态下被选中的计算总价
    total2 = 0;
    $('input[name="orders[]"]').each(function(){
        if($(this).attr('checked')){
            xiaoji2 = $(this).parents('tr').find('.xiaoji').html();
            total2 += parseFloat(xiaoji2); //将字符串转为整型
        }
            
    }) 
     //console.log(total);
     $('#total').html(total2+'元');

     //Ajax删除
     function ShowDiv(obj){
        //设置删除确认框
        if(confirm('亲!确认要删除么?')){
            //alert(1)
            //获取需要删除的id
            id = $(obj).parents('tr').find('input:checkbox').val();
            //获取需要删除商品的价格小计
            total3 = Number($(obj).parents('tr').find('.xiaoji').html());
            //console.log(total3);
            //alert(id);
            $.get('/home/ajax_cartdelete',{id:id},function(data){
                //console.log(data);
                if(data){
                    //删除本条记录
                    $(obj).parents('tr').remove();
                    //删除成功改变总价的价格
                    total4 = parseFloat($('#total').html())-total3;
                    //如果什么都有选,就直接删除商品,就会出现负数,要避免
                    if(total4<=0){
                        total4 = 0;
                    }
                    console.log(total4);
                    $('#total').html(total4+'元');
                    
                }else{
                    alert('删除失败');
                }
            }) 
        }
        
     }
</script>
@endsection
