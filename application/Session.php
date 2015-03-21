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

	public static function acceso( $level )
	{
		if( !Session::get('op_autenticado') ) 
		{
			header('Location: '.BASE_URL.'error/access/5050');
			exit;
		}

		Session::tiempo();

		if( Session::getLevel($level) > Session::getLevel(Session::get('op_level')) ) {
			header('Location: '.BASE_URL.'error/access/5050');
			exit;	
		}
	}

/*	public static function accesoView( $level )
	{
		if( !Session::get('op_autenticado') ) {
			return false;
		}

		if( Session::getLevel($level) > Session::getLevel( Session::get('op_level')) ) {
			return false;
		}

		return true;
	}*/

	public static function getLevel( $level )
	{
		$role['administrador'] = 5;
		$role['vendedor'] = 2;
		$role['usuario'] = 1;

		if( !array_key_exists($level, $role) ) {
			throw new Exception("Error de acceso. Nivel no encontrado");
		}
		else{
			return $role[$level];
		}
	}

	public static function accesoEstricto( array $level, $noAdmin = false )
	{
		if( !Session::get('op_autenticado') ) {
			header('Location: '.BASE_URL.'error/access/5050');
			exit;	
		}

		Session::tiempo();

		if( $noAdmin == false ) {
			if( Session::get('op_level') == 'admin' ) {
				return;//permite acceso al admin
			}
		}

		if( count($level) ) {
			if( in_array( Session::get('op_level'), $level)) {
				return;
			}
		}

		header('Location: '.BASE_URL.'error/access/5050');
	}

/*	public static function accesoViewEstricto( array $level, $noAdmin = false )
	{
		if( !Session::get('op_autenticado') ) {
			return false;
		}

		if( $noAdmin = false ) {
			if( Session::get('op_level') == 'admin' ) {
				return true;//permite acceso al admin
			}
		}

		if( count($level) ) {
			if( in_array( Session::get('op_level'), $level)) {
				return true;
			}
		}

		return false;
	}*/

	public static function tiempo()
	{
		if ( !Session::get('op_tiempo') || !defined('SESSION_TIME') ) {
			throw new Exception("No se ha definido el tiempo de sesion.");
		}

		if( SESSION_TIME == 0) {
			return;//tiempo de session indefinido
		}

		if( time() - Session::get('op_tiempo') > (SESSION_TIME * 60) ) {
			Session::destroy();//expiro session
			header('Location: '.BASE_URL.'error/access/8080');		
		}
		else {
			Session::set('op_tiempo', time());
		}
	}

/*	public static function tiempo_carrito()
	{
		///if ( !Session::get('tiempo_carrito') || !defined('SESSION_TIME_CARRO') ) {
		if ( Session::get('tiempo_carrito') && defined('SESSION_TIME_CARRO') ) {

			if( SESSION_TIME_CARRO == 0) {
			return;//tiempo de session indefinido
			}

			if( time() - Session::get('tiempo_carrito') > (SESSION_TIME_CARRO * 60) ) {
				Session::destroy( array('carro','tiempo_carrito','contador') );//expiro session
				//header('Location: '.BASE_URL.'error/access/8080');		
			}
			else {
				Session::set('tiempo_carrito', time());
			}

		} 
		/*if( SESSION_TIME_CARRO == 0) {
			return;//tiempo de session indefinido
		}

		if( time() - Session::get('tiempo_carrito') > (SESSION_TIME_CARRO * 60) ) {
			Session::destroy( array('carro','tiempo_carrito','contador') );//expiro session
			//header('Location: '.BASE_URL.'error/access/8080');		
		}
		else {
			Session::set('tiempo_carrito', time());
		}*/
	/*}*/
}

?>