<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model {
	
	public $timestamps = false;
	public $table = "sp_orden_detalle";
	public $primaryKey = "od_id";

}