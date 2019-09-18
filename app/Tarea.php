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

    // Defino las variables que son creadas y editadas en el controlador Tarea 
    

    protected $fillable = [
        'nombre', 'direccion', 'latitud', 'longitud','mercancia','estado', 'distribuidor_id'
    ];

    

    // relacion "pertenece a: "

    // Una tarea pertenece a un distribuidor

    public function distribuidor()
        {
            return $this->belongsTo('App\Distribuidor');
        }


}
