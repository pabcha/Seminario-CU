<?php 
namespace App\Classes;

use App\Models\User;

class MiCuentaService
{
	public static function validar($validator, $old_password)
	{
		$validator->set_content_delimiters('<div class="alert alert-error error-messages">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<ul>','</ul></div>');
		$validator->set_error_delimiters('<li>','</li>');

		$validator->set_reglas('inputPassword','contraseña','requerido|min_length[6]|max_length[15]|matches[inputPassword2]');
		$validator->set_reglas('inputPassword2','contraseña','max_length[15]');

		$validator->set_message('matches', 'Las contraseñas deben coincidir.');

		if ( count($_POST) > 0 )
		{
			if ($old_password != md5($_POST['old_password']))
			{
				$validator->additional_errors("Tu anterior password no coincide con el ingresado.");
			}
		}

		if ( $validator->validar() )
		{
			return true;
		}
		
		return false;
	}
}