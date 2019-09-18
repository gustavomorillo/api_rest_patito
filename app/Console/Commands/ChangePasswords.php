<?php

namespace App\Console\Commands;


use Auth;
use App\Distribuidor;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


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

       // Se Desarrolla un comando de laravel 
     

        // Listo todos los distribuidores para ejecutar el comando que enviara la nueva contraseña a los distribuidor

         $distribuidores = Distribuidor::all();

         // Realizo un loop foreach para obtener informacion de cada distribuidor

         foreach ($distribuidores as $distribuidor){

            $BuscarDistribuidor = Distribuidor::find($distribuidor['id']);

             // cambie aleatoriamente las contraseñas de cada distribuidor

            $newPassword = str_random(8);
            $data = ['password' => $newPassword];
            $hashPassword = Hash::make($newPassword);
            $BuscarDistribuidor->password = $hashPassword;
            $BuscarDistribuidor->save();

              // En el envío de los correos electrónicos se debe usar una cola 
              // y le envié a cada uno un correo con la nueva contraseña // 
            Mail::to($BuscarDistribuidor['email'])->send(new SendEmail($data));
            $this->info("Changed password " . $BuscarDistribuidor['email']);
        }
        
    }
    
}
