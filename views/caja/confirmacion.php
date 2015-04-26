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
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
		<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
	<?= App\Helpers\Vista::loadCss( $styles ) ?>


	<script src="<?= $roots['js'] ?>vendor/jquery-1.8.2.min.js"></script>
	<?= App\Helpers\Vista::loadJs( $scripts ) ?>
</head>
<body>

	<div class="conten-prin" style="margin-bottom:30px;">
		<div class="s960">

			<div class="row-fluid logo">
				<h1>SaltaShop</h1>
			</div>

			<div class="row-fluid message" style="margin-bottom:20px;">
				<div class="titulo-post">
					<h3 style="font-size:22px;">Gracias por tu orden!</h3>
				</div>
				<p style="font-size: 15px;">
					Tu pedido ha sido recibido y ahora esta sieno procesado. En breve nos comunicaremos con usted.
				</p>
				<p style="font-size: 15px;">
					La siguiente siguiente información le sera enviada a su correo. 
					Tambien podra acceder a la misma desde su cuenta en Saltashop.
				</p>
			</div>

			<div class="row-fluid order-header">
				<h2>N° <?= Underscore\Types\Number::paddingLeft($id, 5) ?></h2>
				<p><span>Fecha:</span> 25-05-2015 21:15:16</p>
			</div>

			<div class="row-fluid client-info">
				<div class="row-fluid">
					<div class="span6">
						<h3>Nombre</h3>
						<div><?= $nombre ?></div>
					</div>
					<div class="span6">
						<h3>Telefono</h3>
						<div><?= $telefono ?></div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6">
						<h3>Correo</h3>
						<div><?= $correo ?></div>
					</div>
					<div class="span6">
						<h3>Forma de pago</h3>
						<div><?= $pago ?></div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6">
						<h3>Domicilio</h3>
						<div><?= $domicilio ?></div>
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
							<td><?= $p['cantidad'] ?></td>
							<td class="prod-precio"><?= App\Helpers\Utils::to_pesos($p['producto_precio']) ?></td>
							<td class="prod-precio"><?= App\Helpers\Utils::to_pesos($p['producto_precio'] * $p['cantidad']); ?></td>
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
								<?= App\Helpers\Utils::to_pesos($carrito_total) ?>
							</td>
						</tr>
					</tfoot>
				</table>					
			</div>
			<!-- /Detalle carrito -->
			
			<div style="overflow:hidden;margin-bottom: 15px;">
				<a href="<?= BASE_URL ?>" class="btn pull-right">volver a la tienda</a>			
			</div>			
		</div>
	</div>
</body>
</html>