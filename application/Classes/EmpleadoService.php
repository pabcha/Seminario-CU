<?php 
namespace App\Classes;

use App\Models\Operador;

class EmpleadoService
{
	public static function validar($val)
	{
		$val->set_content_delimiters('<div class="alerta"><ul class="alert_info">','</ul></div>');
		$val->set_error_delimiters('<li><i class="icon-remove"></i>','</li>');

		$val->set_reglas('nombre','nombre','requerido|max_length[35]');
		$val->set_reglas('apellido','apellido','requerido|max_length[35]');
		$val->set_reglas('dni','DNI','requerido|integer|max_length[8]');
		$val->set_reglas('genero','genero','requerido|max_length[1]');

		$val->set_reglas('correo','correo','requerido|valid_email');
		$val->set_reglas('password','password','requerido|min_length[6]');
		$val->set_reglas('rol','rol','requerido');

		if ( count($_POST) > 0 )
		{
			$u = Operador::exists($_POST['correo'])->first();

			if ( !is_null($u) )
			{
				$val->additional_errors("Correo ya registrado.");
			}
		}

		return $val->validar();
	}

	public static function store()
	{
		$emp = new Operador();

		$emp->op_correo = $_POST['correo'];
		$emp->op_rol = $_POST['rol'];
		$emp->op_password = md5($_POST['password']);
		$emp->op_nombre = $_POST['nombre'];
		$emp->op_apellido = $_POST['apellido'];
		$emp->op_dni = $_POST['dni'];
		$emp->op_genero = $_POST['genero'];
		$emp->op_estado = 'A';

		$emp->save();
	}

	public static function validar_update($val)
	{
		$val->set_content_delimiters('<div class="alerta"><ul class="alert_info">','</ul></div>');
		$val->set_error_delimiters('<li><i class="icon-remove"></i>','</li>');

		$val->set_reglas('nombre','nombre','requerido|max_length[35]');
		$val->set_reglas('apellido','apellido','requerido|max_length[35]');
		$val->set_reglas('dni','DNI','requerido|integer|max_length[8]');
		$val->set_reglas('genero','genero','requerido|max_length[1]');
		$val->set_reglas('rol','rol','requerido');

		return $val->validar();
	}

	public static function validar_edit_password($val, $old_password)
	{
		$val->set_content_delimiters('<div class="alerta"><ul class="alert_info">','</ul></div>');
		$val->set_error_delimiters('<li><i class="icon-remove"></i>','</li>');

		$val->set_reglas('password','password','requerido|min_length[6]|max_length[15]|matches[password2]');
		$val->set_reglas('password2','password','max_length[15]');

		$val->set_message('matches', 'Los passwords deben coincidir.');

		if ( count($_POST) > 0 )
		{
			if ($old_password != md5($_POST['old_password']))
			{
				$val->additional_errors("Tu anterior password no coincide con el ingresado.");
			}
		}

		return $val->validar();
	}

	public static function update($id)
	{
		$emp = Operador::find($id);

		$emp->op_rol = $_POST['rol'];
		$emp->op_nombre = $_POST['nombre'];
		$emp->op_apellido = $_POST['apellido'];
		$emp->op_dni = $_POST['dni'];
		$emp->op_genero = $_POST['genero'];

		$emp->save();
	}

	public static function update_pass($id)
	{
		$emp = Operador::find($id);

		$emp->op_password = md5($_POST['password']);
		$emp->save();
	}
}
