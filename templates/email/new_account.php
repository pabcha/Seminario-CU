<!DOCTYPE html>
<html>
<head></head>
<body>
	<table style="font-family:Verdana,sans-serif;font-size:11px;color:#374953;width:550px;">
		<tbody>	
			<tr>
				<td align="left">
					Hola <strong style="color:#ff5e00;"><?php echo $name; ?></strong>,
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td style="background-color:#ff5e00;color:#fff;font-size:12px;font-weight:bold;padding:0.5em 1em;" align="left">
					Detalles de su cuenta
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="left">
					<strong>Gracias por crear una cuenta de cliente en Salta Shop.</strong><br><br> 
					Estos son sus datos de acceso:<br><br> 
					Correo: <strong><span style="color:#ff5e00;"><?php echo $destino; ?></span></strong> <br>
					Contraseña: <strong><?php echo $password; ?></strong>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="left">
					Ahora podrá realizar pedidos en nuestra tienda: 
					<a href="<?php echo BASE_URL; ?>" target="_blank">Salta Shop</a>.
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:10px;border-top:1px solid #D9DADE;" align="center">
					<a style="color:#ff5e00;font-weight:bold;text-decoration:none;" href="<?php echo BASE_URL; ?>" target="_blank">
						SaltaShop.com
					</a>
				</td>
			</tr>
		</tbody>
		</table>
</body>
</html>