<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    //与数据库关联的数据表
    protected $table = 'details';
    //设置主键
    protected $primaryKey="id";
    //该模型是否被自动维护时间戳
    public $timestamps = false;

    //可以被批量赋值的属性
    protected $fillable = ['orders_id','goods_id','num','price','color','type'];
}
