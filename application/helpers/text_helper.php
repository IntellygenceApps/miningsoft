<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('recortar_texto'))
{
    function recortar_texto($texto, $limite)
    {	
		$ci=& get_instance();
		
		$texto = trim($texto);
		$texto = strip_tags($texto);
		$tamano = strlen($texto);
		$resultado = '';
		if($tamano <= $limite){
			return $texto;
		}else{
			$texto = substr($texto, 0, $limite);
			$palabras = explode(' ', $texto);
			$resultado = implode(' ', $palabras);
			$resultado .= '...';
		}	
		return $resultado;
	}
}

if (!function_exists('clean'))
{
	function clean($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	
	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
}

//end application/helpers/filemanager_helper.php