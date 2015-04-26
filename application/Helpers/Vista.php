<?php 
namespace App\Helpers;

class Vista
{
	public static function loadCss($styles)
	{
		$tmp = "";

		if (isset($styles) && count($styles))
		{
			foreach ($styles as $href) 
			{
				$tmp .= sprintf("\t<link href='%s' rel='stylesheet'>\n", $href);
			}
		}

		return $tmp;
	}

	public static function loadJs($scripts)
	{
		$tmp = "";

		if (isset($scripts) && count($scripts))
		{
			foreach ($scripts as $src) 
			{
				$tmp .= sprintf("\t<script src='%s'></script>\n", $src);
			}
		}

		return $tmp;
	}

	public static function loadTitle($title)
	{
		return (isset($title)) ? $title : '';
	}
	
	public static function is_active($page, $compare)
	{
		if ( $page == $compare) {
			return 'class="active"';
		} else {
			return '';
		}
	}

	/*	Para el front	*/
	public static function buildDefaultImg($producto, $src)
	{
		$img = $producto->getDefaultImg();

		if ( $img )	{
			return sprintf("src='%sstorage/uploads/%s/%s' alt='%s'",BASE_URL, $src, $img->producto_img_nombre, $img->producto_img_alt);
		} else {
			return sprintf("src='%sstorage/uploads/no-image.jpg' alt='no-image'",BASE_URL);
		}
	}

	public static function is_first(&$i)
	{
		$clase = ( ($i-1) % 4 == 0 ) ? 'first' : '';
		$i++;
		return $clase;
	}

	public static function get_cantidad()
	{
		if (isset($_SESSION['carrito']['cantidad']))
		{
			if ( $_SESSION['carrito']['cantidad'] > 1 OR $_SESSION['carrito']['cantidad'] == 0)
			{
				return $_SESSION['carrito']['cantidad'] . ' productos';
			}
			else
			{
				return $_SESSION['carrito']['cantidad'] . ' producto';
			}
			
		}
		else
		{
			return '0';
		}
	}

	public static function get_total()
	{
		if (isset($_SESSION['carrito']['total']))
		{
			return $_SESSION['carrito']['total'];
		}
		else
		{
			return '$ 0,00';
		}
	}

	public static function hrefPaginator($id, $pag)
	{
		$orderby = '';

		if ( !empty($_GET['orderby']) )
		{
			$orderby = '&orderby='.$_GET['orderby'];
		}

		return BASE_URL.'index/categoria/'.$id.'?page='.$pag.$orderby;
	}

	public static function hrefPagSearch($pag)
	{
		$a = array();

		if (!empty($_GET['q'])) array_push($a, 'q='.$_GET['q']);
		if (isset($_GET['min'])) array_push($a, 'min='.$_GET['min']);
		if (isset($_GET['max'])) array_push($a, 'max='.$_GET['max']);
		if (isset($_GET['marca']) and $_GET['marca'] != 0) array_push($a, 'marca='.$_GET['marca']);
		array_push($a, 'page='.$pag);

		return BASE_URL.'search?'.implode('&', $a);;
	}

	public static function actionSearch()
	{
		$a = array();

		if (!empty($_GET['q'])) array_push($a, 'q='.$_GET['q']);
		if (isset($_GET['min'])) array_push($a, 'min='.$_GET['min']);
		if (isset($_GET['max'])) array_push($a, 'max='.$_GET['max']);
		if (isset($_GET['marca']) and $_GET['marca'] != 0) array_push($a, 'marca='.$_GET['marca']);

		return BASE_URL.'search?'.implode('&', $a);;
	}

	public static function is_selected($value, $get)
	{
		return ($value == $get) ? 'selected="selected"' : '';
	}

	public static function is_selectedGet($value, $key)
	{
		$get = '';

		if ( !empty($_GET[$key]) )
		{
			$get = $_GET[$key];
		}

		return ($value == $get) ? 'selected="selected"' : '';
	}

	public static function set_value($key)
	{
		$get = '';

		if ( isset($_GET[$key]) )
		{
			$get = $_GET[$key];
		}

		return $get;
	}

	public static function get_query($query)
	{
		$q = '';

		if ( isset($_GET[$query])) 
		{
			$q = $query.'='.$_GET[$query];
		}

		return $q;
	}

	public static function set_label($item)
	{
		$clase = '';

		switch ($item) {
			case 'Pedido':
				$clase = 'bg-light-gray';
				break;
			case 'Esperando pago':
				$clase = 'bg-yellow';
				break;
			case 'Pago aceptado':
				$clase = 'bg-light-blue';
				break;
			case 'Enviado':
				$clase = 'bg-black';
				break;
			case 'Recibido':
				$clase = 'bg-green';
				break;
			case 'Cancelado':
				$clase = 'bg-red';
				break;											
			default:
				# code...
				break;
		}

		return $clase;
	}

	public static function set_label_historia($accion)
	{
		$clase = '';

		if ( strtolower($accion) == 'nota' ) 
		{
			$clase = 'label-blue';
		} 
		else if ( strtolower($accion) == 'nuevo estado' ) 
		{
			$clase = 'label-green';
		} 
		else 
		{
			$clase = 'label-darkblue';
		}

		return $clase;
	}
}