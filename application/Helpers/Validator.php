<?php 
namespace App\Helpers;
/**
 * Validador de Formularios Class
 *
 * @subpackage	Libraries
 * @category	Validation
 * @author		Farfan Chavez Pablo
 * @link		https://github.com/pablo1416
 */

class Validator
{
	protected $_campo_datos 			= array();
	protected $_cantidad_errores 		= array();
	protected $_error_array 			= array();
	protected $_additional_errors		= array();
	protected $_prefix_error 			= "<li>";
	protected $_suffix_error 			= "</li>";
	protected $_prefix_content_error 	= "<ul>";
	protected $_suffix_content_error 	= "</ul>";
	protected $_msj_errors = array(
		'requerido' => 'El %s es requerido',
		"numeric" => "%s debe ser un número.",
		'integer' => 'El %s no es valido.',
		"is_natural" => "%s debe ser un numero natural.",
		"is_natural_no_zero" => "%s debe ser un numero natural distinto de 0.",
		"decimal"=> "%s debe ser decimal.",
		"alpha"=> "%s debe contener caracteres alfabeticos.",
		"alpha_numeric"=> "%s debe contener caracteres alfanumericos.",
		"alpha_dash"=> "%s contiene caracteres no validos.",
		"min_length"=> "El %s debe contener al menos %s caracteres.",
		"max_length"=> "El %s no debe contener mas de %s caracteres.",
		"exact_length"=> "El %s debe contener exactamente %s caracteres.",
		'valid_email' => 'El %s debe contener una dirección de correo valida',

		"matches"=> "Los %ss deben coincidir.",
		"valid_phone_number"=> "%s no es un numero de telefono valido.",
		"valid_url"=> "%s no es una URL valida.",
		"greater_than" => "%s debe ser mayor a %s",
		"less_than" => "%s debe ser menor a %s",
	);

	/**
	 * Set Reglas
	 *
	 * Esta funcion toma un array de nombre de campo y reglas de validacion,
	 * verifica los datos,y los almacena en $_campo_datos
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @return	void
	 */	
	public function set_reglas($campo, $label = '', $reglas = '')
	{
		//No POST? no iniciamos reglas
		if (empty($_POST))
		{
			return $this;
		}

		if(is_array($campo))
		{
			foreach ($campo as $elemento) 
			{
				//si no puso key:campo o reglas lo ignoramos
				if ( !isset($elemento['campo']) OR !isset($elemento['reglas']) ) 
				{
					continue;
				}
				//label es opcional, si no esta iniciado usamos nombre de campo
				$label = ( !isset($elemento['label']) ) ? $elemento['campo'] : $elemento['label'];

				$this->set_reglas($elemento['campo'], $label, $elemento['reglas']);
			}
			//para que no continue
			return $this;
		}

		// No campo? nada que hacer...
		if ( ! is_string($campo) OR  ! is_string($reglas) OR $campo == '')
		{
			return $this;
		}

		//label = campo si no se especifico
		$label = (empty($label)) ? $campo : $label;

		//Si no puso reglas no registramos
		if ( empty($reglas) )
		{
			return $this;
		}

		$this->_campo_datos[$campo] = array(
			'campo' => $campo,
			'label' => $label,
			'reglas' => $reglas,
			'error' => '',
			'postdata' => NULL
		);

		return $this;
	}

