

	<div class="contenido-principal">
		<div class="container">
			<div class="row-fluid">

				<!-- navegacion -->
				<?php require_once ROOT.'views\layout\admin\left-bar.php'; ?>
				<!-- fin navegacion -->

				<!-- fin navegacion -->
				<div class="span9">					

					<h1 class="pag-titulo">Orden de compra - <?php echo $orden['id']; ?></h1>

					<ul class="nav nav-tabs">
						<li>
							<a href="<?php echo BASE_URL.'admin/orden/'.$orden_id; ?>">Detalle de compra</a>
						</li>
						<li class="active">
							<a href="<?php echo BASE_URL.'admin/orden_historia/'.$orden_id; ?>">Historial</a>
						</li>
					</ul>

					<p>Historia de este pedido. Puedes agregar notas y comunicarte con tu cliente.</p>

					<div class="menu-historia">
						<a href="<?php echo BASE_URL.'admin/orden_nota/'.$orden_id; ?>" class="btn">Agregar nota</a>
						<a href="<?php echo BASE_URL.'admin/orden_correo/'.$orden_id; ?>" class="btn">Habla con el cliente</a>
					</div>

					<?php if ( Session::get("mensajeExito") ) : ?>
			            <div class="alert alert-success alert-dismissable">
			            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                <?php echo Session::show("mensajeExito"); ?>
			            </div>   
			        <?php endif; ?>

					<div class="row-fluid">						
						<div class="widget widget-compact">
							<div class="widget-header"><h3>Historia</h3></div>
							<div class="widget-content">
								<table class="table table-condensed">
									<tbody>
										<?php foreach ($historias as $historia): ?>
											<?php 
												$clase = '';

												if ( strtolower($historia['accion']) == 'nota' ) {
													$clase = 'label-blue';
												} else if ( strtolower($historia['accion']) == 'nuevo estado' ) {
													$clase = 'label-green';
												} else {
													$clase = 'label-darkblue';
												}
											?>
											<tr>
												<td style="width:20%;"><span class="<?php echo $clase; ?>"><?php echo $historia['accion']; ?></span></td>
												<td><?php echo $historia['descripcion']; ?> <span class="label-fecha"><?php echo $this->get_fecha($historia['fecha']); ?></span></td>
											</tr>
										<?php endforeach ?>									
									</tbody>
								</table>
							</div>
						</div>						
					</div>

				</div>
			</div>
		</div>
	</div>