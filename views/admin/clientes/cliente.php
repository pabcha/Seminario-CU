	<div class="contenido-principal">
		<div class="container">
			<div class="row-fluid">
				
				<!-- navegacion -->
				<?php require_once ROOT.'views\layout\admin\left-bar.php'; ?>
				<!-- fin navegacion -->

				<div class="span9">
					<a href="<?php echo BASE_URL.'admin/clientes'; ?>"><i class="icon-arrow-left"></i> volver a clientes</a>

					<div class="pag-subtitulo">
						<h3>Cliente <span style="color:#009fe1;"><?php echo $cliente['nombre'].' '.$cliente['apellido']; ?></span></h3>
					</div>

					<div class="row-fluid">
						<div class="span6">
							<div class="widget widget-compact">
								<div class="widget-header"><h3>Informacion</h3></div>
								<div class="widget-content">
									<table class="table table-condensed">
										<tbody>
											<tr>
												<td><b>Correo</b></td>
												<td><?php echo $cliente['correo']; ?></td>
											</tr>
											<tr>
												<td><b>DNI</b></td>
												<td><?php echo $cliente['dni']; ?></td>
											</tr>
											<tr>
												<td><b>Localidad</b></td>
												<td><?php echo $cliente['provincia'].', '.$cliente['ciudad']; ?></td>												
											</tr>
											<tr>
												<td><b>CP</b></td>
												<td><?php echo $cliente['cpostal']; ?></td>
											</tr>
											<tr>
												<td><b>Domicilio</b></td>
												<td><?php echo $cliente['domicilio']; ?></td>
											</tr>
											<tr>
												<td><b>Telefono</b></td>
												<td><?php echo $cliente['telefono']; ?></td>
											</tr>
											<tr>
												<td><b>Celular</b></td>
												<td><?php echo $cliente['celular']; ?></td>
											</tr>
											<tr>
												<td><b>Estado</b></td>
												<td>
													<?php if ($cliente['estado'] == 'A'): ?>
														<i class="icon-ok"></i>
													<?php else: ?>
														<i class="icon-remove"></i>
													<?php endif ?>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>			

					<div class="tabla-datos">
						<div class="pag-subtitulo">
							<h3>Ordenes (<?php echo count($ordenes); ?>)</h3>
						</div>

						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th style="width:3%;text-align:center;">#</th>
									<th>Fecha y hora</th>
									<th>Total</th>
									<th>Metodo de Pago</th>
									<th>Estado</th>
									<th style="width:10%">Acciones</th>									
								</tr>
							</thead>
							<tbody>							
							<?php foreach ($ordenes as $orden): ?>
								<?php 
										$clase = '';
										switch ($orden['estado']) {
											case 'Pedido':
												$clase = '';
												break;
											case 'Esperando pago':
												$clase = 'label-warning';
												break;
											case 'Pago aceptado':
												$clase = 'label-info';
												break;
											case 'Enviado':
												$clase = 'label-inverse';
												break;
											case 'Recibido':
												$clase = 'label-success';
												break;
											case 'Cancelado':
												$clase = 'label-important';
												break;											
											default:
												# code...
												break;
										}
									?>
								<tr>
									<td style="text-align:center;"><?php echo $orden['id']; ?></td>
									<td><?php echo $this->get_fecha($orden['fecha']); ?></td>
									<td><?php echo $this->to_pesos($orden['total']); ?></td>
									<td><?php echo $orden['forma_pago']; ?></td>
									<td><span class="label <?php echo $clase; ?>"><?php echo $orden['estado']; ?></span></td>
									<td style="text-align:center;">
										<div class="btn-group">
											<a href="<?php echo BASE_URL.'admin/orden/'.$orden['id']; ?>" class="btn" title="ver" target="_blank"><i class="icon-search"></i></a>											
										</div>
									</td>	
								</tr>
							<?php endforeach ?>
							</tbody>
						</table>
					</div>

					

				</div>
			</div>
		</div>
	</div>