<div class="row-fluid">
	<ul class="nav nav-pills">
		<li <?= App\Helpers\Vista::is_active($stock_menu, 1) ?>>
			<a href="<?= BASE_URL.'admin/stock/low_stock'; ?>">Stock bajo</a>
		</li>
		<li <?= App\Helpers\Vista::is_active($stock_menu, 2) ?>>
			<a href="<?= BASE_URL.'admin/stock/out_stock'; ?>">Agotado</a>
		</li>
	</ul>
</div>