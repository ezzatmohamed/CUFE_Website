<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    public function projects(){
        return $this->hasMany('App\project');
    }
}
