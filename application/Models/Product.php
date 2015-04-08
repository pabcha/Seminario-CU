<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;

class Product extends Model {

	public $timestamps = false;
	public $table = "sp_productos";
	public $primaryKey = "producto_id";

	public function images() 
	{
		return $this->hasMany('App\Models\ProductImage', 'producto_id', 'producto_id');
	}

	public function getDefaultImg()
	{
		return $this->images()
			->where('producto_img_predeterminado','S')
			->first();
	}

	public static function active_paginate($per_page, $offset)
	{
		return Product::where('producto_estado', '!=', 'B')
				->limit( $per_page )
				->offset( $offset );
	}

	public static function count_all()
	{
		return Product::where('producto_estado', '!=', 'B')
				->select(Capsule::raw('count(*) as count'))
				->first()
				->count;
	}

	public static function validate($Validator)
	{
		$Validator->set_content_delimiters('<div class="alerta" id="alerta"><ul class="alert_info">','</ul></div>');
		$Validator->set_error_delimiters('<li><i class="icon-remove"></i>','</li>');

		$Validator->set_reglas('inputNombre','nombre','requerido|max_length[60]');
		$Validator->set_reglas('inputPrecio','precio','requerido|decimal');
		$Validator->set_reglas('inputStock','stock','requerido|is_natural');
		$Validator->set_reglas('inputStockMin','stock minimo','is_natural');
		$Validator->set_reglas('inputCategoria','campo categoria','requerido|is_natural');
		$Validator->set_reglas('inputMarca','marca','requerido|is_natural');
		$Validator->set_reglas('inputShortDescripcion','descripcion corta','max_length[400]');
		$Validator->set_reglas('inputDescripcion','descripcion','max_length[3000]');
		$Validator->set_reglas('inputEstado','estado','requerido|alpha|max_length[1]');

		$Validator->set_message("max_length", "La %s no debe contener mas de %s caracteres.");

		if ( count($_POST) > 0 )
		{
			$r = Product::where('producto_nombre', $_POST['inputNombre'])
				->where('producto_estado', '!=', 'B')
				->first();

			if ($r)
			{
				$Validator->additional_errors("El producto ya se encuentra en la base de datos.");
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

		$Validator->set_reglas('inputNombre','nombre','requerido|max_length[60]');
		$Validator->set_reglas('inputPrecio','precio','requerido|decimal');
		$Validator->set_reglas('inputStock','stock','requerido|is_natural');
		$Validator->set_reglas('inputStockMin','stock minimo','is_natural');
		$Validator->set_reglas('inputCategoria','campo categoria','requerido|is_natural');
		$Validator->set_reglas('inputMarca','marca','requerido|is_natural');
		$Validator->set_reglas('inputShortDescripcion','descripcion corta','max_length[400]');
		$Validator->set_reglas('inputDescripcion','descripcion','max_length[3000]');
		$Validator->set_reglas('inputEstado','estado','requerido|alpha|max_length[1]');

		$Validator->set_message("max_length", "La %s no debe contener mas de %s caracteres.");

		if ( $Validator->validar() )
		{
			return true;
		}
		
		return false;		
	}
	
}