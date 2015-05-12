<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Underscore\Types\Arrays;
use Underscore\Types\String;

class adminController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	private function viewMake($str, $data = array())
	{
		$this->_view->renderizar('layout/admin/header');
		$this->_view->renderizar($str, $data);
		$this->_view->renderizar('layout/admin/footer');
	}
//---------------- Entrar ---------------------//
	public function index()
	{
		if ( Session::get('operador')['autenticado'] ) 
		{
			$this->redireccionar('admin/ordenes');
		}

		$this->_view->titulo = 'Area de administracion';
		$this->_view->renderizar('layout/admin/header_login');
		$this->_view->renderizar('admin/index');
		$this->_view->renderizar('layout/admin/footer');
	}

	public function logear()
	{
		Session::isAutenticado();

		if ( $_SERVER['REQUEST_METHOD'] != 'POST' )
		{
			$this->redireccionar('admin');
		}

		$op = App\Models\Operador::autenticar($_POST['correo'], $_POST['password'])
				->first();

		if ( !empty($op) )
		{
			$_SESSION['operador'] = array(
				'autenticado' => true,
				'nombre' => $op->op_nombre,
				'apellido' => $op->op_apellido,
				'correo' => $op->op_correo,
				'id' => $op->op_id,
				'rol' => $op->op_rol,
				'tiempo' => time(),
			);

			$this->redireccionar('admin/ordenes');
		}

		Session::set('correo', $_POST['correo']);
		Session::set('errors', "Usuario/Contraseña incorrectos.");
		$this->redireccionar('admin');
	}

	public function logout()
	{
		Session::isAutenticado();
		Session::destroy('operador');
		$this->redireccionar('admin');
	}

//---------------- Categorias ---------------------//

	public function categorias()
	{
		Session::isAutenticado();
		
		$this->_view->titulo = 'Categorias';
		$this->_view->setJs(array(
			'vendor/datatable1.10.6/jquery.dataTables.min',
			'common/helpers',
			'admin/catalogo'
		));		

		$datos['cs'] = App\Models\Category::where('producto_categoria_padre_id',0)
			->where('producto_categoria_estado', '!=', 'B')
			->get();
		$datos['page'] = 1;

		$this->viewMake('admin/catalogo/categorias', $datos);
	}

	public function categorias_add()
	{
		Session::isAutenticado();

		$this->_view->titulo = 'Añadir categoria';
		$this->_view->setCss(array('vendor/jquery.treeview'));
		$this->_view->setJs(array('vendor/jquery.treeview'));


		$Val = new App\Helpers\Validator();

		if ( App\Models\Category::validate($Val) )
		{
			$category = new App\Models\Category();

			$category->producto_categoria_nombre = $_POST['inputNombre'];
			$category->producto_categoria_padre_id = $_POST['inputCategoria'];
			$category->producto_categoria_estado = $_POST['inputEstado'];

			$category->save();

			Session::set("mensajeExito", "Se ha añadido una nueva categoria.");
			$this->redireccionar('admin/categorias');
		}


		$datos['validador'] 	= $Val;
		$datos['errors'] 		= $Val->show_errors();
		$datos['categorias'] 	= App\Models\Category::where('producto_categoria_padre_id',0)
			->where('producto_categoria_estado', '!=', 'B')
			->get();
		$datos['page'] = 1;

		$this->viewMake('admin/catalogo/categorias_add', $datos);
	}

	public function categorias_update($id_categoria)
	{
		Session::isAutenticado();

		try {
			$categoria = App\Models\Category::findOrFail($id_categoria);

			$this->_view->titulo = 'Editar Categoria';
			$this->_view->setCss(array('vendor/jquery.treeview'));
			$this->_view->setJs(array('vendor/jquery.treeview'));
			$datos['page'] = 1;

			$Val = new App\Helpers\Validator();

			if ( App\Models\Category::validateUpdate($Val) )
			{
				$category = App\Models\Category::find($id_categoria);

				$category->producto_categoria_nombre = $_POST['inputNombre'];
				$category->producto_categoria_padre_id = $_POST['inputCategoria'];
				$category->producto_categoria_estado = $_POST['inputEstado'];

				$category->save();

				Session::set("mensajeExito", "La marca ".$category->producto_categoria_nombre." ha sido modificada.");
				$this->redireccionar('admin/categorias');
			}

			$datos['categoria'] = $categoria;
			$datos['validador'] = $Val;
			$datos['errors'] = $Val->show_errors();
			$datos['categorias'] = App\Models\Category::where('producto_categoria_padre_id',0)
				->where('producto_categoria_estado', '!=', 'B')
				->get();
			
			$this->viewMake('admin/catalogo/categorias_update', $datos);

		} catch (Exception $e) {;
			$this->redireccionar('admin/categorias');
		};
	}

	public function categoria($id_categoria)
	{
		Session::isAutenticado();

		try {
			$datos['c'] = App\Models\Category::findOrFail($id_categoria);

			$datos['categorias'] = App\Models\Category::where('producto_categoria_padre_id', $id_categoria)
				->where('producto_categoria_estado', '!=', 'B')
				->get();
			$datos['page'] = 1;		

			$this->_view->titulo = 'Categorias en '.$datos['c']->producto_categoria_nombre;
			$this->_view->setJs(array(
				'vendor/datatable1.10.6/jquery.dataTables.min',
				'common/helpers',
				'admin/catalogo'
			));

			$this->viewMake('admin/catalogo/categoria', $datos);

		} catch (Exception $e) {
			$this->redireccionar('admin/categorias');
		}
	}

	public function categoria_delete( $id_categoria ) 
	{
		Session::isAutenticado();

		try {
			$categoria = App\Models\Category::findOrFail($id_categoria);

			$nombre = $categoria->producto_categoria_nombre;
			$categoria->producto_categoria_estado = 'B';
			$categoria->save();

			Session::set("mensajeExito", "Se eliminado la categoria ".$nombre.".");
			$this->redireccionar('admin/categorias');
			
		} catch (Exception $e) {
			$this->redireccionar('admin/categorias');
		}
	}

