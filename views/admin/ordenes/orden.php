	<div class="contenido-principal">
		<div class="container">
			<div class="row-fluid">

				<!-- navegacion -->
				<?php require_once ROOT.'views\layout\admin\left-bar.php'; ?>
				<!-- fin navegacion -->

				<!-- fin navegacion -->
				<div class="span9">					

					<h1 class="pag-titulo">Orden de compra - <?= Underscore\Types\Number::paddingLeft($o->ord_id, 5) ?></h1>

					<ul class="nav nav-tabs">
						<li class="active">
							<a href="<?= BASE_URL.'admin/orden/'.$o->ord_id; ?>">Detalle de compra</a>
						</li>
						<li>
							<a href="<?= BASE_URL.'admin/orden_historia/'.$o->ord_id; ?>">Historial</a>
						</li>
					</ul>

					<h3 class="margin-bottom:0">
						<?= $u->us_nombre.' '.$u->us_apellido; ?> 
						<a href="<?= BASE_URL.'admin/cliente/'.$u->us_id; ?>" class="btn" title="ver usuario" target="_blank"><i class="icon-zoom-in"></i></a>
					</h3>
					<p class="lead" style="margin-bottom:5px;"><?= $u->us_correo; ?></p>
					<p style="margin-bottom:20px;">La orden se efectuo: <span class="bg-gray"><?= App\Helpers\Utils::dateHour2Locale($o->ord_fecha); ?></span></p>

					<div class="row-fluid">
						<div class="span6">
							<div class="widget widget-compact">
								<div class="widget-header"><h3>Direccion de envio</h3></div>
								<div class="widget-content">
									<table class="table table-condensed">
										<tbody>
											<tr>
												<td><b>DNI</b></td>
												<td><?= $u->us_dni; ?></td>
											</tr>
											<tr>
												<td><b>Localidad</b></td>
												<td><?= $u->us_provincia.', '.$u->us_ciudad; ?></td>												
											</tr>
											<tr>
												<td><b>CP</b></td>
												<td><?= $u->us_cpostal; ?></td>
											</tr>
											<tr>
												<td><b>Domicilio</b></td>
												<td><?= $u->us_domicilio; ?></td>
											</tr>
											<tr>
												<td><b>Telefono</b></td>
												<td><?= $u->us_telefono; ?></td>
											</tr>
											<tr>
												<td><b>Celular</b></td>
												<td><?php echo ($u->us_celular == '') ? '-' : $u->us_celular; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					<div class="row-fluid">
						<div class="widget widget-compact">
							<div class="widget-header"><h3>Detalle de la orden</h3></div>
							<div class="widget-content">
								<table class="table table-condensed">
									<thead>
										<tr>
											<th>Producto</th>
											<th>Precio</th>
											<th>Cantidad</th>
											<th>Subtotal</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($detalles as $d): ?>
											<tr>
												<td><?= $d->producto_nombre; ?></td>
												<td><?= App\Helpers\Utils::to_pesos($d->producto_precio); ?></td>
												<td><?= $d->producto_cantidad; ?></td>
												<td><?= App\Helpers\Utils::to_pesos($d->producto_subtotal); ?></td>
											</tr>
										<?php endforeach ?>
										<tr>
											<td></td>
											<td></td>
											<td class="bg-gray">Total</td>
											<td class="bg-gray big-num"><?= App\Helpers\Utils::to_pesos($o->ord_total) ?></td>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td class="bg-gray">Forma de pago</td>
											<td class="bg-gray"><?= $o->ord_forma_pago; ?></td>
										</tr>
									</tbody>									
								</table>
							</div>
						</div>
					</div>										

					<div class="row-fluid">
						<div class="span6">
							<div class="widget widget-compact">
								<div class="widget-header"><h3>Estado de la orden</h3></div>
								<div class="widget-content">
									
									<p class="estado-orden <?= App\Helpers\Vista::set_label($o->ord_estado) ?>"><?php echo $o->ord_estado; ?></p>

									<form class="form-inline status-order-form" action="<?php echo BASE_URL.'admin/orden/'.$o->ord_id; ?>" method="post">
										<small>cambiar estado de orden</small>

										<select name="orden_estado" class="input-block-level">										
										<?php foreach ($estados as $estado): ?>											
											<option value="<?php echo $estado['id']; ?>" <?= App\Helpers\Vista::is_selected($estado['nombre'], $o->ord_estado) ?>>
												<?php echo $estado['nombre']; ?>
											</option>
										<?php endforeach ?>
										</select>										

										<div class="menu-form">
											<a href="<?php echo BASE_URL.'admin/ordenes'; ?>" class="boton boton-cancel">Salir</a>		
											<button class="boton boton-acept" type="submit" style="margin-left: 10px;">Guardar Cambios</button>	
										</div>										
									</form>
								</div>
							</div>
						</div>						
					</div>

				</div>
			</div>
		</div>
	</div>