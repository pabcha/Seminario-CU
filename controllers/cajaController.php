<?php

use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderHistory;
use App\Models\Product;
use Illuminate\Database\Capsule\Manager as DB;
use App\Classes\Carrito;
use App\Helpers\Email;

use App\Classes\CajaService;

class cajaController extends Controller
{
	public function __construct()
	{
		parent::__construct();		
	}

	private function viewMake($str, $data = array())
	{
		$this->_view->renderizar('layout/default/header');
		$this->_view->renderizar($str, $data);
		$this->_view->renderizar('layout/default/footer');
	}

	public function index()
	{
		if (Session::get('usuario')['autenticado']) 
		{
			$this->redireccionar('caja/pago_y_envio');
			exit;
		}		

		$this->_view->titulo = 'Checkout - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias'));
		$this->viewMake('caja/index');
	}

	public function logear()
	{
		if (Session::get('usuario')['autenticado']) 
		{
			$this->redireccionar('caja/pago_y_envio');
		}

		if ( $_SERVER['REQUEST_METHOD'] != 'POST' )
		{
			$this->redireccionar('caja/pago_y_envio');
		}

		$u = User::isUser($_POST['inputCorreo'], md5($_POST['inputPassword']))
			->active()
			->first();

		if ( !empty($u) ) 
		{
			$_SESSION['usuario'] = array(
				'autenticado' => true,
				'nombre' => $u->us_nombre,
				'apellido' => $u->us_apellido,
				'correo' => $u->us_correo,
				'id' => $u->us_id,
				'tiempo' => time(),
			);

			$this->redireccionar('caja/pago_y_envio');
			exit;			
		}

		Session::set('correo', $_POST['inputCorreo']);
		Session::set('errors', "Usuario/Contraseña incorrectos.");
		$this->redireccionar('caja');
	}

	public function pago_y_envio()
	{
		if ( !Session::get('usuario')['autenticado'] ) 
		{
			$this->redireccionar('caja');
			exit;
		}

		$this->_view->titulo = 'Pago y Envio - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias'));
		$this->_view->setJs(array('front/fn_caja'));

		$datos['u'] = User::find( Session::get('usuario')['id'] );
		$datos['correo'] = Session::get('usuario')['correo'];
		$datos['total'] = Session::get('carrito')['total']*100;//centavos
		$datos['descripcion'] = '';

		foreach (Session::get('carrito')['productos'] as $p) 
		{
			$datos['descripcion'] .= $p['producto_nombre'].' x '.$p['cantidad'].";";
		}

		$this->viewMake('caja/pago_y_envio', $datos);
	}

	public function confirmacion()
	{
		if ( !Session::get('usuario')['autenticado'] ) 
		{
			$this->redireccionar('caja');
			exit;
		}

		if ( !isset($_SESSION['temp']) OR !isset($_SESSION['carrito']) )
		{
			$this->redireccionar('index');
			exit;
		}		

		$datos['id'] = Session::get('temp')['orden_id'];
		$datos['ps'] = Carrito::get_productos();
		$datos['carrito_total'] = App\Classes\Carrito::get_total();

		//personal info
		$u = User::find( Session::get('usuario')['id'] );
		$datos['nombre'] = $u->us_nombre.' '.$u->us_apellido;
		$datos['telefono'] = $u->us_telefono;
		$datos['correo'] = $u->us_correo;
		$datos['domicilio'] = $u->us_domicilio;
		$datos['pago'] = Session::get('temp')['forma_pago'];

		//send an email
	    $html = Email::get_template('new_order', $datos);
	    $Mailer = new PHPMailer();
	    $subject = 'Confirmacion de orden en saltashop';

	    Email::send($u->us_correo, $html, $Mailer, $subject);


		//finalizado la insercion el carrito se tiene que vaciar
		Session::destroy('carrito');
		Session::destroy('temp');

		$this->_view->titulo = 'Felicidades - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias',
			'front/estilos_congrats'));
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		
		$this->_view->renderizar('caja/confirmacion', $datos);
	}

	public function cobrar_transferencia()
	{
		if ( !Session::get('usuario')['autenticado'] ) 
		{
			$this->redireccionar('caja');
			exit;
		}

		if ( Session::get('carrito')['cobrado'] )
		{
			$this->redireccionar('index');
			exit;
		}

		$forma_pago = 'Transferencia bancaria';
		$orden_id = CajaService::saveOrder($forma_pago);

		Session::get('carrito')['cobrado'] = true;
		Session::set('temp', array(
			'orden_id' => $orden_id,
			'forma_pago' => $forma_pago
		));

		$this->redireccionar('caja/confirmacion');
	}

	public function cobrar_stripe()
	{
		if ( !Session::get('usuario')['autenticado'] ) 
		{
			$this->redireccionar('caja');
			exit;
		}

		if ( Session::get('carrito')['cobrado'] )
		{
			$this->redireccionar('index');
			exit;
		}

		if ( isset($_POST['stripeToken']) )
		{
			$correo = Session::get('usuario')['correo'];
			$total = Session::get('carrito')['total']*100;//centavos
			$token = $_POST['stripeToken'];
			
			\Stripe\Stripe::setApiKey(stripe_secret);

			try 
			{
				\Stripe\Charge::create(array(
				  "amount" => $total,
				  "currency" => "ARS",
				  "source" => $token, // obtained with Stripe.js
				  "description" => "Cobro para ".$correo
				));

				//cobrar en mi db
				$forma_pago = 'Tarjeta de credito - Stripe';				
				$orden_id = CajaService::saveOrder($forma_pago);

				//ya esta cobrado
				Session::get('carrito')['cobrado'] = true;
				Session::set('temp', array(
					'orden_id' => $orden_id,
					'forma_pago' => $forma_pago
				));

				$this->redireccionar('caja/confirmacion');
			} 
			catch(\Stripe\Error\Card $e) {
			  $this->redireccionar('error/bad');
			} catch (\Stripe\Error\InvalidRequest $e) {
			  $this->redireccionar('error/bad');
			} catch (\Stripe\Error\Authentication $e) {
			  $this->redireccionar('error/bad');
			} catch (\Stripe\Error\ApiConnection $e) {
			  $this->redireccionar('error/bad');
			} catch (\Stripe\Error\Base $e) {
			  $this->redireccionar('error/bad');
			} catch (Exception $e) {
			  $this->redireccionar('error/bad');
			}
		}		
	}
}