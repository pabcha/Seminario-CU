<!-- contenido principal	-->
<div class="conten-prin">
	<div class="container">
		<div class="row-fluid">
			<?php include_once ROOT.'views\layout\default\leftbar.php'; ?>

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
								<small>Hay <?= count($ps) ?> productos</small>
							</h3>
						</div>
						<!-- /titulo categoria -->

						<div class="widget-product-content">
						<?php if ( ! $ps->isEmpty() ): ?>
							<?php foreach ($ps as $p): ?>
								<div class="span3 centerText <?= App\Helpers\Vista::is_first($i) ?>">
									
									<a href="<?= BASE_URL.'productos/producto/'.$p['producto_id'] ?>" class="title">
										<img <?= App\Helpers\Vista::buildDefaultImg($p, 'thumb_medium') ?>>
									</a>

									<a href="<?= BASE_URL.'productos/producto/'.$p['producto_id'] ?>" class="title">
										<?= $p['producto_nombre'] ?>
									</a>

									<span class="precio">
										<?= App\Helpers\Utils::to_pesos($p['producto_precio']) ?>
									</span>

								</div>
							<?php endforeach ?>
						<?php else: ?>
							<?php echo "No se encontraron productos." ?>
						<?php endif ?>				
						</div>
						
					</div>
				</div>
			</div>	
			<!-- /span9 -->	
		</div>
	</div>
</div>