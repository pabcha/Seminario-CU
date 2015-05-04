<?php 
namespace App\Classes;

use App\Models\Operador;

class LoginService
{
	public static function validar($val)
	{
		$val->set_content_delimiters('<div class="alerta"><ul class="alert_info">','</ul></div>');
		$val->set_error_delimiters('<li><i class="icon-remove"></i>','</li>');

		$val->set_reglas('correo','correo','requerido|valid_email');

		if ( count($_POST) > 0 )
		{
			$u = Operador::autenticar($_POST['correo'], $_POST['password'])->first();

			if ( empty($u) )
			{
				$val->additional_errors("Usuario o contraseña incorrectos.");
			}
		}

		return $val->validar();
	}
}