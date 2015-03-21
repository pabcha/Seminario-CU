	<!-- Contenido principal -->
	<div class="contenido-principal">
		<div class="container">
			<div class="row-fluid">

				<!-- navegacion -->
				<?php require_once ROOT.'views\layout\admin\left-bar.php'; ?>
				<!-- fin navegacion -->

				<div class="span9">
					<h1 class="pag-titulo">Ordenes</h1>
					
					<div class="tabla-datos">

						<table class="table table-striped table-bordered" id="tabla-result">
							<thead>
								<tr>
									<th style="width:3%;">#</th>
									<th>Cliente</th>
									<th>Total</th>
									<th>Estado</th>
									<th>Fecha y hora</th>
									<th style="width:4%;">Acciones</th>
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
										<td><?php echo $orden['nombre_us']; ?></td>
										<td><?php echo $this->to_pesos($orden['total']); ?></td>
										<td>
											<span class="label <?php echo $clase; ?>">
												<?php echo $orden['estado']; ?>
											</span>
										</td>
										<td><?php echo $this->get_fecha( $orden['estado_fecha'] ); ?></td>
										<td style="text-align:center;">
											<div class="btn-group">
												<a href="<?php echo BASE_URL.'admin/orden/'.$orden['id']; ?>" class="btn" title="Ver"><i class="icon-zoom-in"></i></a>	
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

	<!-- <script type="text/javascript" src="<?php echo BASE_URL; ?>views/admin/js/dataTables.scrollingPagination.js"></script>	 -->
	<script type="text/javascript">
		$(function() {
			$('#tabla-result').dataTable({
					"oLanguage" : {
						"sLengthMenu" : "Mostrar _MENU_",
						"sZeroRecords" : "No hubo coincidencias",
						"sInfo" : "Mostrando _START_ - _END_ de _TOTAL_ registros",
						"sInfoEmpty" : "Mostrando 0 - 0 de 0 registros",
						"sInfoFiltered" : "(de _MAX_ registros)",
						"sSearch": "Buscar:",
						oPaginate : {
							"sLast"		: 		"Ultimo",
							"sFirst"	: 		"Primero",
							"sPrevious"	: 		"Anterior",
							"sNext"		: 		"Siguiente"
						} 						
					},
					"sPaginationType": "bootstrap"
				});
		});
	</script>