<?php 
namespace App\Helpers;

use Carbon\Carbon;

class Fechas
{
	public function __construct()
	{
		date_default_timezone_set('America/Buenos_Aires');
	}

	/**
	 * Retorna el ultimo dia del mes anterior
	*/
	public function getEndOfLastMonth()
	{
		return Carbon::now()->subMonth()->endOfMonth()->toDateString();
	}

	/**
	 * Obtiene fechas de los ultimos x dias
	*/
	public function get_last_days($days)
	{
		$today = Carbon::now();
		$daysA = [];

		while ( $days > 0)
		{
			array_push($daysA, $today->toDateString());
			$today->subDay();
			$days--;
		}

		return array_reverse( $daysA );
	}

	/**
	 * Obtiene los dias transcurridos en el mes. Desde el principio de mes hasta la fecha señalada
	*/
	public function getDatesInMonth($end = '')
	{
		$end = $end ? Carbon::parse( $end ) : Carbon::now();
		$aux = $end->copy();
		$fechas = [];

		while ( $end->month == $aux->month) 
		{
			array_push($fechas, $aux->toDateString());
			$aux->subDay();
		}

		return array_reverse( $fechas );
	}

	/**
	 * Obtiene los meses transcurridos en el año, incluido el actual
	*/
	public function get_months($date = '')
	{
		$date = $date ? Carbon::parse( $date ) : Carbon::now();;
		$aux = $date->copy();
		$months = [];

		while ( $date->year == $aux->year ) 
		{
			array_push($months, $aux->month);
			$aux->subMonth();
		}

		return array_reverse( $months );
	}

	
	public function cambiaf_a_mysql($fecha)
	{ 
	   	ereg("([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha); 
	   	$lafecha = $mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
	   	return $lafecha; 
	}
}