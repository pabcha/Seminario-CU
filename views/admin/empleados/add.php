<!-- Contenido principal -->
<div class="contenido-principal">
	<div class="container">
		<div class="row-fluid">

			<!-- navegacion -->
			<?php require_once ROOT.'views\layout\admin\left-bar.php'; ?>
			<!-- fin navegacion -->

			<div class="span9">
				<h1 class="pag-titulo">Empleados</h1>

				<?php if ( Session::get("errors") ) : ?>
				        <?= Session::show("errors"); ?> 
				<?php endif; ?>

		        <div class="widget">
					<div class="widget-header">
						<h3>Añadir producto</h3>
					</div>

					<div class="widget-content">
						<form class="form-horizontal" action="<?= BASE_URL.'admin/store_empleado' ?>" method="post">
							<div class="control-group">
								<label for="nombre" class="control-label"><span>*</span> Nombre</label>
								<div class="controls">
									<input type="text" class="span11" name="nombre" value="<?= Session::show('nombre') ?>">
								</div>
							</div> <!-- /inputNombre -->

							<div class="control-group">
								<label for="apellido" class="control-label"><span>*</span> Apellido</label>
								<div class="controls">
									<input type="text" class="span11" name="apellido" value="<?= Session::show('apellido') ?>">
								</div>
							</div> <!-- /inputApellido -->

							<div class="control-group">
								<label for="dni" class="control-label"><span>*</span> DNI</label>
								<div class="controls">
									<input type="text" class="span11" name="dni" value="<?= Session::show('dni') ?>">
								</div>
							</div> <!-- /inputDNI -->

							<div class="control-group">
								<label for="genero" class="control-label"><span>*</span> Genero</label>
								<div class="controls">
									<select class="span11" name="genero">
							    		<option value="M" <?= App\Helpers\Vista::is_selected($genero, 'M') ?>>masculino</option>
							    		<option value="F" <?= App\Helpers\Vista::is_selected($genero, 'F') ?>>femenino</option>
							    	</select>
								</div>
							</div> <!-- /inputGenero -->

							<div class="control-group">
								<label for="correo" class="control-label"><span>*</span> Correo</label>
								<div class="controls">
									<input type="text" class="span11" name="correo" value="<?= Session::show('correo') ?>">
								</div>
							</div> <!-- /inputCorreo -->

							<div class="control-group">
								<label for="password" class="control-label"><span>*</span> Password</label>
								<div class="controls">
									<input type="password" class="span11" name="password" value="">
								</div>
							</div> <!-- /inputPassword -->

						    <div class="control-group">
							    <label class="control-label"><span>*</span> Rol</label>
							    <div class="controls">
							    	<select class="span11" name="rol">
							    		<option value="administrador" <?= App\Helpers\Vista::is_selected($rol, 'administrador');?>>administrador</option>
							    		<option value="vendedor" <?= App\Helpers\Vista::is_selected($rol, 'vendedor');?>>vendedor</option>
							    	</select>
							    </div>
							</div> <!-- /rol -->

							<div class="control-group">
								<div class="controls boton-responsive">
									<button type="submit" class="boton boton-acept">Añadir</button>
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