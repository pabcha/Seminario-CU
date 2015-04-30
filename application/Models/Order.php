<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
	
	public $timestamps = false;
	public $table = "sp_ordenes";
	public $primaryKey = "ord_id";

	public function productos()
	{
		return $this->belongsToMany('App\Models\Product', 'sp_orden_detalle', 'ord_id', 'producto_id');
	}

	public function usuario()
	{
		return $this->belongsTo('App\Models\User', 'us_id', 'us_id');
	}

	public function historias()
	{
		return $this->hasMany('App\Models\OrderHistory', 'ord_id', 'ord_id');
	}

	public function scopeEstado($query, $estado)
	{
		return $query->orWhere('ord_estado', $estado);
	}

}