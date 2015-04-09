<!-- contenido principal	-->
<div class="conten-prin">
	<div class="container">
		<div class="row-fluid">
			<?php include_once ROOT.'views\layout\default\leftbar.php'; ?>

			<div class="span9">
				<div class="row-fluid">
					<div class="widget-product">

						<div class="widget-product-header">
							<h3>
								Buscar <?= $q ?>
							</h3>
						</div>
						<!-- /titulo categoria -->

						<div>
							<form action="<?= BASE_URL.'search' ?>" method="get">
								<input type="hidden" name="q" value="<?= $q ?>">
								<p>
									Precio Min <input type="text" name="min" id="min" value="<?= App\Helpers\Vista::set_value('min') ?>">
									Precio Max <input type="text" name="max" id="max" value="<?= App\Helpers\Vista::set_value('max') ?>">
								</p>
								<p>Marca 
									<select name="marca" id="marca">
										<option value="0">--</option>
										<?php foreach ($marcas as $m): ?>
											<option value="<?= $m['producto_marca_id'] ?>" <?= App\Helpers\Vista::is_selectedGet($m['producto_marca_id'], 'marca') ?>>
												<?= $m['producto_marca_nombre'] ?>
											</option>
										<?php endforeach ?>
									</select>
								</p>
								<input type="submit" id="sSubmit">
							</form>
						</div>

						<div class="widget-product-content">
							<?php if ( ! $ps->isEmpty() ): ?>
								<?php foreach ($ps as $p): ?>
									<div class="span3 centerText <?= App\Helpers\Vista::is_first($i) ?>">
										
										<a href="<?= BASE_URL.'index/producto/'.$p['producto_id'] ?>" class="title">
											<img <?= App\Helpers\Vista::buildDefaultImg($p, 'thumb_medium') ?>>
										</a>

										<a href="<?= BASE_URL.'index/producto/'.$p['producto_id'] ?>" class="title">
											<?= $p['producto_nombre'] ?>
										</a>

										<span class="precio">
											<?= App\Helpers\Utils::to_pesos($p['producto_precio']) ?>
										</span>

									</div>
								<?php endforeach ?>
							<?php endif ?>		
						</div>
					</div>
				</div>
			</div>	
			<!-- /span9 -->	
		</div>
	</div>
</div>