<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
	
	public $timestamps = false;
	public $table = "sp_usuarios";

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

}