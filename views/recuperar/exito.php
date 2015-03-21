<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php echo $this->titulo; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
   
	<link href="<?php echo $_layoutParams['ruta_css']; ?>bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $_layoutParams['ruta_css']; ?>bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $_layoutParams['ruta_css']; ?>font-awesome.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL.'views/recuperar/css/'; ?>recuperar.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL.'views/recuperar/css/'; ?>exito.css" rel="stylesheet" type="text/css">

	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>	

	<script type="text/javascript" src="<?php echo BASE_URL; ?>public/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>public/js/bootstrap.min.js"></script>
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
				<a href="<?php echo BASE_URL.'entrar'; ?>" class="btn" style="margin-top:10px;">Entrar a SaltaShop</a>
			</div>			
		</div>
	</div>
</body>
</html>