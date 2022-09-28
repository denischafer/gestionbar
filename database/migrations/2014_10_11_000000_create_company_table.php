<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Company;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $nameconn = Schema::getConnection()->getName();
        $dbdefault = 'gestionbar';
        if(($dbdefault == $nameconn) && !empty($dbdefault)) {

            if (!Schema::hasTable('companies')) {

                Schema::create('companies', function (Blueprint $table) {
                    $table->id();
                    $table->string('name');
                    $table->string('db')->unique();
                    $table->timestamps();
                });

            }

            //Agregar DB gestionbar
            $exist = Company::where('name','gestionbar')->first();

            if(empty($exist)){

                $company = new Company();
                $company->name='gestionbar';
                $company->db='gestionbar';
                $company->save();

                echo "Creando DB: gestionbar \n";
            }


        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
