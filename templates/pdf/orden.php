<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
   
	<link href="<?= BASE_URL.'public/css/' ?>vendor/bootstrap.min.css" rel="stylesheet">		
	<link href="<?= BASE_URL.'public/css/' ?>front/estilos_comercio.css" rel="stylesheet">
	<link href="<?= BASE_URL.'public/css/' ?>front/estilos_categorias.css" rel="stylesheet">
	<link href="<?= BASE_URL.'public/css/' ?>front/estilos_congrats.css" rel="stylesheet">
	<style>
		h3, h2 {
			font-family: 'Open Sans', sans-serif;
		}
		td {
			padding: 2px;
		}	
	</style>

	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
</head>
<body>

	<div class="conten-prin" style="margin-bottom:30px;">
		<div class="s960">
			<div class="row-fluid logo">
				<h1 style="float:right">SaltaShop</h1>
			</div>

			<div style="clear:both"></div>

			<div class="row-fluid order-header" style="margin-bottom:5px">				
				<h2>N° <?= Underscore\Types\Number::paddingLeft($id, 5) ?></h2>
				<p><span>Fecha y Hora:</span> <?= App\Helpers\Utils::dateHour2Locale($fecha) ?></p>
			</div>

			<div class="row-fluid client-info" style="margin-bottom:30px;">
				<table style="font-size:12px;">
					<tr>
						<td style="width: 250px;">
							<h3>Nombre</h3>
						</td>
						<td>
							<h3>Telefono</h3>
						</td>
					</tr>
					<tr>
						<td><?= $titular ?></td>
						<td><?= $u->us_telefono ?></td>
					</tr>

					<tr>
						<td>
							<h3>Correo</h3>
						</td>
						<td>
							<h3>Forma de pago</h3>
						</td>
					</tr>
					<tr>
						<td><?= $u->us_correo ?></td>
						<td><?= $forma_pago ?></td>
					</tr>

					<tr>
						<td>
							<h3>Provincia</h3>
						</td>
						<td>
							<h3>Ciudad</h3>
						</td>
					</tr>
					<tr>
						<td><?= $u->us_provincia ?></td>
						<td><?= $u->us_ciudad ?></td>
					</tr>
				</table>
			</div>					

			<div class="row-fluid" style="margin-bottom:30px;">
				<table class="tab-det-carro">
					<thead>
						<tr>
							<th style="width: 30%">Producto</th>
							<th style="width: 15%">Cantidad</th>
							<th style="width: 20%">Precio</th>
							<th style="width: 35%">Subtotal</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($ps as $p): ?>
						<tr>
							<td><?= $p['producto_nombre'] ?></td>
							<td><?= $p['producto_cantidad'] ?></td>
							<td class="prod-precio"><?= App\Helpers\Utils::to_pesos($p['producto_precio']) ?></td>
							<td class="prod-precio"><?= App\Helpers\Utils::to_pesos($p['producto_subtotal']); ?></td>
						</tr>	
						<?php endforeach ?>
						
					</tbody>
					<tfoot>					
						<tr>
							<th colspan="3">Costos de envio</th>
							<td>Acordar con el vendedor</td>
						</tr>
						<tr>
							<th colspan="3">Total</th>
							<td class="prod-precio" style="font-weight:bold;font-size:16px;">
								<?= App\Helpers\Utils::to_pesos($total) ?>
							</td>
						</tr>
					</tfoot>
				</table>					
			</div>
		</div>
	</div>
</body>
</html>