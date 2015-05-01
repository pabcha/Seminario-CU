<!-- contenido principal	-->
<div class="conten-prin">
	<div class="container">
		<div class="row-fluid">

			<div class="span4">
				<div class="widget-product-header">
					<h3>¿Ya tienes cuenta?</h3>					
				</div>

				<?php if ( Session::get("errors") ) : ?>
				    <div class="alert alert-error alert-dismissable">
				    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				        <?php echo Session::show("errors"); ?>
				    </div>   
				<?php endif; ?>

				<form action="<?php echo BASE_URL.'caja/logear'; ?>" method="post" class="form-signin">				
					<label for="inputCorreo">Correo</label>
					<input class="input-block-level" type="text" name="inputCorreo" value="<?= Session::show('correo') ?>">

					<label for="inputCorreo">Contraseña</label>
					<input class="input-block-level" type="password" name="inputPassword">

					<a href="<?php echo BASE_URL.'recuperar' ?>" class="help-block pull-right">¿Olvido su contraseña?</a>
					
					<div style="clear: both;">
						<button type="submit" class="boton boton-acept">Entrar</button>
					</div>
				</form>
			</div>
				
			<div class="span4 offset2">
				<div class="widget-product-header">
					<h3>¿No tienes cuenta? Registrate!</h3>					
				</div>

				<a href="<?php echo BASE_URL.'registro' ?>" class="boton boton-acept">Registrar</a>
				
			</div>
		</div>
	</div>
</div>