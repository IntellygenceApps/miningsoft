<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //obtenemos las entradas de todos o un usuario, dependiendo
    // si le pasamos le id como argument o no
    public function view($id)
    {
        $this->db->select('a.UsuarioId, a.Usuario, a.Nombres, a.Apellidos, a.Foto, c.Nombre as perfil, d.Nombre as Cargo,
						   a.Direccion, a.Telefono, a.Email, a.LinkedIn');
		$this->db->from('ms_ms_usuario a');		  
		$this->db->join('ms_ms_perfil c','a.PerfilId = c.PerfilId');
		$this->db->join('ms_ms_cargo d','a.CargoId = d.CargoId');		
		$this->db->where('a.UsuarioId', $id);
		$this->db->where('a.Status', 1);
		 
		$query = $this->db->get();
		  
		if($query->num_rows() > 0){
		  
		    return $query->row();		
		
		}
    }

}

?>    