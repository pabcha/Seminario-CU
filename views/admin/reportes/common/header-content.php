<h1 class="pag-titulo">Reportes</h1>

<div style="margin-top:10px;">
	<ul class="nav nav-tabs">
		<li <?= App\Helpers\Vista::is_active($page, 1) ?>>
			<a href="<?= BASE_URL.'admin/reportes'; ?>">Ventas por fecha</a>
		</li>
		<li <?= App\Helpers\Vista::is_active($page, 2) ?>>
			<a href="<?= BASE_URL.'admin/stock'; ?>">Disponibilidad</a>
		</li>
	</ul>
</div>