<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('menu'))
{
    function menu()
    {	
		$ci=& get_instance();		
		
		$sql = "SELECT a.ModuloId,a.Nombre, a.Icono
				FROM ms_ms_modulo a		
				WHERE a.Status = 1
				ORDER BY Nombre"; 
		$query = $ci->db->query($sql);		
				
		return $query->result();
	}
}


if (!function_exists('submenu'))
{
    function submenu($id,$id_usuario)
    {	
		$ci=& get_instance();
		
		$sql = "SELECT a.Nombre, a.Link, b.Simbolo
				FROM ms_ms_opcion a	
				INNER JOIN ms_ms_tipoopc b ON a.TipoOpcionId = b.TipoOpcionId
				WHERE a.ModuloId = $id AND a.Status = 1	AND a.OpcionId IN(SELECT OpcionId 
																		  FROM ms_ms_usuariopcion
																		  WHERE UsuarioId = $id_usuario)	
				ORDER BY a.Nombre"; 
						
		$query = $ci->db->query($sql);		
				
		if($query->num_rows() > 0){
			
			return $query->result();
				
		}else{
			
			return false;
		}		
	}
}


if (!function_exists('auxCumplimientoVerify'))
{
    function auxCumplimientoVerify($id)
    {	
		$ci=& get_instance();
		
		$sql = "SELECT OficialCumpliemiento
				FROM ms_ms_cargo a
				WHERE CargoId = $id"; 
				
		$query = $ci->db->query($sql);		
		
		$Resp = $query->row();
		
		//die(print_r($Resp->OficialCumpliemiento));
		
		if($Resp->OficialCumpliemiento == 1){
			
			return true;
				
		}else{
			
			return false;
		}		
	}
}


if (!function_exists('estados'))
{
    function estados($id)
    {		
		$ci=& get_instance();
		
		$ResultAfirmative = null;
		       
        $query = $ci->db->query("SELECT *
								 FROM ms_mp_regivalora a
								 LEFT JOIN ms_mp_regiest b ON a.RegistroEstadoId = b.RegistroEstadoId						  
								 WHERE RegistroId = $id");
        		
		$result = $query->result();
		$num_rows = $query->num_rows();
		
		foreach($result as $result_a){
			
			if($result_a->Habilita == 1){
				
				$ResultAfirmative++;  	
			}
		}
		
		if($num_rows > 0 && $num_rows == $ResultAfirmative){
			
			return true;			
			
		}else{
		
			return false;
		}
    }
}

if (!function_exists('removespace'))
{
    function removespace($string)
    {	
		$ci=& get_instance();
		
		$result = str_replace(" ","-",$string);
		
		return $result;		
	}
}

if (!function_exists('icon_activate'))
{
    function icon_activate($boolean, $title="")
    {	
		if($boolean == 1){

			return '<a class="text-center btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="'.$title.'""><i class="fa fa-check" aria-hidden="true"></i></a>';

		}else{

			return '<a class="text-center btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="'.$title.'"><i class="fa fa-times" aria-hidden="true"></i></a>';
		}	
	}
}


if (!function_exists('icon_state'))
{
    function icon_state($string)
    {	
		if($string == "A"){

			return '<a class="text-center btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Activa (en proceso)"><i class="fa fa-exchange" aria-hidden="true"></i></a>';

		}else{

			if($string == "C"){		

				return '<a class="text-center btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Cancelado"><i class="fa fa-times" aria-hidden="true"></i></a>';
			
			}else{

				if($string == "F"){		

					return '<a class="text-center btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Finalizado"><i class="fa fa-check" aria-hidden="true"></i></a>';
				}
			}
		}	
	}
}


if (!function_exists('status_letter'))
{
    function status_letter($str)
    {	
		if($str == "F"){

			return '<a class="text-center btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Finalizada"><i class="fa fa-check" aria-hidden="true"></i></a>';
		}

		if($str == "C"){

			return '<a class="text-center btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Cancelada"><i class="fa fa-times" aria-hidden="true"></i></a>';
		}	

		if($str == "A"){

			return '<a class="text-center btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Activa"><i class="fa fa-clock-o" aria-hidden="true"></i></a>';
		}	
	}
}
//end application/helpers/template_helper.php