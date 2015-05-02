<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php echo $this->titulo; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="<?= $roots['css'] ?>vendor/bootstrap.min.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>vendor/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?= $roots['css'].'front/estilos_comercio.css'; ?>" rel="stylesheet" type="text/css">
	<link href="<?= $roots['css'].'front/recuperar.css'; ?>" rel="stylesheet" type="text/css">
	<link href="<?= $roots['css'].'front/exito.css'; ?>" rel="stylesheet" type="text/css">

	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>	

	<script src="<?= $roots['js'] ?>vendor/jquery-1.8.2.min.js"></script>
	<script src="<?= $roots['js'] ?>vendor/bootstrap.min.js"></script>	
</head>
<body>	
	<div class="container">
		<div class="row-fluid exito-container">
			<div class="exit-container">
				<h3>Por favor, revise su correo</h3>
				<p>Se le ha enviado una nueva contraseña al correo registrado en nuestro sistema. Copie y pegue la informacion en el area de login y podra
				acceder nuevamente.</p>
				<p>Si la contraseña es muy dificil de recordar cambiela desde las opciones de usuario una vez dentro del sistema.</p>
				
				<a href="<?php echo BASE_URL; ?>" class="btn" style="margin-top:10px;margin-right:5px;">Ir a inicio</a>				
			</div>			
		</div>
	</div>
</body>
</html>