<?php 
namespace App\Classes;

use App\Models\ProductImage;
use Gregwar\Image\Image;

class ImageService
{
	public static function generateFileName($filename)
	{
		$tmp = explode('.', $filename);

		$token = '_' . time();
		$filename = $tmp[0] . $token . '.png';

		return $filename;
	}

	public static function generateAlt($filename)
	{
		$tmp = explode('.', $filename);
		$alt = str_replace('_', ' ', $tmp[0]);

		return $alt;
	}

	public static function exportImages($file, $filename)
	{
		Image::open( $file['tmp_name'] )
			->resize(120, 120)
		    ->save( ROOT . "storage/uploads/thumb_tiny/" . $filename, 'png');

		Image::open( $file['tmp_name'] )
			->resize(400, 400)
		    ->save( ROOT . "storage/uploads/thumb_medium/" . $filename, 'png');

		Image::open( $file['tmp_name'] )
			->resize(642, 642)
		    ->save( ROOT . "storage/uploads/thumb/" . $filename, 'png');
	}
}