	<!-- Contenido principal -->
	<div class="contenido-principal">
		<div class="container">
			<div class="row-fluid">

				<!-- navegacion -->
				<?php require_once ROOT.'views\layout\admin\left-bar.php'; ?>
				<!-- fin navegacion -->

				<div class="span9">

					<?php require_once ROOT.'views\admin\reportes\common\header-content.php'; ?>
					<!-- /header-content -->

					<?php require_once ROOT.'views\admin\reportes\common\stock-menu.php'; ?>
					<!-- /stock menu -->

					<div class="tabla-datos" style="margin-top:0">
						<table class="table table-striped table-bordered" id="tabla-result">
							<thead>
								<tr>
									<th>Producto</th>
									<th>Unidades en stock</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>	
							<?php if (!$products->isEmpty()): ?>
								<?php foreach ($products as $product): ?>
								<tr>
									<td><?= $product['producto_nombre'] ?></td>
									<td><?= $product['producto_cantidad'] ?></td>
									<td></td>
								</tr>
								<?php endforeach ?>
							<?php else: ?>
								<tr>
									<td colspan="3">No se encontraron productos sin existencias.</td>
								</tr>
							<?php endif ?>
								
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>