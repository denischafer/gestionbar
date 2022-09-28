<?php return array (
  'default' => 'gestionbar',
  'migrations' => 'migrations',
  'redis' => 
  array (
    'client' => 'predis',
    'options' => 
    array (
      'cluster' => 'redis',
      'prefix' => NULL,
    ),
    'default' => 
    array (
      'url' => NULL,
      'host' => '127.0.0.1',
      'password' => NULL,
      'port' => '6379',
      'database' => '0',
    ),
    'cache' => 
    array (
      'url' => NULL,
      'host' => '127.0.0.1',
      'password' => NULL,
      'port' => '6379',
      'database' => '1',
    ),
  ),
  'connections' => 
  array (
    'gestionbar' => 
    array (
      'driver' => 'mysql',
      'host' => '127.0.0.1',
      'port' => '3306',
      'database' => 'gestionbar',
      'username' => 'root',
      'password' => '20dejulio',
      'unix_socket' => '',
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => '',
      'strict' => false,
      'engine' => NULL,
    ),
    1 => 
    array (
      'driver' => 'mysql',
      'host' => '127.0.0.1',
      'port' => '3306',
      'database' => '1',
      'username' => 'root',
      'password' => '20dejulio',
      'unix_socket' => '',
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => '',
      'strict' => false,
      'engine' => NULL,
    ),
  ),
);