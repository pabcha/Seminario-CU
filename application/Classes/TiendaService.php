<?php 
namespace App\Classes;

use App\Models\Category;
use Illuminate\Database\Capsule\Manager as DB;

class TiendaService
{
	public static function createTree($id_categoria)
	{
		$subcategorias = Category::where('producto_categoria_padre_id', $id_categoria)
			->where('producto_categoria_estado', 'A')
			->get();

		if ( ! $subcategorias->isEmpty() ) 
		{
			echo '<ul class="children">';
			foreach ($subcategorias as $s) 
			{
				echo "<li><a href='".BASE_URL."index/categoria/".$s['producto_categoria_id']."/1'>".$s['producto_categoria_nombre']."</a>";
				static::createTree( $s['producto_categoria_id'] );
				echo "</li>";
			}
			echo "</ul>";
		} 	
	}

	public static function most_selled($limit)
	{
		$temp =	DB::table('sp_ordenes')
					->join('sp_orden_detalle', 'sp_ordenes.ord_id', '=', 'sp_orden_detalle.ord_id')
					->select('sp_ordenes.ord_id', 'sp_ordenes.ord_estado', 'sp_ordenes.ord_fecha', 
							'sp_orden_detalle.producto_id', 'sp_orden_detalle.producto_subtotal', 'sp_orden_detalle.producto_precio',
							'sp_orden_detalle.producto_nombre', DB::raw('sum(sp_orden_detalle.producto_cantidad) as cantidad'))
					->whereRaw("DATEDIFF(now(), sp_ordenes.ord_fecha) < ?", [7])
					->orderBy('cantidad', 'desc')
					->groupBy('sp_orden_detalle.producto_id')
					->limit($limit)
					->get();

		return $temp;		
	}
}