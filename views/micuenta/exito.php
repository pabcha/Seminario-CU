<div class="conten-prin" style="margin-bottom:80px;">
	<div class="container">
		<!-- Orden recibida -->
		<div class="row-fluid" style="margin-bottom:30px;">

			<?php require_once ROOT.'views/micuenta/common/menu.php'; ?>	

			<div class="span9">
				<div class="row-fluid" style="margin-bottom:30px;">
					<div class="titulo-post">
						<h3 style="font-size:22px;">Su información personal ah sido modificada</h3>
					</div>
					<div class="domicilios row-fluid" style="margin-left:0;">
						<div class="span5">
							<table class="tab-det-carro">
								<tbody>
									<tr>
										<td>
											Nombre
										</td>
										<td class="resaltar">
											<?= $u->us_nombre; ?>
										</td>									
									</tr>
									<tr>
										<td>
											Apellido
										</td>
										<td class="resaltar">
											<?= $u->us_apellido; ?>
										</td>									
									</tr>
									<tr>
										<td>
											DNI
										</td>
										<td class="resaltar">
											<?= $u->us_dni; ?>
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
											Codigo postal
										</td>
										<td class="resaltar">
											<?= $u->us_cpostal ?>
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
											Telefono
										</td>
										<td class="resaltar">
											<?= $u->us_telefono ?>
										</td>									
									</tr>
									<tr>
										<td>
											Celular
										</td>
										<td class="resaltar">
											<?= $u->us_celular ?>
										</td>									
									</tr>			
								</tbody>
							</table>			
						</div>
					</div>				
				</div>			
			</div>
		</div>
	</div>
</div>