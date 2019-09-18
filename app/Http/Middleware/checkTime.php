<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
class checkTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        // Desarrollo de un middleware que valida que las peticiones al API REST solo se hagan entre las 8 am y las 5 pm.

        $dateTime = Carbon::now();

        // Convierto la hora a segundos (desde la medianoche)

        $str_time = $dateTime->format('H:i:s');
        $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
        $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

            // 8am son 28800 segundos (desde la medianoche hasta las 8am)
            // 5pm son 61200 segundos (desde la medianoche hasta las 5pm)

            // si la hora actual es mayor o igual a 28800 segundos permitir 
            // y menor o igual a 61200 segundos permitir // RANGO de 8AM a 5PM hora bogota.


        if($time_seconds >= 28800 && $time_seconds <= 61200){
            return $next($request);
        } else {
            return response()->json('Fuera de horario');
        } 
        

        
    }
}