//---------------- Marcas ---------------------//

	public function marcas()
	{
		Session::isAutenticado();

		$this->_view->titulo = 'Marcas de producto';
		$this->_view->setJs(array(
			'vendor/datatable1.10.6/jquery.dataTables.min',
			'common/helpers',
			'admin/catalogo'
		));

		$datos['marcas'] = App\Models\Marca::where('producto_marca_estado', '!=', 'B')->get();
		$datos['page'] = 3;

		$this->viewMake('admin/catalogo/marcas', $datos);
	}

	public function marcas_add()
	{
		Session::isAutenticado();	

		$Val = new App\Helpers\Validator();

		if ( App\Models\Marca::validate($Val) )
		{
			$marca = new App\Models\Marca();

			$marca->producto_marca_nombre = $_POST['inputNombre'];
			$marca->producto_marca_estado = 'A';

			$marca->save();

			Session::set("mensajeExito", "Se ha añadido una nueva categoria.");
			$this->redireccionar('admin/marcas');
		}

		$this->_view->titulo = 'Añadir Marca';
		$datos['validador'] 	= $Val;
		$datos['errors'] 		= $Val->show_errors();
		$datos['page'] = 3;	

		$this->viewMake('admin/catalogo/marcas_add', $datos);		
	}

	public function marca_update($marca_id)
	{
		Session::isAutenticado();

		try {
			$marca = App\Models\Marca::findOrFail( $marca_id );

			$Val = new App\Helpers\Validator();

			if ( App\Models\Marca::validateUpdate($Val) )
			{
				$marca->producto_marca_nombre = $_POST['inputNombre'];
				$marca->save();

				Session::set("mensajeExito", "La marca ".$marca->producto_marca_nombre." ha sido modificada.");
				$this->redireccionar('admin/marcas');
			}

			$this->_view->titulo = 'Editar Marca';
			$datos['validador'] 	= $Val;
			$datos['errors'] 		= $Val->show_errors();
			$datos['page'] = 3;
			$datos['marca'] = $marca;

			$this->viewMake('admin/catalogo/marca_update', $datos);

		} catch (Exception $e) {
			$this->redireccionar('admin/marcas');
		}
	}

	public function marca_delete( $marca_id ) 
	{
		Session::isAutenticado();

		try {
			$marca = App\Models\Marca::findOrFail( $marca_id );

			$nombre = $marca->producto_marca_nombre;
			$marca->producto_marca_estado = 'B';
			$marca->save();

			Session::set("mensajeExito", "Se eliminado la marca ".$nombre.".");
			$this->redireccionar('admin/marcas');

		} catch (Exception $e) {
			$this->redireccionar('admin/marcas');
		}
	}

