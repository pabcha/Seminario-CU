				<!-- Menu categorias -->
				<div class="span3">
					<div class="header-menu">
						<span>Categorias</span>
					</div>

					<ul class="menu-categorias">
						<?php if ( ! $categorias->isEmpty() ): ?>

							<?php foreach ($categorias as $c): ?>
								<li>
									<a href="<?= BASE_URL.'productos/categoria/'.$c['producto_categoria_id'].'/1'; ?>" class="nav-header">
										<?= $c['producto_categoria_nombre'] ?>
									</a>
									<?php App\Classes\TiendaService::createTree( $c['producto_categoria_id']); ?>
								</li>						
							<?php endforeach ?>

						<?php else: ?>
							<li>No hay categorias</li>
						<?php endif ?>
					</ul>

				</div>