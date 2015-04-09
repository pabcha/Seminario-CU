<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	public $timestamps = false;
	public $table = "sp_producto_categorias";
	public $primaryKey = "producto_categoria_id";

	public function productos()
	{
		return $this->hasMany('App\Models\Product', 'producto_categoria_id', 'producto_categoria_id');
	}

	public function scopePadre($query, $id)
	{
		return $query->where('producto_categoria_padre_id', $id);
	}

	public function scopeActive($query)
	{
		return $query->where('producto_categoria_estado', 'A');
	}

	public function scopebyId($query, $id)
	{
		return $query->where('producto_categoria_id', $id);
	}

	public function get_subcategories()
	{
		return $this->where('producto_categoria_padre_id', $this->producto_categoria_id)
			->where('producto_categoria_estado', 'A')
			->get();
	}

	public static function validate($Validator)
	{
		$Validator->set_content_delimiters('<div class="alerta" id="alerta"><ul class="alert_info">','</ul></div>');
		$Validator->set_error_delimiters('<li><i class="icon-remove"></i>','</li>');

		$Validator->set_reglas('inputNombre','nombre','requerido|max_length[50]');
		$Validator->set_reglas('inputCategoria','categoria','requerido|integer');
		$Validator->set_reglas('inputEstado','estado','requerido|alpha|max_length[1]');

		if ( count($_POST) > 0 )
		{
			$r = Category::where('producto_categoria_nombre', $_POST['inputNombre'])
				->where('producto_categoria_estado', '!=', 'B')
				->first();

			if ($r)
			{
				$Validator->additional_errors("La categoria ya se encuentra en la base de datos.");
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

		$Validator->set_reglas('inputNombre','nombre','requerido|max_length[50]');
		$Validator->set_reglas('inputCategoria','categoria','requerido|integer');
		$Validator->set_reglas('inputEstado','estado','requerido|alpha|max_length[1]');

		if ( $Validator->validar() )
		{
			return true;
		}
		
		return false;		
	}
}