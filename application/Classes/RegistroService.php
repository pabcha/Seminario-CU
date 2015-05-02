<?php 
namespace App\Classes;

use App\Models\User;

class RegistroService
{
	public static function validar($val)
	{
		$val->set_content_delimiters('<div class="alert alert-error error-messages">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<ul>','</ul></div>');
		$val->set_error_delimiters('<li>','</li>');

		$val->set_reglas('correo','correo','requerido|valid_email');
		$val->set_reglas('password','contraseña','requerido|min_length[6]|matches[password2]');
		$val->set_reglas('password2','contraseña','max_length[50]');

		$val->set_reglas('nombre','nombre','requerido|max_length[35]');
		$val->set_reglas('apellido','apellido','requerido|max_length[35]');
		$val->set_reglas('dni','DNI','requerido|integer|max_length[8]');
		$val->set_reglas('provincia','campo provincia','requerido|max_length[30]');
		$val->set_reglas('ciudad','campo ciudad','requerido|max_length[30]');
		$val->set_reglas('cpostal','codigo postal','requerido|integer|max_length[4]');
		$val->set_reglas('domicilio','domicilio','requerido|max_length[60]');
		$val->set_reglas('telefono','telefono','requerido|valid_phone_number');
		$val->set_reglas('celular','El celular','valid_phone_number');

		$val->set_message('matches', 'Las contraseñas deben coincidir.');

		if ( count($_POST) > 0 )
		{
			$u = User::exists($_POST['correo'])->first();

			if ( !is_null($u) )
			{
				$val->additional_errors("Usuario ya registrado.");
			}
		}

		return $val->validar();
	}

	public static function createUser()
	{
		$u = new User();

		$u->us_correo = $_POST['correo'];
		$u->us_password = md5($_POST['password']);
		$u->us_nombre = $_POST['nombre'];
		$u->us_apellido = $_POST['apellido'];
		$u->us_dni = $_POST['dni'];
		$u->us_provincia = $_POST['provincia'];
		$u->us_ciudad = $_POST['ciudad'];
		$u->us_cpostal = $_POST['cpostal'];
		$u->us_domicilio = $_POST['domicilio'];
		$u->us_telefono = $_POST['telefono'];
		$u->us_celular = $_POST['celular'];
		$u->us_estado = 'A';

		$u->save();
	}
}