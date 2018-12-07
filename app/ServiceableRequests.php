<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceableRequests extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'destination_address', 'pick_up_address', 'estimated_length'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
