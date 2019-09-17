<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;

class Tarea extends Eloquent implements Authenticatable
{
    use AuthenticatableTrait;
    use Notifiable;

    protected $connection = 'mongodb';

    protected $fillable = [
        'nombre', 'direccion', 'latitud', 'longitud','mercancia','estado', 'user_id'
    ];

}
