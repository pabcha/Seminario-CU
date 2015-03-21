<div class="row-fluid">
	<ul class="nav nav-pills">
		<li <?= App\Helpers\Vista::is_active($pr_page, 1) ?>>
			<a href="<?= BASE_URL.'admin/producto_update/'.$producto['producto_id']; ?>">Informacion</a>
		</li>
		<li <?= App\Helpers\Vista::is_active($pr_page, 2) ?>>		
			<a href="<?= BASE_URL.'admin/producto_update_img/'.$producto['producto_id']; ?>">Imagenes</a>
		</li>
	</ul>
</div>