<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $table = "manager";

    protected $fillable = ['door', 'user'];

    public function user(){
      return $this->belongsTo('App\User', 'user');
    }
}
