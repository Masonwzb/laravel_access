<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ac_user extends Model
{
    protected $table ='user';

    public $timestamps = false;
    protected $primaryKey = 'user_id';

    protected $fillable = ['user_id', 'card_no', 'user_name','user_no','tel','sex','register_time','permission','password','profession'];

    protected function getDateFormat()
    {
        return time();
    }

    protected function asDateTime($value)
    {
        return $value;
    }

}

