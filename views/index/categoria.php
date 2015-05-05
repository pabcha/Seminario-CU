<!-- contenido principal	-->
<div class="conten-prin">
	<div class="container">
		<div class="row-fluid">
			<?php include_once ROOT.'views/layout/default/leftbar.php'; ?>

			<div class="span9">
				<div class="row-fluid">
					<div class="widget-product">

						<?php if ( ! $subcategorias->isEmpty() ): ?>
							<div class="widget-product-header">
								<h3>Subcategorias</h3>
							</div>

							<ul class="subcategory-menu">
								<?php foreach ($subcategorias as $s): ?>
									<li>
										<a href="<?= BASE_URL.'index/categoria/'.$s['producto_categoria_id'] ?>">
											<?= $s['producto_categoria_nombre'] ?>
										</a>
									</li>
								<?php endforeach ?>
							</ul>
						<?php endif ?>
						<!-- /subcategorias -->

						<div class="widget-product-header">
							<h3>
								<?= $categoria_nombre ?>
							</h3>
						</div>
						<!-- /titulo categoria -->
						
						<?php if ( ! $ps->isEmpty() ): ?>
							<div style="text-align:right;">
								<form action="<?= BASE_URL.'index/categoria/'.$categoria_id ?>" method="GET" id="formOrderBy">
									<div style="font-size: 16px;margin-right: 10px;display:inline-block;">
										<p style="margin:0;display:inline-block;overflow:hidden">Ordenar por</p>
									</div> 
									<select name="orderby" id="orderBy">
										<option value="0">--</option>
										<option value="menorPrecio" <?= App\Helpers\Vista::is_selectedGet('menorPrecio', 'orderby') ?>>Menor precio</option>
										<option value="mayorPrecio" <?= App\Helpers\Vista::is_selectedGet('mayorPrecio', 'orderby') ?>>Mayor precio</option>
										<option value="azNombre" <?= App\Helpers\Vista::is_selectedGet('azNombre', 'orderby') ?>>Nombre de A a Z</option>
										<option value="zaNombre" <?= App\Helpers\Vista::is_selectedGet('zaNombre', 'orderby') ?>>Nombre de Z a A</option>
									</select>
								</form>
							</div>
						<?php endif ?>

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
							<?php echo "No se encontraron productos." ?>
						<?php endif ?>				
						</div>

						<?php if ($pag->total_pages() > 1): ?>
							<div class="pagination pagination-right" style="clear:both">
								<ul>
									<?php if ($pag->has_previous_page()): ?>
										<li>
											<a href="<?= App\Helpers\Vista::hrefPaginator($categoria_id, $pag->previous_page()) ?>">Anterior</a>
										</li>
									<?php endif ?>

									<?php for ($i=1; $i <= $pag->total_pages(); $i++) : ?>
										<li>
											<a href="<?= App\Helpers\Vista::hrefPaginator($categoria_id, $i) ?>"><?= $i ?></a>
										</li>
									<?php endfor ?>

									<?php if ($pag->has_next_page()): ?>
										<li>
											<a href="<?= App\Helpers\Vista::hrefPaginator($categoria_id, $pag->next_page()) ?>">Siguiente</a>
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