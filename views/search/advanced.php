<!-- contenido principal	-->
<div class="conten-prin">
	<div class="container">
		<div class="row-fluid">
			<?php include_once ROOT.'views/layout/default/leftbar.php'; ?>

			<div class="span9">
				<div class="row-fluid">
					<div class="widget-product">

						<div class="row-fluid" style="margin-bottom:20px;">
							<form action="<?= BASE_URL.'search/advanced' ?>" method="get">
								Buscar
								<div class="some row-fluid">
									<input class="input-mini" type="text" name="q" id="qu" value="<?= App\Helpers\Vista::set_value('q') ?>">
									<button type="submit" id="sSubmit"><i class="icon-search"></i></button>
								</div>

								<div class="row-fluid" id="moresearch_criteria">
									<div class="span3">
										Precio Min
										<div class="input-prepend">
											<span class="add-on">$</span>
											<input class="input-mini" type="text" name="min" id="min" value="<?= App\Helpers\Vista::set_value('min') ?>">
										</div>
									</div>
										
									<div class="span3">
										Precio Max
										<div class="input-prepend">
											<span class="add-on">$</span>
											<input class="input-mini" type="text" name="max" id="max" value="<?= App\Helpers\Vista::set_value('max') ?>">
										</div>
									</div>
									
									<div class="span6">
										Marca 
										<div>
											<select name="marca" id="marca" class="input-medium">
												<option value="0">--</option>
												<?php foreach ($marcas as $m): ?>
													<option value="<?= $m['producto_marca_id'] ?>" <?= App\Helpers\Vista::is_selectedGet($m['producto_marca_id'], 'marca') ?>>
														<?= $m['producto_marca_nombre'] ?>
													</option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- /titulo categoria -->


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
									<?php if ($i == 5): ?>
										<div style="clear:both"></div>
									<?php endif ?>
								<?php endforeach ?>
							<?php else: ?>
								<p class="not-found">No se encontraron resultados.</p>
							<?php endif ?>		
						</div>

						<?php if ( isset($pag) and $pag->total_pages() > 1): ?>
							<div class="pagination pagination-right" style="clear:both">
								<ul>
									<?php if ($pag->has_previous_page()): ?>
										<li>
											<a href="<?= App\Helpers\Vista::hrefPagSearch($pag->previous_page()) ?>">Anterior</a>
										</li>
									<?php endif ?>

									<?php for ($i=1; $i <= $pag->total_pages(); $i++) : ?>
										<li>
											<a href="<?= App\Helpers\Vista::hrefPagSearch($i) ?>"><?= $i ?></a>
										</li>
									<?php endfor ?>

									<?php if ($pag->has_next_page()): ?>
										<li>
											<a href="<?= App\Helpers\Vista::hrefPagSearch($pag->next_page()) ?>">Siguiente</a>
										</li>
									<?php endif ?>									
								</ul>
							</div>
							<!-- /paginador -->
						<?php endif ?>

					</div>
				</div>
			</div>	
			<!-- /span9 -->	
		</div>
	</div>
</div>