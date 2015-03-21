<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Gracias - Salta Shop</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="<?php echo $_layoutParams['ruta_css']; ?>bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $_layoutParams['ruta_css']; ?>bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $_layoutParams['ruta_css']; ?>font-awesome.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL.'views/registro/css/'; ?>felicidades.css" rel="stylesheet" type="text/css">
        
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100' rel='stylesheet' type='text/css'>

	<script type="text/javascript" src="<?php echo BASE_URL; ?>public/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>public/js/bootstrap.min.js"></script>		
</head>
<body>

	<div class="container">
		<div class="row-fluid">
			<div class="header">
				<h1>Gracias por registrarse!</h1>
			</div>
			<div class="congratulation-container">
				<div class="congratulation-message">
					<p>Sus datos han sido enviados al correo proporcionado en el registro.</p>	
					<p>¿Desea <a href="<?php echo BASE_URL.'entrar'; ?>">Entrar en SaltaShop</a> o <a href="<?php echo BASE_URL; ?>">volver a inicio</a>?</p>
				</div>				
			</div>
		</div>
	</div>



</body>
</html>