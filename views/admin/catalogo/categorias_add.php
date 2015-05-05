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

				<?= $errors ?>

				<div class="widget">					
					<div class="widget-header">
						<h3>Añadir categoria</h3>
					</div>

					<div class="widget-content">
						<form class="form-horizontal" action="<?= BASE_URL.'admin/categorias_add' ?>" name="form-add-cat" method="post">

							<div class="control-group">
								<label for="inputNombre" class="control-label"><span>*</span> Nombre</label>
								<div class="controls">
									<input type="text" id="inputNombre" class="span11" name="inputNombre" value="<?= $validador->set_valor('inputNombre') ?>">
								</div>
							</div> <!-- /inputNombre -->


							<div class="control-group">
								<label class="control-label"><span>*</span> Categoria padre</label>
								<div class="controls">
									<div id="sidetree">
										<div id="sidetreecontrol"><a href="?#">Contraer</a> | <a href="?#">Expandir</a></div>
										
										<ul id="tree">
											<li>
												<span><input type="radio" name="inputCategoria" value="0" <?= $validador->set_radio('inputCategoria','0',true); ?>></span> No Tiene
											</li>
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
								<label class="control-label">Mostrar</label>
								<div class="controls">
									<input type="radio" value="A" name="inputEstado" <?= $validador->set_radio('inputEstado','A') ?>>
									<i class="icon-ok"></i>

									<input type="radio" value="D" name="inputEstado" <?= $validador->set_radio('inputEstado','D',true) ?>>
									<i class="icon-remove"></i>
								</div>
							</div> <!-- /inputEstado -->

							<div class="control-group">
								<div class="controls boton-responsive">
									<button type="submit" class="boton boton-acept">Añadir</button>
								</div>
							</div> 
							<!-- /inputSubmit -->

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