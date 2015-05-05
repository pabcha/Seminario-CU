	<!-- Contenido principal -->
	<div class="contenido-principal">
		<div class="container">
			<div class="row-fluid">

				<!-- navegacion -->
				<?php require_once ROOT.'views/layout/admin/left-bar.php'; ?>
				<!-- fin navegacion -->

				<div class="span9">
					<h1 class="pag-titulo">Ordenes</h1>

					<div style="margin-top:10px;">
						<ul class="nav nav-tabs">
							<li <?= App\Helpers\Vista::is_active($page, 1) ?>>
								<a href="<?= BASE_URL.'admin/ordenes'; ?>">Recientes</a>
							</li>
							<li <?= App\Helpers\Vista::is_active($page, 2) ?>>
								<a href="<?= BASE_URL.'admin/ordenes_pagadas'; ?>">Pagadas</a>
							</li>
							<li <?= App\Helpers\Vista::is_active($page, 3) ?>>
								<a href="<?= BASE_URL.'admin/ordenes_enviadas'; ?>">Enviadas</a>
							</li>
							<li <?= App\Helpers\Vista::is_active($page, 4) ?>>
								<a href="<?= BASE_URL.'admin/ordenes_finalizadas'; ?>">Finalizadas</a>
							</li>
							<li <?= App\Helpers\Vista::is_active($page, 5) ?>>
								<a href="<?= BASE_URL.'admin/ordenes_canceladas'; ?>">Canceladas</a>
							</li>
						</ul>
					</div>
					
					<div class="tabla-datos">

						<table class="table table-striped table-bordered" id="tabla-result">
							<thead>
								<tr>
									<th style="width:3%;">#</th>
									<th>Cliente</th>
									<th>Total</th>
									<th>Estado</th>
									<th>Fecha y hora</th>
									<th style="width:4%;">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($ordenes as $o): ?>						
									<tr>
										<td style="text-align:center;"><?= $o->ord_id ?></td>
										<td style="text-align:right;"><?= $o->ord_nombre_us ?></td>
										<td data-order="<?= $o->ord_total ?>" style="text-align:right;">
											<?= App\Helpers\Utils::to_pesos($o->ord_total) ?>
										</td>
										<td style="text-align:center;">
											<span class="label <?= App\Helpers\Vista::set_label($o->ord_estado) ?>">
												<?= $o->ord_estado ?>
											</span>
										</td>
										<td data-order="<?= $o->ord_fecha ?>" style="text-align:right;">
											<?= App\Helpers\Utils::dateHour2Locale($o->ord_fecha) ?>
										</td>
										<td style="text-align:center;">
											<div class="btn-group">
												<a href="<?= BASE_URL.'admin/orden/'.$o->ord_id ?>" class="btn" title="Ver"><i class="icon-zoom-in"></i></a>	
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
			$('#tabla-result').DataTable(ordenes.config);
		});
	</script>