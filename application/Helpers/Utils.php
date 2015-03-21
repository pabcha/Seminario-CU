<?php 
namespace App\Helpers;

class Utils
{
	/**
	 * Convierte expresion monetaria en pesos
	 * devuelve 0,00 si no es una valor valido
	*/	
	public static function to_pesos($precio, $with_simbol = true)
	{
		$precio = static::truncate($precio, 2);
		$precio = number_format($precio, 2, ',', '.');
		
		if ($with_simbol)
		{
			return "$ ".$precio;			
		}
		else
		{
			return $precio;
		}
	}

	public function test()
	{
		
	}

	/**
	 * Trunca un valor decimal 
	 * devuelve 0 si no es una valor valido
	*/	
	public static function truncate($float, $decimals)
	{
		if ( ! is_float($float) ) 
		{
			$float = floatval($float);
		}		
		
		if ( $float != 0 )
		{
			$nro = strval($float);
			$index = stripos($nro, '.');
			
			if ($index != false) 
			{
				$length = $index + $decimals + 1;
				$nro = substr($nro, 0, $length);	
				return floatval($nro);
			}
			
		}

		return $float;		
	}

	/* 
	   retorna fecha y hora en formato ARG
	*/
	public static function dateHour2Locale($fecha)
	{
		$f = date_create($fecha);
		return date_format($f, 'd/m/Y H:i');
	}

	/* retorna fecha en formato ARG*/
	public static function date2Locale($fecha)
	{
		$f = date_create($fecha);
		return date_format($f, 'd/m/Y');	
	}

	public static function month2Spa($m)
	{
		$m = intval($m);
		$mes = '';

		switch ($m) {
			case 1:
				$mes = 'Enero';
				break;
			case 2:
				$mes = 'Febrero';
				break;
			case 3:
				$mes = 'Marzo';
				break;
			case 4:
				$mes = 'Abril';
				break;
			case 5:
				$mes = 'Mayo';
				break;
			case 6:
				$mes = 'Junio';
				break;
			case 7:
				$mes = 'Julio';
				break;
			case 8:
				$mes = 'Agosto';
				break;
			case 9:
				$mes = 'Septiempre';
				break;
			case 10:
				$mes = 'Octubre';
				break;
			case 11:
				$mes = 'Noviembre';
				break;
			case 12:
				$mes = 'Diciembre';
				break;
			default:
				$mes = "error";
				break;
		}

		return $mes;	
	}

	public static function to_codigo($num)
	{
		return sprintf('%04d', $num);
	}

	public static function slug($string, $slug = '-', $extra = null)
	{
	    return strtolower(trim(preg_replace('~[^0-9a-z' . preg_quote($extra, '~') . ']+~i', $slug, static::unaccent($string)), $slug));
	}

	public static function unaccent($string) // normalizes (romanization) accented chars
	{
	    if (strpos($string = htmlentities($string, ENT_QUOTES, 'UTF-8'), '&') !== false)
	    {
	        $string = html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|tilde|uml);~i', '$1', $string), ENT_QUOTES, 'UTF-8');
	    }

	    return $string;
	    //http://stackoverflow.com/questions/5851189/naming-convention-uploaded-files
	}
}