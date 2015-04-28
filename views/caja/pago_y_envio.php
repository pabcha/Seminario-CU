<div class="conten-prin" style="margin-bottom:30px;">
	<div class="s960">

		<div class="row-fluid" style="margin-bottom:30px;">
			<div class="titulo-post">
				<h3 style="font-size:22px;">Informacion de envio</h3>
			</div>
			<div class="domicilios row-fluid" style="margin-left:0;">
				<table class="tab-det-carro">
					<tbody>
						<tr>
							<td>
								Nombre
							</td>
							<td class="resaltar">
								<?= $u->us_nombre.' '.$u->us_apellido ?>
							</td>									
						</tr>
						<tr>
							<td>
								Domicilio
							</td>
							<td class="resaltar">
								<?= $u->us_domicilio ?>
							</td>									
						</tr>
						<tr>
							<td>
								Provincia
							</td>
							<td class="resaltar">
								<?= $u->us_provincia ?>
							</td>									
						</tr>
						<tr>
							<td>
								Ciudad
							</td>
							<td class="resaltar">
								<?= $u->us_ciudad ?>
							</td>									
						</tr>
						<tr>
							<td>
								Codigo Postal
							</td>
							<td class="resaltar">
								<?= $u->us_cpostal ?>
							</td>									
						</tr>
						<tr>
							<td>
								Telefono
							</td>
							<td class="resaltar">
								<?= $u->us_telefono ?>
							</td>									
						</tr>								
					</tbody>
				</table>
			</div>				
		</div>
		<!-- /info envio -->

		<div class="row-fluid">
			<div class="titulo-post">
				<h3 style="font-size:22px;">Forma de pago</h3>
			</div>

			<ul class="formas-pago">
				<li style="margin-bottom:20px;">
					<input type="radio" name="forma_pago" id="radio-transfer">
					<label for="inputTB">Transferencia Bancaria</label>
					<div class="detalle_pago_tb alerta" style="padding-bottom:15px;display:none;" id="transfer">
						<p>Debera realizar una transferencia bancaria, la cual sera acordada con el vendedor luego de realizar la orden.
						</p>
						<div class="row-fluid" style="text-align: right;">
							<a href="<?= BASE_URL.'caja/cobrar_transferencia' ?>" class="boton boton-acept">Transferencia bancaria</a>
						</div>
						<div style="clear:both"></div>
					</div>
				</li>
				<li>
					<input type="radio" name="forma_pago" id="radio-credit-card">
					<label for="inputPP">
						<img src="<?= BASE_URL.'public/img/visa-curved-32px.png' ?>" alt="visa">
						<img src="<?= BASE_URL.'public/img/mastercard-curved-32px.png' ?>" alt="mastercard">
						<img src="<?= BASE_URL.'public/img/american-express-curved-32px.png' ?>" alt="american-express">
						<img src="<?= BASE_URL.'public/img/discover-curved-32px.png' ?>" alt="discover">
					</label>
					<div class="detalle_pago_pp alerta" id="credit-card" style="display:none">
						<p>Usamos Stripe un procesador de pagos online.</p>
						<div class="row-fluid" style="text-align: right;">
							<form action="<?= BASE_URL.'caja/cobrar_stripe' ?>" method="POST">
							  <script
							    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
							    data-key="<?= stripe_pub ?>"
							    data-name="Saltashop"
							    data-currency="ARS"
							    data-panel-label="Pagar {{amount}}"
							    data-label="Pagar con Stripe"
							    data-email="<?= $correo ?>"
							    data-allow-remember-me="false"
							    data-description="<?= $descripcion ?>"
							    data-amount="<?= $total ?>">
							  </script>
							</form>
						</div>
					</div>
				</li>					
			</ul>
		</div>		
	</div>
</div>