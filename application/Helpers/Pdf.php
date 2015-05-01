<?php 
namespace App\Helpers;

class Pdf
{
	public static function get_template($file, array $data = array())
	{
		ob_start();
		extract($data);
		include ROOT.'templates/'.$file.'.php';
		return ob_get_clean();
	}	
}