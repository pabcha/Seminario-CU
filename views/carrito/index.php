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
						<!-- BASE_URL.'carrito/update' -->
						<table class="tab-det-carro">
							<thead>
								<tr>
									<th class="prod-quitar"></th>
									<th class="prod-thumb hidden-phone"></th>
									<th class="prod-nombre">Producto</th>
									<th class="prod-precio">Precio unitario</th>
									<th class="prod-cantidad">Cantidad</th>
									<th class="prod-subtotal">Subtotal</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($productos as $producto): ?>
								<tr>
									<td class="prod-quitar"><i class="icon-trash" id="<?= $producto['producto_id']; ?>"></i></td>

									<td class="prod-thumb hidden-phone">
										<a href="<?= BASE_URL.'productos/producto/'.$producto['producto_id']; ?>">
											<?php if (! empty($producto['imagen'])): ?>
												<img src="<?= BASE_URL; ?>storage/uploads/thumb_tiny/<?= $producto['imagen']; ?>" alt="<?= $producto['producto_nombre']; ?>">		
											<?php else: ?>
												<img src="<?= BASE_URL; ?>storage/uploads/no-image.jpg" alt="no-image">
											<?php endif ?>
										</a>
									</td>

									<td class="prod-nombre">
										<a href="<?= BASE_URL.'productos/producto/'.$producto['producto_id'] ?>"><?= $producto['producto_nombre']; ?></a>	
									</td>

									<td class="prod-precio">
										<?= App\Helpers\Utils::to_pesos($producto['producto_precio']); ?>
									</td>

									<td class="prod-cantidad">
										<div class="btn-cant">
											<input type="button" class="restar" value="-">
											<input type="text" class="inputCant" id="<?= $producto['producto_id'] ?>" maxlength="2" value="<?= $producto['cantidad'] ?>">
											<input type="button" class="sumar" value="+">
										</div>
									</td>

									<td class="prod-subtotal" id="<?= 'total-'.$producto['producto_id'] ?>">
										<?= App\Helpers\Utils::to_pesos($producto['producto_precio'] * $producto['cantidad']); ?>
									</td>
								</tr>
								<?php endforeach ?>				
							</tbody>
						</table>
					</div>
	
					<div class="row-fluid resumen-carro">
						<div class="span4 pull-right">
							<table class="tab-det-carro">
								<tr>
									<td>Coste de envio</td>
									<td>Acordar con el vendedor</td>
								</tr>
								<tr>
									<td style="font-size:16px;">Total</td>
									<td class="prod-precio big-precio" id="total"><?= App\Helpers\Utils::to_pesos(App\Classes\Carrito::get_total()) ?></td>
								</tr>
								<tr style="border-top: none;">
									<td colspan="2" style="padding-top: 20px;">
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