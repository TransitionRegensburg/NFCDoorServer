<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Door extends Model
{
    protected $fillable = ['name', 'description', 'geolocation'];

    public function manager(){
      return $this->hasMany('App\Manager', 'door');
    }
    public function grants(){
      return $this->hasMany('App\DoorUserGrant', 'door');
    }
}
