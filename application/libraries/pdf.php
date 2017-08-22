<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pdf {

	function __construct(){

		$CI = & get_instance();
		log_message('Debug', 'mPDF class is loaded.');
	}

	function load($param=""){

		include_once APPPATH.'/third_party/mpdf/mpdf.php';

		if ($params == NULL){

			$param = '"es-ES-x","A4-L","12","Arial",10,10,10,10,6,3';
		}
		
		return new mPDF($param);
	}
}