<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2018/3/20
 * Time: 20:14
 */
namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class ac_record extends Model
{
    protected $table = 'record';
    protected $primaryKey='record_id';
    public $timestamps = false;

    protected function getDateFormat()
    {
        return time();
    }

    protected function asDateTime($value)
    {
        return $value;
    }

    public function ac_user(){
        return $this->belongsTo('App\Http\Model\ac_user', 'user_id');
    }
    public function ac_room(){

        return $this->belongsTo('App\Http\Model\Room', 'room_id');
    }

}