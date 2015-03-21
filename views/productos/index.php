	<!-- contenido principal	-->
	<div class="conten-prin">
		<div class="container">
			<div class="row-fluid">
				<?php include_once ROOT.'views\layout\default\leftbar.php'; ?>

				<div class="span9">

					<div class="row-fluid">
						<div class="catalogo-header">
							<h3>Productos Destacados</h3>
						</div>
					</div>

					<?php if (count($productos) == 0): ?>	
						<div class="row-fluid mensaje-no-products">
							<p>No encontramos productos en esta categoria.</p>
						</div>
					<?php endif ?>

					<?php if (count($productos) > 0): ?>
						<div class="row-fluid">
							<div class="widget-product">						
								<div class="widget-product-content">
									<?php 
										$i = 1;
										foreach ($productos as $producto): 
									?>
										<?php $imagen = $Producto->getImagenPredeterminada( $producto['id'] ); ?>
										<?php $clase = ( ($i-1) % 3 == 0 ) ? 'first' : ''; ?>

										<div class="span4 centerText <?php echo $clase; ?>">
											<a href="<?php echo BASE_URL.'productos/producto/'.$producto['id']; ?>">

												<?php if (isset($imagen['nombre']) && !empty($imagen['nombre'])): ?>
													<img src="<?php echo BASE_URL; ?>storage/uploads/thumb_medium/<?php echo $imagen['nombre']; ?>" alt="<?php echo $imagen['nombre']; ?>">	
												<?php else: ?>
													<img src="<?php echo BASE_URL; ?>storage/uploads/no-image.jpg" alt="no-image">
												<?php endif ?>

											</a>
											<a href="<?php echo BASE_URL.'productos/producto/'.$producto['id']; ?>" class="title"><?php echo $producto['nombre']; ?></a>
											<span class="precio"><?php echo "$ ".$producto['precio']; ?></span>
										</div>
										<?php $i++; ?>
									<?php endforeach ?>
								</div>						
							</div>
						</div>
						<!-- /thumbnails -->					
					<?php endif ?>
				</div>	<!-- /span9 -->	
			</div>
		</div>
	</div>