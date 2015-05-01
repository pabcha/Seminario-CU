<!-- Menu categorias -->
<div class="span3">
	<div class="header-menu">
		<span>Bienvenido, <?php echo Session::get('usuario')['nombre'].' '.Session::get('usuario')['apellido']; ?></span>
	</div>
	<ul class="menu-categorias">
		<li>
			<a href="<?= BASE_URL.'micuenta' ?>" class="nav-header">
				Mis ordenes
			</a>
		</li>
		<li>
			<a href="<?= BASE_URL.'micuenta/editar_informacion' ?>" class="nav-header">
				Editar informacion
			</a>
		</li>
		<li>
			<a href="<?= BASE_URL.'micuenta/cambiar_password' ?>" class="nav-header">
				Cambiar password
			</a>
		</li>
	</ul>
</div>