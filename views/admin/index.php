	<div class="container" style="margin-top:100px;margin-bottom:100px;">
		<div class="row-fluid">
			<div class="row-fluid">
				<div class="panel-admin-header span6 offset3">
					<h5><i class="icon-lock" style=""></i> Area de administracion</h5>
				</div>
			</div>
			<div class="row-fluid">
				<div class="panel-admin-login span6 offset3">

					<div class="alerta" id="alerta" style="display:none;">
						<ul class="alert_info">
						</ul>
					</div>

					<?php if ( isset($this->_error) ) : ?>
						<div class="alerta" id="alerta">
							<ul class="alert_info">
			                <?php echo '<li><i class="icon-remove"></i>'.$this->_error.'</li>'; ?>
				            </ul>
						</div> 
			        <?php endif; ?>

					<form method="post" action="<?php echo BASE_URL;?>admin"  class="form-horizontal" name="form-admin-login">
						<input type="hidden" name="enviar" value="1">

						<div class="control-group">
							<div class="controls">
								<input type="text" id="inputCorreo" name="inputCorreo" placeholder="Correo" value="<?php if(isset($this->datos)) echo $this->datos['inputCorreo']; ?>" class="span12">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<input type="password" id="inputPassword" name="inputPassword" placeholder="Password" class="span12">
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

