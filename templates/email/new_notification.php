<!doctype html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>

<table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#FFFFFF;">
<tbody>
<tr>
	<td align="center" valign="top" style="border-collapse:collapse;">		
		<table border="0" cellpadding="0" cellspacing="0" width="600" id="ecxtemplateHeader" style="background-color:#FFFFFF;border-bottom:0;border-bottom:2px solid #CACACA;">
			<tbody>
			<tr>
				<td style="border-collapse:collapse;color:#202020;font-family:Tahoma,kalimati;font-size:16px;line-height:100%;padding:0;vertical-align:middle;line-height:1em;">
					<h1 style="color:#81b947;font-size:28px;line-height:100%;font-weight:400;margin-bottom:20px;">
						Notificación de estado de tu pedido
					</h1>
					<p>
						Orden de pedido 
						<span style="background-color:#ECECEC;color:#ff5e00;font-size:18px;padding:3px 7px;border-radius:6px;">
							<?php echo Underscore\Types\Number::paddingLeft($id, 5); ?>
						</span>
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
                <td>
                    <p style="font-family:Arial;color:#505050;">
                    	Hola 
                    	<strong><?php echo $name; ?></strong>
                    </p>
                    <p style="padding:8px 20px;color:#505050;font-family:Arial;background-color:#D8F1F5;border:1px solid #C9CCCC;border-radius:4px;line-height:150%;">
	                    <?php echo nl2br($message); ?>
                    </p>
                </td>
            </tr>
       		</tbody>
        </table>
    </td>
</tr>
<tr>
	<td style="font-size:10px;border-top:1px solid #D9DADE;font-family:Verdana,sans-serif;" align="center">
		<a style="color:#ff5e00;font-weight:bold;text-decoration:none;" href="<?php echo BASE_URL; ?>" target="_blank">
			SaltaShop.com
		</a>
	</td>
</tr>
</table>
</body>
</html>