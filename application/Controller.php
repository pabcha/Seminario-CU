<?php

abstract class Controller
{
	protected $_view;

	public function __construct()
	{
		$this->_view = new View( new Request );
	}

	abstract public function index();

	//Importar Modelos
	//Y ademas proporciona una instancia del modelo
	protected function loadModel( $modelo )
	{
		$modelo = $modelo . 'Model';
		$rutaModelo = ROOT . 'models' . DS . $modelo . '.php';

		if( is_readable($rutaModelo) ){
			require_once $rutaModelo;
			$modelo = new $modelo;
			return $modelo;
		} else {
			throw new Exception("Error de Modelo");
		}
	}
	//Importa una libreria. No crea una instancia
	protected function getLibrary( $libreria )
	{
		$rutaLibreria = ROOT . 'libs' . DS . $libreria . '.php';

		if(is_readable( $rutaLibreria ))
		{
			require_once $rutaLibreria;
		}
		else
		{
			throw new Exception("Error de libreria");
		}
	}

	protected function getInt($clave)
	{
		if( isset($_POST[$clave]) && !empty($_POST[$clave])) {
			$_POST[$clave] = filter_input(INPUT_POST, $clave, FILTER_VALIDATE_INT);
			return $_POST[$clave];
		}
		return 0;
	}
//validar que en entero un numero pasado por $_GET
	protected function filtrarInt( $int )
	{
		$int = (int) $int;

		if( is_int($int) ) {
			return $int;
		} else {
			return 0;
		}		
	}

	/*
	*Devolver el post sin filtrar
	*al usar prepare de PDO
	*se limpian los parametros de inyeccion y xss
	*
	*/
	public function getFilesParam( $clave,$atributo )
	{
		if (isset( $_FILES[$clave][$atributo]) ) {
			return $_FILES[$clave][$atributo];
		}
	}

	protected function getPostParam($clave)
	{
		if (isset($_POST[$clave]) ) {
			return $_POST[$clave];
		}
	}

	protected function redireccionar($ruta=false)
	{
		if($ruta) {
			header('location:'. BASE_URL . $ruta);
			exit;
		}
		else{
			header('location:'. BASE_URL);	
			exit;
		}
	}
    
    protected function getAlphaNum($clave)//solo acepta caracteres de
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$clave]);
            return trim($_POST[$clave]);
        }
    }
}

?>
