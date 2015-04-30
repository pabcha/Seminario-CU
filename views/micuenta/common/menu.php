<!-- Menu categorias -->
<div class="span3">
	<div class="header-menu">
		<span>Mi Cuenta</span>
	</div>
	<ul class="menu-categorias">
		<li>
			<a href="<?= BASE_URL.'micuenta' ?>" class="nav-header">Mis ordenes</a>
			<ul class="children">
				<li><a href="#">Recientes</a></li>
				<li><a href="#">Finalizadas</a></li>
				<li><a href="#">Canceladas</a></li>
			</ul>
		</li>
		<li>
			<a href="<?= BASE_URL.'micuenta/editar_informacion' ?>" class="nav-header">
				Editar informacion
			</a>
		</li>
		<li>
			<a href="<?= BASE_URL.'micuenta/editar_domicilio' ?>" class="nav-header">
				Editar domicilio
			</a>
		</li>
	</ul>
</div>