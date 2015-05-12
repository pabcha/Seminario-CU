<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= App\Helpers\Vista::loadTitle($this->titulo) ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
   
	<link href="<?= $roots['css'] ?>vendor/bootstrap.min.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>vendor/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>vendor/font-awesome/font-awesome.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>front/estilos_comercio.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>front/estilos_categorias.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>front/estilos_congrats.css" rel="stylesheet">

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

			<div class="row-fluid order-header" style="margin-bottom:40px">				
				<h2>N° <?= Underscore\Types\Number::paddingLeft($id, 5) ?></h2>
				<p><span>Fecha y Hora:</span> <?= App\Helpers\Utils::dateHour2Locale($fecha) ?></p>
			</div>

			<div class="row-fluid client-info" style="margin-bottom:60px;">
				<div class="row-fluid">
					<div class="span6">
						<h3>Nombre</h3>
						<div><?= $titular ?></div>
					</div>
					<div class="span6">
						<h3>Telefono</h3>
						<div><?= $u->us_telefono ?></div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6">
						<h3>Correo</h3>
						<div><?= $u->us_correo ?></div>
					</div>
					<div class="span6">
						<h3>Forma de pago</h3>
						<div><?= $forma_pago ?></div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6">
						<h3>Provincia</h3>
						<div><?= $u->us_provincia ?></div>
					</div>
					<div class="span6">
						<h3>Ciudad</h3>
						<div><?= $u->us_ciudad ?></div>
					</div>
				</div>			
			</div>						

			<div class="row-fluid" style="margin-bottom:60px;">
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