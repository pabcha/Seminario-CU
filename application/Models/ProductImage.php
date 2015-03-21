<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model {

	public $timestamps = false;
	public $table = "sp_producto_imgs";
	public $primaryKey = "producto_img_id";

	public function producto()
	{
		return $this->belongsTo('App\Models\Product', 'producto_img_id', 'producto_id');
	}

	public function reset_imgs($id)
	{
		ProductImage::where('producto_id', $id)
			->update(array('producto_img_predeterminado' => 'N'));
	}

	public static function validate($Validator)
	{
			$Validator->set_content_delimiters('<div class="alerta" id="alerta"><ul class="alert_info">','</ul></div>');
			$Validator->set_error_delimiters('<li><i class="icon-remove"></i>','</li>');

			$Validator->set_reglas('inputPortada','portada','requerido|alpha|max_length[1]');

			if ( count($_POST) > 0 )
			{
				$file = $_FILES['inputArchivo'];

				switch ( $file['error'] ) 
				{
			        case UPLOAD_ERR_OK:
			            break;
			        case UPLOAD_ERR_NO_FILE:
			            $Validator->additional_errors("No envio ningun archivo.");
			            break;
			        default:
			            $Validator->additional_errors("Error desconocido.");
			            break;
		    	}

				if( $file['error'] === UPLOAD_ERR_OK ) 
				{
					$type = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);

					if ( ! in_array(exif_imagetype($file['tmp_name']), $type) )
					{
						$Validator->additional_errors("Tipo de archivo invalido.");
					}

					//ancho y alto minimo de 642px
					list($ancho, $alto) = getimagesize($file['tmp_name']);

					if ($ancho < 642 && $alto < 642) 
					{
						$Validator->additional_errors("El ancho y alto minimo debe ser 642px.");
					}

					/*if ($ancho != $alto) 
					{
						$Validator->additional_errors("El ancho y el alto de la imagen deben coincidir.");
					}	*/			

					if( $file['size'] > 2097152 ) 
					{
						$Validator->additional_errors("El tamaño de archivo excede el maximo permitido.");		
					}

					if ( ! is_uploaded_file($file['tmp_name']) )
					{
						$Validator->additional_errors("Fallo al guardar el archivo.Intente nuevamente.");
					}
				}
			}

			if ( $Validator->validar() )
			{
				return true;
			}
			
			return false;
	}
	
}