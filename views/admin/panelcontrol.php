
	<!-- Contenido principal -->
	<div class="contenido-principal">
		<div class="container">
			<div class="row-fluid">

				<!-- navegacion -->
				<?php require_once ROOT.'views\layout\admin\left-bar.php'; ?>
				<!-- fin navegacion -->

				<div class="span9">
					<h1 class="pag-titulo">Panel de Control</h1>

					<!-- info general -->
					<div class="caja-contenedor">
						<div class="span3 caja-item"><h2>$5</h2><span>Hoy</span></div>
						<div class="span3 caja-item"><h2>$17</h2><span>Esta semana</span></div>
						<div class="span3 caja-item"><h2>$158</h2><span>Este mes</span></div>
						<div class="span3 caja-item"><h2>$1005</h2><span>Total</span></div>
					</div>

					<!-- reporte ventas -->
					<div class="widget">
						<div class="widget-header">
							<h3><i class="icon-signal" style="margin-right:5px;"></i>Ventas</h3>
						</div>
						<div class="widget-content">
							<div id="chart1"></div>
						</div>
					</div>

					<!--Ordenes Recientes -->
					<div class="widget">
						<div class="widget-header">
							<h3>Ordenes recientes</h3>
						</div>
						<div class="widget-content">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Fecha</th>
										<th>Usuario</th>
										<th class="hidden-phone">Subtotal</th>
										<th>Total</th>
										<th>Estado</th>
										<th class="hidden-phone" style="width:15%;">Accion</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>07/01/2013</td>
										<td>Pablo</td>
										<td class="hidden-phone">$159.99</td>
										<td>$159.99</td>
										<td><span class="label label-warning">Pendiente</span></td>
										<td class="hidden-phone">
											<div class="btn-group">
												<a href="#" class="btn" title="Detalles"><i class="icon-info-sign"></i></a>
											</div>											
										</td>
									</tr>
									<tr>
										<td>06/01/2013</td>
										<td>Tiffany</td>
										<td class="hidden-phone">$200.00</td>
										<td>$210.00</td>
										<td><span class="label label-success">Pagado</span></td>
										<td class="hidden-phone">
											<div class="btn-group">
												<a href="#" class="btn" title="Detalles"><i class="icon-info-sign"></i></a>
											</div>											
										</td>
									</tr>
									<tr>
										<td>01/01/2013</td>
										<td>Felix</td>
										<td class="hidden-phone">$1005.00</td>
										<td>$1005.00</td>
										<td><span class="label label-important">Cancelado</span></td>
										<td class="hidden-phone">
											<div class="btn-group">
												<a href="#" class="btn" title="Detalles"><i class="icon-info-sign"></i></a>
											</div>											
										</td>
									</tr>
								</tbody>
							</table>	
						</div>
					</div>
					<!-- Ordenes Recientes -->	
					<div class="widget">
						<div class="widget-header">
							<h3>Usuarios</h3>
						</div>
						<div class="widget-content">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Rol</th>
										<th>Estado</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Pablo</td>
										<td>Usuario</td>
										<td><span class="label label-warning">Inactivo</span></td>
									</tr>
									<tr>
										<td>Maria</td>
										<td>Vendedor</td>
										<td><span class="label label-success">Activo</span></td>
									</tr>
									<tr>
										<td>Josue</td>
										<td>Admin</td>
										<td><span class="label label-success">Activo</span></td>
									</tr>
									<tr>
										<td>Alcira</td>
										<td>Usuario</td>
										<td><span class="label label-important">Bloqueado</span></td>
									</tr>
									<tr>
										<td>Mariano</td>
										<td>Usuario</td>
										<td><span class="label label-success">Activo</span></td>
									</tr>
									<tr>
										<td>Jose</td>
										<td>Usuario</td>
										<td><span class="label label-success">Activo</span></td>
									</tr>
								</tbody>
							</table>	
						</div>
					</div>					
				</div><!-- /row-fluid -->
			</div>
		</div>
	</div>