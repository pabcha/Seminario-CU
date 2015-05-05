<?php 
	use Illuminate\Database\Capsule\Manager as Capsule;
	
	$whoops = new \Whoops\Run;
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();

	Kint::enabled(true);

	$capsule = new Capsule;
	$capsule->addConnection([
	    'driver'    => 'mysql',
	    'host'      => DB_HOST,
	    'database'  => DB_NAME,
	    'username'  => DB_USER,
	    'password'  => DB_PASS,
	    'charset'   => 'utf8',
	    'collation' => 'utf8_spanish_ci',
	    'prefix'    => '',
	]);

	$capsule->setAsGlobal();
	$capsule->bootEloquent();