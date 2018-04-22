<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Super extends Model
{
    //超级管理员表设置
    protected $table='super';
    protected $primaryKey='super_id';

    //需要排除不存入数据库到字段
    protected $guarded=[];

    //自动维护时间戳
    public $timestamps=false;
}
