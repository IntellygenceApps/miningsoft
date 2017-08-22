<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
	public function load_conf()
    {      
		//Arreglar esta consulta para verificar el estado basados en la tabla ms_mp_regicab  
        $query = $this->db->query("SELECT * FROM ms_co_confcom");								   
		
        return $query->row_array();
    }
	
	public function load_status()
    {      
		//Arreglar esta consulta para verificar el estado basados en la tabla ms_mp_regicab  
        $query = $this->db->query("SELECT * FROM ms_mp_regiest");								   
		
        return $query->result();
    }
	
	
    public function lista()
    {        
        $query = $this->db->query("SELECT a.Codigo, a.FechaSolicitud, a.HoraSolicitud, a.TerceroId, b.PrimerNombre, 
								   b.PrimerApellido
								   FROM ms_mp_regicab a
								   LEFT JOIN ms_mp_tercero b ON a.TerceroId = b.TerceroId						  
								   WHERE RegistroEstadoId = 0");
        return $query->result();
    }
	
	public function AjaxLoadDataThird($Id){
			
		$query = $this->db->query("SELECT a.TerceroId, a.NumeroIdentificacion, a.PrimerNombre, a.SegundoNombre, 
								   a.PrimerApellido, a.SegundoApellido, a.NombreCompleto, a.Genero, a.Direccion, a.Telefono,
								   a.Celular, a.FechaCreacion, b.Nombre as Clase, c.Nombre as Ciudad
								   FROM ms_mp_tercero a
								   LEFT JOIN ms_me_claster b ON a.ClaseTerceroId = b.ClaseTerceroId
								   LEFT JOIN ms_mp_ciudad c ON a.CiudadCodigo = c.CiudadCodigo
								   WHERE a.Status = 1 AND TerceroId = $Id");
	
		if($query->num_rows() > 0){				

			return json_encode($query->row_array());			

		}else{				

			return json_encode(0);
		}			
	 }	
	 
	 public function AjaxLoadThirdClass($Id){
			
		$query = $this->db->query("SELECT ClaseTerceroId
								   FROM ms_mp_tercero
								   WHERE TerceroId = $Id");
	
		if($query->num_rows() > 0){				

			return $query->row_array('ThirdClassId');			

		}else{				

			return json_encode(0);
		}			
	 }
	 
	 
	 public function AjaxLoadRequirements($Id){
			
		$query = $this->db->query("SELECT a.RequisitoId, a.Codigo, a.Nombre, a.Archivo, a.Obligatorio, a.Status
								   FROM ms_mp_requisi a
								   LEFT JOIN ms_mp_reqxcla b ON a.RequisitoId = b.RequisitoId								   
								   WHERE a.Status = 1 AND b.ClaseTerceroId = $Id");
			
		if($query->num_rows() > 0){				
						
			return json_encode($query->result());			

		}else{				

			return json_encode(0);
		}			
	 }		
	 
	 public function save($data){
		
		$this->db->insert("ms_mp_regicab",$data);
				
		if($this->db->insert_id() > 0){
			
			return $this->db->insert_id();
			
		}else{
			
			return false;
		}		
	 }
}

?>    
