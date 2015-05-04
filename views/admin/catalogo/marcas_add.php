	<!-- Contenido principal -->
	<div class="contenido-principal">
		<div class="container">
			<div class="row-fluid">

				<!-- navegacion -->
				<?php require_once ROOT.'views\layout\admin\left-bar.php'; ?>
				<!-- fin navegacion -->

				<div class="span9">
					<?php require_once ROOT.'views\admin\catalogo\catalogo_menu.php'; ?>
					<!--fin nav catalogo -->

					<?= $errors; ?>

					<div class="widget">
						<div class="widget-header"><h3>Añadir marca</h3></div>

						<div class="widget-content">
							<form class="form-horizontal" action="<?= BASE_URL.'admin/marcas_add' ?>" name="form-add-fab" method="post">

								<div class="control-group">
									<label for="inputNombre" class="control-label"><span>* </span>Nombre</label>
									<div class="controls">
										<input type="text" id="inputNombre" class="span11" name="inputNombre" value="<?= $validador->set_valor('inputNombre'); ?>">
									</div>
								</div> <!-- /inputNombre -->

								<div class="control-group">
									<div class="controls boton-responsive">
										<button type="submit" class="boton boton-acept">Añadir</button>
									</div>
								</div><!-- /inputSubmit -->

								<div class="control-gruop">
									<div class="controls">
										<p style="font-size: 11px;">(*) Campos obligatorios.</p>										
									</div>
								</div><!-- /alert -->
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>