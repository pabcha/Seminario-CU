	<div class="contenido-principal">
		<div class="container">
			<div class="row-fluid">

				<!-- navegacion -->
				<?php require_once ROOT.'views\layout\admin\left-bar.php'; ?>
				<!-- fin navegacion -->

				<!-- fin navegacion -->
				<div class="span9">					

					<h1 class="pag-titulo">Orden de compra - <?php echo $this->to_codigo($orden['id']); ?></h1>

					<ul class="nav nav-tabs">
						<li class="active">
							<a href="<?php echo BASE_URL.'admin/orden/'.$orden_id; ?>">Detalle de compra</a>
						</li>
						<li>
							<a href="<?php echo BASE_URL.'admin/orden_historia/'.$orden_id; ?>">Historial</a>
						</li>
					</ul>

					<h3 class="margin-bottom:0">
						<?php echo $usuario['nombre'].' '.$usuario['apellido']; ?> 
						<a href="<?php echo BASE_URL.'admin/cliente/'.$usuario['id']; ?>" class="btn" title="ver usuario" target="_blank"><i class="icon-zoom-in"></i></a>
					</h3>
					<p class="lead" style="margin-bottom:5px;"><?php echo $usuario['correo']; ?></p>
					<p style="margin-bottom:20px;">La orden se efectuo: <span class="bg-gray"><?php echo $this->get_fecha($orden['fecha']); ?></span></p>

					<div class="row-fluid">
						<div class="span6">
							<div class="widget widget-compact">
								<div class="widget-header"><h3>Direccion de envio</h3></div>
								<div class="widget-content">
									<table class="table table-condensed">
										<tbody>
											<tr>
												<td><b>Nombre</b></td>
												<td><?php echo $usuario['nombre'].' '.$usuario['apellido']; ?></td>												
											</tr>
											<tr>
												<td><b>DNI</b></td>
												<td><?php echo $usuario['dni']; ?></td>
											</tr>
											<tr>
												<td><b>Localidad</b></td>
												<td><?php echo $usuario['provincia'].', '.$usuario['ciudad']; ?></td>												
											</tr>
											<tr>
												<td><b>CP</b></td>
												<td><?php echo $usuario['cpostal']; ?></td>
											</tr>
											<tr>
												<td><b>Domicilio</b></td>
												<td><?php echo $usuario['domicilio']; ?></td>
											</tr>
											<tr>
												<td><b>Telefono</b></td>
												<td><?php echo $usuario['telefono']; ?></td>
											</tr>
											<tr>
												<td><b>Celular</b></td>
												<td><?php echo $usuario['celular']; ?></td>
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
										<?php foreach ($detalles as $detalle): ?>
											<tr>
												<td><?php echo $detalle['producto_nombre']; ?></td>
												<td><?php echo $this->to_pesos($detalle['producto_precio']); ?></td>
												<td><?php echo $detalle['producto_cantidad']; ?></td>
												<td><?php echo $this->to_pesos($detalle['producto_subtotal']); ?></td>
											</tr>
										<?php endforeach ?>
										<tr>
											<td></td>
											<td></td>
											<td class="bg-gray">Total</td>
											<td class="bg-gray big-num"><?php echo $this->to_pesos($orden['total']); ?></td>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td class="bg-gray">Forma de pago</td>
											<td class="bg-gray"><?php echo $orden['forma_pago']; ?></td>
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
									<?php 
										$clase = '';

										switch ($orden['estado']) {
											case 'Pedido':
												$clase = 'bg-light-gray';
												break;
											case 'Esperando pago':
												$clase = 'bg-yellow';
												break;
											case 'Pago aceptado':
												$clase = 'bg-light-blue';
												break;
											case 'Enviado':
												$clase = 'bg-black';
												break;
											case 'Recibido':
												$clase = 'bg-green';
												break;
											case 'Cancelado':
												$clase = 'bg-red';
												break;											
											default:
												# code...
												break;
										}
									?>
									<p class="estado-orden <?php echo $clase; ?>"><?php echo $orden['estado']; ?></p>

									<form class="form-inline status-order-form" action="<?php echo BASE_URL.'admin/orden/'.$orden_id; ?>" method="post">
										<small>cambiar estado de orden</small>

										<select name="orden_estado" class="input-block-level">										
										<?php foreach ($estados as $estado): ?>
											<?php 
												$selected = '';
												if ($estado['nombre'] == $orden['estado']) { $selected = "selected = 'selected'"; }
											 ?>
											
											<option value="<?php echo $estado['id']; ?>" <?php echo $selected; ?>>
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