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

				<div class="span9">
					<div class="row-fluid">
						<div class="catalogo-header">
							<h3><?php echo $categoriaNombre; ?></h3>
						</div>
					</div>
					<!-- /nombre categoria -->

				<?php if (count($productos) == 0): ?>	
					<div class="row-fluid mensaje-no-products">
						<p>No encontramos productos en esta categoria.</p>
					</div>
				<?php else: ?>
					<div class="row-fluid mensaje-no-products">
						<p>Encontramos <span><?php echo $productosTotal; ?> productos</span> en esta categoria.</p>
					</div>
				<?php endif ?>
				<!-- /cantidad de productos -->

				<?php if ( count($subcategorias) > 0): ?>
					<div class="row-fluid subcategorias">
						<h4 style="margin-top:0;">&raquo; Subcategorias</h4>
						
						<ul>
						<?php foreach ($subcategorias as $subcategoria): ?>
							<li>
								<a href="<?php echo BASE_URL.'productos/categoria/'.$subcategoria['id']; ?>" class="link-subcategorias"><?php echo $subcategoria['nombre']; ?></a>
							</li>
						<?php endforeach ?>
						</ul>
					</div>
				<?php endif ?>
				 <!-- /subcategorias -->

				<?php //var_dump($_SESSION['catalogoDatos']); ?>
				<?php //echo $Catalogo->loadProductos2(21); ?>
				<?php //echo $sql; ?>
				<?php //var_dump($Catalogo->get_test() ); ?>				

				<?php if ( count($productos) > 0): ?>
					<div class="bar-busqueda">
						<div class="item">
							<select name="inputMarca" id="inputMarca">
								<option value="#">Marca</option>
								<?php foreach ($marcas as $marca): ?>

									<?php if ($Catalogo->get_data('marca_id') == $marca['id']): ?>
										<option value="<?php echo $marca['id']; ?>" selected="selected"><?php echo $marca['nombre']; ?></option>	
									<?php else: ?>
										<option value="<?php echo $marca['id']; ?>"><?php echo $marca['nombre']; ?></option>
									<?php endif ?>
									
								<?php endforeach ?>
							</select>
						</div> <!-- /select marca -->

						<div class="item price-range">
							<p>Precio:</p>
							<ul>									
								<li id="amount-min" class="lower-price"></li>
								<li class="slide">
									<div id="slider-range"></div>
								</li>
								<li id="amount-max" class="higher-price"></li>
							</ul>
							
							<input type="hidden" id="inputMinInicial" value="<?php echo $Catalogo->get_precio_minimo($categoria_id); ?>">
							<input type="hidden" id="inputMaxInicial" value="<?php echo $Catalogo->get_precio_maximo($categoria_id); ?>">
							<input type="hidden" id="inputCategoriaId" value="<?php echo $categoria_id; ?>">
							<input type="hidden" id="inputPrecioMin" name="inputPrecioMin" value="<?php echo $Catalogo->get_data('precio_minimo'); ?>">
							<input type="hidden" id="inputPrecioMax" name="inputPrecioMax" value="<?php echo $Catalogo->get_data('precio_maximo'); ?>">

							<!-- <form action="<?php //echo BASE_URL."productos/categoria/".$categoria_id ?>" id="formData" method="post">
								<input type="hidden" name="enviar" value="1">
								<input type="hidden" id="inputMarcaId" name="inputMarcaId" value="">
								<input type="hidden" id="inputPrecioMin" name="inputPrecioMin" value="">
								<input type="hidden" id="inputPrecioMax" name="inputPrecioMax" value="">
								<input type="hidden" id="inputOrden" name="inputOrden" value="">
							</form> -->
						</div>						
					</div> 
					<!-- /bar-busqueda -->

					<div class="row-fluid bar-filtros">
						<label for="inputOrden">Ordenar por:</label>
						<a href="<?php echo BASE_URL.'productos/ordenar/1/'.$categoria_id; ?>" <?php echo $Catalogo->set_default_orden('nombre');?> >Nombre</a>
						<span>|</span>
						<a href="<?php echo BASE_URL.'productos/ordenar/2/'.$categoria_id; ?>" <?php echo $Catalogo->set_default_orden('precio_asc');?> >Menor precio</a>
						<span>|</span>
						<a href="<?php echo BASE_URL.'productos/ordenar/3/'.$categoria_id; ?>" <?php echo $Catalogo->set_default_orden('precio_desc');?> >Mayor precio</a>
					</div>
					<!-- /bar-filtros -->

					<div class="row-fluid">							
						<div class="widget-product">						
							<div class="widget-product-content">
								<?php $i = 1;foreach ($productos as $producto): ?>
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
					
					<?php if ($total_paginas > 1): ?>				
						<div class="bar-busqueda">
							<div class="pagination">
								<ul>
									<?php for ($i = 1; $i <= $total_paginas ; $i++): ?>
										<?php if ($page == $i): ?>
											<li class="active"><a href="<?php echo BASE_URL.'productos/pagina/'.$categoria_id.'/'.$i; ?>"><?php echo $i; ?></a></li>
										<?php else: ?>
											<li><a href="<?php echo BASE_URL.'productos/pagina/'.$categoria_id.'/'.$i; ?>"><?php echo $i; ?></a></li>
										<?php endif ?>										
									<?php endfor; ?>
								</ul>
							</div>
						</div> 
					<?php endif ?>
					<!-- /bar-busqueda -->				
				<?php endif ?>
				</div>	<!-- /span9 -->	
			</div>
		</div>
	</div>