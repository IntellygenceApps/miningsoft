<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
  
   	public function validate($Usuario, $Password){
      
		  $this->db->select('a.UsuarioId, a.Usuario, a.Nombres, a.Apellidos, a.Foto, c.Nombre as perfil, d.Nombre as Cargo, d.CargoId');
		  $this->db->from('ms_ms_usuario a');		  
		  $this->db->join('ms_ms_perfil c','a.PerfilId = c.PerfilId');
		  $this->db->join('ms_ms_cargo d','a.CargoId = d.CargoId','LEFT');
		  $this->db->where('Usuario', $Usuario);
		  $this->db->where('Clave', $Password);
		  $this->db->where('a.Status', 1);
		 
		  $query = $this->db->get();
		  
		  if($query->num_rows() > 0){
		  
			  return $query->row();		
		
		  }else{
			  
			  $this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
			  redirect(base_url().'login','refresh');
		  }
	}
	
	public function validateEmail($email){
      
		  $this->db->select('a.UsuarioId, a.Usuario, a.Nombres, a.Apellidos, a.Email');
		  $this->db->from('ms_ms_usuario a');		  		  
		  $this->db->where('Email', $email);		 
		  $this->db->where('a.Status', 1);
		 
		  $query = $this->db->get();
		  
		  if($query->num_rows() > 0){
		  
			  return $query->row();	
		
		  }else{
			  
			  return FALSE;
		  }
	}
	
	public function validSession($UsuarioId){
      
		  $query = $this->db->get_where('ms_ms_sesion', array('UsuarioId'=>$UsuarioId,
		  											 		  'Status'   =>1));
				  
		  if($query->num_rows() > 0){
		  
			  return TRUE;	
		
		  }else{
			  
			  return FALSE;
		  }
	}
	
	public function insertSession($UsuarioId,$token){
      		
		  $data = array("UsuarioId"    =>$UsuarioId,
		  				"Token"        =>$token,
						"Direccion_Ip" =>$_SERVER['REMOTE_ADDR'],
						"FechaInicio"  =>date("Y-m-d"),
						"HoraInicio"   =>date("H:i:s"),
						"Status"       =>1);
	  
		 $this->db->insert('ms_ms_sesion', $data);
				  
		  if($this->db->insert_id() > 0){
		  
			  return TRUE;	
		
		  }else{
			  
			  return FALSE;
		  }
	}
	
	public function closeSession($UsuarioId){
      		
		  $data = array("FechaFin"    =>date("Y-m-d"),
		  				"HoraFin"     =>date("H:i:s"),
						"Status"      =>0);						
	  
	  	  $this->db->where('UsuarioId', $UsuarioId);
		  $this->db->update('ms_ms_sesion', $data);
				  
		  if($this->db->affected_rows() > 0){
		  
			  return TRUE;	
		
		  }else{
			  
			  return FALSE;
		  }
	}
	
	
} 