//---------------- Productos ---------------------//

	public function productos()
	{
		Session::isAutenticado();

		$this->_view->titulo = 'Productos de catalogo';
		$this->_view->setJs(array(
			'vendor/datatable1.10.6/jquery.dataTables.min',
			'common/helpers',
			'admin/catalogo'
		));

		$datos['productos'] = App\Models\Product::where('producto_estado', '!=', 'B')->get();
		$datos['page'] = 2;
		
		$this->viewMake('admin/catalogo/productos', $datos);		
	}

	public function productos_add()
	{
		Session::isAutenticado();			
		
		$Val = new App\Helpers\Validator();

		if ( App\Models\Product::validate($Val) )
		{
			$producto = new App\Models\Product();
			
			$producto->producto_marca_id 			= $_POST['inputMarca'];
			$producto->producto_categoria_id 		= $_POST['inputCategoria'];
			$producto->producto_nombre 				= $_POST['inputNombre'];
			$producto->producto_descripcion_corta 	= $_POST['inputShortDescripcion'];
			$producto->producto_descripcion 		= $_POST['inputDescripcion'];
			$producto->producto_cantidad 			= $_POST['inputStock'];
			$producto->producto_precio 				= $_POST['inputPrecio'];
			$producto->producto_cantidad_comprada 	= 0;
			$producto->producto_estado 				= $_POST['inputEstado'];

			$producto->save();

			Session::set("mensajeExito", "Se ha añadido un nuevo producto.");
			$this->redireccionar('admin/productos');
		}

		$datos['marcas'] = App\Models\Marca::where('producto_marca_estado', '!=', 'B')
			->orderBy('producto_marca_nombre')
			->get();
		$datos['categorias'] = App\Models\Category::where('producto_categoria_padre_id', 0)
			->where('producto_categoria_estado', '!=', 'B')
			->get();

		$this->_view->titulo      = 'Añadir producto';
		$this->_view->setCss(array('vendor/jquery.treeview'));
		$this->_view->setJs(array('vendor/jquery.treeview'));

		$datos['validador'] = $Val;
		$datos['errors'] = $Val->show_errors();
		$datos['page'] = 2;

		$this->viewMake('admin/catalogo/productos_add', $datos);
	}

	public function producto_update($producto_id)
	{
		Session::isAutenticado();

		try {
			$producto = App\Models\Product::findOrFail($producto_id);

			$Val = new App\Helpers\Validator();

			if ( App\Models\Product::validateUpdate($Val) )
			{
				$producto->producto_marca_id 			= $_POST['inputMarca'];
				$producto->producto_categoria_id 		= $_POST['inputCategoria'];
				$producto->producto_nombre 				= $_POST['inputNombre'];
				$producto->producto_descripcion_corta 	= $_POST['inputShortDescripcion'];
				$producto->producto_descripcion 		= $_POST['inputDescripcion'];
				$producto->producto_cantidad 			= $_POST['inputStock'];
				$producto->producto_precio 				= $_POST['inputPrecio'];
				$producto->producto_estado 				= $_POST['inputEstado'];

				$producto->save();

				Session::set("mensajeExito", "El producto <b>".$producto->producto_nombre."</b> ha sido modificado.");
				$this->redireccionar('admin/productos');
			}

			$datos['marcas'] = App\Models\Marca::where('producto_marca_estado', '!=', 'B')
				->orderBy('producto_marca_nombre')
				->get();
			$datos['categorias'] = App\Models\Category::where('producto_categoria_padre_id', 0)
				->where('producto_categoria_estado', '!=', 'B')
				->get();

			$this->_view->titulo      = 'Añadir producto';
			$this->_view->setCss(array('vendor/jquery.treeview'));
			$this->_view->setJs(array('vendor/jquery.treeview'));

			$datos['validador'] = $Val;
			$datos['errors'] = $Val->show_errors();
			$datos['page'] = 2;
			$datos['pr_page'] = 1;
			$datos['producto'] = $producto;

			$this->viewMake('admin/catalogo/producto_update', $datos);

		} catch (Exception $e) {
			$this->redireccionar('error');
		}
	}

	public function producto_update_img($producto_id)
	{
		Session::isAutenticado();

		try {
			$producto = App\Models\Product::findOrFail($producto_id);

			$Val = new App\Helpers\Validator();

			if ( App\Models\ProductImage::validate($Val) ) 
			{
				$file = $_FILES['inputArchivo'];
				$filename = $file['name'];
				$filename = App\Helpers\Utils::slug($filename, '_', '.'); //sanitize
				
				$alt 		= App\Classes\ImageService::generateAlt( $filename );
				$filename 	= App\Classes\ImageService::generateFileName( $filename );

			    //exportar thumbs
			    App\Classes\ImageService::exportImages($file, $filename);

				$cantidadImgs = $producto->images()->first();

				if( $cantidadImgs !== null ) 
				{
					//todas las imagenes a 'N'
					$is_portada = $_POST['inputPortada'];

					if ($is_portada === 'S')
					{
						App\Models\ProductImage::reset_imgs( $producto_id );
					}
				} 
				else 
				{				
					$is_portada = 'S';//Si es la primera imagen
				}

				$image = new App\Models\ProductImage();

				$image->producto_id = $producto_id;
				$image->producto_img_nombre = $filename;
				$image->producto_img_predeterminado = $is_portada;
				$image->producto_img_alt = $alt;

				$image->save();

				Session::set("mensajeExito", "Se ha agregado una nueva imagen.");
				$this->redireccionar('admin/producto_update_img/'.$producto_id);
			}

			$this->_view->titulo      = 'Imagenes del producto';
			$this->_view->setCss(array('vendor/jquery.treeview'));
			$this->_view->setJs(array('vendor/jquery.treeview',
				'common/helpers',
				'admin/catalogo'));

			$datos['validador'] = $Val;
			$datos['errors'] = $Val->show_errors();
			$datos['page'] = 2;
			$datos['pr_page'] = 2;
			$datos['producto'] = $producto;

			$datos['imagenes'] = $producto->images()->get();

			$this->viewMake('admin/catalogo/producto_update_img', $datos);

		} catch (Exception $e) {			
			$this->redireccionar('admin/productos');
		}
	}

	public function producto_img_delete($producto_id, $img_id)
	{
		Session::isAutenticado();

		try {
			$producto = App\Models\Product::findOrFail($producto_id);
			$imagen = App\Models\ProductImage::findOrFail($img_id);

			if ( $imagen->producto_img_predeterminado == 'S' )
			{
				App\Models\ProductImage::reset_imgs( $producto_id );

				$otherImg = $producto->images()->where('producto_img_id','!=', $img_id)->first();

				if ( $otherImg != null)
				{
					$otherImg->producto_img_predeterminado = 'S';
					$otherImg->save();
				}
			}			

			$filename = $imagen->producto_img_nombre;
			$imagen->delete();
			unlink(ROOT . "storage/uploads/thumb_tiny/" . $filename);
			unlink(ROOT . "storage/uploads/thumb_medium/" . $filename);
			unlink(ROOT . "storage/uploads/thumb/" . $filename);

			Session::set("mensajeExito", "Se ha eliminado una imagen.");
			$this->redireccionar('admin/producto_update_img/'.$producto_id);	
			
		} catch (Exception $e) {
			$this->redireccionar('error');
		}		
	}

	public function change_img_predeterminada($producto_id, $img_id)
	{
		Session::isAutenticado();

		try {
			$producto = App\Models\Product::findOrFail($producto_id);
			$imagen = App\Models\ProductImage::findOrFail($img_id);

			App\Models\ProductImage::reset_imgs( $producto_id );

			$imagen->producto_img_predeterminado = 'S';
			$imagen->save();

			Session::set("mensajeExito", "Nuevo imagen por defecto.");
			$this->redireccionar('admin/producto_update_img/'.$producto_id);
			
		} catch (Exception $e) {
			$this->redireccionar('admin/productos');
		}
	}

	public function producto_delete( $producto_id ) 
	{
		Session::isAutenticado();

		try {
			$producto = App\Models\Product::findOrFail($producto_id);

			$nombre = $producto->producto_nombre;
			$producto->producto_estado = 'B';
			$producto->save();

			Session::set("mensajeExito", "Se eliminado el producto ".$nombre.".");
			$this->redireccionar('admin/productos');

		} catch (Exception $e) {
			$this->redireccionar('admin/productos');
		}
	}

