<div class="span3">	
	<!-- Productos en ofertas -->
	<div class="header-menu">
		<span>Novedad</span>
	</div>
	<div class="wrap-ofertas">
		<?php foreach ($ps as $p): ?>
			<div class="prod-oferta">
				<div class="nom-prod-oferta">
					<span class="nom">
						<?= $p['producto_nombre']  ?>
					</span>
					<span class="precio"><?= App\Helpers\Utils::to_pesos($p['producto_precio']) ?></span>
				</div>
				<div class="img-prod">
					<img <?= App\Helpers\Vista::buildDefaultImg($p, 'thumb_tiny') ?>>
				</div>
			</div>
		<?php endforeach ?>
	</div>

	<!-- Productos mas comprados -->
	<div class="header-menu">
		<span>Mas vendidos</span>
	</div>
	<div class="wrap-ofertas">
		<?php foreach ($top as $p): ?>
			<div class="prod-oferta">
				<div class="nom-prod-oferta">
					<span class="nom">
						<?= $p['producto_nombre']  ?>
					</span>
					<span class="precio"><?= App\Helpers\Utils::to_pesos($p['producto_precio']) ?></span>
				</div>
				<div class="img-prod">
					<img <?= App\Helpers\Vista::buildDefaultImg($p, 'thumb_tiny') ?>>
				</div>
			</div>
		<?php endforeach ?>					
	</div>
</div>