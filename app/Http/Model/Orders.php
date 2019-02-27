<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //与数据库关联的数据表
    protected $table = 'orders';
    //设置主键
    protected $primaryKey="order_id";

    //该模型是否被自动维护时间戳
    public $timestamps = false;

    //可以被批量赋值的属性
    protected $fillable = ['order_id','coupon_id','user_id','num','money','status','oname','phone','address','pay_at'];


    public function info(){
    	return $this->hasMany('App\Model\Details','orders_id');
    }
}