//---------------- Ordenes ---------------------//

	public function ordenes()
	{
		Session::isAutenticado();

		$datos['ordenes'] = App\Models\Order::estado('Pedido')
			->estado('Esperando pago')
			->get();
		
		$this->_view->titulo = "Ordenes";
		$this->_view->setCss(array('admin/orden_style'));
		$this->_view->setJs(array(
			'admin/fn_ordenes',
			'vendor/datatable1.10.6/jquery.dataTables.min'));
		$datos['page'] = 1;

		$this->viewMake('admin/ordenes/ordenes', $datos);
	}

	public function ordenes_pagadas()
	{
		Session::isAutenticado();

		$datos['ordenes'] = App\Models\Order::estado('Pago aceptado')->get();
		
		$this->_view->titulo = "Ordenes";
		$this->_view->setCss(array('admin/orden_style'));
		$this->_view->setJs(array(
			'admin/fn_ordenes',
			'vendor/datatable1.10.6/jquery.dataTables.min'));
		$datos['page'] = 2;

		$this->viewMake('admin/ordenes/ordenes', $datos);
	}

	public function ordenes_enviadas()
	{
		Session::isAutenticado();

		$datos['ordenes'] = App\Models\Order::estado('Enviado')->get();
		
		$this->_view->titulo = "Ordenes";
		$this->_view->setCss(array('admin/orden_style'));
		$this->_view->setJs(array(
			'admin/fn_ordenes',
			'vendor/datatable1.10.6/jquery.dataTables.min'));
		$datos['page'] = 3;

		$this->viewMake('admin/ordenes/ordenes', $datos);
	}

	public function ordenes_finalizadas()
	{
		Session::isAutenticado();

		$datos['ordenes'] = App\Models\Order::estado('Recibido')->get();
		
		$this->_view->titulo = "Ordenes";
		$this->_view->setCss(array('admin/orden_style'));
		$this->_view->setJs(array(
			'admin/fn_ordenes',
			'vendor/datatable1.10.6/jquery.dataTables.min'));
		$datos['page'] = 4;

		$this->viewMake('admin/ordenes/ordenes', $datos);
	}

	public function ordenes_canceladas()
	{
		Session::isAutenticado();

		$datos['ordenes'] = App\Models\Order::estado('Cancelado')->get();
		
		$this->_view->titulo = "Ordenes";
		$this->_view->setCss(array('admin/orden_style'));
		$this->_view->setJs(array(
			'admin/fn_ordenes',
			'vendor/datatable1.10.6/jquery.dataTables.min'));
		$datos['page'] = 5;

		$this->viewMake('admin/ordenes/ordenes', $datos);
	}

	public function orden($orden_id)
	{
		Session::isAutenticado();

		try {
			$o = App\Models\Order::findOrFail($orden_id);			
			
			if ( isset($_POST['orden_estado']) )
			{			
				$estado = App\Classes\OrdenService::get_estado($_POST['orden_estado']);

				//actualizo estado en tabla ordenes
				$fecha = Capsule::raw('now()');
				$o->ord_estado_fecha = $fecha;
				$o->ord_estado = $estado;

				$o->save();
				//agrego nueva historia a tabla historial
				$oh = new App\Models\OrderHistory();
				$oh->ord_id = $orden_id;
				$oh->historia_fecha = $fecha;
				$oh->historia_accion = 'Nuevo estado';
				$oh->historia_descripcion = $estado;

				$oh->save();
				
				$this->redireccionar('admin/ordenes');
			}

			//datos del cliente en cuestion
			$datos['u'] = $o->usuario()->first();
			//datos detalle de orden
			$datos['detalles'] = App\Models\OrderDetail::where('ord_id', $orden_id)->get();

			$datos['estados'] = array(
					array('id' => '1',
						'nombre' => 'Pedido'
						),
					array('id' => '2',
						'nombre' => 'Esperando pago'
						),
					array('id' => '3',
						'nombre' => 'Pago aceptado'
						),
					array('id' => '4',
						'nombre' => 'Enviado'
						),
					array('id' => '5',
						'nombre' => 'Recibido'
						),
					array('id' => '6',
						'nombre' => 'Cancelado'
						),
				);

			$datos['o'] = $o;

			$this->_view->titulo = "Orden ".Underscore\Types\Number::paddingLeft($o->ord_id, 5);
			$this->_view->setCss(array('admin/orden_style'));

			$this->viewMake('admin/ordenes/orden', $datos);	

		} 
		catch (Exception $e) 
		{
			$this->redireccionar('error');
		};		
	}

	public function orden_historia($orden_id)
	{
		Session::isAutenticado();

		try 
		{
			$o = App\Models\Order::findOrFail($orden_id);
			$oh = $o->historias()->orderBy('historia_fecha', 'desc')->get();

			$datos['o'] = $o;
			$datos['oh'] = $oh;

			$this->_view->titulo = "Historial de la orden";
			$this->_view->setCss(array('admin/orden_style'));

			$this->viewMake('admin/ordenes/orden_historia', $datos);	
		} 
		catch (Exception $e) 
		{
			$this->redireccionar('error');
		};		
	}

	public function orden_correo($orden_id)
	{
		Session::isAutenticado();

		try 
		{
			$o = App\Models\Order::findOrFail($orden_id);
		} 
		catch (Exception $e) 
		{
			$this->redireccionar('error');
		}

		if ( isset($_POST['inputMensaje']) )
		{
			if ( ! empty($_POST['inputMensaje']) )
			{
				$mensaje = $_POST['inputMensaje'];
				$oh = new App\Models\OrderHistory();

				$oh->ord_id = $o->ord_id;
				$oh->historia_fecha = Capsule::raw('now()');
				$oh->historia_accion = 'Notificación al cliente';
				$oh->historia_descripcion = $mensaje;

				$oh->save();

				//Enviar correo
				$u = $o->usuario()->first();

				$data = array(
					'id' => $o->ord_id,
			    	'name' => $u->us_nombre.' '.$u->us_apellido,	
			    	'message' => $mensaje
			    );

			    /*$html = App\Helpers\Email::get_template('new_notification', $data);
			    $Mailer = new PHPMailer();
			    $subject = 'Notificación de estado de tu pedido';

			    App\Helpers\Email::send($u->us_correo, $html, $Mailer, $subject);*/

				Session::set("mensajeExito", "El mensaje se ha enviado al correo electrónico del cliente.");
				$this->redireccionar('admin/orden_historia/'.$o->ord_id);
			}			
		}

		$datos['o'] = $o;

		$this->_view->titulo = "Hablar con el cliente";
		$this->viewMake('admin/ordenes/orden_correo', $datos);
		
	}

	public function orden_nota($orden_id)
	{
		Session::isAutenticado();

		try 
		{
			$o = App\Models\Order::findOrFail($orden_id);

			if ( isset($_POST['inputNota']) )
			{
				if ( ! empty($_POST['inputNota']) )
				{
					//$Orden->insert_nota($orden_id, $_POST['inputNota']);
					$oh = new App\Models\OrderHistory();

					$oh->ord_id = $o->ord_id;
					$oh->historia_fecha = Capsule::raw('now()');
					$oh->historia_accion = 'Nota';
					$oh->historia_descripcion = $_POST['inputNota'];

					$oh->save();

					Session::set("mensajeExito", "Se ha añadido una nueva nota.");
					$this->redireccionar('admin/orden_historia/'.$o->ord_id);
				}			
			}

			$datos['o'] = $o;

			$this->_view->titulo = "Agregar una nota";
			$this->viewMake('admin/ordenes/orden_nota', $datos);
		} 
		catch (Exception $e) 
		{
			$this->redireccionar('error');
		};
	}

