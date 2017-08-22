<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('lineas'))
{
    function lineas($id)
    {	
		$ci=& get_instance();
		
		$sql = "SELECT LineaId, Nombre
				FROM dm_linea	
				WHERE GrupoId = $id AND Status = 1"; 
		$query = $ci->db->query($sql);	
		
		if($query->num_rows() > 0){
			
			return $query->result();
				
		}else{
			
			return false;
		}
		
	}
}


//end application/helpers/template_helper.php