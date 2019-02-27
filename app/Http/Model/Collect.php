<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    //关联数据表
    protected $table = 'collection';
    //设置主键
    public $primaryKey = 'coll_id';
    //是否自动维护时间戳
    public $timestamps = false;
    //可以被批量赋值的字段
    protected $fillable = ['user_id','goods_id'];
}
