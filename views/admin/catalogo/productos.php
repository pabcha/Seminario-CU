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

				<?php if ( isset($this->_error) ) : ?>
		            <div class="alert alert-error">
		                <?php echo $this->_error; ?>
		            </div>   
		        <?php endif; ?>
		        
		        <?php if ( Session::get("mensajeExito") ) : ?>
		            <div class="alert alert-success alert-dismissable">
		            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <?php echo Session::show("mensajeExito"); ?>
		            </div>   
		        <?php endif; ?>

				<a href="<?php echo BASE_URL.'admin/productos_add'; ?>" class="boton boton-acept">Añadir producto</a>

				<div class="tabla-datos">
					<table class="table table-striped table-bordered" id="tabla-result">
						<thead>
							<tr>
								<th>Producto</th>
								<th>Precio</th>
								<th class="hidden-phone" style="width:5%;">Mostrado</th>
								<th style="width:8%;">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($productos as $p): ?>
							<tr>

								<td><?= $p['producto_nombre']; ?></td>

								<td style="text-align:right"><?= App\Helpers\Utils::to_pesos($p['producto_precio']); ?></td>

								<td class="hidden-phone" style="text-align:center;">
									<?php if ( $p['producto_estado'] == 'A' ): ?>
										<i class="icon-ok"></i><p style="display:none">A</p>
									<?php else: ?>
										<i class="icon-remove"></i><p style="display:none">D</p>
									<?php endif ?>
								</td>

								<td style="text-align:center">
									<div class="btn-group">
										<a href="<?= BASE_URL; ?>admin/producto_update/<?= $p['producto_id']; ?>" class="btn" title="Editar"><i class="icon-pencil"></i></a>
										<a href="<?= $p['producto_id']; ?>" class="btn" title="Borrar"><i class="icon-trash"></i></a>
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
		Catalogo.deleter("a[title='Borrar']", "/admin/producto_delete/");
		$('#tabla-result').dataTable( Catalogo.tableOpt );
	});
</script>