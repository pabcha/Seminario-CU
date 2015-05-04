<!-- contenido principal	-->
<div class="conten-prin">
	<div class="container">
		<div class="row-fluid">
			<?php include_once ROOT.'views\layout\default\leftbar.php'; ?>	
			<div class="span3"></div>

			<!-- Articulos -->
			<div class="span9">
				<div class="catalogo-header">
					<h3>
						<?= htmlspecialchars($p['producto_nombre']) ?>
					</h3>
				</div>
				<div class="row-fluid">
					<div class="wrap-short-descrip">
						<!-- imagenes -->
						<div class="galeria span6">
							<?php if (!$imagenes->isEmpty()): ?>

								<div id="slider" class="flexslider">
							        <ul class="slides">
							        	<?php foreach ($imagenes as $img): ?>
							        		<li>
							  	    			<img src="<?= BASE_URL.'storage/uploads/thumb_medium/'.$img->producto_img_nombre ?>">
							  	    		</li>
							        	<?php endforeach ?>
							        </ul>
								</div>

						        <div id="carousel" class="flexslider">
							        <ul class="slides">
							            <?php foreach ($imagenes as $img): ?>
							        		<li>
							  	    			<img src="<?= BASE_URL.'storage/uploads/thumb_tiny/'.$img->producto_img_nombre ?>">
							  	    		</li>
							        	<?php endforeach ?>
							        </ul>
						        </div>	
							<?php else: ?>
								<div class="flexslider">
									<img src="<?= BASE_URL.'storage/uploads/no-image.jpg' ?>" alt="no hay imagen">
								</div>
							<?php endif ?>								
						</div>

						<!-- Descripcion Resumen -->
						<div class="short-descrip span6">
							<div class="precio-header">
								<h2 class="precio">
									<?= App\Helpers\Utils::to_pesos(htmlspecialchars($p['producto_precio'])) ?>
								</h2>							
							</div>

							<div class="descripcion">
								<p><?= $p['producto_descripcion_corta'] ?></p>
							</div>

							
							<?php if ($p['producto_cantidad'] == 0): ?>
								<div class="prod-stock">
									<span class="label label-inverse" style="padding: 8px 15px 8px 15px;">producto sin stock</span>
								</div>
							<?php endif ?>
							
							<?php if ($p['producto_cantidad'] > 0): ?>
								<div class="botones">
									<div class="row-fluid">
										<div class="span3">
											<span style="display: inline-block; margin-top: 10px;">Cantidad:</span>
										</div>

										<div class="span6">
											<div class="btn-cant">
												<input type="button" class="restar" value="-">
												<input type="text" class="inputCant" maxlength="2" value="1" id="cantidad">
												<input type="button" class="sumar" value="+">
											</div>
										</div>
									</div>

									<div class="row-fluid" style="margin-top: 10px;">
										<?php if ($p['producto_cantidad'] > 0): ?>
											<input type="hidden" id="id" value="<?= $p['producto_id'] ?>">
											<button id="addCarro"class="boton large">Agregar al carrito</button>
										<?php endif ?>
									</div>
								</div>
							<?php endif ?>
						</div>
					</div>
				</div>

				<div class="row-fluid description">
					<h3>Descripcion</h3>
					<p><?= nl2br( htmlspecialchars($p['producto_descripcion']) ) ?></p>				
				</div>
			</div>
		</div>
	</div>
</div>