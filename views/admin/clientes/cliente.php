<div class="contenido-principal">
	<div class="container">
		<div class="row-fluid">
			
			<!-- navegacion -->
			<?php require_once ROOT.'views\layout\admin\left-bar.php'; ?>
			<!-- fin navegacion -->

			<div class="span9">
				<a href="<?php echo BASE_URL.'admin/clientes'; ?>">
					<i class="icon-arrow-left"></i> volver a clientes
				</a>

				<div class="pag-subtitulo">
					<h3>
						Cliente 
						<span style="color:#009fe1;">
							<?php echo $u->us_nombre.' '.$u->us_apellido; ?>
						</span>
					</h3>
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
											<td><?php echo $u->us_correo; ?></td>
										</tr>
										<tr>
											<td><b>DNI</b></td>
											<td><?php echo $u->us_dni; ?></td>
										</tr>
										<tr>
											<td><b>Localidad</b></td>
											<td><?php echo $u->us_provincia.', '.$u->us_ciudad; ?></td>												
										</tr>
										<tr>
											<td><b>CP</b></td>
											<td><?php echo $u->us_cpostal; ?></td>
										</tr>
										<tr>
											<td><b>Domicilio</b></td>
											<td><?php echo $u->us_domicilio; ?></td>
										</tr>
										<tr>
											<td><b>Telefono</b></td>
											<td><?php echo $u->us_telefono; ?></td>
										</tr>
										<tr>
											<td><b>Celular</b></td>
											<td><?php echo $u->us_celular; ?></td>
										</tr>
										<tr>
											<td><b>Estado</b></td>
											<td>
												<?php if ($u->us_estado == 'A'): ?>
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

					<table class="table table-striped table-bordered" id="tabla-result">
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
						<?php foreach ($ordenes as $o): ?>
							<tr>
								<td style="text-align:center;">
									<?php echo $o->ord_id; ?>
								</td>
								<td>
									<?php echo App\Helpers\Utils::dateHour2Locale($o->ord_fecha); ?>
								</td>
								<td>
									<?php echo App\Helpers\Utils::to_pesos($o->ord_total); ?>
								</td>
								<td>
									<?php echo $o->ord_forma_pago; ?>
								</td>
								<td>
									<span class="label <?= App\Helpers\Vista::set_label($o->ord_estado) ?>">
										<?php echo $o->ord_estado; ?>
									</span>
								</td>
								<td style="text-align:center;">
									<div class="btn-group">
										<a href="<?php echo BASE_URL.'admin/orden/'.$o->ord_id; ?>" class="btn" title="ver">
											<i class="icon-search"></i>
										</a>											
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

<script type="text/javascript">
	$(function() {
		$('#tabla-result').DataTable( clientes.config );
	});
</script>