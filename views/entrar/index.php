<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php echo $this->titulo; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
   
	<link href="<?php echo $_layoutParams['ruta_css']; ?>bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $_layoutParams['ruta_css']; ?>bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $_layoutParams['ruta_css']; ?>font-awesome.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL.'views/entrar/css/'; ?>login_style.css" rel="stylesheet" type="text/css">

	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>	

	<script type="text/javascript" src="<?php echo BASE_URL; ?>public/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>public/js/bootstrap.min.js"></script>
	<script>
		var sConfig = { url: "http://localhost/saltaShop/" };
	</script>
</head>
<body>
	<?php echo $errors; ?>
	<div class="container">
		<div class="row-fluid form-container">

			<a href="<?php echo BASE_URL; ?>">
				<h1>SaltaShop</h1>
			</a>
			<h2>Entrar</h2>	

			<form action="<?php echo BASE_URL.'entrar'; ?>" method="post" class="form-signin">				
				<label for="inputCorreo">Correo</label>
				<input class="input-block-level" type="text" name="inputCorreo" value="<?php echo $validador->set_valor('inputCorreo'); ?>">

				<label for="inputCorreo">Contraseña</label>
				<input class="input-block-level" type="password" name="inputPassword">

				<a href="<?php echo BASE_URL.'recuperar' ?>" class="help-block pull-right">¿Olvido su constraseña?</a>

				<button type="submit" class="btn btn-large btn-block btn-info">Entrar</button>
			</form>

			<p class="signin-notamember">¿No estas registrado? <a href="<?php echo BASE_URL; ?>registro">registrate ahora!</a></p>
		</div>
	</div>
</body>
</html>