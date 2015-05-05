<!-- Contenido principal -->
<div class="contenido-principal">
	<div class="container">
		<div class="row-fluid">

			<!-- navegacion -->
			<?php require_once ROOT.'views/layout/admin/left-bar.php'; ?>
			<!-- fin navegacion -->

			<div class="span9">
				<h1 class="pag-titulo">Empleados</h1>

				<?= $errors ?>

		        <div class="widget">
					<div class="widget-header">
						<h3>Cambiar contraseña</h3>
					</div>

					<div class="widget-content">
						<form class="form-horizontal" action="<?= BASE_URL.'admin/edit_password/'.$id ?>" method="post">
							
							<div class="control-group">
								<label for="password" class="control-label"><span>*</span> Nuevo password</label>
								<div class="controls">
									<input type="password" class="span11" name="password" value="">
								</div>
							</div> <!-- /inputPassword -->

							<div class="control-group">
								<label for="password2" class="control-label"><span>*</span> Repetir password</label>
								<div class="controls">
									<input type="password" class="span11" name="password2" value="">
								</div>
							</div> <!-- /inputPassword -->

							<div class="control-group">
								<div class="controls boton-responsive">
									<button type="submit" class="boton boton-acept">Cambiar password</button>
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