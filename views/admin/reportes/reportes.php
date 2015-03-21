	<!-- Contenido principal -->
	<div class="contenido-principal">
		<div class="container">
			<div class="row-fluid">

				<!-- navegacion -->
				<?php require_once ROOT.'views\layout\admin\left-bar.php'; ?>
				<!-- fin navegacion -->

				<div class="span9">

					<?php require_once ROOT.'views\admin\reportes\common\header-content.php'; ?>
					<!-- /header-content -->

					<div class="row-fluid">
						<ul class="nav nav-pills">
							<li>
								<a href="reportes/year" id="year">Año</a>
							</li>
							<li>
								<a href="reportes/last_month" id="last_month">Ultimo mes</a>
							</li>
							<li>
								<a href="reportes/month" id="month">Este mes</a>
							</li>
							<li class="active">
								<a href="reportes/7day" id="7day">Ultimos 7 dias</a>
							</li>
						</ul>
					</div>
					<!-- /report-menu -->

					<div class="row-fluid caja-contenedor" style="margin-bottom: 30px">
						<div class="span4 caja-item"><h2 id="ventasT"></h2><span>Ventas totales</span></div>
						<div class="span4 caja-item"><h2 id="ventasProm"></h2><span>Ventas promedio</span></div>
						<div class="span2 caja-item"><h2 id="ordersT"></h2><span>Ordenes totales</span></div>
						<div class="span2 caja-item"><h2 id="productT"></h2><span>Productos totales</span></div>
					</div>

					<div class="row-fluid" style="margin-bottom: 20px;">
						<div id="graphic"></div>
						<!-- /graphic statics -->
					</div>

					<div class="row-fluid">
						<div class="btn-group pull-right">
							<button id="pdfBtn" class="btn">Exportar a PDF</button>
							<button id="csvBtn" class="btn">Exportar a CSV</button>
						</div>
					</div> <!-- /export menu -->

					<form action="<?= BASE_URL ?>admin/build_pdf" id="sendImage" method="post">
						<input type="hidden" id="imgSrc" name="imgSrc">
						<input type="hidden" class="categories" name="categories">
						<input type="hidden" class="seriesY" name="seriesY">
						<input type="hidden" class="cantidadOrdenes" name="cantidadOrdenes">
						<input type="hidden" class="cantidadVendida" name="cantidadVendida">

						<input type="hidden" id="totalD" name="totalD">
						<input type="hidden" id="avg" name="avg">
						<input type="hidden" id="cantidadOrdenesD" name="cantidadOrdenesD">
						<input type="hidden" id="cantidadVendidaD" name="cantidadVendidaD">

						<input type="hidden" class="title" name="title">
					</form>

					<form action="<?= BASE_URL ?>admin/build_csv" id="getCsv" method="post">
						<input type="hidden" class="categories" name="categories">
						<input type="hidden" class="seriesY" name="seriesY">
						<input type="hidden" class="cantidadOrdenes" name="cantidadOrdenes">
						<input type="hidden" class="cantidadVendida" name="cantidadVendida">

						<input type="hidden" class="title" name="title">
					</form>

				</div>
			</div>
		</div>
	</div>	