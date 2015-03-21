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

				<a href="<?php echo BASE_URL.'admin/marcas_add'; ?>" class="boton boton-acept">Añadir marca</a>

				<div class="tabla-datos">
					<table class="table table-striped table-bordered" id="tabla-result">
						<thead>
							<tr>
								<th>Marca</th>
								<th style="width:8%;">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($marcas as $marca): ?>
							<tr>
								<td><?= $marca['producto_marca_nombre']; ?></td>

								<td style="text-align:center">
									<div class="btn-group">
										<a href="<?= BASE_URL; ?>admin/marca_update/<?= $marca['producto_marca_id']; ?>" class="btn" title="Editar"><i class="icon-pencil"></i></a>
										<a href="<?= $marca['producto_marca_id']; ?>" class="btn" title="Borrar"><i class="icon-trash"></i></a>											
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
		Catalogo.deleter("a[title='Borrar']", "/admin/marca_delete/");
		$('#tabla-result').dataTable( Catalogo.tableOpt );
	});
</script>