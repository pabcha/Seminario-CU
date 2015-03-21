<?php
class Request
{
	private $_controlador;
	private $_metodo;
	private $_argumentos;

	public function __construct()
	{
		if( isset($_GET['url']) ){
			//Vamos a obtener controlador metodo y parametros
			//de la url
			$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
			$url = explode( '/', $url );
			$url = array_filter($url);

			$this->_controlador = strtolower(array_shift($url));
			$this->_metodo = strtolower(array_shift($url));
			$this->_argumentos = $url;//las url restantes son paramentros
		}

		

		if( !$this->_controlador ){
			//sino se pasa un controlador
			//asignamos controlador por defecto
			$this->_controlador = DEFAULT_CONTROLLER;
		}

		if( !$this->_metodo ){
			$this->_metodo = 'index';
		}

		if( !isset($this->_argumentos) ){
			//si no existen colocamos array sin datos
			$this->_argumentos = array();
		}
	}

	public function getControlador(){ return $this->_controlador; }
	public function getMetodo(){ return $this->_metodo; }
	public function getArgs(){ return $this->_argumentos; }

}
?>
