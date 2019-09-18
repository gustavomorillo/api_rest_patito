<?php

use Illuminate\Database\Seeder;

class DistribuidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Creo 2 distribuidores en la base de datos por facilidad asigno pw: 123456

        for( $i = 0; $i<2; $i++ ) {

            $newPassword = '123456';
            $hashPassword = Hash::make($newPassword);
            $api_token = str_random(60);

        DB::table('distribuidores')->insert([

            'email' => 'Usuario' . $i . '@gmail.com',
            'password' => $hashPassword,
            'api_token' => $api_token,
            
        ]);
            //Creo 1 distribuidor en la base de datos por facilidad asigno pw: 123456
            // El distribuidor le asigno un api_token de 123456
        }
        DB::table('distribuidores')->insert([

            'email' => '123456' . '@gmail.com',
            'password' => Hash::make('123456'),

             // El distribuidor le asigno un api_token de 123456
            'api_token' => '123456',
            
        ]);
    }
}
