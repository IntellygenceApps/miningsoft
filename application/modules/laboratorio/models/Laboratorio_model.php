<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laboratorio_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    

    public function saveMuestra($data){

        $this->db->insert_batch('ms_mo_muestra', $data);

        if($this->db->insert_id() > 0){

            return true;
        
        }else{
            
            return false;
        }
    }


    public function loadMuestras(){
        
        //Session data	
        //$usuario = $this->session->userdata('data');
        //$idUser = $usuario['id_usuario'];

        $query = $this->db->query("SELECT a.*, DATE(a.fecha) as fechaA, c.Nombre as sucursal, CONCAT(d.Nombres,' ',d.Apellidos) as Usuario,
                                    CONCAT(e.PrimerNombre,' ', e.PrimerApellido) as nombre, e.NombreCompleto as nombre_completo,
                                    f.descripcion 
                                    FROM ms_mo_muestra a          
                                    INNER JOIN ms_mo_actacab b ON a.idActa = b.id                        
                                    INNER JOIN ms_me_sucursal c ON b.idSucursal = c.SucursalId
                                    INNER JOIN ms_ms_usuario d ON b.idUsuario = d.UsuarioId
                                    INNER JOIN ms_mp_tercero e ON b.idTercero = e.TerceroId 
                                    INNER JOIN ms_mo_barras f ON a.idBarra = f.id                                   
                                    ORDER BY fecha DESC");

        $data["data"] =  $query->result_array();                          

        return (object)$data;
    }

    public function reloadData(){

        //Session data	
		$usuario = $this->session->userdata('data');
        $idUser = $usuario['id_usuario'];

    	$query = $this->db->query("SELECT a.*, DATE(a.fecha) as fechaA, c.Nombre as sucursal, CONCAT(d.Nombres,' ',d.Apellidos) as Usuario,
                                   CONCAT(e.PrimerNombre,' ', e.PrimerApellido) as nombre, e.NombreCompleto as nombre_completo 
                                   FROM ms_mo_actacab a                                   
                                   INNER JOIN ms_me_sucursal c ON a.idSucursal = c.SucursalId
                                   INNER JOIN ms_ms_usuario d ON a.idUsuario = d.UsuarioId
                                   INNER JOIN ms_mp_tercero e ON a.idTercero = e.TerceroId
                                   WHERE a.idSucursal IN (SELECT SucursalId
                                                          FROM ms_ms_ususucursal
                                                          WHERE UsuarioId = $idUser) AND a.estado IN ('A')
                                   ORDER BY fecha DESC");

        $data["data"] =  $query->result_array();                          

    	return (object)$data;
    }


    public function reloadDataHistory(){

        //Session data	
		$usuario = $this->session->userdata('data');
        $idUser = $usuario['id_usuario'];

    	$query = $this->db->query("SELECT a.*, DATE(a.fecha) as fechaA, c.Nombre as sucursal, CONCAT(d.Nombres,' ',d.Apellidos) as Usuario,
                                   CONCAT(e.PrimerNombre,' ', e.PrimerApellido) as nombre, e.NombreCompleto as nombre_completo 
                                   FROM ms_mo_actacab a                                   
                                   INNER JOIN ms_me_sucursal c ON a.idSucursal = c.SucursalId
                                   INNER JOIN ms_ms_usuario d ON a.idUsuario = d.UsuarioId
                                   INNER JOIN ms_mp_tercero e ON a.idTercero = e.TerceroId
                                   WHERE a.idSucursal IN (SELECT SucursalId
                                                          FROM ms_ms_ususucursal
                                                          WHERE UsuarioId = $idUser) AND a.estado IN ('F','Q','C')
                                   ORDER BY fecha DESC");

        $data["data"] =  $query->result_array();                          

    	return (object)$data;
    }



    public function loadActa($id){

    	$query = $this->db->query("SELECT a.*, DATE(a.fecha) as fechaA, c.Nombre as sucursal, CONCAT(d.Nombres,' ',d.Apellidos) as Usuario,
                                   CONCAT(e.PrimerNombre,' ', e.PrimerApellido) as nombre, e.NombreCompleto as nombre_completo 
                                   FROM ms_mo_actacab a                                   
                                   INNER JOIN ms_me_sucursal c ON a.idSucursal = c.SucursalId
                                   INNER JOIN ms_ms_usuario d ON a.idUsuario = d.UsuarioId
                                   INNER JOIN ms_mp_tercero e ON a.idTercero = e.TerceroId
                                   WHERE a.id = $id");
                                
    	return $query->row();
    }


    public function loadAnalisis($id){

    	$query = $this->db->query("SELECT a.* , b.id as idBarra, b.descripcion as barra
                                   FROM ms_mo_actalab a
                                   INNER JOIN ms_mo_barras b on a.idBarra = b.id
                                   WHERE a.idActa = $id
                                   ORDER BY b.id, a.tipo ASC");
                                
    	return $query->result_array();
    }


    public function terceros(){

    	$query = $this->db->query("SELECT a.TerceroId, a.NumeroIdentificacion, a.NombreCompleto
                                    FROM ms_mp_tercero a                                    
                                    WHERE a.Status = 1 AND a.TerceroId IN (SELECT TerceroId 
                                                                           FROM ms_mp_regicab
                                                                           WHERE Finalizado = 1)");

    	return $query->result();

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


    public function cargaBarras($id){

        return $this->db->get_where('ms_mo_barras', array("idSucursal"=>$id,
                                                          "estado"=>1))->result();
    }
	

    public function loadBarra($id){

        $session = $this->session->userdata('data');

    	$query = $this->db->query("SELECT a.*, b.Nombre as sucursal
                                   FROM ms_mo_barras a
                                   INNER JOIN ms_me_sucursal b ON a.idSucursal = b.SucursalId
                                   WHERE a.id = $id
                                 ");    
        $data = $query->result_array();

    	return $data[0];
    }


    public function validaMaterial($idBarra){
     
    	$query = $this->db->query("SELECT a.idBarra
                                   FROM ms_mo_actadet a
                                   INNER JOIN ms_mo_actacab b ON a.idCabActa = b.id
                                   WHERE a.idBarra <> $idBarra AND b.estado NOT IN ('A','F')");
  
        if($query->num_rows() > 0){

            return true;

        }else{

            return false;
        }   	
    }


    public function save($dataCab, $dataDet){

        $this->db->trans_begin();
        $this->db->query("INSERT INTO ms_mo_actacab (fecha,lugar,idUsuario,idSucursal,idTercero,sha_pdf,ip,estado)
                                            VALUES ('".$dataCab["fecha"]."', 'Medellin', '".$dataCab["idUsuario"]."',
                                                    '".$dataCab["idSucursal"]."', '".$dataCab["idTercero"]."',
                                                    '".hash("sha256",date("Ymdhis").$dataCab["idTercero"])."',
                                                    '".$dataCab["ip"]."', 'A')");      
        $idCabActa = $this->db->insert_id();
        
        foreach($dataDet as $key){
		
			$this->db->query("INSERT INTO `ms_mo_actadet` (`idCabActa`, `idBarra`, `peso`, `pesohumedo`) 
                              VALUES ($idCabActa, '".$key["idBarra"]."', '".$key["peso"]."',
                                      '".$key["peso_humedo"]."')");	
		}

        if ($this->db->trans_status() === FALSE){

           $this->db->trans_rollback();
           return false;
        }

        else{
           $this->db->trans_commit();
           return $idCabActa;
        }
    }


    public function veriSha($sha){
     
    	$query = $this->db->query('SELECT a.id
                                   FROM ms_mo_actacab a                                   
                                   WHERE a.sha_pdf = "'.$sha.'"');
  
        if($query->num_rows() > 0){

            $query = $this->db->query('UPDATE ms_mo_actacab set cantImpresiones=cantImpresiones+1                                  
                                       WHERE sha_pdf = "'.$sha.'"');

            if($this->db->affected_rows() > 0){
                
                return true;

            }else{

                return false;    
            }
            
        }else{

            return false;
        }   	
    }


    public function receiveMaterial($data, $id){
     
    	$this->db->where('id', $id);
        $this->db->update('ms_mo_actacab', $data); 
  
        if($this->db->affected_rows() > 0){
                
            return true;
   
        }else{

            return false;
        }   	
    }


    public function loadBarras($idActa){
     
    	$query = $this->db->query("SELECT a.idBarra, a.peso, a.pesohumedo, b.descripcion
                                   FROM ms_mo_actadet a
                                   INNER JOIN ms_mo_barras b ON a.idBarra = b.id
                                   WHERE a.idCabActa = $idActa");

        if($query->num_rows() > 0){

            return $query->result();

        }else{

            return false;
        }   	
    }


    public function saveLaboratorio($id, $data, $tipoLab){
        
        $s_field = "";
    	$this->db->trans_start();
        $this->db->insert_batch('ms_mo_actalab', $data);

        if($this->db->insert_id() > 0){

            //Valido el examen que estan enviando
            if($tipoLab == "D"){
                $s_field = "cantDensidad";
            }

            if($tipoLab == "RFX"){
                $s_field = "cantRFX";
            }

            if($tipoLab == "C"){
                $s_field = "cantCopela";
            }            

            //Actualizo la tabla cabecera acta
            /*$this->db->where('id', $id);
            $this->db->update('ms_mo_actacab', $s_field); 
            */
            //die($this->db->last_query());

            $query = $this->db->query("UPDATE ms_mo_actacab SET $s_field = $s_field + 1 WHERE id = $id");

            if($this->db->affected_rows() > 0){

                $this->db->trans_commit();
                return true;

            }else{

                $this->db->trans_rollback();
                return false;
            }         

        }else{

            $this->db->trans_rollback();
            return false;
        }   	
    }

    public function validaBarra($idBarra, $idActa){

        $query = $this->db->get_where('ms_mo_actalab', array('idActa' => $idActa, "idBarra"=>$idBarra));

        if($query->num_rows() > 0){

            return true;

        }else{
            
            return false;
        }
    }


    public function cancel($id){
  
        $query = $this->db->query('UPDATE ms_mo_actacab set estado = "C"                                   
                                    WHERE id = '.$id.'');

        if($this->db->affected_rows() > 0){
            
            return true;

        }else{

            return false;    
        }
       
    }


    public function finish($id){
  
        $query = $this->db->query('UPDATE ms_mo_actacab set estado = "F"                                   
                                    WHERE id = '.$id.'');

        if($this->db->affected_rows() > 0){
            
            return true;

        }else{

            return false;    
        }
       
    }
	 	 
}


