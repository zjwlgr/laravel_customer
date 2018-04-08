<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class Infomation extends Model
{
    protected $table = 'infometion';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public $timestamps = true;

    protected function getDateFormat()
    {
        return time();
    }

    protected function asDateTime($value)
    {
        return $value;
    }

}