<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Tarea;
class Distribuidor extends Eloquent implements Authenticatable
{
    use AuthenticatableTrait;
    use Notifiable;

    protected $connection = 'mongodb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

         // Defino las variables que son creadas y editadas en el controlador Distribuidor


    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table =  'distribuidores';

    // Relacion uno a muchos (distribuidor tiene muchas tareas)


    public function tareas()
    {
        return $this->hasMany('App\Tarea');
    }

}
