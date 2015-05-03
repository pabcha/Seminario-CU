<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operador extends Model {
	
	public $timestamps = false;
	public $table = "sp_operadores";
	public $primaryKey = "op_id";

	public function scopeExists($query, $correo)
	{
		return $query->where('op_correo', $correo);
	}
}