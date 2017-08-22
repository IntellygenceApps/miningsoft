<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mail_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
	public function third()
    {      
		//Arreglar esta consulta para verificar el estado basados en la tabla ms_mp_regicab  
        $query = $this->db->query("SELECT a.TerceroId, a.NumeroIdentificacion, a.NombreCompleto, a.PrimerNombre, a.SegundoNombre, 
								   a.PrimerApellido, a.SegundoApellido
								   FROM ms_mp_tercero a								  
								   WHERE Status = 1 AND TerceroId NOT IN(SELECT TerceroId 
								   										 FROM ms_mp_regicab a
																		 LEFT JOIN ms_mp_regiest b ON a.RegistroEstadoId = b.RegistroEstadoId
																		 WHERE b.Habilita = 1 OR a.RegistroEstadoId = 0)");
        return $query->result();
    }
	
	
	public function verify_process($id)
    {      
		//Arreglar esta consulta para verificar el estado basados en la tabla ms_mp_regicab  
        $query = $this->db->query("SELECT *,a.Codigo as Code FROM ms_mp_regicab a
								   LEFT JOIN ms_mp_tercero b ON a.TerceroId = b.TerceroId
								   WHERE a.RegistroId = $id");								   
		
        return $query->row();
    }	
	
	public function verify_process_valoration($id)
    {      
		//Arreglar esta consulta para verificar el estado basados en la tabla ms_mp_regicab  
        $query = $this->db->query("SELECT *, b.Nombre as NombreValoracion, c.Nombre as NombreEstado
								   FROM ms_mp_regivalora a
								   LEFT JOIN ms_co_valoracion b ON a.ValoracionId = b.ValoracionId
								   LEFT JOIN ms_mp_regiest c ON a.RegistroEstadoId = c.RegistroEstadoId 
								   WHERE RegistroId = $id");
							
		//die($this->db->last_query());						   
								   								   
		if($query->num_rows() > 0){
			
			return $query->result();
			
		}else{
			
			return false;
		}
    }
	
	
	public function register_valoration($Usuario, $id)
    {      
		//Arreglar esta consulta para verificar el estado basados en la tabla ms_mp_regicab
				 
        $query = $this->db->query("SELECT a.Valoracion, a.RegistroEstadoId, b.Nombre as NombreValoracion, 
								   c.Nombre as NombreEstado, c.Habilita
								   FROM ms_mp_regivalora a
								   LEFT JOIN ms_co_valoracion b ON a.ValoracionId = b.ValoracionId
								   LEFT JOIN ms_mp_regiest c ON a.RegistroEstadoId = c.RegistroEstadoId
								   WHERE b.UsuarioId = $Usuario AND a.RegistroId = $id");	
						
		if($query->num_rows() > 0){
			
			return $query->result();
			
		}else{
			
			return false;
		}
    }
	
	public function detValorations($id)
    {      
		//Arreglar esta consulta para verificar el estado basados en la tabla ms_mp_regicab  
        $query = $this->db->query("SELECT a.*, b.Nombre as NombreValoracion, b.*, c.Nombre as NombreEstado, c.*
								   FROM ms_mp_regivalora a
								   LEFT JOIN ms_co_valoracion b ON a.ValoracionId = b.ValoracionId
								   LEFT JOIN ms_mp_regiest c ON a.RegistroEstadoId = c.RegistroEstadoId
								   WHERE a.RegistroId = $id");	
								
		if($query->num_rows() > 0){
			
			return $query->result();
			
		}else{
			
			return false;
		}
    }
	
	
	public function register_valoration_view($id)
    {      
		
        $query = $this->db->query("SELECT a.Valoracion,b.Nombre as NombreValoracion, c.Nombre as NombreEstado
								   FROM ms_mp_regivalora a
								   LEFT JOIN ms_co_valoracion b ON a.ValoracionId = b.ValoracionId
								   LEFT JOIN ms_mp_regiest c ON a.RegistroEstadoId = c.RegistroEstadoId 
								   LEFT JOIN ms_ms_usuario d ON a.UsuarioId = d.UsuarioId 
								   WHERE a.RegistroId = $id");
												   
		if($query->num_rows() > 0){
			
			return $query->result();
			
		}else{
			
			return false;
		}
    }
	
	
	public function register_status()
    {      
		//Arreglar esta consulta para verificar el estado basados en la tabla ms_mp_regicab  
        $query = $this->db->get_where("ms_mp_regiest");
		
		if($query->num_rows() > 0){
			
			return $query->result();
			
		}else{
			
			return false;
		}
    }
	
	public function register_status_complete($status)
    {      
		//Arreglar esta consulta para verificar el estado basados en la tabla ms_mp_regicab  
        $query = $this->db->get_where("ms_mp_regiest",array("Habilita"=>$status));
		
		if($query->num_rows() > 0){
			
			return $query->result();
			
		}else{
			
			return false;
		}
    }
	
    public function lista()
    {        
        $query = $this->db->query("SELECT a.RegistroId,a.Codigo, a.FechaSolicitud, a.HoraSolicitud, a.TerceroId, b.PrimerNombre, 
								   b.PrimerApellido
								   FROM ms_mp_regicab a
								   LEFT JOIN ms_mp_tercero b ON a.TerceroId = b.TerceroId						  
								   WHERE RegistroEstadoId = 0");
        return $query->result();
    }
	
	public function lista_general()
    {        
        $query = $this->db->query("SELECT a.RegistroId,a.Codigo, a.FechaSolicitud, a.HoraSolicitud, a.TerceroId, b.PrimerNombre, 
								   b.PrimerApellido, c.Nombre as Estado, d.Nombre as ClaseTercero
								   FROM ms_mp_regicab a
								   LEFT JOIN ms_mp_tercero b ON a.TerceroId = b.TerceroId
								   LEFT JOIN ms_mp_regiest c ON a.RegistroEstadoId = c.RegistroEstadoId
								   LEFT JOIN ms_me_claster d ON b.ClaseTerceroId = d.ClaseTerceroId
								   WHERE a.RegistroEstadoId <> 0");
								   
		//die($this->db->last_query());   
        
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
	
	 public function VerifyValoration($Valoracion, $Registro){
		
		$query = $this->db->get_where("ms_mp_regivalora",array("ValoracionId"=>$Valoracion,
													           "RegistroId"=>$Registro));
						
		if($query->num_rows() > 0){
								
			return "Si";
			
		}else{
						
			return "No";
		}		
	 }
		 
	 public function verify_process_save($data){
		
		$this->db->insert("ms_mp_regivalora",$data);
					
		if($this->db->insert_id() > 0){
			
			return true;
			
		}else{
			
			return false;
		}		
	 }
	 
	 public function saveValoration($data){
		
		$this->db->insert("ms_mp_regivalora",$data);
	
		if($this->db->insert_id() > 0){
			
			return true;
			
		}else{
			
			return false;
		}		
	 }
	 
	 public function verify_process_update($data, $registro, $valoracion){
		
		$this->db->where('RegistroId', $registro);
		$this->db->where('ValoracionId', $valoracion);
		$this->db->update("ms_mp_regivalora",$data);		
				
		if($this->db->affected_rows() > 0){
			
			return true;
			
		}else{
			
			return false;
		}		
	 }
	 
	 public function complete_register_save($data, $registro){
		
		$this->db->where('RegistroId', $registro);		
		$this->db->update("ms_mp_regicab",$data);		
				
		if($this->db->affected_rows() > 0){
			
			return true;
			
		}else{
			
			return false;
		}		
	 }
	 
	 
	 public function valorations(){
	 	
	 	$query = $this->db->get_where("ms_co_valoracion",array("Status"=>1));		
	 			
	 	return $query->result();			
	 }
	 	 
}


