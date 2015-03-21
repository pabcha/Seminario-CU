<!-- Contenido principal -->
<div class="contenido-principal">
	<div class="container">
		<div class="row-fluid">

			<!-- navegacion -->
			<?php require_once ROOT.'views\layout\admin\left-bar.php'; ?>
			<!-- /navegacion -->

			<div class="span9">
				<?php require_once ROOT.'views\admin\catalogo\catalogo_menu.php'; ?>
				<!-- /nav catalogo -->

				<?php if ( isset($this->_error) ) : ?>
	            <div class="alert alert-error">
	                <?= $this->_error ?>
	            </div>   
		        <?php endif; ?>

		        <?php if ( Session::get("mensajeExito") ) : ?>
		            <div class="alert alert-success alert-dismissable">
		            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <?= Session::show("mensajeExito") ?>
		            </div>   
		        <?php endif; ?>

				<a href="<?= BASE_URL.'admin/categorias_add' ?>" class="boton boton-acept">Añadir categoria</a>

				<div class="tabla-datos">
					<table class="table table-striped table-bordered" id="tabla-result">
						<thead>
							<tr>
								<th>Categoria</th>
								<th style="width:5%">Mostrado</th>
								<th style="width:5%">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($cs as $c): ?>
								<tr>

									<td>
										<a href="<?= BASE_URL.'admin/categoria/'.$c['producto_categoria_id']; ?>">
										<?= $c->producto_categoria_nombre ?>
										</a>
									</td>

									<td style="text-align:center;">
										<?php if ( $c['producto_categoria_estado'] == 'A' ): ?>
											<i class="icon-ok"></i><p style="display:none">A</p>
										<?php else: ?>
											<i class="icon-remove"></i><p style="display:none">D</p>
										<?php endif ?>
									</td>

									<td>
										<div class="btn-group">
											<a href="<?= BASE_URL.'admin/categorias_update/'.$c['producto_categoria_id'] ?>" class="btn" title="Editar">
												<i class="icon-pencil"></i>
											</a>
											<a href="<?= $c['producto_categoria_id'] ?>" class="btn" title="Borrar">
												<i class="icon-trash"></i>
											</a>
										</div>
									</td>

								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		Catalogo.deleter("a[title='Borrar']", "/admin/categoria_delete/");
		$('#tabla-result').dataTable( Catalogo.tableOpt );
	});
</script>