<?php
class Session
{
	public static function init()
	{
		session_start();
	}

	public static function destroy( $clave = false )
	{
		/*para detruir la session
		* o destruir varias sesiones
		* por array
		*/
		if( $clave ) {
			if( is_array($clave) ) {
				for ($i=0; $i < count($clave) ; $i++) { 
					if( isset( $_SESSION[$clave[$i]] )) {
						unset( $_SESSION[$clave[$i]] );	
					}
				}
			} else {
				if( isset( $_SESSION[$clave] )) {
					unset( $_SESSION[$clave] );	
				}
			}
		} else {
			session_destroy();
		}
	}

	public static function set( $clave,$valor ) 
	{
		if( ! empty($clave) ) 
		{
			$_SESSION[ $clave ] = $valor;
		}			
	}

	public static function get( $clave )
	{
		if( isset($_SESSION[ $clave ]) ) 
		{
			return $_SESSION[ $clave ];
		}
	}

	/**
	 * Muestra la variable e inmediatamente despues
	 * la borra
	 *
	 * @access	public
	 * @param   string
	 * @return	string
	*/
	public static function show( $clave )
	{
		if( isset($_SESSION[ $clave ]) ) {
			$mensaje = $_SESSION[ $clave ];
			Session::destroy($clave);
			return $mensaje;
		}
	}
	
	public static function isAutenticado()
	{
		if ( !Session::get('operador')['autenticado'] ) 
		{
			header('location:'. BASE_URL . 'admin');
		}
	}

	public static function soloAdmin()
	{
		if ( Session::get('operador')['rol'] !== 'administrador' )
		{
			header('location:'. BASE_URL . 'error/access/5050');
		}
	}
}

?>