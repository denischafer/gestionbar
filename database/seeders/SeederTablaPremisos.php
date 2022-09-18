<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//Saptie
use Spatie\Permission\Models\Permission;

class SeederTablaPremisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //Tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',
            //Tabla products
            'ver-product',
            'crear-product',
            'editar-product',
            'borrar-product',
        ];

        foreach($permisos as $premiso){
            Permission::create(['name' => $premiso]);
        }

    }
}
