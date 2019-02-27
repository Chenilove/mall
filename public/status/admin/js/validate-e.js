/////////////////////////////////////////////////////////////////////////////////
//表单验证函数集 //
/////////////////////////////////////////////////////////////////////////////////
//公用的验证表单为空或者非法字符函数 return 1 --字段为空 2 --非法字符 3 --ok
function validate(token)
{
    //判断字段是否为空
    if (token == '' || token == null || token == undefined || token == false) 
    {
        return 1;
    }
    //创建js正则对象
    var pattern = new RegExp("[~'!@#$%^&*()-+_=:></`]");
    //判断字符是否为非法字符
    if (pattern.test(token)) {
        return 2;
    }else{
        return 3;
    }
}


//验证商品名字
function validateName()
{
    //获取表单内容
    var token = $('#goods_name').val();
    // 获取父级元素
    var dad = $('#goods_name').parent();
    // 获取块状帮助元素
    var help = $('#goods_name').next();
    //调用验证函数
    var num = validate(token);
    //判断报错
    if (num == 1) {
        $(dad).removeClass('has-success');//移除原始样式
        $(dad).addClass('has-error');//添加报错样式
        $(help).html('商品名字不能为空');//报错信息
        return false;
    }else if(num == 2){
        $(dad).removeClass('has-success');//移除原始样式
        $(dad).addClass('has-error');//添加报错样式
        $(help).html('非法字符!');//报错信息
        return false;
    }else if(num == 3){
        $(dad).removeClass('has-error');//移除原始样式
        $(dad).addClass('has-success');//添加样式
        $(help).html('名字可用!');//报错信息
        return true;
    }
}
//ajax搜索品牌
function queryBrand(obj)
{
    var name = $(obj).next().val();
    $.get('/admin/goods-query-brand',{'brand_name':name},function(data){
        $('#query_brand').html(data)
    });
}   
//验证商品金额不能为负数
function validatePrica()
{
    //获取表单内容
    var token = $('#pricea').val();
    // 获取父级元素
    var dad = $('#pricea').parent();
    // 获取块状帮助元素
    var help = $('#price-helpa');
    //判断报错
    if (token < 0) {
        $(dad).removeClass('has-success');//移除原始样式
        $(dad).addClass('has-error');//添加报错样式
        $(help).html('金额不能为负数');//报错信息
        return false;
    }else{
        $(dad).removeClass('has-error');//移除原始样式
        $(dad).addClass('has-success');//添加报错样式
        $(help).html('金额合法');//报错信息
        return true;
    }
}
//验证商品金额不能为负数
function validatePriceb()
{
    //获取表单内容
    var token = $('#priceb').val();
    // 获取父级元素
    var dad = $('#priceb').parent();
    // 获取块状帮助元素
    var help = $('#price-helpb');
    //判断报错
    if (token < 0) {
        $(dad).removeClass('has-success');//移除原始样式
        $(dad).addClass('has-error');//添加报错样式
        $(help).html('小数点后两位不合法');//报错信息
        return false;
    }else{
        $(dad).removeClass('has-error');//移除原始样式
        $(dad).addClass('has-success');//添加报错样式
        $(help).html('金额合法');//报错信息
        return true;
    }
}
//验证商品产地
function validateCountry()
{
    //获取表单内容
    var token = $('#country').val();
    // 获取父级元素
    var dad = $('#country').parent();
    // 获取块状帮助元素
    var help = $('#country').next();
    //调用验证函数
    var num = validate(token);
    //判断报错
    if (num == 1) {
        $(dad).removeClass('has-success');//移除原始样式
        $(dad).addClass('has-error');//添加报错样式
        $(help).html('不能为空');//报错信息
        return false;
    }else if(num == 2){
        $(dad).removeClass('has-success');//移除原始样式
        $(dad).addClass('has-error');//添加报错样式
        $(help).html('非法字符!');//报错信息
        return false;
    }else if(num == 3){
        $(dad).removeClass('has-error');//移除原始样式
        $(dad).addClass('has-success');//添加样式
        $(help).html('名字可用!');//报错信息
        return true;
    }
}

//验证图片
function validateImg()
{   
    //获取表单对象
    var file = document.getElementById('goods_img');
    //获取帮助对象
    var help = $(file).next();
    //显示上传总数
    $(help).html('请上传4张图片,已选择'+file.files.length+'张图片');
    //判断图片是否是4张
    if (file.files.length == 4 || file.files.length == 0) {
        return true;
    }else{
        alert('请上传4张图片');
        $(help).html('已选择'+file.files.length+'张图片,请不要上传4张以上');
        return false;
    }
}

//提交触发所有验证
function validateCommit()
{
    //商品名字
    if (!validateName()) {
        return false;
    }
    //验证商品金额不能为负数
    if (!validatePrica()) {
        return false;
    }
    //验证商品金额不能为负数
    if (!validatePriceb()) {
        return false;
    }
    //验证产品产地
    if (!validateCountry()) {
        return false;
    }
    //验证商品图片
    if (!validateImg()) {
        return false;
    }   

    return true;
}
