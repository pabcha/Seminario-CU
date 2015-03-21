<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model {

	public $timestamps = false;
	public $table = "sp_producto_marcas";
	public $primaryKey = "producto_marca_id";

	public static function validate($Validator)
	{
		$Validator->set_content_delimiters('<div class="alerta" id="alerta"><ul class="alert_info">','</ul></div>');
		$Validator->set_error_delimiters('<li><i class="icon-remove"></i>','</li>');

		$Validator->set_reglas('inputNombre','nombre','requerido|max_length[40]');

		if ( count($_POST) > 0 )
		{
			$r = Marca::where('producto_marca_nombre', $_POST['inputNombre'])
				->where('producto_marca_estado', '!=', 'B')
				->first();

			if ($r)
			{
				$Validator->additional_errors("La marca ya se encuentra en la base de datos.");
			}
		}

		if ( $Validator->validar() )
		{
			return true;
		}
		
		return false;
	}

	public static function validateUpdate($Validator)
	{
		$Validator->set_content_delimiters('<div class="alerta" id="alerta"><ul class="alert_info">','</ul></div>');
		$Validator->set_error_delimiters('<li><i class="icon-remove"></i>','</li>');

		$Validator->set_reglas('inputNombre','nombre','requerido|max_length[40]');

		if ( $Validator->validar() )
		{
			return true;
		}
		
		return false;		
	}
	
}