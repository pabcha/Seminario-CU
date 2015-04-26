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
								<?php foreach ($ordenes as $o): ?>						
									<tr>
										<td style="text-align:center;"><?php echo $o->ord_id; ?></td>
										<td><?php echo $o->ord_nombre_us; ?></td>
										<td><?php echo $o->ord_total; ?></td>
										<td>
											<span class="label <?= App\Helpers\Vista::set_label($o->ord_estado) ?>">
												<?php echo $o->ord_estado; ?>
											</span>
										</td>
										<td><?php echo $o->ord_fecha; ?></td>
										<td style="text-align:center;">
											<div class="btn-group">
												<a href="<?php echo BASE_URL.'admin/orden/'.$o->ord_id ?>" class="btn" title="Ver"><i class="icon-zoom-in"></i></a>	
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