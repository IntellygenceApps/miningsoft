<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //obtenemos las entradas de todos o un usuario, dependiendo
    // si le pasamos le id como argument o no
    public function consulta_grupo()
    {

        $this->db->select('u.username,u.fname,u.lname,u.register_date,e.titulo,e.entrada,e.publish_date');
        $this->db->from('users u');
           
        $query = $this->db->get();

        return $query->result();

    }

}

?>    