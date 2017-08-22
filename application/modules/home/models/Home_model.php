<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //obtenemos las entradas de todos o un usuario, dependiendo
    // si le pasamos le id como argument o no
    public function grupo()
    {
        $this->db->select('*');
        $this->db->from('dm_grupo');  
		$this->db->where('Status',1);         
        $query = $this->db->get();
		
        return $query->result();
    }

}

?>    