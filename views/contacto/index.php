	<!-- Contacto -->

	<div class="conten-prin">
		<div class="container">
			<div class="row-fluid">
				<div class="span9">
					<div class="titulo-post">
						<h3 style="font-size:22px;">Contactar</h3>
					</div>

					<!-- Contacto contenido -->
					<div class="cuerpo-contacto">
						<div class="google-map">
							<iframe height="350" src="https://www.google.com/maps/ms?msa=0&amp;msid=203800839985310471200.0004d69487e0e324d1c50&amp;ie=UTF8&amp;t=m&amp;ll=-24.792657,-65.404701&amp;spn=0.013636,0.018239&amp;z=15&amp;output=embed"></iframe>
						</div>
						<div class="det-contacto">
							<div class="span4">
								<div class="renglon">
									<h5><i class="icon-globe"></i> Provincia:</h5>
									<p>Argentina, Salta Capital</p>
								</div>
								<div class="renglon">
									<h5><i class="icon-road"></i> Direccion:</h5>
									<p>Belgrano 775</p>
								</div>
								<div class="renglon">
									<h5><i class="icon-rss"></i> Redes sociales:</h5>
									<p>
										<a href="#"><i class="icon-facebook-sign" style="font-size:32px;color: #777777;margin-right:8px;"></i></a> 
										<a href="#"><i class="icon-twitter-sign" style="font-size:32px;color: #777777;margin-right:8px;"></i></a>
									</p>
								</div>
							</div>
							<div class="span4">
								<div class="renglon">
									<h5><i class="icon-phone"></i> Telefono:</h5>
									<p>(387)-154-587458</p>
								</div>
								<div class="renglon">
									<h5><i class="icon-envelope-alt"></i> Correo:</h5>
									<p>saltashop@saltashop.com.ar</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="span3">	
					<!-- Productos en ofertas -->
					<div class="header-menu">
						<span>Novedad</span>
					</div>
					<div class="wrap-ofertas">
					<?php if ( ! $ps->isEmpty() ): ?>
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
					<?php else: ?>
						<?php echo "No se encontraron productos." ?>
					<?php endif ?>	
					</div>

					<!-- Productos mas comprados -->
					<div class="header-menu">
						<span>Mas vendidos</span>
					</div>
					<div class="wrap-ofertas">
					<?php if ( !empty($top) ): ?>
						<?php foreach ($top as $p): ?>
							<div class="prod-oferta">
								<div class="nom-prod-oferta">
									<span class="nom">
										<?= $p['producto_nombre']  ?>
									</span>
									<span class="precio"><?= App\Helpers\Utils::to_pesos($p['producto_precio']) ?></span>
								</div>
								<div class="img-prod">
									<img <?= App\Helpers\Vista::getDefaultImg($p, 'thumb_tiny') ?>>
								</div>
							</div>
						<?php endforeach ?>
					<?php else: ?>
						<?php echo "No se encontraron productos." ?>
					<?php endif ?>					
					</div>
				</div>
				<!-- /Barra derecha -->

			</div>
		</div>
	</div>