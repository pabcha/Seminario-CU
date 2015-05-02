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

				<?php if ( Session::get("errors") ) : ?>
				        <?= Session::show("errors"); ?> 
				<?php endif; ?>
				
				<form class="form-horizontal newuser-form" action="<?php echo BASE_URL.'registro/store'; ?>" method="post">
					<div class="page-subheader">
						<h3 class="medium">Información de usuario</h3>
						<p>Con esta información accederas al sitio.</p>				
					</div>					

					<div class="control-group">
						<label class="control-label" for="correo">Correo*</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="correo" value="<?= Session::show('correo') ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="password">Contraseña*</label>
						<div class="controls">
							<input type="password" class="input-block-level" name="password">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="password2">Repetir Contraseña*</label>
						<div class="controls">
							<input type="password" class="input-block-level" name="password2">
						</div>
					</div>

					<div class="page-subheader">
						<h3 class="medium">Información de envío</h3>
						<p>A esta dirección llegara tu pedido.</p>				
					</div>

					<div class="control-group">
						<label class="control-label" for="nombre">Nombre*</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="nombre" value="<?= Session::show('nombre') ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="apellido">Apellido*</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="apellido" value="<?= Session::show('apellido') ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="dni">DNI*</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="dni" value="<?= Session::show('dni') ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="provincia">Provincia*</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="provincia" value="<?= Session::show('provincia') ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="ciudad">Ciudad*</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="ciudad" value="<?= Session::show('ciudad') ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="cpostal">Codigo postal*</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="cpostal" value="<?= Session::show('cpostal') ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="domicilio">Domicilio*</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="domicilio" value="<?= Session::show('domicilio') ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="telefono">Telefono*</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="telefono" value="<?= Session::show('telefono') ?>">
						</div>
					</div>

					<div class="control-group" style="margin-bottom: 40px;">
						<label class="control-label" for="celular">Celular</label>
						<div class="controls">
							<input type="text" class="input-block-level" name="celular" value="<?= Session::show('celular') ?>">
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