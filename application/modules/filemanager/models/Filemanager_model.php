<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Filemanager_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function folder()
    {        
        $query = $this->db->query("SELECT a.FolderId, a.Nombre, a.Status, b.Nombre as FolderPadre, a.Encriptado FROM ms_mp_folder a
								   LEFT JOIN ms_mp_folder b ON a.FolderPadreId = b.FolderId
								   ORDER BY a.FolderId, a.FolderPadreId ,a.Posicion");
		
        return $query->result_array();
    }
	
	public function usuario()
    {        
        $query = $this->db->query("SELECT * 
								   FROM ms_ms_usuario			
								   WHERE Status = 1					 
								   ORDER BY Nombres, Apellidos");
		
        return $query->result_array();
    }

	public function get_folders(){


			$query = $this->db->query("SELECT a.FolderId as id, a.FolderPadreId as parent, a.Nombre as text, a.Encriptado , a.Status
									   FROM ms_mp_folder a
									   ORDER BY a.FolderPadreId ,a.Posicion");

		return json_encode($query->result());
	}
		
	public function save($data){
		
		$this->db->insert("ms_mp_folder",$data);
				
		if($this->db->insert_id() > 0){
			
			return $this->db->insert_id();
			
		}else{
			
			return false;
		}		
	}
	
	
	public function folder_view($Id)
    {        
        $query = $this->db->query("SELECT * 
								   FROM ms_mp_folder		
								   WHERE Status = 1 AND FolderId = $Id");
		
		if($query->num_rows() > 0){
		
			return $query->row();
		
		}else{
			
			return false;
		}
    }
	
	public function file_view($Id)
    {        
        $query = $this->db->query("SELECT * 
								   FROM ms_mp_archivo		
								   WHERE Status = 1 AND ArchivoId = $Id");
		
		if($query->num_rows() > 0){
		
			return $query->row();
		
		}else{
			
			return false;
		}
    }
	
	
	public function files_folder($Id)
    {        
        $query = $this->db->query("SELECT * 
								   FROM ms_mp_archivo a
								   LEFT JOIN ms_mp_foldarchi b ON a.ArchivoId = b.ArchivoId
								   WHERE a.Status = 1 AND b.FolderId = $Id");
								   
		if($query->num_rows() > 0){
		
			return $query->result();
		
		}else{
			
			return false;
		}
    }
	 
	 	
	public function saveFolderUsuario($folderId, $usuarioId){
		
		$data = array("FolderId"=>$folderId,
					  "UsuarioId"=>$usuarioId);
		
		$this->db->insert("ms_mp_foldusu",$data);
				
		if($this->db->insert_id() > 0){
			
			return $this->db->insert_id();
			
		}else{
			
			return false;
		}		
	 }
	 
	 
	 public function file_upload_save($data){
		 
		$this->db->insert("ms_mp_archivo",$data);
				
		if($this->db->insert_id() > 0){
			
			return $this->db->insert_id();
			
		}else{
			
			return false;
		}	
	 }
	 
	 public function saveFolderArchivo($archivoId, $folderId){
		
		$data = array("FolderId"=>$folderId,
					  "ArchivoId"=>$archivoId);
		
		$this->db->insert("ms_mp_foldarchi",$data);
				
		if($this->db->insert_id() > 0){
			
			return $this->db->insert_id();
			
		}else{
			
			return false;
		}		
	}
	 
	 
	public function folder_parent0($usuarioId)
    {        
        $query = $this->db->query("SELECT a.FolderId, a.Nombre, a.Status, a.Encriptado 
								   FROM ms_mp_folder a
								   LEFT JOIN ms_mp_foldusu b ON a.FolderId = b.FolderId
								   WHERE b.UsuarioId = $usuarioId 
								   ORDER BY a.FolderId, a.FolderPadreId ,a.Posicion");

								   //die($this->db->last_query());
		
        return $query->result();
    }
	
	 
	public function folder_usuario_view($Id,$usuarioId)
    {        
        $query = $this->db->query("SELECT a.FolderId, a.Nombre, a.Status, a.Encriptado 
								   FROM ms_mp_folder a
								   LEFT JOIN ms_mp_foldusu b ON a.FolderId = b.FolderId
								   WHERE b.UsuarioId = $usuarioId AND a.FolderPadreId = $Id
								   ORDER BY a.FolderId, a.FolderPadreId ,a.Posicion");
		
		if($query->num_rows() > 0){
		
			return $query->result();
		
		}else{
			
			return false;
		}
    }
	 
	public function files_folder_parent($Id)
    {        
        $query = $this->db->query("SELECT * 
								   FROM ms_mp_archivo a
								   LEFT JOIN ms_mp_foldarchi b ON a.ArchivoId = b.ArchivoId
								   WHERE a.Status = 1 AND b.FolderId = $Id");
								   
		if($query->num_rows() > 0){
		
			return $query->result();
		
		}else{
			
			return false;
		}
    } 
	 
	 
	 
	public function files_folder_view($Id)
    {        
        $query = $this->db->query("SELECT * 
								   FROM ms_mp_archivo a
								   LEFT JOIN ms_mp_foldarchi b ON a.ArchivoId = b.ArchivoId
								   WHERE a.Status = 1 AND b.FolderId = $Id");
								   
		if($query->num_rows() > 0){
		
			return $query->result();
		
		}else{
			
			return false;
		}
    } 
	
	
	public function download_file($data){
		 
		$this->db->insert("ms_mp_descarchivo",$data);
				
		if($this->db->insert_id() > 0){
			
			return $this->db->insert_id();
			
		}else{
			
			return false;
		}	
	}
	
	
	public function share_file($Id)
    {        
        $query = $this->db->query("SELECT * 
								   FROM ms_mp_archivo		
								   WHERE Status = 1 AND ArchivoId = $Id");
		
		if($query->num_rows() > 0){
		
			return $query->row();
		
		}else{
			
			return false;
		}
    }
	 
	 
	public function share_file_save($data){
		 
		$this->db->insert("ms_mp_link",$data);
				
		if($this->db->insert_id() > 0){
			
			return $this->db->insert_id();
			
		}else{
			
			return false;
		}	
	} 
	
	
	public function download_external_verify($link)
    {        		
        $query = $this->db->query('SELECT * 
								   FROM ms_mp_link		
								   WHERE Link = "'.$link.'"');
		
		if($query->num_rows() > 0){
		
			return $query->row();
		
		}else{
			
			return false;
		}
    }
	
	public function download_external_filename($Id)
    {        		
        $query = $this->db->query("SELECT * 
								   FROM ms_mp_archivo		
								   WHERE ArchivoId = $Id");
				
		if($query->num_rows() > 0){
		
			return $query->row();
		
		}else{
			
			return false;
		}
    }
	
	public function download_external_save($data,$encriptado){
		 		 
		$this->db->where('Link', $encriptado);
		$this->db->update("ms_mp_link",$data);
				
		if($this->db->affected_rows() > 0){
			
			return true;
			
		}else{
			
			return false;
		}	
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
	 
	 
}
