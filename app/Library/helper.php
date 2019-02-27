<?php
//做支付
function pay(){
	echo '这是支付功能';
}

//发送短信校验码(调用短信接口)
function sendphone($p){
	//echo 'sendphone';
	//初始化必填
	//填写在开发者控制台首页上的Account Sid
	$options['accountsid']='b70ea9ba6c9bcef4e612f0219d88e902';
	//填写在开发者控制台首页上的Auth Token
	$options['token']='4adbb781143f7fabc344b8fdc0cd73c5';

	//初始化 $options必填
	$ucpass = new Ucpaas($options);

	$appid = "2d2451f503f442a8800682b4bc4d0063";	//应用的ID，可在开发者控制台内的短信产品下查看
	//短信模板id
	$templateid = "399377";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
	//发送的短信校验码
	$param = rand(1,10000); //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
	//接收短信校验码的手机号
	$mobile = $p;
	$uid = "";

	//70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。

	echo $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);
}
	//支付宝支付接口
	function pays($ordercode,$name,$fee,$des){
		//echo '支付接口';
		/*************************注意*****************
		 
		 *如果您在接口集成过程中遇到问题，可以按照下面的途径来解决
		 *1、开发文档中心（https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.KvddfJ&treeId=62&articleId=103740&docType=1）
		 *2、商户帮助中心（https://cshall.alipay.com/enterprise/help_detail.htm?help_id=473888）
		 *3、支持中心（https://support.open.alipay.com/alipay/support/index.htm）

		 *如果想使用扩展功能,请按文档要求,自行添加到parameter数组即可。
		 **********************************************
		 */

		require_once("alipay.config.php");
		require_once("lib/alipay_submit.class.php");

		/**************************请求参数**************************/
	
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $ordercode;

        //订单名称，必填
        $subject = $name;

        //付款金额，必填
        $total_fee = $fee;

        //商品描述，可空
        $body = $des;





		/************************************************************/

		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service"       => $alipay_config['service'],
				"partner"       => $alipay_config['partner'],
				"seller_id"  => $alipay_config['seller_id'],
				"payment_type"	=> $alipay_config['payment_type'],
				"notify_url"	=> $alipay_config['notify_url'],
				"return_url"	=> $alipay_config['return_url'],
				
				"anti_phishing_key"=>$alipay_config['anti_phishing_key'],
				"exter_invoke_ip"=>$alipay_config['exter_invoke_ip'],
				"out_trade_no"	=> $out_trade_no,
				"subject"	=> $subject,
				"total_fee"	=> $total_fee,
				"body"	=> $body,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
				//其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.kiX33I&treeId=62&articleId=103740&docType=1
		        //如"参数名"=>"参数值"
				
		);

		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		echo $html_text;
	}

	//获取购物车
    function getCart()
    {
        //根据用户
        $data = DB::table('cart_list')
        ->join('goods','cart_list.goods_id','=','goods.goods_id')
        ->join('picture','goods.goods_id','=','picture.goods_id')
        ->select('cart_list.*','goods.goods_name','goods.price','picture.url')
        ->where('cart_list.user_id','=',session('id')) //此处填写用户ID 测试数据
        ->groupBy('picture.goods_id')
        ->limit(5)
        ->get();
        //dd($data);
        return $data;
    }
?>