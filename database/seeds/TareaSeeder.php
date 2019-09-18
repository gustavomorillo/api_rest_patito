<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for( $i = 0; $i<3; $i++ ) {
            $time = new Carbon();
                DB::table('tareas')->insert([

                    'fecha' => $time,
                    'nombre' => 'Usuario' . $i,
                    'direccion' => 'Direccion' . $i,
                    'latitud' => '60',
                    'longitud' => '30',
                    'mercancia' => '100',
                    'estado' => 'aprobado',
                ]);
         }
        
                
    }
}
