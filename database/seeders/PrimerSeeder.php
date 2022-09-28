<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Status;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

//Saptie
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PrimerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $count=0;

        //Agrego Statuses
        $statuses = [
            [
                'name'=>'Habilitado',
                'comment'=>'Habilitado para utilizar',
                'enabled'=>1,
                'created_at'=>date('Y-m-d'),
            ],
            [
                'name'=>'Bajado',
                'comment'=>'Inhabilitado para utilizar',
                'enabled'=>0,
                'created_at'=>date('Y-m-d'),
            ],
        ];

        foreach($statuses as $status){

            $exist = Status::where('name',$status['name'])->first();

            if(empty($exist)){

                $sta = new Status();
                $sta->name = $status['name'];
                $sta->comment = $status['comment'];
                $sta->enabled = $status['enabled'];
                $sta->created_at = $status['created_at'];
                $sta->save();

                echo "Creando Estado: ".$status['name']." \n";
                $count++;
            }
        }

        //Agrego Categories
        $categories = [
            [
                'name'=>'Bebida',
                'comment'=>'Alcoholica',
                'enabled'=>1,
                'created_at'=>date('Y-m-d'),
            ],
            [
                'name'=>'Comida',
                'comment'=>'Minutas',
                'enabled'=>1,
                'created_at'=>date('Y-m-d'),
            ],
        ];

        foreach($categories as $categorie){

            $exist = Categorie::where('name',$categorie['name'])->first();

            if(empty($exist)){

                $cta = new Categorie();
                $cta->name = $categorie['name'];
                $cta->comment = $categorie['comment'];
                $cta->enabled = $categorie['enabled'];
                $cta->created_at = $categorie['created_at'];
                $cta->save();

                echo "Creando Categoria: ".$categorie['name']." \n";
                $count++;
            }
        }

        //Agrego todos los permisos
        $permisos = [
            //Tabla roles
            'ver-puestos',
            'crear-puestos',
            'editar-puestos',
            'borrar-puestos',
            //Tabla products
            'ver-productos',
            'crear-productos',
            'editar-productos',
            'borrar-productos',
            //Tabla users
            'ver-usuarios',
            'crear-usuarios',
            'editar-usuarios',
            'borrar-usuarios',
        ];

        foreach($permisos as $permiso){

            $exist = Permission::where('name',$permiso)->first();

            if(empty($exist)){
                echo "Creando Permisos ".$permiso." \n";
                Permission::create(['name' => $permiso]);
                $count++;
            }

        }

        //Creo Rol SuperAdministrador
        $exist = Role::where('name','SuperAdministrador')->first();

        if(empty($exist)){
            $role = new Role();
            $role->name = 'SuperAdministrador';
            $role->save();
            $role->syncPermissions( $permisos );
            echo "Creando Rol de SuperUsuario \n";
            $count++;
        }

        //Creo el superUsuario
        $exist = User::where('email','denischafer@gmail.com')->first();

        if(empty($exist)){
            $user = new User();
            $user->name='Denis Schafer';
            $user->email='denischafer@gmail.com';
            $user->password=Hash::make('$0deJulio');
            $user->db='gestionbar';
            $user->save();
            echo "Creando SuperUsuario \n";
            $count++;
        }

        //Obtengo el id del superUsuario
        $SuperAdmin = User::where('email','denischafer@gmail.com')->first();

        //Asigno el rol al SuperUsuario
        $user = User::find($SuperAdmin->id);
        DB::table('model_has_roles')->where('model_id', $SuperAdmin->id)->delete();
        $user->assignRole(['SuperAdministrador']);

        if($count == 1){
            echo "Finalizo el seeder con ".$count." modificacion realizada \n";
        } else {
            echo "Finalizo el seeder con ".$count." modificaciones realizadas \n";
        }

    }
}
