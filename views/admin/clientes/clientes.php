	<div class="contenido-principal">
		<div class="container">
			<div class="row-fluid">
				
				<!-- navegacion -->
				<?php require_once ROOT.'views\layout\admin\left-bar.php'; ?>
				<!-- fin navegacion -->

				<div class="span9">
					<h1 class="pag-titulo">Clientes</h1>
					
					<div class="tabla-datos">
						<table class="table table-striped table-bordered" id="tabla-result">
							<thead>
								<tr>
									<th>Nombre y apellido</th>									
									<th>Email</th>
									<th>Estado</th>
									<th style="width:10%">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($clientes as $cliente): ?>
									<tr>
										<td><?php echo $cliente['nombre'].' '.$cliente['apellido']; ?></td>
										<td><?php echo $cliente['correo']; ?></td>
										<td style="text-align:center;width:5%;">
											<?php if ($cliente['estado'] == 'A'): ?>
												<a href="<?php echo BASE_URL.'admin/bloquear/'.$cliente['id']; ?>" style="text-decoration:none;"><i class="icon-ok"></i></a>
											<?php else: ?>
												<a href="<?php echo BASE_URL.'admin/desbloquear/'.$cliente['id']; ?>" style="text-decoration:none;"><i class="icon-remove"></i></a>
											<?php endif ?>											
										</td>
										<td style="text-align:center;">
											<div class="btn-group">
												<a href="<?php echo BASE_URL.'admin/cliente/'.$cliente['id']; ?>" class="btn" title="ver">
													<i class="icon-zoom-in"></i>
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