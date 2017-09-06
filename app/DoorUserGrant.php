<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoorUserGrant extends Model
{
    protected $fillable = ['door', 'door_user', 'grants'];
    public function door(){
      return $this->belongsTo('App\Door', 'door');
    }
    public function doorUser(){
      return $this->belongsTo('App\DoorUser', 'door_user');
    }
}
