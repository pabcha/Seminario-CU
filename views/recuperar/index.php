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

	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>	

	<script type="text/javascript" src="<?php echo BASE_URL; ?>public/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>public/js/bootstrap.min.js"></script>
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
				<label for="inputCorreo">Correo</label>
				<input class="input-block-level" type="text" name="inputCorreo" value="<?php echo $validador->set_valor('inputCorreo'); ?>">
			
				<div class="pull-right">
					<a href="<?php echo BASE_URL.'entrar' ?>" class="btn" style="margin-top:10px;">Cancelar</a>
					<button type="submit" class="btn btn-info" style="margin-top:10px;margin-right:5px;">Enviar</button>					
				</div>
			</form>

		</div>
	</div>
</body>
</html>