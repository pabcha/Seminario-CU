

	<div class="contenido-principal">
		<div class="container">
			<div class="row-fluid">

				<!-- navegacion -->
				<?php require_once ROOT.'views\layout\admin\left-bar.php'; ?>
				<!-- fin navegacion -->

				<!-- fin navegacion -->
				<div class="span9">					

					<h1 class="pag-titulo">Orden de compra - <?php echo $o->ord_id; ?></h1>

					<ul class="nav nav-tabs">
						<li>
							<a href="<?php echo BASE_URL.'admin/orden/'.$o->ord_id; ?>">Detalle de compra</a>
						</li>
						<li class="active">
							<a href="<?php echo BASE_URL.'admin/orden_historia/'.$o->ord_id; ?>">Historial</a>
						</li>
					</ul>

					<p>Historia de este pedido. Puedes agregar notas y comunicarte con tu cliente.</p>

					<div class="menu-historia">
						<a href="<?php echo BASE_URL.'admin/orden_nota/'.$o->ord_id; ?>" class="btn">Agregar nota</a>
						<a href="<?php echo BASE_URL.'admin/orden_correo/'.$o->ord_id; ?>" class="btn">Habla con el cliente</a>
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
										<?php foreach ($oh as $h): ?>
											<tr>
												<td style="width:20%;">
													<span class="<?= App\Helpers\Vista::set_label_historia($h->historia_accion) ?>">
														<?php echo $h->historia_accion; ?>
													</span>
												</td>
												<td>
													<?php echo $h->historia_descripcion; ?> 
													<span class="label-fecha"><?php echo $h->historia_fecha; ?></span>
												</td>
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