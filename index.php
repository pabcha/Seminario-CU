<?php
require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'application' . DS);

try{
	require_once APP_PATH . 'Config.php';
	require_once APP_PATH . 'Request.php';
	require_once APP_PATH . 'Bootstrap.php';
	require_once APP_PATH . 'Controller.php';
	require_once APP_PATH . 'Model.php';
	require_once APP_PATH . 'View.php';
	require_once APP_PATH . 'DataBase.php';
	require_once APP_PATH . 'Session.php';

	$whoops = new \Whoops\Run;
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();

	Kint::enabled(true);

	$capsule = new Capsule;
	$capsule->addConnection([
	    'driver'    => 'mysql',
	    'host'      => 'localhost',
	    'database'  => 'saltashop2',
	    'username'  => 'root',
	    'password'  => '4236154',
	    'charset'   => 'utf8',
	    'collation' => 'utf8_spanish_ci',
	    'prefix'    => '',
	]);

	$capsule->setAsGlobal();
	$capsule->bootEloquent();

	Session::init();
	Bootstrap::run(new Request);
}
catch(Exception $e){
	echo $e->getMessage();
}

?>