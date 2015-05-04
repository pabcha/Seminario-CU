	<div class="container" style="margin-top:100px;margin-bottom:100px;">
		<div class="row-fluid">
			<div class="row-fluid">
				<div class="panel-admin-header span6 offset3">
					<h5><i class="icon-lock" style=""></i> Area de administracion</h5>
				</div>
			</div>
			<div class="row-fluid">
				<div class="panel-admin-login span6 offset3">

					<?php if ( Session::get("errors") ) : ?>
						<div class="alerta">
							<ul class="alert_info">
								<li>
									<i class="icon-remove"></i>
									<?= Session::show("errors"); ?>
								</li>
							</ul>
						</div>
					<?php endif; ?>

					<form method="post" action="<?php echo BASE_URL.'admin/logear';?>" class="form-horizontal">					

						<div class="control-group">
							<div class="controls">
								<input type="text" name="correo" placeholder="Correo" value="<?= Session::show('correo') ?>" class="span12">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<input type="password" name="password" placeholder="Password" class="span12">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button type="submit" class="boton boton-acept">Entrar</button>
							</div>
						</div>			
					</form>
				</div>
			</div>
		</div>
	</div>

