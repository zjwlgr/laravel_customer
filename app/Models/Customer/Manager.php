<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $table = 'manager';

    protected $primaryKey = 'id';

    protected $guarded = ['repassword'];

    public $timestamps = true;

    protected function getDateFormat()
    {
        return time();
    }

    protected function asDateTime($value)
    {
        return $value;
    }

    static function userGroup($uGid = null)
    {
        $uG = [
            1 => '超级管理员',
            2 => '普通管理员'
        ];
        if($uGid !== null)
        {
            return $uG[$uGid];
        }
        return $uG;
    }


}