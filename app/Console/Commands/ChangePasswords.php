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
       
            $data = array(
                'password' => 6543210
            );

            Mail::to('gustavomorillo@gmail.com')->queue(new SendEmail($data));
        
            $this->info("Changed password");
        
    }
}
