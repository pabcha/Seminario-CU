<?php 
namespace App\Classes;

use App\Models\Category;

class CategoryService
{
	public static function createTree($id, $validate)
	{
		$sub = Category::where('producto_categoria_padre_id', $id)
			->where('producto_categoria_estado', '!=', 'B')
			->get();
		
		if ( ! $sub->isEmpty() ) 
		{
			echo '<ul>';
			foreach ($sub as $v) 
			{
				echo "<li><span><input type='radio' name='inputCategoria' value='"
					.$v['producto_categoria_id']."' "
					.$validate->set_radio('inputCategoria', $v['producto_categoria_id'])
					."></span>"
					.$v['producto_categoria_nombre'];

				static::createTree($v['producto_categoria_id'], $validate);
			}
			echo "</ul>";
		}
	}

	public static function createTreeForUpdate($id_categoria, $id_padre, $id_categoria_exeption, $validate)
	{
		$subcategorias = Category::where('producto_categoria_padre_id', $id_categoria)
			->where('producto_categoria_id', '!=', $id_categoria_exeption)
			->where('producto_categoria_estado', '!=', 'B')
			->get();

		if ( count($subcategorias) > 0 ) 
		{
			echo '<ul>';
			foreach ($subcategorias as $subcategoria) 
			{
				echo "<li><span><input type='radio' name='inputCategoria' value='"
					.$subcategoria['producto_categoria_id']
					."' "
					.$validate->set_radio('inputCategoria', $subcategoria['producto_categoria_id'], $id_padre == $subcategoria['producto_categoria_id'])
					."></span> "
					.$subcategoria['producto_categoria_nombre'];

				static::createTreeForUpdate( $subcategoria['producto_categoria_id'], $id_padre, $id_categoria_exeption, $validate);
				echo "</li>";
			}
			echo "</ul>";
		}
	}

	public static function getFilterProducts($builder, $limit, $offset)
	{
		$builder->limit( $limit )->offset( $offset );

		if ( !empty($_GET['orderby']) ) 
		{
			switch ($_GET['orderby']) {
				case 'menorPrecio':
					$builder->orderBy('producto_precio', 'asc');
					break;
				case 'mayorPrecio':
					$builder->orderBy('producto_precio', 'desc');
					break;
				case 'azNombre':
					$builder->orderBy('producto_nombre', 'asc');
					break;
				case 'zaNombre':
					$builder->orderBy('producto_nombre', 'desc');
					break;
				default:
					# code...
					break;
			}
		}
	}
}