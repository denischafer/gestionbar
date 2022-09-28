<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class migrateall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migracion a todas las bases de datos especificadas en la tabla companies.';

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
        $this->info( '- Iniciando migrate:all' );

        /* Esto no va mas, parche de adan viejo
        $this->info( '- Editando headers' );
        //Quito los problemas de los headers
        $dirHeaders = dirname( __FILE__ ) . "/../../../bootstrap/app.php";
        $contents = file_get_contents($dirHeaders);
        $contents = str_replace("header('Access-Control-Allow-Origin: *');", '', $contents);
        $contents = str_replace("header('Access-Control-Allow-Methods: *');", '', $contents);
        $contents = str_replace("header('Access-Control-Allow-Headers: *');", '', $contents);
        file_put_contents($dirHeaders, $contents);
        /*/

        $this->info( '- Limpiando cache de configuracion' );
        Artisan::call('config:clear');
        sleep(1);
        Artisan::call('config:cache');

        //Primero me conecto a la base de datos default para obtener el array incial..//////////////////////////////////////////////////////////////
        $servername = env('DB_HOST', 'localhost');
        $username = env('DB_USERNAME', 'root');
        $database = env('DB_DATABASE', 'gestionbar');
        $password = env('DB_PASSWORD', '20dejulio');
        $port = env('DB_PORT', '3306');


        $this->info( '- Obteniendo companies' );
        $companies =  DB::table('companies')
        ->select('*')
        ->get();

        $connections=[];
        foreach($companies as $row) {
            $connections[$row->name] = [
                'driver' => 'mysql',
                'host' => env('DB_HOST', 'localhost'),
                'port' => env('DB_PORT', '3306'),
                'database' => $row->db,
                'username' => 'root',
                'password' => '20dejulio',
                'unix_socket' => '',
                'charset' => 'utf8',
                'collation' =>'utf8_unicode_ci',
                'prefix' => '',
                'strict' => false,
                'engine' => null,
            ];
        }


        $databases = [
            'default' => env('DB_CONNECTION', env('DB_CONNECTION', 'homestead')),
            'migrations' => 'migrations',
            'redis' => [
                'client' => env('REDIS_CLIENT', 'predis'),
                'options' => [
                    'cluster' => env('REDIS_CLUSTER', 'redis'),
                    'prefix' => env('REDIS_PREFIX'),
                ],
                'default' => [
                    'url' => env('REDIS_URL'),
                    'host' => env('REDIS_HOST', '127.0.0.1'),
                    'password' => env('REDIS_PASSWORD', null),
                    'port' => env('REDIS_PORT', '6379'),
                    'database' => env('REDIS_DB', '0'),
                ],
                'cache' => [
                    'url' => env('REDIS_URL'),
                    'host' => env('REDIS_HOST', '127.0.0.1'),
                    'password' => env('REDIS_PASSWORD', null),
                    'port' => env('REDIS_PORT', '6379'),
                    'database' => env('REDIS_CACHE_DB', '1'),
                ],
            ],
        ];


        $databases['connections'] = $connections;
        //Solo lo hago cuando haya mas de una empresa
        $this->info('- Tengo companies. Cantidad: ' . count( $companies ));
        if ( count( $companies ) > 0 ) {
            $text = "<?php return " .var_export($databases, true).";";
            $myfile = fopen(dirname( __FILE__ ) . "/../../../config/database.php", "w") or die("Unable to open file!");
            $this->info('- Exportando archivo database.php');
            fwrite($myfile, $text);
            fclose($myfile);
            $this->info('- Archivo database.php generado correctamente!');

            $this->info('- Limpiando nuevamente cache de configuracion');
            Artisan::call('config:clear');
            sleep(1);
            Artisan::call('config:cache');

            $this->info('- Obteniendo companies');
            //$companies = Company::all();

            foreach ($companies as $company){
                $this->info("- Ejecutando migracion para $company->name ");
                try {

                    $this->info("- Creando database $company->name ");
                    $result = DB::statement('CREATE SCHEMA `'. $company->name .'` DEFAULT CHARACTER SET utf8;');
                    $this->info("- Database $company->name creada correctamente");

                } catch(\Illuminate\Database\QueryException $ex){
                    $this->info("- Database $company->name ya existe");
                }

                $this->info("- Migrando $company->name");
                Artisan::call('migrate', array('--database' => $company->name));
                session(['db_customer' => $company->name]);

                $this->info("- Corriendo db:seed para $company->name");
                Artisan::call('db:seed');

            }
        }


        $this->error('- OK OK OK OK');

        return true;
    }
}
