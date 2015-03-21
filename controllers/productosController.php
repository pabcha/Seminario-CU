<?php
class productosController extends Controller
{
	public function __construct()
	{
		parent::__construct();	
	}

	public function index()
	{
		$datos['Producto'] = $this->loadModel('producto');
		$Categoria = $this->loadModel('categoria');

		$datos['productos'] = $datos['Producto']->getProductosDestacados(9);
		$datos['categorias'] = $Categoria->getActiveSubCategorias(0);
		$datos['Categoria'] = $Categoria;

		$this->_view->titulo = 'Tienda - Salta Shop';

		$this->_view->setCss( array('front/estilos_categorias',
			'vendor/jquery-ui-1.10.4.custom.min'));
		$this->_view->setJs( array('front/fn_catalogo',
			'vendor/jquery-ui-1.10.4.custom.min'));
						
		$this->_view->renderizar('layout/default/header');
		$this->_view->renderizar('productos/index', $datos);
		$this->_view->renderizar('layout/default/footer');
	}

	public function producto($producto_id)
	{
		$Producto          = $this->loadModel('producto');
		$datos['producto'] = $Producto->getProductoById( $producto_id );
				
		if( ! $datos['producto'] ) 
		{
			$this->redireccionar('error');
		}
		//iniciando datos
		$datos['imagenes'] = $Producto->getProductoImagenes( $producto_id );

		$Categoria = $this->loadModel('categoria');		
		$datos['categorias'] = $Categoria->getActiveSubCategorias(0);
		$datos['Categoria'] = $Categoria;
		//$datos['categorias'] = $Categoria->getSubCategorias(0,true);

		$this->_view->titulo = 'Salta Shop';
		/*$this->_view->setCss( array('estilos_categorias', 'flexslider') );
		$this->_view->setJs( array('fn_producto', 'jquery.flexslider-min') );*/

		$this->_view->setCss( array('front/estilos_categorias',
			'vendor/flexslider'));
		$this->_view->setJs( array('front/fn_producto',
			'vendor/jquery.flexslider-min'));
						
		$this->_view->renderizar('layout/default/header');
		$this->_view->renderizar('productos/producto', $datos);
		$this->_view->renderizar('layout/default/footer');
	}

	public function add_producto()
	{
		//var_dump($_POST);
		/*Session::destroy('carrito');
		exit;*/
		$producto_id = $_POST['inputIdProducto'];
		
		$Producto = $this->loadModel('producto');
		$product = $Producto->getProductoById( $producto_id );

		
		//quitando atributos no utiles
		unset($product['descripcion_corta']);
		unset($product['descripcion']);
		unset($product['estado']);
		$product['cantidad'] = intval($_POST['inputCantidad']);
		$product['imagen'] = $Producto->getImagenPredeterminada( $product['id'] )['nombre'];

		$Carro = $this->loadModel('carrito');
		$Carro->add_producto( $product );
		//var_dump($_SESSION['carrito']);
		//var_dump($product);
		//exit;
		

		//Session::set("mensaje_exito", "El producto ha sido agregado al carrito!");
		$this->redireccionar('productos/producto/'.$producto_id);		
		exit;
	}	

