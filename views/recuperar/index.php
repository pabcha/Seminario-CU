<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Recuperar Contraseña - Salta Shop</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
   
	<link href="<?= $roots['css'] ?>vendor/bootstrap.min.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>vendor/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?= $roots['css'].'front/estilos_comercio.css'; ?>" rel="stylesheet" type="text/css">
	<link href="<?= $roots['css'].'front/recuperar.css'; ?>" rel="stylesheet" type="text/css">

	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>	

	<script src="<?= $roots['js'] ?>vendor/jquery-1.8.2.min.js"></script>
	<script src="<?= $roots['js'] ?>vendor/bootstrap.min.js"></script>
</head>
<body>
	<?php echo $errors; ?>
	
	<div class="container">
		<div class="row-fluid form-container">

			<div class="recovery-head">
				<h3>¿Olvido su contraseña?</h3>
				<p>Ingrese el correo con el cual se registro y le enviaremos su contraseña.</p>
			</div>

			<form action="<?php echo BASE_URL.'recuperar'; ?>" method="post" class="form-recovery">
				<label for="correo">Correo</label>
				<input class="input-block-level" type="text" name="correo" value="<?php echo $validador->set_valor('correo'); ?>">
			
				<div class="pull-right">
					<a href="<?php echo BASE_URL.'entrar' ?>" class="btn" style="margin-top:10px;">Cancelar</a>
					<button type="submit" class="boton boton-acept" style="margin-top:10px;margin-right:5px;">Enviar</button>					
				</div>
			</form>

		</div>
	</div>
</body>
</html>