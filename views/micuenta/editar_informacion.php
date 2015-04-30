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

					<div class="alerta" id="alerta" style="display:none;">
						<ul class="alert_info">
						</ul>
					</div>

					<form action="<?= BASE_URL.'micuenta/editar_informacion' ?>" class="form-horizontal" >
						<div class="control-group">
							<label for="inputNombre" class="control-label">Nombre<span class="requerido">*</span></label>
							<div class="controls">
								<input type="text" id="inputNombre" class="span11" name="inputNombre">
							</div>
						</div>

						<div class="control-group">
							<label for="inputApellido" class="control-label">Apellido<span class="requerido">*</span></label>
							<div class="controls">
								<input type="text" id="inputApellido" class="span11" name="inputApellido">
							</div>
						</div>

						<div class="control-group">
							<label for="inputDNI" class="control-label">DNI<span class="requerido">*</span></label>
							<div class="controls">
								<input type="text" id="inputDNI" class="span11" name="inputDNI">
							</div>
						</div>

						<div class="control-group">
							<label for="inputCorreo" class="control-label">Correo<span class="requerido">*</span></label>
							<div class="controls">
								<input type="text" id="inputCorreo" class="span11" name="inputCorreo">
							</div>
						</div>

						<div class="control-group">
							<label for="inputPassword" class="control-label">Password<span class="requerido">*</span></label>
							<div class="controls">
								<input type="text" id="inputPassword" class="span11" name="inputPassword">
							</div>
						</div>

						<div class="control-group">
							<label for="inputPassword2" class="control-label">Repetir password<span class="requerido">*</span></label>
							<div class="controls">
								<input type="text" id="inputPassword2" class="span11" name="inputPassword2">
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
								<button type="submit" class="boton boton-acept">Añadir</button>
							</div>
						</div>	
					</form>
				</div>				
			</div>
		</div>
	</div>
</div>