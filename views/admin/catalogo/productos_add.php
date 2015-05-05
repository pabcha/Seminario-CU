<!-- Contenido principal -->
<div class="contenido-principal">
	<div class="container">
		<div class="row-fluid">

			<!-- navegacion -->
			<?php require_once ROOT.'views/layout/admin/left-bar.php'; ?>
			<!-- fin navegacion -->

			<div class="span9">
				<?php require_once ROOT.'views/admin/catalogo/catalogo_menu.php'; ?>
				<!--fin nav catalogo -->

				<?= $errors; ?>

		        <div class="widget">
					<div class="widget-header"><h3>Añadir producto</h3></div>
					<div class="widget-content">

					<?php if ( !$marcas->isEmpty() AND !$categorias->isEmpty() ): ?>	

						<form class="form-horizontal" action="<?= BASE_URL.'admin/productos_add' ?>" name="form-add-prod" method="post">
							<input type="hidden" name="enviar" value="1">

							<div class="control-group">
								<label for="inputNombre" class="control-label"><span>*</span> Nombre</label>
								<div class="controls">
									<input type="text" class="span11" name="inputNombre" value="<?= $validador->set_valor('inputNombre'); ?>">
								</div>
							</div> <!-- /inputNombre -->

							<div class="control-group">
								<label for="inputPrecio" class="control-label"><span>*</span> Precio</label>
								<div class="controls">
									<input type="text" class="span11" name="inputPrecio" value="<?= $validador->set_valor('inputPrecio'); ?>">
								</div>
							</div> <!-- /inputPrecio -->

		   					<div class="control-group">
							    <label class="control-label" for="inputStock"><span>* </span>Disponibilidad</label>
							    <div class="controls">
							    	<input type="text" class="span11" name="inputStock" value="<?= $validador->set_valor('inputStock'); ?>">
						    	</div>
						    </div> <!-- /inputStock -->

							<div class="control-group">
							    <label class="control-label"><span>*</span> Categoria</label>
							    <div class="controls">
							    	<div id="sidetree">
										<div id="sidetreecontrol"><a href="?#">Contraer</a> | <a href="?#">Expandir</a></div>

										<ul id="tree">
											<?php foreach ($categorias as $c): ?>
											<li>
												<span>
													<input type="radio" name="inputCategoria" value="<?= $c['producto_categoria_id']; ?>" <?= $validador->set_radio('inputCategoria', $c['producto_categoria_id']) ?>>
												</span>
												<?php echo $c['producto_categoria_nombre'];
													App\Classes\CategoryService::createTree($c['producto_categoria_id'], $validador);
												?>													
											</li>
											<?php endforeach ?>
										</ul>

									</div>
								</div>
							</div> <!-- /inputCategoria -->

						    <div class="control-group">
							    <label class="control-label"><span>*</span> Marca</label>
							    <div class="controls">
							    	<select class="span11" name="inputMarca">
							    		<?php foreach ($marcas as $m): ?>
			    			    			<option value="<?= $m['producto_marca_id']; ?>" <?= $validador->set_select('inputMarca', $m['producto_marca_id']) ?>>
			    								<?= $m['producto_marca_nombre'] ?>
			    							</option>
							    		<?php endforeach ?>
							    	</select>
							    </div>
							</div> <!-- /inputMarca -->

		   					<div class="control-group">
								<label for="inputShortDescripcion" class="control-label">Descripcion Corta</label>
								<div class="inputTextEdit">
									<textarea name="inputShortDescripcion" class="span11" style="height:150px;"><?= $validador->set_valor('inputShortDescripcion') ?></textarea>
								</div>
							</div> <!-- /inputShortDescripcion -->

		   					<div class="control-group">
								<label for="inputDescripcion" class="control-label">Descripcion Larga</label>
								<div class="inputTextEdit">
									<textarea name="inputDescripcion" class="span11" style="height:150px;"><?= $validador->set_valor('inputDescripcion') ?></textarea>
								</div>
							</div> <!-- /inputDescripcion -->

							<div class="control-group">
								<label class="control-label">Mostrar</label>
								<div class="controls">
									<input type="radio" name="inputEstado" value="A" <?= $validador->set_radio('inputEstado','A',true) ?>>
									<i class="icon-ok"></i>

									<input type="radio" name="inputEstado" value="D" <?= $validador->set_radio('inputEstado','D') ?>>
									<i class="icon-remove"></i>
								</div>
							</div> <!-- /inputEstado -->

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

					<?php else: ?>
						<div class="alert alert-error"><?= "Debe crear <b>categorias</b> y <b>marcas</b> para proceder." ?></div>
					<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		$("#tree").treeview({
			collapsed: false,
			animated: "medium",
			control:"#sidetreecontrol",
			persist: "location"
		});
	})		
</script>