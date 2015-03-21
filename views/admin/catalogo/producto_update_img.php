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
				
				<?php require_once ROOT.'views\admin\catalogo\common\product_menu.php'; ?>

				<?= $errors ?>

		        <?php if ( Session::get("mensajeExito") ) : ?>
		            <div class="alert alert-success alert-dismissable">
		            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <?php echo Session::show("mensajeExito"); ?>
		            </div>   
		        <?php endif; ?>

				<div class="widget">
					<div class="widget-header">
						<h3>Imagenes de producto: <span style="color: #3498db;"><?= $producto['producto_nombre']; ?></span></h3>
					</div>

					<div class="widget-content">
						<form class="form-horizontal" action="<?= BASE_URL.'admin/producto_update_img/'.$producto['producto_id'] ?>" name="form-add-prod" method="post" enctype="multipart/form-data">

							<div class="control-group">
								<label for="inputArchivo" class="control-label"><span>*</span> Archivo</label>
								<div class="controls">
									<input type="file" class="span11" name="inputArchivo">
									<p class="descripcion">Formato: JPG, GIF, PNG. Tamaño: 2000Kb max.</p>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Portada</label>
								<div class="controls">
									<input type="radio" name="inputPortada" value="S" <?= $validador->set_radio('inputPortada','S'); ?>>
									<i class="icon-ok"></i>

									<input type="radio" name="inputPortada" value="N" <?= $validador->set_radio('inputPortada','N', true); ?>>
									<i class="icon-remove"></i>
									<p class="descripcion">Si desea seleccionar esta imagen como portada del producto.</p>
								</div>
							</div>

							<div class="control-group">
								<div class="controls boton-responsive">
									<button type="submit" class="boton boton-acept">Añadir imagen</button>
								</div>
							</div>		

							<div class="control-gruop">
								<div class="controls">
									<p style="font-size: 11px;">(*) Campos obligatorios.</p>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="tabla-datos">
					<table class="table table-striped table-bordered" id="tabla-result">
						<thead>
							<tr>
								<th>Imagen</th>
								<th>Portada</th>
								<th style="width:8%;">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php if ( !$imagenes->isEmpty() ): ?>
								<?php foreach ($imagenes as $i): ?>
									<tr>
										<td style="text-align:center">
											<img src="<?= BASE_URL.'storage/uploads/thumb_tiny/'.$i['producto_img_nombre'] ?>" alt="<?= $i['producto_img_nombre'] ?>">
										</td>

										<td style="text-align:center">
											<?php if ( $i['producto_img_predeterminado'] === 'S' ): ?>
												<i class="icon-ok"></i>
											<?php else: ?>
												<a href="<?= BASE_URL.'admin/change_img_predeterminada/'.$producto['producto_id'].'/'.$i['producto_img_id'];  ?>" style="text-decoration:none;">
													<i class="icon-remove"></i>
												</a>
											<?php endif ?>
										</td>

										<td style="text-align:center">
											<div class="btn-group">
												<a href="<?= $producto['producto_id'].'/'.$i['producto_img_id']; ?>" class="btn" title="Borrar">
													<i class="icon-trash"></i>
												</a>
											</div>
										</td>

									</tr>
								<?php endforeach ?>
							<?php else: ?>
							<tr>
								<td colspan="4">No se encontraron imagenes en este producto.</td>
							</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		Catalogo.deleter("a[title='Borrar']", "/admin/producto_img_delete/");
	});
</script>