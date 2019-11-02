<?php

namespace Models;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;

// TODO: Move config.ini

class Database {
    function __construct() {
        $config = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/web/assets/php/config.ini');
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => $config['db_host'],
            'database' => $config["db_name"],
            'username' => $config["db_user"],
            'password' => $config["db_password"],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $capsule->setEventDispatcher(new Dispatcher(new Container));
        $capsule->setAsGlobal();
        // Setup the Eloquent ORM…
        $capsule->bootEloquent();
    }
}
