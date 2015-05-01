<div class="conten-prin" style="margin-bottom:80px;">
	<div class="container">
		<!-- Orden recibida -->
		<div class="row-fluid" style="margin-bottom:30px;">

			<?php require_once ROOT.'views/micuenta/common/menu.php'; ?>	

			<div class="span9">
				<div class="titulo-header-3">
					<h3>Editar informacion</h3>
				</div>

				<div class="row-fluid">

					<?= $errors; ?>

					<form action="<?= BASE_URL.'micuenta/editar_informacion' ?>" class="form-horizontal" method="POST">

						<div class="control-group">
							<label for="inputNombre" class="control-label">Nombre</label>
							<div class="controls">
								<input type="text" name="inputNombre" value="<?= $validador->set_valor('inputNombre', $u['us_nombre']) ?>">
							</div>
						</div>

						<div class="control-group">
							<label for="inputApellido" class="control-label">Apellido</label>
							<div class="controls">
								<input type="text" name="inputApellido" value="<?= $validador->set_valor('inputApellido', $u['us_apellido']) ?>">
							</div>
						</div>

						<div class="control-group">
							<label for="inputDNI" class="control-label">DNI</label>
							<div class="controls">
								<input type="text" name="inputDNI" value="<?= $validador->set_valor('inputDNI', $u['us_dni']) ?>">
							</div>
						</div>						

						<div class="control-group">
							<label for="inputProvincia" class="control-label">Provincia</label>
							<div class="controls">
								<input type="text" name="inputProvincia" value="<?= $validador->set_valor('inputProvincia', $u['us_provincia']) ?>">
							</div>
						</div>

						<div class="control-group">
							<label for="inputCiudad" class="control-label">Ciudad</label>
							<div class="controls">
								<input type="text" name="inputCiudad" value="<?= $validador->set_valor('inputCiudad', $u['us_ciudad']) ?>">
							</div>
						</div>

						<div class="control-group">
							<label for="inputCPostal" class="control-label">Codigo Postal:</label>
							<div class="controls">
								<input type="text" name="inputCPostal" value="<?= $validador->set_valor('inputCPostal', $u['us_cpostal']) ?>">
							</div>
						</div>

						<div class="control-group">
							<label for="inputDireccion" class="control-label">Domicilio</label>
							<div class="controls">
								<input type="text" name="inputDireccion" value="<?= $validador->set_valor('inputDireccion', $u['us_domicilio']) ?>">
							</div>
						</div>

						<div class="control-group">
							<label for="inputTelefono" class="control-label">Telefono</label>
							<div class="controls">
								<input type="text" name="inputTelefono" value="<?= $validador->set_valor('inputTelefono', $u['us_telefono']) ?>">
							</div>
						</div>

						<div class="control-group">
							<label for="inputCelular" class="control-label">Celular</label>
							<div class="controls">
								<input type="text" name="inputCelular" value="<?= $validador->set_valor('inputCelular', $u['us_celular']) ?>">
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
								<button type="submit" class="boton boton-acept">Editar</button>
							</div>
						</div>
					</form>
				</div>				
			</div>
		</div>
	</div>
</div>