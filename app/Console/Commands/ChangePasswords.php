<?php

namespace App\Console\Commands;


use Auth;
use App\Distribuidor;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ChangePasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change-paswords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cambia aleatoriamente las contraseñas de cada distribuidor ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       
        $str_time = "23:12:95";


            $dt = Carbon::now();
            // $str_time = $dt->format('H:i:s');
            

            // 8am son 28800 segundos
            // 5pm son 61200 segundos

            // si la hora actual es mayor o igual a 28800 segundos permitir 
            // y menor o igual a 61200 segundos permitir // RANGO de 8AM a 5PM hora bogota.


            $str_time = $dt->format('H:i:s');
    
            $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
            sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
            $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
            
            $this->info($time_seconds);    
            
        
    }
}
