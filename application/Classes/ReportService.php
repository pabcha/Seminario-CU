<?php 
namespace App\Classes;

use Underscore\Types\Arrays;
use Carbon\Carbon;
use \DOMPDF;

class ReportService
{
	protected static $keys = ['fecha',
		 'total_ventas', 
		 'cantidad_ordenes', 
		 'cantidad_vendida'];
	
	public static function build_report($dates, $orders)
	{
		$pluck = Arrays::pluck($orders, 'fecha');
		$keys = static::$keys;

		$report = Arrays::each($dates, function ($value) use ($keys, $pluck, &$orders) {
			
			return ( in_array($value, $pluck) ) ? 
				array_combine($keys, array_values(array_shift($orders))) :
				array_combine($keys, [$value, 0, 0, 0]);

		});

		return $report;
	}

	private static function config_dompdf()
	{
		define('DOMPDF_ENABLE_AUTOLOAD', false);
		define('DOMPDF_ENABLE_REMOTE', true);
		define('DOMPDF_ENABLE_CSS_FLOAT', true);

		require_once 'vendor/dompdf/dompdf/dompdf_config.inc.php';
	}

	public static function build_pdf( $arr )
	{		
		static::config_dompdf();

		$report = static::build_array_report(
				$arr['categories'], 
				$arr['seriesY'], 
				$arr['cantidad_ordenes'], 
				$arr['cantidad_vendida']
			);

		$data = array(
			'src' => $arr['src'],
			'subtitle' => $arr['subtitle'],

			'total' => $arr['total'],
			'average' => $arr['average'],
			'total_ordenes' => $arr['total_ordenes'],
			'total_productos' => $arr['total_productos'],

			'report' => $report
		);

		$filename = 'reporte-'
				.str_replace(' ', '-', strtolower($arr['subtitle']))
				.'-'
				.Carbon::now()->format('d-m-Y')
				.'.pdf';

		ob_start();
		extract($data);
		include ROOT.'templates/pdf/reporte.php';
		$html = ob_get_clean();

		$dompdf = new DOMPDF();
		$dompdf->load_html( $html );
		$dompdf->render();
		$dompdf->stream( $filename );
	}

	public static function build_csv( $arr )
	{		
		$report = static::build_array_report(
				$arr['categories'], 
				$arr['seriesY'], 
				$arr['cantidad_ordenes'], 
				$arr['cantidad_vendida']
			);

		$filename = 'reporte-'
				.str_replace(' ', '-', strtolower($arr['subtitle']))
				.'-'
				.Carbon::now()->format('d-m-Y')
				.'.csv';		

		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename='.$filename);

		$output = fopen('php://output', 'w');

		fputcsv($output, ['Fecha', 'Total_ventas', 'Cantidad_ordenes', 'Cantidad_vendida']);

		foreach ($report as $line) 
		{
			fputcsv($output, $line);
		}
	}

	private static function build_array_report($categories, $seriesY, $can_o, $can_vend)
	{
		$report = [];
		$length = count($categories);

		for ($i=0; $i < $length; $i++) {
			array_push($report, array(
					"fecha" => $categories[$i],
					"total_ventas" => $seriesY[$i],
					"cantidad_ordenes" => $can_o[$i],
					"cantidad_vendida" => $can_vend[$i]
				)
			);
		};
		return $report;
	}

}