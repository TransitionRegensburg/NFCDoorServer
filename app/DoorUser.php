<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoorUser extends Model
{
    public function grants()
    {
        return $this->hasMany('App\DoorUserGrant', 'door_user');
    }
}
