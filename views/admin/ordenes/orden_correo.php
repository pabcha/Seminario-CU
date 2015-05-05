

	<div class="contenido-principal">
		<div class="container">
			<div class="row-fluid">

				<!-- navegacion -->
				<?php require_once ROOT.'views/layout/admin/left-bar.php'; ?>
				<!-- fin navegacion -->

				<!-- fin navegacion -->
				<div class="span9">					

					<h1 class="pag-titulo">Orden de compra - <?= Underscore\Types\Number::paddingLeft($o->ord_id, 5) ?></h1>

					<h3>Habla con el cliente</h3>
					<div class="span8">
						<p>Este mensaje sera enviado al correo eléctronico del cliente.</p>

						<form method="post" action="<?php echo BASE_URL.'admin/orden_correo/'.$o->ord_id; ?>" class="form-horizontal">
							<div class="control-group">
								<textarea name="inputMensaje" class="input-block-level" rows="4"></textarea>
							</div>
							<div class="control-group">
								<a href="<?php echo BASE_URL.'admin/orden_historia/'.$o->ord_id; ?>" class="boton boton-cancel">Cancelar</a>
								<button type="submit" class="boton boton-acept">Enviar</button>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>