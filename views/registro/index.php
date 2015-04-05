<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Registrar - Salta Shop</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="<?= $roots['css'] ?>vendor/bootstrap.min.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>vendor/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>vendor/font-awesome/font-awesome.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>front/registro_style.css" rel="stylesheet">
        
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>	
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100' rel='stylesheet' type='text/css'>

	<script src="<?= $roots['js'] ?>vendor/jquery-1.8.2.min.js"></script>
	<script src="<?= $roots['js'] ?>vendor/bootstrap.min.js"></script>	
</head>
<body>
	
	<div class="container">
		<div class="row-fluid">
			
			<a href="<?php echo BASE_URL; ?>">
				<h1 class="logo">SaltaShop</h1>
			</a>

			<div class="header">
				<h1>Registrate!</h1>
			</div>
			<div class="newuser-container">

				<?php echo $errors; ?>
				
				<form class="form-horizontal newuser-form" action="<?php echo BASE_URL.'registro'; ?>" method="post">
					<div class="page-subheader">
						<h3 class="medium">Información de usuario</h3>
						<p>Con esta información accederas al sitio.</p>				
					</div>					

					<div class="control-group">
						<label class="control-label" for="inputCorreo">Correo</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="inputCorreo" value="<?php echo $validador->set_valor('inputCorreo'); ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="inputPassword">Contraseña</label>
						<div class="controls">
							<input type="password" class="input-block-level" name="inputPassword" value="<?php echo $validador->set_valor('inputPassword'); ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="inputPassword2">Repetir Contraseña</label>
						<div class="controls">
							<input type="password" class="input-block-level" name="inputPassword2" value="<?php echo $validador->set_valor('inputPassword2'); ?>">
						</div>
					</div>

					<div class="page-subheader">
						<h3 class="medium">Información de envío</h3>
						<p>A esta dirección llegara tu pedido.</p>				
					</div>

					<div class="control-group">
						<label class="control-label" for="inputNombre">Nombre</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="inputNombre" value="<?php echo $validador->set_valor('inputNombre'); ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="inputApellido">Apellido</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="inputApellido" value="<?php echo $validador->set_valor('inputApellido'); ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="inputDNI">DNI</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="inputDNI" value="<?php echo $validador->set_valor('inputDNI'); ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="inputProvincia">Provincia</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="inputProvincia" value="<?php echo $validador->set_valor('inputProvincia'); ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="inputCiudad">Ciudad</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="inputCiudad" value="<?php echo $validador->set_valor('inputCiudad'); ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="inputCPostal">Codigo postal</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="inputCPostal" value="<?php echo $validador->set_valor('inputCPostal'); ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="inputDomicilio">Domicilio</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="inputDomicilio" value="<?php echo $validador->set_valor('inputDomicilio'); ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="inputTelefono">Telefono</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="inputTelefono" value="<?php echo $validador->set_valor('inputTelefono'); ?>">
						</div>
					</div>

					<div class="control-group" style="margin-bottom: 40px;">
						<label class="control-label" for="inputCelular">Celular</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="inputCelular" value="<?php echo $validador->set_valor('inputCelular'); ?>">
						</div>
					</div>					

					<div class="control-group">
						<div class="controls">
							<button type="submit" class="boton boton-acept">Crear cuenta</button>
						</div>
					</div>
				</form>		
			</div>
		</div>
	</div>

</body>
</html>