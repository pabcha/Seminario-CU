<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model {
	
	public $timestamps = false;
	public $table = "sp_orden_historial";
	public $primaryKey = "historia_id";

	public function orden()
	{
		return $this->belongsTo('App\Models\OrderHistory', 'ord_id', 'ord_id');
	}

}