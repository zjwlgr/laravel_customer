<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Index extends Model{

    static function testset(){
        return ['name' => 'zjwlgr','age' => 18];
    }

}