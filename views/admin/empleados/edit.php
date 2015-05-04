<!-- Contenido principal -->
<div class="contenido-principal">
	<div class="container">
		<div class="row-fluid">

			<!-- navegacion -->
			<?php require_once ROOT.'views\layout\admin\left-bar.php'; ?>
			<!-- fin navegacion -->

			<div class="span9">
				<h1 class="pag-titulo">Empleados</h1>

				<?= $errors ?>

		        <div class="widget">
					<div class="widget-header">
						<h3>Editar empleado</h3>
					</div>

					<div class="widget-content">
						<form class="form-horizontal" action="<?= BASE_URL.'admin/edit_empleado/'.$emp->op_id; ?>" method="post">
							<div class="control-group">
								<label for="nombre" class="control-label"><span>*</span> Nombre</label>
								<div class="controls">
									<input type="text" class="span11" name="nombre" value="<?= $val->set_valor('nombre', $emp->op_nombre) ?>">
								</div>
							</div> <!-- /inputNombre -->

							<div class="control-group">
								<label for="apellido" class="control-label"><span>*</span> Apellido</label>
								<div class="controls">
									<input type="text" class="span11" name="apellido" value="<?= $val->set_valor('apellido', $emp->op_apellido) ?>">
								</div>
							</div> <!-- /inputApellido -->

							<div class="control-group">
								<label for="dni" class="control-label"><span>*</span> DNI</label>
								<div class="controls">
									<input type="text" class="span11" name="dni" value="<?= $val->set_valor('dni', $emp->op_dni) ?>">
								</div>
							</div> <!-- /inputDNI -->

							<div class="control-group">
								<label for="genero" class="control-label"><span>*</span> Genero</label>
								<div class="controls">
									<select class="span11" name="genero">
							    		<option value="M" <?= $val->set_select('genero', $emp->op_genero, $emp->op_genero == 'M') ?>>masculino</option>
							    		<option value="F" <?= $val->set_select('genero', $emp->op_genero, $emp->op_genero == 'F') ?>>femenino</option>
							    	</select>
								</div>
							</div> <!-- /inputGenero -->

						    <div class="control-group">
							    <label class="control-label"><span>*</span> Rol</label>
							    <div class="controls">
							    	<select class="span11" name="rol">
							    		<option value="administrador" <?= $val->set_select('rol', $emp->op_rol, $emp->op_rol == 'administrador') ?>>administrador</option>
							    		<option value="vendedor" <?= $val->set_select('rol', $emp->op_rol, $emp->op_rol == 'vendedor') ?>>vendedor</option>
							    	</select>
							    </div>
							</div> <!-- /rol -->

							<div class="control-group">
								<div class="controls boton-responsive">
									<button type="submit" class="boton boton-acept">Editar</button>
								</div>
							</div> <!-- /inputSubmit -->

							<div class="control-gruop">
								<div class="controls">
									<p style="font-size: 11px;">(*) Campos obligatorios.</p>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>