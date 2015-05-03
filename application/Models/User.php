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

	public function scopeExists($query, $correo)
	{
		return $query->where('us_correo', $correo);
	}

	public function scopeisUser($query, $correo, $pass)
	{
		return $query->where('us_correo', $correo)
				->where('us_password', $pass);
	}
}