//---------------- Clientes ---------------------//

	public function clientes()
	{
		Session::isAutenticado();

		$datos['clientes'] = App\Models\User::all();
		$this->_view->titulo = "Clientes en SaltaShop";

		$this->_view->setJs(array(
			'admin/fn_clientes',
			'vendor/datatable1.10.6/jquery.dataTables.min'));
		$this->viewMake('admin/clientes/clientes', $datos);
	}

	public function cliente($cliente_id)
	{
		Session::isAutenticado();

		try {
			$u = App\Models\User::findOrFail($cliente_id);	
		} catch (Exception $e) {
			$this->redireccionar('error');
		}

		$datos['u'] = $u;
		$datos['ordenes'] = $u->ordenes()->get();
		
		$this->_view->titulo = "Cliente en SaltaShop";
		$this->_view->setJs(array(
			'admin/fn_clientes',
			'vendor/datatable1.10.6/jquery.dataTables.min'));
		$this->_view->setCss(array('admin/orden_style'));
		$this->viewMake('admin/clientes/cliente', $datos);
	}

//---------------- Empleados -----------------------//

	public function empleados()
	{
		Session::isAutenticado();
		Session::soloAdmin();

		$datos['operadores'] = App\Models\Operador::all();
		$this->_view->titulo = "Empleados en SaltaShop";
		$this->_view->setJs(array(
			'admin/fn_empleados',
			'vendor/datatable1.10.6/jquery.dataTables.min'));

		$this->viewMake('admin/empleados/index', $datos);
	}

	public function add_empleado()
	{
		Session::isAutenticado();
		Session::soloAdmin();

		$datos['genero'] = (Session::get('genero')) ? Session::show('genero') : '';
		$datos['rol'] = (Session::get('rol')) ? Session::show('rol') : '';

		$this->_view->titulo = "Añador empleado en SaltaShop";
		$this->viewMake('admin/empleados/add', $datos);
	}

	public function store_empleado()
	{
		Session::isAutenticado();
		Session::soloAdmin();

		if ( $_SERVER['REQUEST_METHOD'] != 'POST' )
		{
			$this->redireccionar('admin/empleados');
		}

		$val = new App\Helpers\Validator();

		if ( App\Classes\EmpleadoService::validar($val) )
		{
			App\Classes\EmpleadoService::store();

			Session::set("mensajeExito", "Se ha añadido un nuevo empleado.");
			$this->redireccionar('admin/empleados');
		}
		
		Session::set('errors', $val->show_errors());

		Session::set('nombre', $_POST['nombre']);
		Session::set('apellido', $_POST['apellido']);
		Session::set('dni', $_POST['dni']);
		Session::set('genero', $_POST['genero']);
		Session::set('correo', $_POST['correo']);
		Session::set('rol', $_POST['rol']);

		$this->redireccionar('admin/add_empleado');
	}

	public function show_empleado($id)
	{
		Session::isAutenticado();

		try {
			$emp = App\Models\Operador::findOrFail($id);	
		} catch (Exception $e) {
			$this->redireccionar('error');
		}

		$datos['emp'] = $emp;
		$this->_view->titulo = "Ver empleado en SaltaShop";
		$this->viewMake('admin/empleados/show', $datos);
	}

	public function edit_empleado($id)
	{
		Session::isAutenticado();
		Session::soloAdmin();

		try {
			$emp = App\Models\Operador::findOrFail($id);	
		} catch (Exception $e) {
			$this->redireccionar('error');
		}

		$val = new App\Helpers\Validator();

		if ( App\Classes\EmpleadoService::validar_update($val) )
		{
			App\Classes\EmpleadoService::update($id);

			Session::set("mensajeExito", "Se ha editado un empleado.");
			$this->redireccionar('admin/empleados');
		}		

		$datos['emp'] = $emp;
		$datos['val'] = $val;
		$datos['errors'] = $val->show_errors();

		$this->_view->titulo = "Ver empleado en SaltaShop";
		$this->viewMake('admin/empleados/edit', $datos);
	}

	public function edit_password($id)
	{
		Session::isAutenticado();
		Session::soloAdmin();

		try {
			$emp = App\Models\Operador::findOrFail($id);	
		} catch (Exception $e) {
			$this->redireccionar('error');
		}

		$val = new App\Helpers\Validator();

		if ( App\Classes\EmpleadoService::validate_password($val, $emp->op_password) )
		{
			App\Classes\EmpleadoService::update_pass($id);

			Session::set("mensajeExito", "Se ha cambiado la contraseña.");
			$this->redireccionar('admin/empleados');
		}

		$datos['emp'] = $emp;
		$datos['val'] = $val;
		$datos['errors'] = $val->show_errors();
		$datos['id'] = $id;

		$this->_view->titulo = "Ver empleado en SaltaShop";
		$this->viewMake('admin/empleados/edit_password', $datos);
	}

