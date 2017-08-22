<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Barras_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
   

    public function lista(){

        $session = $this->session->userdata('data');

    	$query = $this->db->query("SELECT a.*, b.Nombre as sucursal, d.nombre as producto, CONCAT(c.Nombres,' ',c.Apellidos) as Usuario FROM ms_mo_barras a
                                   INNER JOIN ms_me_sucursal b ON a.idSucursal  = b.SucursalId
                                   INNER JOIN ms_ms_usuario c ON a.idUsuario = c.UsuarioId
                                   INNER JOIN ms_co_producto d ON a.idProducto = d.id
                                   WHERE a.idSucursal IN (SELECT SucursalId 
                                                          FROM ms_ms_ususucursal
                                                          WHERE UsuarioId = ".$session['id_usuario'].") AND a.estado = 1
                                   ORDER BY  a.id
                                  ");

    	return $query->result_array();
    }

    public function productos(){

    	return $this->db->get_where('ms_co_producto', array('estado' => 1))->result();
    }

    public function sucursales(){

        $session = $this->session->userdata('data');

    	$query = $this->db->query("SELECT b.SucursalId ,b.Nombre as sucursal
                                   FROM ms_ms_ususucursal a
                                   INNER JOIN ms_me_sucursal b ON a.SucursalId = b.SucursalId
                                   WHERE a.UsuarioId = ".$session['id_usuario']."
                                 ");

    	return $query->result();
    }

    public function save($table, $data){

        $result = $this->db->insert($table, $data); 

        if($this->db->insert_id() > 1){
        
            return true;

        }else{
        
            return false;
        }

    }	 	 

}