	/**
	 * Ejecuta el validador
	 *
	 * Se encarga de hacer todo el trabajo
	 *
	 * @access	public
	 * @return	bool
	 */	
	public function validar()
	{
		//si no hay post, no hacemos nada
		if (count($_POST) == 0)
		{
			return FALSE;
		}
		//Si no seteo reglas, no hacemos nada
		if (count($this->_campo_datos) == 0)
		{
			return FALSE;
		}
		
		foreach ($this->_campo_datos as $campo => $elemento) {
			//Si esta iniciada y vacia agregamos a campo_datos
			//el valor del $_POST. Por defecto NULL para
			//evitar problemas con los radio button y checkbox						
			if (isset($_POST[$campo]) AND $_POST[$campo] != "")
			{
				$this->_campo_datos[$campo]['postdata'] = $_POST[$campo];
			}
			
			$this->_ejecutar($elemento, explode('|', $elemento['reglas']), $this->_campo_datos[$campo]['postdata']);
		}

		//$total_errors = count($this->_error_array);
		$total_errors = $this->count_errors();

		//falta preparar los datos antes de ser enviados
		if ( $total_errors === 0 )
		{
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Devuelve un mensaje de error
	 *
	 * Devuelve el mensaje de error asociado a un campo particular
	 * si existe
	 *
	 * @access	public
	 * @param   string
	 * @param   string
	 * @param   string
	 * @return	string
	 */	
	public function error($campo, $prefix = '', $suffix = '')
	{
		if ( ! isset($this->_campo_datos[$campo]['error']) OR $this->_campo_datos[$campo]['error'] == '')
		{
			return '';
		}

		if ($prefix == '') 
		{
			$prefix = $this->_prefix_error;
		}

		if ($suffix == '')
		{
			$suffix = $this->_suffix_error;
		}

		return $prefix.$this->_campo_datos[$campo]['error'].$suffix;
	}

	/**
	 * Muestra los errores encontrados
	 *
	 * Arma y muestra todos los errores encontrados
	 *
	 * @access	public
	 * @param   string
	 * @param   string
	 * @return	string
	 */	
	public function show_errors($prefix = '', $suffix = '')
	{
		if ( count($this->_error_array) === 0 AND count($this->_additional_errors) === 0 )
		{
			return '';
		}

		if ($prefix == '') 
		{
			$prefix = $this->_prefix_content_error;
		}

		if ($suffix == '')
		{
			$suffix = $this->_suffix_content_error;
		}

		$str = $prefix;
		foreach ($this->_error_array as $campo => $value) {
			if ( $campo != '' )
			{
				$str .= $this->error($campo);
			}
		}

		//Agregamos los errores adicionales (additional errors)
		if ( count($this->_additional_errors) > 0 ) 
		{
			for ($i=0; $i < count($this->_additional_errors); $i++) { 
				$str .= $this->_additional_errors[$i]; 
			}
		}

		$str .= $suffix;

		return $str;
	}

	/**
	 * Devuelve la cantidad de errores
	 *
	 *
	 * @access	public
	 * @return	integer
	 */	
	public function count_errors()
	{
		$cantidad = count($this->_error_array) + count($this->_additional_errors);
		return $cantidad;
	}

	/**
	 * Ejecuta las funciones de validacion
	 *
	 *
	 * @access	private
	 * @param   array(campo,label,rules,error,postdata)
	 * @param   array
	 * @param   mixed	 
	 * @return	mixed
	 */

	protected function _ejecutar( $input_data, $reglas, $postdata = NULL )
	{
		// Si el campo no es requerido y esta vacio no validamos nada
		if ( ! in_array('requerido', $reglas) AND is_null($postdata))
		{
			return;
		}

		//Requerido es la primera validacion
		if ( in_array('requerido', $reglas))
		{
			//Comprobamos si esta vacio
			if ( is_array($postdata) )
			{
				//si es array no se necesario contar
				//ya que el usuario usa checkbox[] este no
				//se enviara si no se marca nada, pero si envia
				//sera un array con al menos un elemento
				$result = TRUE;
			}
			else
			{
				$result = $this->requerido($postdata);
			}
			

			if ($result == FALSE)
			{
				//Armamos el mensaje de error
				$linea = $this->_msj_errors['requerido'];
				$mensaje = sprintf($linea, $input_data['label']);

				//Guardamos el error en el input_data
				$this->_campo_datos[$input_data['campo']]['error'] = $mensaje;

				//Agregamos a error array, si no esta definido lo definimos
				if ( ! isset($this->_error_array[$input_data['campo']]) )
				{
					$this->_error_array[$input_data['campo']] = $mensaje;
				}
				//No hay nada mas que validar
				return;
			}
		}

		// --------------------------------------------------------------------

		foreach ($reglas as $regla) {

			if( $regla == 'requerido')
			{
				continue;
			}

			// Extraigo el parametro (si existe) de la regla
			// Reglas pueden contener un parametro: max_length[5]						
			if (preg_match("/(.*?)\[(.*)\]/", $regla, $match))
			{
				$regla	= $match[1];
				$param	= $match[2];
			}
	
			if ( !method_exists($this, $regla))
			{
				$mensaje_error = "Error la regla ".$regla." no existe";
				throw new Exception($mensaje_error);				
			}

			//Ejecutamos la regla dependiendo si es un array de datos
			//o un string
			if ( is_array($postdata))
			{
				for ($i=0; $i < count($postdata); $i++) 
				{ 
					//echo $postdata[$i]."<br>";
					if( isset($param) ) 
					{
						$result = $this->$regla($postdata[$i], $param);
					} 
					else 
					{
						$result = $this->$regla($postdata[$i]);
					}		
				}
				//continue;//No deberia continuar en la siguientes lineas
			}
			else
			{
				//$result = $this->$regla($postdata);
				if( isset($param) ) 
				{
					$result = $this->$regla($postdata, $param);
				} 
				else 
				{
					$result = $this->$regla($postdata);
				}
			}
			

			if ($result === FALSE)
			{
				//Verifico si existe mensaje de error
				if ( ! isset($this->_msj_errors[$regla]) )
				{
					throw new Exception("No se ha definido un mensaje de error para regla: ".$regla);
				} else 
				{
					$linea = $this->_msj_errors[$regla];
				}
				
				if( isset($param) ) {
					$mensaje = sprintf($linea, $input_data['label'], $param);
				} else {
					$mensaje = sprintf($linea, $input_data['label']);
				}
				

				//Guardamos el error en el input_data
				$this->_campo_datos[$input_data['campo']]['error'] = $mensaje;

				//Agregamos a error array, si no esta definido lo definimos
				if ( ! isset($this->_error_array[$input_data['campo']]) )
				{
					$this->_error_array[$input_data['campo']] = $mensaje;
				}

				return;			
			}	
		}
	}

	/**
	 * Devuelve el valor del campo de formulario especificado
	 *
	 * Nos permite rellenar los campos del formulario
	 * con los valores especificados, si el valor no existe,
	 * devuelve el por defecto
	 *
	 * @access	public
	 * @param   string
	 * @return	string
	 */	

	public function set_valor($campo = '', $default = '')
	{
		if ( ! isset($this->_campo_datos[$campo]))
		{
			return $default;
		}

		return $this->_campo_datos[$campo]['postdata'];
	}

	/**
	 * Conservar los checkbox
	 * luego de enviar un mensaje de error y definir checked por defecto
	 *
	 * @access	public
	 * @param   string
	 * @return	string
	 */
	public function set_checkbox($campo = '', $value = '', $default = FALSE)
	{
		//Valor por defecto cuando nada se a inicializado
		//campo datos no se a iniciado || postdata es null o no existe
		if ( ! isset($this->_campo_datos[$campo]) OR ! isset($this->_campo_datos[$campo]['postdata']) )
		{
			//si ya hemos enviado formulario, trabajamos con valores nuevos
			//no trabajamos con valores por defecto
			if ( $default == TRUE AND count($this->_campo_datos) === 0 )
			{
				return ' checked = "checked"';
			}
			return '';
		}
		//postdata esta definido
		$campo = $this->_campo_datos[$campo]['postdata'];

		if (is_array($campo))
		{
			if ( ! in_array($value, $campo))
			{
				return '';
			}
		}
		else
		{
			//si no es un array
			if (($campo == '' OR $value == '') OR ($campo != $value))
			{
				return '';
			}
		}

		return ' checked="checked"';		
	}

	/**
	 * Conservar los select 
	 * luego de enviar un mensaje de error y definir select por defecto
	 *
	 * @access	public
	 * @param   string
	 * @return	string
	 */
	public function set_select($campo = '', $value = '', $default = FALSE)
	{
		if ( ! isset($this->_campo_datos[$campo]) OR ! isset($this->_campo_datos[$campo]['postdata']) )
		{
			if ( $default == TRUE AND count($this->_campo_datos) === 0 )
			{
				return ' selected="selected"';
			}
			return '';
		}

		$campo = $this->_campo_datos[$campo]['postdata'];

		if (is_array($campo))
		{
			if ( ! in_array($value, $campo))
			{
				return '';
			}
		}
		else
		{
			if (($campo == '' OR $value == '') OR ($campo != $value))
			{
				return '';
			}
		}

		return ' selected="selected"';		
	}

	/**
	 * Conservar los radio buttons
	 * luego de enviar un mensaje de error y definir checked por defecto
	 *
	 * @access	public
	 * @param   string
	 * @return	string
	 */
	public function set_radio($campo = '', $value = '', $default = FALSE)
	{
		if ( ! isset($this->_campo_datos[$campo]) OR ! isset($this->_campo_datos[$campo]['postdata']) )
		{
			if ( $default == TRUE AND count($this->_campo_datos) === 0 )
			{
				return ' checked = "checked"';
			}
			return '';
		}

		$campo = $this->_campo_datos[$campo]['postdata'];

		if (is_array($campo))
		{
			if ( ! in_array($value, $campo))
			{
				return '';
			}
		}
		else
		{
			if (($campo == '' OR $value == '') OR ($campo != $value))
			{
				return '';
			}
		}

		return ' checked="checked"';		
	}

	/**
	 * Personaliza un mensaje de error
	 * @access	public
	 * @param   string
	 * @param   string
	 * @return	void
	 */	
	public function set_message($regla, $mensaje = '')
	{
		if ( ! isset($this->_msj_errors[$regla]) )
		{
			return false;
		}

		$this->_msj_errors[$regla] = $mensaje;
	}

	/**
	 * Para funciones de validacion personalizadas
	 * esta funcion nos permite agregar mensajes de error adicionales
	 * para luego ser mostrados en pantalla
	 *
	 * @access	public
	 * @param   string
	 * @return	void
	 */	
	public function additional_errors($error)
	{
		$error = $this->_prefix_error. $error . $this->_suffix_error;
		array_push($this->_additional_errors, $error);
	}

	public function set_error_delimiters($prefix = '<li>', $suffix = "</li>")
	{
		$this->_prefix_error = $prefix;
		$this->_suffix_error = $suffix;

		return $this;
	}

	public function set_content_delimiters($prefix = '<ul>', $suffix = "</ul>")
	{
		$this->_prefix_content_error = $prefix;
		$this->_suffix_content_error = $suffix;

		return $this;	
	}

	// --------------------------------------------------------------------

	/**
	 * Evalua si el campo esta vacio
	 *
	 *
	 * @access	public
	 * @param   string
	 * @return	bool
	 */	
	private function requerido($str)
	{
		return (trim($str) == '') ? FALSE : TRUE;		
	}


	// --------------------------------------------------------------------

	/**
	 * Numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function numeric($str)
	{
		return (bool)preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/', $str);

	}

	// --------------------------------------------------------------------

	/**
	 * Integer
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function integer($str)
	{
		return (bool) preg_match('/^[\-+]?[0-9]+$/', $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Es un numero natural  (0,1,2,3, etc.)
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function is_natural($str)
	{
		return (bool) preg_match( '/^[0-9]+$/', $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Is a Natural number, but not a zero  (1,2,3, etc.)
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function is_natural_no_zero($str)
	{
		if ( ! preg_match( '/^[0-9]+$/', $str))
		{
			return FALSE;
		}

		if ($str == 0)
		{
			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Decimal number
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function decimal($str)
	{
		return (bool) preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Caracateres del alfabeto
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function alpha($str)
	{
		return ( ! preg_match("/^([a-z])+$/i", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Caracteres del alfabeto y numeros
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function alpha_numeric($str)
	{
		return ( ! preg_match("/^([a-z0-9])+$/i", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Caracteres del alfabeto, numeros y dashes
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function alpha_dash($str)
	{
		return ( ! preg_match("/^([-a-z0-9_-])+$/i", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Minimum Length
	 *
	 * @access	public
	 * @param	string
	 * @param	value
	 * @return	bool
	 */
	public function min_length($str, $val)
	{
		if (preg_match("/[^0-9]/", $val))
		{
			return FALSE;
		}

		if (function_exists('mb_strlen'))
		{
			return (mb_strlen($str) < $val) ? FALSE : TRUE;
		}

		return (strlen($str) < $val) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Max Length
	 *
	 * @access	public
	 * @param	string
	 * @param	value
	 * @return	bool
	 */
	public function max_length($str, $val)
	{
		if (preg_match("/[^0-9]/", $val))
		{
			return FALSE;
		}

		if (function_exists('mb_strlen'))
		{
			return (mb_strlen($str) > $val) ? FALSE : TRUE;
		}

		return (strlen($str) > $val) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Exact Length
	 *
	 * @access	public
	 * @param	string
	 * @param	value
	 * @return	bool
	 */
	public function exact_length($str, $val)
	{
		if (preg_match("/[^0-9]/", $val))
		{
			return FALSE;
		}

		if (function_exists('mb_strlen'))
		{
			return (mb_strlen($str) != $val) ? FALSE : TRUE;
		}

		return (strlen($str) != $val) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Validar Email
	 *
	 *
	 * @access	public
	 * @param   string
	 * @return	bool
	 */	

	private function valid_email($str)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Verifica si un campo coincide con otro
	 *
	 * @access	public
	 * @param	string
	 * @param	field
	 * @return	bool
	 */
	public function matches($str, $field)
	{
		if ( ! isset($_POST[$field]))
		{
			return FALSE;
		}

		$field = $_POST[$field];

		return ($str !== $field) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Verficar que sea un numero de telefono valido
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function valid_phone_number($str)
	{
		return ( ! preg_match("/^(\+?\d{1,4} )?(\d{2,4} ?)?\d{7,9}$/", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Validar url
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function valid_url($str)
	{
		return ( ! preg_match("/^((ht|f)tp(s?)\:\/\/)?[0-9a-z]([-.\w]*[0-9a-z])*(:(0-9)*)*(\/?)( [a-z0-9\-\.\?\,\'\/\\\+&%\$#_]*)?$/i", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Greather than
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function greater_than($str, $min)
	{
		if ( ! is_numeric($str))
		{
			return FALSE;
		}
		return $str > $min;
	}

	// --------------------------------------------------------------------

	/**
	 * Less than
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function less_than($str, $max)
	{
		if ( ! is_numeric($str))
		{
			return FALSE;
		}
		return $str < $max;
	}
}