//---------------- Reportes --------------------- //

	public function reportes($filter = '')
	{
		Session::isAutenticado();
		Session::soloAdmin();

		$this->_view->titulo = "Reportes en SaltaShop";

		$this->_view->setJs(array('common/helpers'));
		$this->_view->setJs(array('vendor/highcharts/highcharts'));
		$this->_view->setJs(array('vendor/highcharts/exporting'));
		$this->_view->setJs(array('vendor/highcharts/canvas-tools'));
		$this->_view->setJs(array('admin/reportes'));

		$datos['page'] = 1;

		$this->viewMake('admin/reportes/reportes', $datos);
	}

	public function month() 
	{
		Session::isAutenticado();
		Session::soloAdmin();

		$orders = App\Models\Order::whereRaw("MONTH(ord_fecha) = MONTH(now())")
					->select(Capsule::raw('date(ord_fecha) as fecha'),
						Capsule::raw('sum(ord_total) as total_ventas'),
						Capsule::raw('count(ord_id) as cantidad_ordenes'),
						Capsule::raw('sum(ord_cantidad_vendida) as cantidad_vendida'))
					->where('ord_estado', '!=', 'Cancelado')
					->orderBy('fecha')
					->groupBy('fecha')					
					->get();

		$Fechas = new App\Helpers\Fechas();
		$fechas = $Fechas->getDatesInMonth();

		$report = App\Classes\ReportService::build_report($fechas, $orders->toArray());

		echo json_encode($report);
	}

	public function day7()
	{
		Session::isAutenticado();
		Session::soloAdmin();

		$orders = App\Models\Order::whereRaw("DATEDIFF(now(), ord_fecha) < ?", [7])
					->select(Capsule::raw('date(ord_fecha) as fecha'),
						Capsule::raw('sum(ord_total) as total_ventas'),
						Capsule::raw('count(ord_id) as cantidad_ordenes'),
						Capsule::raw('sum(ord_cantidad_vendida) as cantidad_vendida'))
					->where('ord_estado', '!=', 'Cancelado')
					->orderBy('fecha')
					->groupBy('fecha')
					->get();

		$Fechas = new App\Helpers\Fechas();
		$fechas = $Fechas->get_last_days(7);

		$report = App\Classes\ReportService::build_report($fechas, $orders->toArray());

		echo json_encode($report);
	}

	public function last_month() 
	{
		Session::isAutenticado();
		Session::soloAdmin();

		$orders = App\Models\Order::whereRaw("MONTH(ord_fecha) = MONTH(now()) - 1")
					->where('ord_estado', '!=', 'Cancelado')					
					->select(Capsule::raw('date(ord_fecha) as fecha'),
						Capsule::raw('sum(ord_total) as total_ventas'),
						Capsule::raw('count(ord_id) as cantidad_ordenes'),
						Capsule::raw('sum(ord_cantidad_vendida) as cantidad_vendida'))
					->orderBy('fecha')
					->groupBy('fecha')
					->get();

		$Fechas = new App\Helpers\Fechas();
		$fechas = $Fechas->getDatesInMonth( $Fechas->getEndOfLastMonth() );

		$report = App\Classes\ReportService::build_report($fechas, $orders->toArray());
		
		echo json_encode($report);
	}

	public function year() 
	{
		Session::isAutenticado();
		Session::soloAdmin();

		$orders = App\Models\Order::whereRaw("YEAR(ord_fecha) = YEAR(now())")
					->where('ord_estado', '!=', 'Cancelado')
					->select(Capsule::raw('MONTH(ord_fecha) as fecha'),
						Capsule::raw('sum(ord_total) as total_ventas'),
						Capsule::raw('count(ord_id) as cantidad_ordenes'),
						Capsule::raw('sum(ord_cantidad_vendida) as cantidad_vendida'))
					->orderBy('fecha')
					->groupBy('fecha')					
					->get();

		$Fechas = new App\Helpers\Fechas();
		$fechas = $Fechas->get_months();

		$report = App\Classes\ReportService::build_report($fechas, $orders->toArray());
		
		echo json_encode($report);
	}

	public function stock($filter = 'low_stock')
	{
		Session::isAutenticado();
		Session::soloAdmin();

		if ($filter == 'out_stock') 
		{
			$this->out_stock();
		} 
		else 
		{
			$this->low_stock();
		}
	}

	public function low_stock()
	{
		Session::isAutenticado();
		Session::soloAdmin();

		$products = App\Models\Product::where('producto_cantidad', '<=', 7)
			->where('producto_cantidad', '>', 0)
			->get();
		
		$datos['products'] = $products;
		$datos['page'] = 2;
		$datos['stock_menu'] = 1;

		$this->_view->titulo = "Reportes en SaltaShop";
		$this->viewMake('admin/reportes/low_stock', $datos);
	}

	public function out_stock()
	{
		Session::isAutenticado();
		Session::soloAdmin();

		$products = App\Models\Product::where('producto_cantidad', 0)->get();
		
		$datos['products'] = $products;
		$datos['page'] = 2;
		$datos['stock_menu'] = 2;

		$this->_view->titulo = "Reportes en SaltaShop";
		$this->viewMake('admin/reportes/out_stock', $datos);
	}

	public function build_pdf()
	{
		Session::isAutenticado();
		Session::soloAdmin();

		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

			$data = array(
				'src' 				=> $_POST["imgSrc"],
				'categories' 		=> explode(',', $_POST['categories']),
				'seriesY'			=> explode(',', $_POST['seriesY']),
				'cantidad_ordenes'	=> explode(',', $_POST['cantidadOrdenes']),
				'cantidad_vendida'	=> explode(',', $_POST['cantidadVendida']),

				'total'				=> App\Helpers\Utils::to_pesos($_POST['totalD']),
				'average'			=> App\Helpers\Utils::to_pesos($_POST['avg']),
				'total_ordenes'		=> $_POST['cantidadOrdenesD'],
				'total_productos'	=> $_POST['cantidadVendidaD'],
				'subtitle'			=> $_POST['title']
			);

			App\Classes\ReportService::build_pdf( $data );
			
		} else {
			die("Ups! ocurrio un problema.");
		}
	}

	public function build_csv()
	{
		Session::isAutenticado();
		Session::soloAdmin();

		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

			$data = array(
				'categories' 		=> explode(',', $_POST['categories']),
				'seriesY'			=> explode(',', $_POST['seriesY']),
				'cantidad_ordenes'	=> explode(',', $_POST['cantidadOrdenes']),
				'cantidad_vendida'	=> explode(',', $_POST['cantidadVendida']),
				'subtitle'			=> $_POST['title']
			);

			App\Classes\ReportService::build_csv( $data );

		} else {
			die("Ups! ocurrio un problema.");
		}
	}

