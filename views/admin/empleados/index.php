<div class="contenido-principal">
	<div class="container">
		<div class="row-fluid">
			<!-- navegacion -->
			<?php require_once ROOT.'views/layout/admin/left-bar.php'; ?>
			<!-- fin navegacion -->

			<div class="span9">
				<h1 class="pag-titulo">Empleados</h1>

				<?php if ( Session::get("mensajeExito") ) : ?>
		            <div class="alert alert-success alert-dismissable">
		            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <?= Session::show("mensajeExito") ?>
		            </div>   
		        <?php endif; ?>

				<a href="<?php echo BASE_URL.'admin/add_empleado'; ?>" class="boton boton-acept">Añadir empleado</a>

				<div class="tabla-datos">
					<table class="table table-striped table-bordered" id="tabla-result">
						<thead>
							<tr>
								<th>Nombre</th>									
								<th>Apellido</th>
								<th>Correo</th>
								<th>Privilegios</th>
								<th style="width:10%">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($operadores as $op): ?>
								<tr>
									<td><?php echo $op->op_nombre.' '.$op->op_apellido; ?></td>
									<td><?php echo $op->op_apellido; ?></td>
									<td><?php echo $op->op_correo; ?></td>
									<td><?php echo $op->op_rol; ?></td>
									<td style="text-align:center;">
										<div class="btn-group">
											<a href="<?php echo BASE_URL.'admin/show_empleado/'.$op->op_id; ?>" class="btn" title="ver">
												<i class="icon-zoom-in"></i>
											</a>
											<a href="<?php echo BASE_URL.'admin/edit_empleado/'.$op->op_id; ?>" class="btn" title="editar">
												<i class="icon-pencil"></i>
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
		$('#tabla-result').DataTable( empleados.config );
	});
</script>