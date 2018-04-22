<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    //大楼表设置
    protected $table='floor';
    protected $primaryKey='floor_id';

    //需要排除不存入数据库到字段
    protected $guarded=[];

    //自动维护时间戳
    public $timestamps=false;
}
