<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= App\Helpers\Vista::loadTitle($this->titulo) ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">	

	<link href="<?= $roots['css'] ?>vendor/bootstrap.min.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>vendor/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>vendor/font-awesome/font-awesome.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>admin/estilos.css" rel="stylesheet">
	<?= App\Helpers\Vista::loadCss( $styles ) ?>
	
	<script src="<?= $roots['js'] ?>vendor/jquery-1.8.2.min.js"></script>
	<script src="<?= $roots['js'] ?>vendor/bootstrap.min.js"></script>
	<?= App\Helpers\Vista::loadJs( $scripts ) ?>
</head>
<body>

	<!-- Navegacion Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container">

				<div class="hidden-phone">
					<ul class="nav pull-right">
						<li>
							<a href="<?= BASE_URL; ?>" target="_blank">
								<i class="icon-briefcase"></i>Ir al negocio
							</a>
						</li>
						<li class="divider-vertical"></li>
						<li class="dropdown">
							<a href="" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-cloud"></i>
								Bienvenido, <?= Session::get('operador')['nombre']; ?>
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="<?= BASE_URL.'admin/edit_empleado/'.Session::get('operador')['id']; ?>">
										<i class="icon-file"></i>
										Informacion de Usuario
									</a>
								</li>
								<li>
									<a href="<?= BASE_URL.'admin/edit_password/'.Session::get('operador')['id']; ?>">
										<i class="icon-key"></i>
										Cambiar Password
									</a>
								</li>
							</ul>
						</li>						
						<li class="divider-vertical"></li>
						<li>
							<a href="<?= BASE_URL.'admin/logout' ?>">
								<i class="icon-signout"></i>
								Salir
							</a>
						</li>
						<li class="divider-vertical"></li>
					</ul>
				</div>
				<!-- /top nav -->

				<div class="visible-phone">	
					<a class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse" href="#">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>					
					</a>
					<div class="nav-collapse">
						<ul class="nav" style="height:auto;">
							<li>
								<a href="<?= BASE_URL . 'admin/panelcontrol'; ?>">
					                <i class="icon-home icon-large"></i> 
					                Panel de Control
					            </a>
							</li>
							<li>
								<a href="<?= BASE_URL . 'admin/categorias'; ?>">
					                <i class="icon-folder-close icon-large"></i> 
					                Catalogo
					            </a>
							</li>
							<li>
								<a href="<?= BASE_URL . 'admin/clientes'; ?>">
					                <i class="icon-user icon-large"></i> 
					                Clientes
					            </a>
							</li>
							<li>
								<a href="<?= BASE_URL . 'admin/ordenes'; ?>">
					                <i class="icon-shopping-cart icon-large"></i> 
					                Ordenes
					            </a>
							</li>
							<li>
								<a href="<?= BASE_URL . 'admin/reportes'; ?>">
					                <i class="icon-bar-chart icon-large"></i> 
					                Reportes
					            </a>
							</li>
							<li>
								<a href="<?= BASE_URL . 'admin/empleados'; ?>">
					                <i class="icon-group icon-large"></i> 
					                Empleados
					            </a>
							</li>
							<li>
								<a href="<?= BASE_URL . 'admin/herramientas'; ?>">
					                <i class="icon-wrench icon-large"></i> 
					                Herramientas
					            </a>
							</li>
						</ul>
					</div>
				</div>
				<!-- /top nav for phones -->
			</div>			
		</div>
	</div>
