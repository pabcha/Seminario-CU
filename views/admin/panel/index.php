<div class="contenido-principal">
	<div class="container">
		<div class="row-fluid">
			
			<!-- navegacion -->
			<?php require_once ROOT.'views/layout/admin/left-bar.php'; ?>
			<!-- fin navegacion -->

			<div class="span9">
				<h1 class="pag-titulo">Mi cuenta</h1>

				<?php if ( Session::get("mensajeExito") ) : ?>
		            <div class="alert alert-success alert-dismissable">
		            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <?= Session::show("mensajeExito") ?>
		            </div>   
		        <?php endif; ?>

				<div class="row-fluid">
					<div class="span6">
						<div class="widget widget-compact">
							<div class="widget-header"><h3>Informacion</h3></div>
							<div class="widget-content">
								<table class="table table-condensed">
									<tbody>
										<tr>
											<td><b>Nombre y apellido</b></td>
											<td><?php echo $emp->op_nombre.' '.$emp->op_apellido; ?></td>
										</tr>
										<tr>
											<td><b>Correo</b></td>
											<td><?php echo $emp->op_correo; ?></td>
										</tr>
										<tr>
											<td><b>Password</b></td>
											<td><a href="<?= BASE_URL.'admin/edit_myPassword'; ?>">cambiar</a></td>
										</tr>
										<tr>
											<td><b>DNI</b></td>
											<td><?php echo $emp->op_dni; ?></td>
										</tr>
										<tr>
											<td><b>Genero</b></td>
											<td><?php echo $emp->op_genero; ?></td>
										</tr>
										<tr>
											<td><b>Rol</b></td>
											<td><?php echo $emp->op_rol; ?></td>
										</tr>										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>