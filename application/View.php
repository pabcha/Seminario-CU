<?php
class View
{
	private $_controlador;
	private $_scripts;
	private $_styles;

	public function __construct(Request $peticion)
	{
		$this->_controlador = $peticion->getControlador();
		$this->_scripts 	= array();
		$this->_styles 		= array();	
	}

	public function renderizar($vistaNombre, $data = array())
	{
		$scripts = count($this->_scripts) ? $this->_scripts : [];
		$styles = count($this->_styles) ? $this->_styles : [];

		$roots = array(
			'css' => BASE_URL . 'public/css/',
			'img' => BASE_URL . 'public/img/',
			'js' => BASE_URL . 'public/js/'
		);

		extract($data);//variables para view

		$rutaView = ROOT . 'views' . DS . $vistaNombre . '.php';
		//die($rutaView);

		if( is_readable( $rutaView ) ){
			include_once $rutaView;			
		} else {
			throw new Exception("Error de vista");			
		}
	}

	public function setJs(array $js)
	{
		if ( is_array($js) && count($js) ) 
		{
			foreach ($js as $src) 
			{
				$this->_scripts[] = BASE_URL.'public/js/'.$src.'.js';
			}
		} 
		else 
		{
			throw new Exception("Error de js");
		}
	}

	public function setCss(array $css)
	{
		if ( is_array($css) && count($css) ) 
		{
			foreach ($css as $href) 
			{
				$this->_styles[] = BASE_URL.'public/css/'.$href.'.css';
			}
		} else {
			throw new Exception("Error de css");
		}
	}




	public function get_cantidad()
	{
		if (isset($_SESSION['carrito']['cantidad']))
		{
			return $_SESSION['carrito']['cantidad'];
		}
		else
		{
			return '0';
		}
	}

	public function get_total()
	{
		if (isset($_SESSION['carrito']['total']))
		{
			return $_SESSION['carrito']['total'];
		}
		else
		{
			return '$0,00';
		}
	}
	
}
?>
