<?php
/**
 * Created by PhpStorm.
 * User: 伟进
 * Date: 2018/3/17
 * Time: 19:43
 */

namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    protected $table = 'permit';
    protected $primaryKey='per_id';
    public $timestamps = false;
    protected $fillable = ['room_id', 'user_id', 'status','b_d_time','e_d_time','b_hm_time','e_hm_time'];

    public function user(){
        return $this->belongsTo('App\Http\Model\ac_user', 'user_id');
    }
    public function room(){

        return $this->belongsTo('App\Http\Model\Room', 'room_id');
    }
}