	public function categoria($categoria_id, $flag = 0, $page = 1)
	{
		if ( $flag == 1) 
		{
			Session::destroy('catalogoDatos');
		}		

		$datos['Producto'] = $this->loadModel('producto');
		$Categoria = $this->loadModel('categoria');				
		$categoria = $Categoria->getCategoriaById( $categoria_id );
		
		if( ! $categoria ) 
		{
			$this->redireccionar('error');
		}

		$datos['categoria_id'] = $categoria_id;
		$datos['categoriaNombre'] = $categoria['nombre'];

		//Modelo catalogo para vista
		$Catalogo = $this->loadModel('catalogoView');
		$datos['productos'] = $Catalogo->getProductos($categoria_id);
		//$datos['productos'] = $datos['Producto']->filtrarProductos(9, $categoria_id, $datos['inputMarcaId']);

		//Tiene subcategorias?
		$datos['subcategorias'] = $Categoria->getActiveSubCategorias( $categoria_id );
		
		$datos['productosTotal'] = $Catalogo->get_cantidad();

		$datos['total_paginas'] = $Catalogo->total_pages();
		$datos['page'] = $page;
		
		//$datos['sql'] = $Catalogo->get_sql();

		$datos['Catalogo'] = $Catalogo;
		//$datos['productosTotal'] = $datos['Producto']->countProductosCategoria( $categoria_id );

		//Para menu de categorias
		$datos['categorias'] = $Categoria->getActiveSubCategorias(0);
		$datos['Categoria'] = $Categoria;

		//Cargo marcas asociadas a esta categoria
		$datos['marcas'] = $Categoria->getMarcas($categoria_id);

		$this->_view->titulo = $categoria['nombre'].' en Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias',
			'vendor/jquery-ui-1.10.4.custom.min'
		));
		$this->_view->setJs(array('front/fn_catalogo',
			'vendor/jquery-ui-1.10.4.custom.min'
		));
		/*$this->_view->setCss( array('estilos_categorias') );
		$this->_view->setCss(array('jquery-ui-1.10.4.custom.min'), true );*/
		/*$this->_view->setJs( array('fn_catalogo') );
		$this->_view->setJs( array('jquery-ui-1.10.4.custom.min'), true );*/
						
		$this->_view->renderizar('layout/default/header');
		$this->_view->renderizar('productos/categoria', $datos);
		$this->_view->renderizar('layout/default/footer');
	}

	public function filtrarXmarca($marca_id, $categoria_id)
	{		
		$Marca = $this->loadModel('marcas');
		$marca = $Marca->getActiveMarcaById($marca_id);

		if ( ! $marca )
		{
			$this->redireccionar('error');
		}

		$Catalogo = $this->loadModel('catalogoView');
		$Catalogo->set_marca( $marca_id );

		//reiniciamos paginador!
		$Catalogo->set_limit(0);

		$this->redireccionar('productos/categoria/'.$categoria_id);		
		exit;
	}

	public function filtrarXprecio($minimo, $maximo, $categoria_id)
	{	
		$Catalogo = $this->loadModel('catalogoView');
		
		//reiniciamos paginador!
		$Catalogo->set_limit(0);

		$Catalogo->set_precio($minimo, $maximo);

		$this->redireccionar('productos/categoria/'.$categoria_id);	
		exit;
	}

	public function ordenar($orden, $categoria_id)
	{
		$Catalogo = $this->loadModel('catalogoView');
		//reiniciamos paginador!
		$Catalogo->set_limit(0);
		switch ((int)$orden) 
		{
			case 1:
				$Catalogo->set_orden("producto_nombre", "ASC");				
				$this->redireccionar('productos/categoria/'.$categoria_id);	
				break;
			case 2:
				//Menor precio
				$Catalogo->set_orden("producto_precio", "ASC");
				$this->redireccionar('productos/categoria/'.$categoria_id);	
				break;
			case 3:
				//Mayor Precio
				$Catalogo->set_orden("producto_precio", "DESC");
				$this->redireccionar('productos/categoria/'.$categoria_id);
				break;			
			default:
				$this->redireccionar('error');
				break;
		}

		exit;
	}

	public function pagina($categoria_id, $page)
	{
		$page = intval($page);
		
		//verificar que es entero
		if ( $page === 0 )
		{
			$this->redireccionar('error');
		}

		$Catalogo = $this->loadModel('catalogoView');
		$total_pages = $Catalogo->total_pages();

		//numero de pagina no existe
		if ($page > $total_pages ) 
		{			
			$this->redireccionar('error');
		}
		
		$per_page = $Catalogo->per_page;
		$start = ($page - 1) * $per_page;
		$Catalogo->set_limit($start);

		//echo 'productos/categoria/'.$categoria_id.'/2/'.$page;

		$this->redireccionar('productos/categoria/'.$categoria_id.'/2/'.$page);	
		exit;
	}
}
?>