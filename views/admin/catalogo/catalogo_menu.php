<h1 class="pag-titulo">Catalogo</h1>

<div style="margin-top:10px;">
	<ul class="nav nav-tabs">
		<li <?= App\Helpers\Vista::is_active($page, 1) ?>>
			<a href="<?= BASE_URL.'admin/categorias'; ?>">Categorias</a>
		</li>
		<li <?= App\Helpers\Vista::is_active($page, 2) ?>>
			<a href="<?= BASE_URL.'admin/productos'; ?>">Productos</a>
		</li>
		<li <?= App\Helpers\Vista::is_active($page, 3) ?>>
			<a href="<?= BASE_URL.'admin/marcas'; ?>">Marcas</a>
		</li>
	</ul>
</div>