<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //节点表设置
    protected $table='room';
    protected $primaryKey='room_id';

    //需要排除不存入数据库到字段
    protected $guarded=[];

    //自动维护时间戳
    public $timestamps=false;

    //节点状态设置
//    const
}
