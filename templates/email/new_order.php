<!doctype html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>

<table border="0" cellpadding="0" cellspacing="0" width="600" id="ecxtemplateContainer" style="background-color:#FFFFFF;">
<tbody>
<tr>
	<td align="center" valign="top" style="border-collapse:collapse;">		
		<table border="0" cellpadding="0" cellspacing="0" width="600" id="ecxtemplateHeader" style="background-color:#FFFFFF;border-bottom:0;border-bottom:2px solid #CACACA;">
			<tbody>
			<tr>
				<td class="ecxheaderContent" style="border-collapse:collapse;color:#202020;font-family:Tahoma,kalimati;font-size:16px;line-height:100%;padding:0;vertical-align:middle;line-height:1em;">
					<h1 style="color:#81b947;font-size:28px;line-height:100%;">
						Tu pedido está en proceso
					</h1>
					<p>
						Tu orden ha sido ingresada y estamos procesando tu compra
					</p>
				</td>
			</tr>
			</tbody>
		</table>		
	</td>
</tr>

<tr>
	<td colspan="" rowspan="" headers="">
		<table border="0" cellpadding="20" cellspacing="0" width="100%">
			<tbody>
			<tr>
				<td valign="top" style="border-collapse:collapse;">

					<div style="color:#505050;font-family:Arial;font-size:12px;line-height:150%;text-align:center;padding-bottom:10px;">
						<h2 style="font-size:1.4em;color:#373E46;text-align:left;padding-left:14px;">		
							Hola Pablo tus datos de confirmación son:
						</h2>

						<table width="100%" style="font-family:Tahoma,kalimati;font-size:14px;color:#515151;">
						<tbody>
							<tr>								
							</tr>
							<tr>
								<td width="70%">
									<ul style="padding-left:10px;list-style:none;text-align:left;">
										<li>
											<strong>Domicilio: </strong>
											<?php echo $domicilio; ?>
										</li>
										<li>
											<strong>Correo: </strong>
											<?php echo $correo; ?>
										</li>
										<li>
											<strong>Teléfono: </strong>
											<?php echo $telefono; ?>
										</li>										
										<li>
											<strong>Forma de pago: </strong>
											<?php echo $pago; ?>
										</li>
									</ul>
								</td>
								<td width="30%">
									<h2 style="line-height:1.3em;">
										Tu número de orden es 
										<span style="display:block;color:#FF694F;">
											<?= Underscore\Types\Number::paddingLeft($id, 5) ?>
										</span>
									</h2>
								</td>
							</tr>
						</tbody>
						</table>						
					</div>

					<div style="color:#505050;font-family:Arial;font-size:12px;line-height:150%;text-align:center;">
						<div style="height:10px;color:#505050;font-family:Arial;font-size:12px;line-height:150%;text-align:center;"></div>
						
						<table style="width:100%">
							<thead>
								<tr>
									<th style="background: #EEEEEE;border: 1px solid #e6e6e6;color: #373E46;font-size: 14px;
										font-weight: bold;padding: 10px 0 10px 15px;text-align: left;width: 30%">
										Producto
									</th>
									<th style="background: #EEEEEE;border: 1px solid #e6e6e6;color: #373E46;font-size: 14px;
										font-weight: bold;padding: 10px 0 10px 15px;text-align: left;width: 15%">
										Cantidad
									</th>
									<th style="background: #EEEEEE;border: 1px solid #e6e6e6;color: #373E46;font-size: 14px;
										font-weight: bold;padding: 10px 0 10px 15px;text-align: left;width: 20%">
										Precio
									</th>
									<th style="background: #EEEEEE;border: 1px solid #e6e6e6;color: #373E46;font-size: 14px;
										font-weight: bold;padding: 10px 0 10px 15px;text-align: left;width: 35%">
										Subtotal
									</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($ps as $p): ?>
								<tr>
									<td style="padding: 10px 0 10px 15px;vertical-align: middle;font-size: 14px;">
										<?= $p['producto_nombre'] ?>
									</td>
									<td style="padding: 10px 0 10px 15px;vertical-align: middle;font-size: 14px;">
										<?= $p['cantidad'] ?>
									</td>
									<td style="padding: 10px 0 10px 15px;vertical-align: middle;font-size: 14px;color: #FF694F;">
										<?= App\Helpers\Utils::to_pesos($p['producto_precio']) ?>
									</td>
									<td style="padding: 10px 0 10px 15px;vertical-align: middle;font-size: 14px;color: #FF694F;">
										<?= App\Helpers\Utils::to_pesos($p['producto_precio'] * $p['cantidad']); ?>
									</td>
								</tr>	
								<?php endforeach ?>								
							</tbody>
							<tfoot>					
								<tr>
									<th style="background: #EEEEEE;border: 1px solid #e6e6e6;color: #373E46;font-size: 14px;
										font-weight: bold;padding: 10px 0 10px 15px;text-align: left;width: 30%" colspan="3">
										Costos de envio
									</th>
									<td style="padding: 10px 0 10px 15px;vertical-align: middle;font-size: 14px;">
										Acordar con el vendedor
									</td>
								</tr>
								<tr>
									<th style="background: #EEEEEE;border: 1px solid #e6e6e6;color: #373E46;font-size: 14px;
										font-weight: bold;padding: 10px 0 10px 15px;text-align: left;width: 30%" colspan="3">
										Total
									</th>
									<td style="padding: 10px 0 10px 15px;vertical-align: middle;font-weight:bold;font-size:16px;color: #FF694F;">
										<?= App\Helpers\Utils::to_pesos($carrito_total) ?>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</td>
			</tr>
		</tbody>
		</table>
	</td>
</tr>

<tr>
	<td align="center" valign="top" style="border-collapse:collapse;">
		
		<table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#D8F1F5;border-top:0;">
			<tbody>
			<tr>
				<td valign="top" style="border-collapse:collapse;">
					<div style="height:3px;width:600px;color:#707070;font-family:Arial;font-size:15px;line-height:125%;text-align:left;"></div>
				
					
					<table border="0" cellpadding="10" cellspacing="0" width="100%">
					<tbody>
						<tr>
							<td valign="top" width="100%" style="border-collapse:collapse;">
								<div style="color:#707070;font-family:Arial;font-size:15px;line-height:125%;text-align:left;padding-bottom:16px;">
									Para cualquier duda no dudes en comunicarte con nosotros escríbenos a 
									<strong>
										<a style="color:#DA283E;" target="_blank">
											<?php echo EMAIL_USERNAME; ?>
										</a>
									</strong>
								</div>
							</td>
						</tr>
					</tbody>
					</table>
					
				
				</td>
			</tr>
		</tbody></table>
		
	</td>
</tr>
</table>
</body>
</html>