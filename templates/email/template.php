<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<table style="font-family:Verdana,sans-serif;font-size:11px;color:#374953;width:550px;">
	<tbody>
		<tr>
			<td style="background-color:#ff5e00;color:#fff;font-size:12px;font-weight:bold;padding:0.5em 1em;" align="left"><?php echo $titulo; ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>

		<?php include_once ROOT.'templates/email/'.$view.'.php'; ?>

		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="font-size:10px;border-top:1px solid #D9DADE;" align="center">
				<a style="color:#ff5e00;font-weight:bold;text-decoration:none;" href="<?php echo BASE_URL; ?>" target="_blank">SaltaShop.com</a></a>
			</td>
		</tr>
	</tbody>
	</table>
</body>
</html>	