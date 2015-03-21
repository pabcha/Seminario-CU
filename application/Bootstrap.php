<?php
class Bootstrap
{
	public static function run(Request $peticion)
	{
		$metodo = $peticion->getMetodo();
		$args = $peticion->getArgs();

		//Armamos ruta del archivo controlador
		$controller = $peticion->getControlador() . 'Controller';
		$rutaControlador = ROOT . 'controllers' . DS . $controller . '.php';

		//si existe archivo controller
		//verifico que el metodo es valido
		if( is_readable($rutaControlador) )	{
			require_once $rutaControlador;
			$controller = new $controller;

			if( is_callable( array($controller, $metodo) ) ){
				$metodo = $peticion->getMetodo();
			}
			else{
				$metodo = 'index';
			}
			/*
			*verifico argumentos para luego llamar al controlador
			*en un arreglo se envia clase y metodo a invocar + los
			*parametros que deseamos pasar a esa clase
			*/
			if( isset( $args) ){
				call_user_func_array( array($controller, $metodo), $args );
			}
			else{
				call_user_func( array($controller, $metodo) );	
			}
		} else {
			//throw new Exception("No encontrado");
			header('Location: '.BASE_URL.'error');
		}
	}
	
}
?>
