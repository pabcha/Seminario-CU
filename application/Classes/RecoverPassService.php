<?php 
namespace App\Classes;

use App\Models\User;

class RecoverPassService
{
	public static function validar($val)
	{
		$val->set_content_delimiters('<div class="error row-fluid">','</div>');
		$val->set_error_delimiters('<h3>','</h3>');

		$val->set_reglas('inputCorreo','correo','max_length[250]');

		if ( count($_POST) > 0 )
		{
			$u = User::exists($_POST['correo'])->first();

			if ( is_null($u) )
			{
				$val->additional_errors("El correo no existe en nuestra base de datos.");
			}
			
			$u = null;
		}

		if ( $val->validar() )
		{
			return true;
		}

		return false;
	}
}