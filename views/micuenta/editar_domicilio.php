<div class="conten-prin" style="margin-bottom:80px;">
	<div class="container">
		<!-- Orden recibida -->
		<div class="row-fluid" style="margin-bottom:30px;">

			<?php require_once ROOT.'views/micuenta/common/menu.php'; ?>	

			<div class="span9">
				<div class="titulo-header-3">
					<h3>Editar domicilio</h3>
				</div>

				<div class="row-fluid">

					<div class="alerta" id="alerta" style="display:none;">
						<ul class="alert_info">
						</ul>
					</div>

					<form action="<?= BASE_URL.'micuenta/editar_domicilio' ?>" class="form-horizontal" >
						<div class="control-group">
							<label for="inputProvincia" class="control-label">Provincia<span class="requerido">*</span></label>
							<div class="controls">
								<input type="text" id="inputProvincia" class="span11" name="inputProvincia">
							</div>
						</div>
						<div class="control-group">
							<label for="inputCiudad" class="control-label">Ciudad<span class="requerido">*</span></label>
							<div class="controls">
								<input type="text" id="inputCiudad" class="span11" name="inputCiudad">
							</div>
						</div>
						<div class="control-group">
							<label for="inputCPostal" class="control-label">Codigo Postal:<span class="requerido">*</span></label>
							<div class="controls">
								<input type="text" id="inputCPostal" class="span11" name="inputCPostal">
							</div>
						</div>
						<div class="control-group">
							<label for="inputDireccion" class="control-label">Domicilio<span class="requerido">*</span></label>
							<div class="controls">
								<input type="text" id="inputDireccion" class="span11" name="inputDireccion">
							</div>
						</div>
						<div class="control-group">
							<label for="inputTelefono" class="control-label">Telefono<span class="requerido">*</span></label>
							<div class="controls">
								<input type="text" id="inputTelefono" class="span11" name="inputTelefono">
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