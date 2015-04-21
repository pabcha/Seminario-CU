<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php echo $this->titulo; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
   
	<link href="<?= $roots['css'] ?>vendor/bootstrap.min.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>vendor/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>vendor/font-awesome/font-awesome.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>front/login_style.css" rel="stylesheet">

	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>	

	<script src="<?= $roots['js'] ?>vendor/jquery-1.8.2.min.js"></script>
	<script src="<?= $roots['js'] ?>vendor/bootstrap.min.js"></script>
</head>
<body>
	<?php echo $errors; ?>
	<div class="container">
		<div class="row-fluid form-container">

			<a href="<?php echo BASE_URL; ?>">
				<h1>SaltaShop</h1>
			</a>

			<form action="<?php echo BASE_URL.'entrar'; ?>" method="post" class="form-signin">				
				<label for="inputCorreo">Correo</label>
				<input class="input-block-level" type="text" name="inputCorreo" value="<?php echo $validador->set_valor('inputCorreo'); ?>">

				<label for="inputCorreo">Contraseña</label>
				<input class="input-block-level" type="password" name="inputPassword">

				<a href="<?php echo BASE_URL.'recuperar' ?>" class="help-block pull-right">¿Olvido su contraseña?</a>
				
				<div style="clear: both;">
					<button type="submit" class="boton boton-acept boton-large">Entrar</button>
				</div>
			</form>

			<p class="signin-notamember">¿No estas registrado? <a href="<?php echo BASE_URL; ?>registro">registrate ahora!</a></p>
		</div>
	</div>
</body>
</html>