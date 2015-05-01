<div class="conten-prin" style="margin-bottom:80px;">
	<div class="container">
		<!-- Orden recibida -->
		<div class="row-fluid" style="margin-bottom:30px;">

			<?php require_once ROOT.'views/micuenta/common/menu.php'; ?>	

			<div class="span9">
				<div class="titulo-header-3">
					<h3>Cambiar password</h3>
				</div>

				<div class="row-fluid">
					<?= $errors ?>					

					<form action="<?= BASE_URL.'micuenta/cambiar_password' ?>" class="form-horizontal" method="POST">
						
						<div class="control-group">
							<label for="inputPassword" class="control-label">Password</label>
							<div class="controls">
								<input type="password" name="inputPassword">
							</div>
						</div>

						<div class="control-group">
							<label for="inputPassword2" class="control-label">Repetir password</label>
							<div class="controls">
								<input type="password" name="inputPassword2">
							</div>
						</div>					

						<div class="control-group">
							<div class="controls">
								<button type="submit" class="boton boton-acept">Cambiar</button>
							</div>
						</div>	
					</form>
				</div>				
			</div>
		</div>
	</div>
</div>