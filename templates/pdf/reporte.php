<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF8">
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<style>
		body, h1, h2, h3, h4 {
			font-family: "Roboto", "Helvetica Neue", Helvetica, Arial, sans-serif;
			font-weight: 300;
		}
		div {
			margin: 0;
			padding: 0;
		}

		.sub-heading {
			width: 100%;
			background-color: #673AB7;
			padding: 15px 10px 15px 10px;
			margin-bottom: 35px;
		}
			.sub-heading h1 {
				font-size: 28px;
				color: #FFF;
				margin: 0;
			}

			.sub-heading h2 {
				color: #D1C4E9;
				line-height: 5px;
				padding-top: 10px; 
				font-size: 16px;
				margin: 0;
			}

		.graphic {
			padding: 10px 5px 10px 20px;
			margin-bottom: 20px;
		}

		.accent {
			color: #FF4081;
		}

		.report {
			border-spacing: 0;
    		border-collapse: collapse;
		}

		.report .tb-head td {
			background-color: #673AB7;
			color: #fff;
			font-weight: 300;
			padding: 4px 5px 4px 5px;
		}

		.report .tb-body td {
			padding: 2px 5px 2px 5px;
			font-size: 14px;
		}
			.report tbody tr:nth-child(even) {
				background: #D1C4E9
			}
	</style>
</head>
<body>

	<div class="sub-heading">
		<h1>Reporte de ventas</h1>
		<h2><?= $subtitle ?></h2>
	</div>

	<div class="graphic">
		<img src="<?= $src ?>">
	</div>

	<table style="width:100%;margin-left: 25px;color:#212121;">
		<tbody>
			<tr>
				<td style="width:200px">Ventas totales:</td>
				<td class="accent"><?= $total ?></td>
			</tr>
			<tr>
				<td>Ventas promedio:</td>
				<td class="accent"><?= $average ?></td>
			</tr>
			<tr>
				<td>Ordenes totales:</td>
				<td class="accent"><?= $total_ordenes ?></td>
			</tr>
			<tr>
				<td>Productos totales:</td>
				<td class="accent"><?= $total_productos ?></td>
			</tr>
		</tbody>
	</table>

	<table class="report" style="width:100%;margin-left: 20px;color:#212121;page-break-before:always">
	<tbody>
		<tr class="tb-head">
			<td>Fecha</td>
			<td>N° productos vendidos</td>
			<td>N° de ordenes</td>
			<td>Total de venta</td>
		</tr>
		<tbody>
			<?php foreach ($report as $item): ?>
				<tr class="tb-body">
					<td><?= $item['fecha'] ?></td>
					<td><?= $item['cantidad_vendida'] ?></td>
					<td><?= $item['cantidad_ordenes'] ?></td>
					<td><?= App\Helpers\Utils::to_pesos($item['total_ventas']) ?></td>
				</tr>
			<?php endforeach ?>
			
		</tbody>
	</tbody>
	</table>
</body>
</html>