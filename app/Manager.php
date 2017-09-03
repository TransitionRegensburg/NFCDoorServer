<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $table = "manager";

    public function user(){
      return $this->belongsTo('App\User', 'user');
    }
}
