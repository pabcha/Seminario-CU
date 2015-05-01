<div class="conten-prin" style="margin-bottom:80px;">
	<div class="container">
		<!-- Orden recibida -->
		<div class="row-fluid" style="margin-bottom:30px;">

			<?php require_once ROOT.'views/micuenta/common/menu.php'; ?>			

			<div class="span9">
				<div class="titulo-post">
					<h3 style="font-size:22px;">Mis ordenes</h3>
				</div>

				<div class="row-fluid">
					<div class="tabla-datos">
						<table class="table table-striped table-bordered" id="tabla-result">
							<thead>
								<tr>
									<th style="width:3%;">#</th>
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
										<td data-order="<?= $o->ord_total ?>" style="text-align:right;">
											<?= App\Helpers\Utils::to_pesos($o->ord_total) ?>
										</td>
										<td style="text-align:right;">
											<span class="label <?= App\Helpers\Vista::set_label($o->ord_estado) ?>">
												<?= $o->ord_estado ?>
											</span>
										</td>
										<td data-order="<?= $o->ord_fecha ?>" style="text-align:right;">
											<?= App\Helpers\Utils::dateHour2Locale($o->ord_fecha) ?>
										</td>
										<td style="text-align:center;">
											<div class="btn-group">
												<a href="<?= BASE_URL.'micuenta/orden/'.$o->ord_id ?>" class="btn" title="Ver"><i class="icon-zoom-in"></i></a>	
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
</div>

<script type="text/javascript">
	$(function() {
		$('#tabla-result').DataTable(MiCuenta.config);
	});
</script>

 