<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
	
	public $timestamps = false;
	public $table = "sp_usuarios";
	public $primaryKey = "us_id";

	public function ordenes()
	{
		return $this->hasMany('App\Models\Order', 'us_id', 'us_id');
	}

	public function scopeActive($query)
	{
		return $query->where('us_estado', 'A');
	}

	public function scopeisUser($query, $correo, $pass)
	{
		return $query->where('us_correo', $correo)
				->where('us_password', $pass);
	}

	public static function validate($Validator)
	{
		$Validator->set_content_delimiters('<div class="error row-fluid">','</div>');
		$Validator->set_error_delimiters('<h3>','</h3>');

		$Validator->set_reglas('inputCorreo', 'correo', 'max_length[250]');

		if ( count($_POST) > 0 )
		{
			$temp = User::isUser($_POST['inputCorreo'], $_POST['inputPassword'])->active()->first();

			if ( empty($temp) ) 
			{
				$Validator->additional_errors("Usuario/Contraseña incorrectos.");
			}
		}

		if ( $Validator->validar() )
		{
			return true;
		}
		
		return false;		
	}

	public static function validateInfo($validator)
	{
		$validator->set_content_delimiters('<div class="alert alert-error error-messages">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<ul>','</ul></div>');
		$validator->set_error_delimiters('<li>','</li>');

		$validator->set_reglas('inputNombre','nombre','requerido|max_length[40]');
		$validator->set_reglas('inputApellido','apellido','requerido|max_length[40]');
		$validator->set_reglas('inputDNI','DNI','requerido|integer|exact_length[8]');	
		$validator->set_reglas('inputProvincia','campo provincia','requerido|max_length[30]');
		$validator->set_reglas('inputCiudad','campo ciudad','requerido|max_length[30]');
		$validator->set_reglas('inputCPostal','codigo postal','requerido|integer|max_length[4]');
		$validator->set_reglas('inputDireccion','domicilio','requerido|max_length[60]');
		$validator->set_reglas('inputTelefono','telefono','requerido|valid_phone_number');
		$validator->set_reglas('inputCelular','celular','valid_phone_number');

		$validator->set_message('exact_length', 'El DNI no es valido.');

		if ( $validator->validar() )
		{
			return true;
		}
		
		return false;
	}

	public static function validateEditPassword($validator)
	{
		$validator->set_content_delimiters('<div class="alert alert-error error-messages">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<ul>','</ul></div>');
		$validator->set_error_delimiters('<li>','</li>');

		$validator->set_reglas('inputPassword','contraseña','requerido|min_length[6]|max_length[15]|matches[inputPassword2]');
		$validator->set_reglas('inputPassword2','contraseña','max_length[15]');

		$validator->set_message('matches', 'Las contraseñas deben coincidir.');

		if ( $validator->validar() )
		{
			return true;
		}
		
		return false;
	}

	

}