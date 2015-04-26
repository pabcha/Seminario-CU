<?php 
namespace App\Classes;

class OrdenService
{
	public static function get_estado($id)
	{
		switch ($id) 
		{
			case '1':
				return 'Pedido';
				break;
			case '2':
				return 'Esperando pago';
				break;
			case '3':
				return 'Pago aceptado';
				break;
			case '4':
				return 'Enviado';
				break;
			case '5':
				return 'Recibido';
				break;
			case '6':
				return 'Cancelado';
				break;				
			default:
				//codigo no valido
				$this->redireccionar('error');
				break;
		}
	}
}