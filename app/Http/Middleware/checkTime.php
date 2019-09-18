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

        $dateTime = Carbon::now();

        $str_time = $dateTime->format('H:i:s');
        $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
        $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

            // 8am son 28800 segundos
            // 5pm son 61200 segundos

            // si la hora actual es mayor o igual a 28800 segundos permitir 
            // y menor o igual a 61200 segundos permitir // RANGO de 8AM a 5PM hora bogota.


        if($time_seconds >= 28800 && $time_seconds <= 91200){
            return $next($request);
        } else {
            return response()->json('Fuera de horario');
        } 
        

        
    }
}
