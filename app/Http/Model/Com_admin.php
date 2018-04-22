<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Com_admin extends Model
{
    //com_admin表设置
    protected $table='admin';
    protected $primaryKey='admin_id';

    //需要排除不存入数据库到字段
    protected $guarded=[];

    //自动维护时间戳
    public $timestamps=false;
}
