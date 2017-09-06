<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoorUser extends Model
{
    protected $fillable = ['chip_uuid', 'name', 'phone', 'email', 'note' ];

    public function grants()
    {
        return $this->hasMany('App\DoorUserGrant', 'door_user');
    }
}
