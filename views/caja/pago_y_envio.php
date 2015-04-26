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
								Juan Perez
							</td>									
						</tr>
						<tr>
							<td>
								Domicilio
							</td>
							<td class="resaltar">
								Lamadrid 979
							</td>									
						</tr>
						<tr>
							<td>
								Provincia
							</td>
							<td class="resaltar">
								Salta
							</td>									
						</tr>
						<tr>
							<td>
								Ciudad
							</td>
							<td class="resaltar">
								Salta
							</td>									
						</tr>
						<tr>
							<td>
								Codigo Postal
							</td>
							<td class="resaltar">
								4400
							</td>									
						</tr>
						<tr>
							<td>
								Telefono
							</td>
							<td class="resaltar">
								4236875
							</td>									
						</tr>								
					</tbody>
				</table>
			</div>				
		</div>
		<!-- /info envio -->

		<form action="caja.html">
			<div class="row-fluid">
				<div class="titulo-post">
					<h3 style="font-size:22px;">Forma de pago</h3>
				</div>

				<ul class="formas-pago">
					<li>
						<input type="radio" name="inputFPago" id="inputTB" checked="checked">
						<label for="inputTB">Transferencia Bancaria</label>
						<div class="detalle_pago_tb alerta">
							<p>El cliente debera realizar una transferencia bancaria, la cual sera acordada con el vendedor luego de realizar la orden. Su orden no se enviara hasta que se halla verificado el pago.
							</p>
						</div>
					</li>
					<li>
						<input type="radio" name="inputFPago" id="inputPP">
						<label for="inputPP">PayPal <img src="img/paypal.png" alt=""></label>
						<div class="detalle_pago_pp alerta">
							<p>El cliente sera redireccionado a PayPal para efectuar el pago utilizando su tarjeta de credito.</p>
						</div>
					</li>					
				</ul>
			</div>
			<!-- /forma de pago -->
				
			<div class="row-fluid" style="text-align: right">
				<input type="submit" class="boton boton-acept btn-pay" value="Listo">
			</div>
			<!-- /enviar orden -->
		</form>
	</div>
</div>