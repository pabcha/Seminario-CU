	<!-- contenido principal	-->
	<div class="conten-prin">
		<div class="container">
			<div class="row-fluid">
				
				<div class="span3">
					<div class="header-menu">
						<span>Categorias</span>
					</div>

					<ul class="menu-categorias">
						<li>No hay categorias</li>
					</ul>
				</div>

				<!-- Articulos -->
				<div class="span9">
					<div class="catalogo-header">
						<h3><?php echo htmlspecialchars( $producto['nombre'] ); ?></h3>
					</div>
					<div class="row-fluid">
						<!-- <div class="wrap-short-descrip"> -->
							
							<div class="galeria span6">
								<div class="flexslider">
						            <ul class="slides">
						            	<?php foreach ($imagenes as $imagen): ?>
						            	<li data-thumb="<?php echo BASE_URL ?>storage/uploads/thumb_tiny/<?php echo $imagen['producto_img_nombre']; ?>">
							  	    	    <img src="<?php echo BASE_URL ?>storage/uploads/thumb_medium/<?php echo $imagen['producto_img_nombre']; ?>" alt="<?php echo htmlspecialchars( $producto['nombre'] ); ?>">
							  	    	</li>	
						            	<?php endforeach ?>
						            	<?php if (empty($imagenes)): ?>
						            		<li data-thumb="<?php echo BASE_URL ?>storage/uploads/no-image.jpg'; ?>">
						            			<img src="<?php echo BASE_URL; ?>storage/uploads/no-image.jpg" alt="no-image">
						            		</li>
						            	<?php endif ?>
						            </ul>
        						</div>
							</div><!-- /slider imagenes -->

							
							<div class="short-descrip span6">
								<div class="precio-header">
									<span class="precio-ant">$850</span>
									<span class="precio"><?= App\Helpers\Utils::to_pesos(htmlspecialchars($producto['precio'])); ?></span>							
								</div>

								<div class="descripcion">
									<p><?php echo nl2br(htmlspecialchars( $producto['descripcion_corta'] )); ?></p>									
								</div>
							
								<div class="prod-categoria">
									<!-- Botones redes sociales -->
									<span>Redes sociales aqui</span>
								</div>
							
								<form action="<?php echo BASE_URL."productos/add_producto" ?>" name="formAdd2Cart" id="formAdd2Cart" method="post">
									<input type="hidden" name="inputIdProducto" value="<?php echo $producto['id']; ?>">
									<input type="hidden" name="inputStock" id="stock" value="<?php echo $producto['cantidad']; ?>">

									<div class="prod-stock" style="margin-bottom: 15px;">
										<?php if ($producto['cantidad'] > 0): ?>
											<?php if ($producto['cantidad'] <= 5): ?>
												<span class="label label-important" style="padding: 5px 10px 5px 10px;"><?php echo $producto['cantidad']; ?> disponibles</span>	
											<?php else: ?>
												<span class="label label-info">disponible</span>	
											<?php endif ?>											
										<?php else: ?>
											<span class="label label-inverse" style="padding: 8px 15px 8px 15px;">producto sin stock</span>
										<?php endif ?>										
									</div>

									<div class="botones">
										<?php if ($producto['cantidad'] > 0): ?>
										<div class="cantidad" style="margin-bottom: 15px;">
											<span>Cantidad:</span>

											<div class="btn-cant">												
												<input type="button" class="restar" value="-" name="restar">
												<input type="text" class="inputCantidad" maxlength="2" value="1" id="inputCantidad" name="inputCantidad">
												<input type="button" class="sumar" value="+" name="sumar">
											</div>
										</div>
										<?php endif ?>
									</div>									

									<?php if ($producto['cantidad'] > 0): ?>
										<button type="submit" class="boton large">Agregar</button>	
									<?php endif ?>									
								</form>
							</div><!-- /Descripcion Resumen -->
						<!-- </div> -->
					</div>

					<!-- Tabs -->
					<div class="row-fluid">
						<div class="wrap-tabs">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#descripcion" data-toggle="tab">Descripcion</a></li>
								<li><a href="#reviews" data-toggle="tab">comentarios (0)</a></li>	
							</ul>

							<div class="tab-content">

								<div class="tab-pane active" id="descripcion">									
									<p><?php echo nl2br(htmlspecialchars( $producto['descripcion'] )); ?></p>
								</div>

								<div class="tab-pane" id="reviews">
									<h4>Comentarios</h4>

									<div class="alerta" id="alerta" style="display:none;margin-bottom:0;margin-top:15px;">
										<ul class="alert_info">
										</ul>
									</div>

									<!-- comentario -->
									<div class="media" style="margin-top:0">
										<span class="text-min">Escribe un comentario:</span>
										<form action="producto.html" name="form-coment">
											<textarea name="inputComent" id="inputComent"></textarea>
											<input type="submit" class="boton" value="Comentar">
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Productos relacionados -->
					<div class="row-fluid">
						<div class="header-strong">
							<h3>Productos relacionados</h3>
						</div>
						<!-- <ul class="thumbnails">
							<li class="span4">
								<div class="thumbnail">
									<a href="#">
										<img src="img/Military-Pilot-Watch-9027big-400x400.jpeg" alt="imagen">	
									</a>
									<div class="detalle_thumb">
										<a href="#"><h3>Nokia Lumia 900</h3></a>
										<span>$158.07</span>
										<a href="#" class="btn btn-warning">Agregar</a>
									</div>
								</div>
							</li>
							<li class="span4">
								<div class="thumbnail">
									<a href="#">
										<img src="img/menswatch-500x392.jpeg" alt="imagen">	
									</a>
									<div class="detalle_thumb">
										<h3>Nokia Lumia 900</h3>
										<span>$158.07</span>
										<a href="#" class="btn btn-warning">Agregar</a>
									</div>
								</div>					
							</li>
							<li class="span4">
								<div class="thumbnail">
									<a href="#">
										<img src="img/Military-Pilot-Watch-9027big-400x400.jpeg" alt="imagen">	
									</a>
									<div class="detalle_thumb">
										<h3>Nokia Lumia 900</h3>
										<span>$158.07</span>
										<a href="#" class="btn btn-warning">Agregar</a>
									</div>
								</div>						
							</li>
						</ul> -->					
					</div>
				</div>
			</div>
		</div>
	</div>