	<!-- Carrito -->
	<div class="conten-prin">
		<div class="container">
			<div class="row-fluid">

				<div class="titulo-post">
					<h3 style="font-size:22px;">Carrito de compras</h3>
				</div>

				<div class="detalle_carro" style="margin-left:0;">

					<?php if ( Session::get('mensaje_exito') ): ?>
						<div class="row-fluid">
							<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<?php echo Session::show('mensaje_exito'); ?>
							</div>
						</div>	
					<?php endif ?>

					<?php if ( Session::get('mensaje_err') ): ?>
						<div class="row-fluid">
							<div class="alert alert-error">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<?php echo Session::show('mensaje_err'); ?>
							</div>
						</div>
					<?php endif ?>
					
					<div class="row-fluid">
						<form action="<?php echo BASE_URL.'carrito/update'; ?>" name="update_carrito" method="post">
							<table class="tab-det-carro">
								<thead>
									<tr>
										<th class="prod-quitar"></th>
										<th class="prod-thumb hidden-phone"></th>
										<th class="prod-nombre">Producto</th>
										<th class="prod-precio">Precio unitario</th>
										<th class="prod-cantidad">Cantidad</th>
										<th class="prod-subtotal">Total</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($productos as $producto): ?>
									<tr>
										<td class="prod-quitar"><i class="icon-trash" id="<?php echo $producto['id']; ?>"></i></td>
										<td class="prod-thumb hidden-phone">
											<a href="<?php echo BASE_URL.'productos/producto/'.$producto['id']; ?>">
												<?php if (! empty($producto['imagen'])): ?>
													<img src="<?php echo BASE_URL; ?>public/img/thumb_tiny/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">		
												<?php else: ?>
													<img src="<?php echo BASE_URL; ?>public/img/no-image.jpg" alt="no-image">
												<?php endif ?>
											</a>
										</td>
										<td class="prod-nombre">
											<a href="<?php echo BASE_URL.'productos/producto/'.$producto['id'] ?>"><?php echo $producto['nombre']; ?></a>	
										</td>
										<td class="prod-precio">
											<?php echo $this->to_pesos($producto['precio']); ?>
										</td>
										<td class="prod-cantidad">
											<div class="btn-cant">
												<input type="button" class="restar" value="-">
												<input type="text" class="inputCantidad" id="prod_<?php echo $producto['id']; ?>" name="<?php echo $producto['id']; ?>" maxlength="2" value="<?php echo $producto['cantidad']; ?>">
												<input type="button" class="sumar" value="+">
											</div>
										</td>
										<td class="prod-subtotal">
											<?php echo $this->to_pesos($producto['precio'] * $producto['cantidad']); ?>
										</td>
									</tr>
									<?php endforeach ?>

									<tr>
										<td class="acciones" colspan="6">
											<div class="pull-right">
												<input type="submit" class="boton" value="Actualizar carrito">											
											</div>
										</td>								
									</tr>				
								</tbody>
							</table>
						</form>
					</div>
	
					<div class="row-fluid">
						<div class="resumen-carro span4 pull-right">
							<div class="titulo-header-2">
								<h3>Total en Carro</h3>
								<table class="tab-det-carro">
									<tr>
										<td>Subtotal</td>
										<td class="prod-precio"><?php echo $this->to_pesos($Carrito->get_total()); ?></td>
									</tr>
									<tr>
										<td>Costo de envio</td>
										<td>Acordar con el vendedor</td>
									</tr>
									<tr>
										<td style="font-size:16px;">Total</td>
										<td class="prod-precio" style="font-weight:bold;font-size:16px;"><?php echo $this->to_pesos($Carrito->get_total()); ?></td>
									</tr>
									<tr>
										<td colspan="2">
											<a href="#" class="boton boton-acept large" style="display:block;color:white;padding:8px;font-size:16px;">Comprar</a>										
										</td>
									</tr>					
								</table>								
							</div>
						</div>
					</div>				
				</div>				
			</div>
		</div>
	</div>