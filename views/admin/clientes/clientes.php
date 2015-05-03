<div class="contenido-principal">
	<div class="container">
		<div class="row-fluid">
			
			<!-- navegacion -->
			<?php require_once ROOT.'views\layout\admin\left-bar.php'; ?>
			<!-- fin navegacion -->

			<div class="span9">
				<h1 class="pag-titulo">Clientes</h1>
				
				<div class="tabla-datos">
					<table class="table table-striped table-bordered" id="tabla-result">
						<thead>
							<tr>
								<th>Nombre y apellido</th>									
								<th>Email</th>
								<th>Provincia</th>
								<th>Telefono</th>
								<th style="width:10%">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($clientes as $u): ?>
								<tr>
									<td><?php echo $u->us_nombre.' '.$u->us_apellido; ?></td>
									<td><?php echo $u->us_correo; ?></td>
									<td><?php echo $u->us_provincia; ?></td>
									<td><?php echo $u->us_telefono; ?></td>
									<td style="text-align:center;">
										<div class="btn-group">
											<a href="<?php echo BASE_URL.'admin/cliente/'.$u->us_id; ?>" class="btn" title="ver">
												<i class="icon-zoom-in"></i>
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

<script type="text/javascript">
	$(function() {
		$('#tabla-result').DataTable( clientes.config );
	});
</script>