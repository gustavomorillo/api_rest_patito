<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Auth;
use App\Distribuidor;
use Illuminate\Support\Facades\Hash;

class ChangePasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change-paswords:change';

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
        $distribuidores = Distribuidor::all();

        foreach ($distribuidores as $distribuidor){

            $distribuidor = Distribuidor::find($distribuidor['id']);
            $newPassword = 654321;
            $distribuidor->password = Hash::make($newPassword);
            $distribuidor->save();
            $this->info("Changed password " . $distribuidor['email']);
        }
        
       
    }
}
