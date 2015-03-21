<?php

class errorController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	private function toError($str, $data = array())
	{
		$this->_view->renderizar('error/header');
		$this->_view->renderizar($str, $data);
	}

	public function index()	
	{
		$this->_view->titulo = 'SaltaShop / Error 404';
		$datos['mensaje'] = $this->_getError();
		$this->_view->setCss(array('front/estilos_error'));


		$this->toError('error/index', $datos);
	}

	public function access( $codigo = 0 )
	{
		$this->_view->titulo = 'Error';
		$datos['mensaje'] = $this->_getError( $codigo );

		$this->_view->setCss(array('front/estilos_error'));

		$this->toError('error/access', $datos);	
	}

	private function _getError( $codigo = false )
	{
		if( $codigo ) 
		{
			$codigo = $this->filtrarInt( $codigo );	
			if( is_int($codigo) ) 
				$codigo = $codigo;
		} 
		else 
		{
			$codigo = 'default';
		}
				
		$error['default'] = 'Lo sentimos, la pagina solicitada no se encuentra!';
		$error['5050'] = 'Usted no tiene autorizacion para acceder a este sitio.';
		$error['8080'] = 'Tiempo de sesion agotado.';

		if(array_key_exists( $codigo, $error )) 
		{
			return $error[$codigo];
		}
		else {
			return $error['default'];
		}
	}
}
?>