//---------------- Panel ---------------------//

	public function mi_cuenta()
	{
		Session::isAutenticado();

		try {
			$emp = App\Models\Operador::findOrFail(Session::get('operador')['id']);	
		} catch (Exception $e) {
			$this->redireccionar('error');
		}

		$datos['emp'] = $emp;
		$this->_view->titulo = "Mi cuenta";
		$this->viewMake('admin/panel/index', $datos);
	}

	public function edit_myPassword()
	{
		Session::isAutenticado();

		try {
			$emp = App\Models\Operador::findOrFail(Session::get('operador')['id']);	
		} catch (Exception $e) {
			$this->redireccionar('error');
		}

		$val = new App\Helpers\Validator();

		if ( App\Classes\EmpleadoService::validar_edit_password($val, $emp->op_password) )
		{
			App\Classes\EmpleadoService::update_pass(Session::get('operador')['id']);

			Session::set("mensajeExito", "Se ha cambiado la contraseña.");
			$this->redireccionar('admin/mi_cuenta');
		}

		$datos['emp'] = $emp;
		$datos['val'] = $val;
		$datos['errors'] = $val->show_errors();

		$this->_view->titulo = "Ver empleado en SaltaShop";
		$this->viewMake('admin/panel/edit_password', $datos);
	}
}
?>