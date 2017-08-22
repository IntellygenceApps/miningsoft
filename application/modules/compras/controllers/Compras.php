<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras extends CI_Controller {
   
    public function __construct()
    {
	    parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('compras_model');
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');     		
    }
	
	public function index()
	{	

		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
				
			redirect(base_url().'home');
		}
	}
	
	
	public function _example_output($output = null)
	{		
		$this->load->view('templates/v1/GC_template_v1.php',$output);
	}
	
	
	public function recepcion()
	{	
		$data['title'] = "Lista de Actas";	
		$data['content'] = "lista";
		$data['actas'] =  $this->compras_model->actas();
		//Styled Data
		$data['js_files'] = array("0"=>"js/modules/compras/lista");	
		//$data['css_files'] = array();	
		//Model Data
		//$data["third"] = $this->register_model->third();
		//Session Data		
		$data['session'] = $this->session->userdata('data');
		$this->load->view('templates/v1/template_v1', $data);
	}


	public function historico()
	{	
		$data['title'] = "Historico de Actas";	
		$data['content'] = "lista";
		$data['actas'] =  $this->compras_model->historico();
		//Styled Data
		$data['js_files'] = array("0"=>"js/modules/compras/lista");	
		//$data['css_files'] = array();	
		//Model Data
		//$data["third"] = $this->register_model->third();
		//Session Data		
		$data['session'] = $this->session->userdata('data');
		$this->load->view('templates/v1/template_v1', $data);
	}

	public function creacion()
	{					
		
		$data['title'] = "Lista de Actas";	
		$data['content'] = "creacion";
		$data["terceros"] = $this->compras_model->terceros();
		$data["sucursales"] = $this->compras_model->sucursales();
		//Styled Data
		$data['js_files'] = array("0"=>"js/modules/compras/creacion");	
		//$data['css_files'] = array();	
		//Model Data
		
		//Session Data		
		$data['session'] = $this->session->userdata('data');
		$this->load->view('templates/v1/template_v1', $data);
	}


	public function cargaBarras(){

		$id = $_POST["id"];

		echo json_encode($this->compras_model->cargaBarras($id));
	}


	public function ajaxLoadBarras(){	

		//die(print_r($this->session->userdata('barras')));

		if($this->session->userdata('barras')){

			echo  json_encode(array("error"=>0, "data"=>$this->session->userdata('barras')));

		}else{

			echo json_encode(array("error"=>1, "data"=>"Sin informacion"));
		}
	}


	public function addBarra(){

		$data = $_POST;

		$dataBarra = $this->compras_model->loadBarra($data["id"]);

		if($this->session->userdata('barras')){

			$barras = $this->session->userdata('barras');
		
			if($this->searchForId($data["id"], $barras) != false){

				echo  json_encode(array("error"=>1, "data"=>"Ya existe este material en la lista."));

			}else{

				$newdata = array('idBarra'     => $dataBarra["id"],
								 'descripcion' => $dataBarra["descripcion"],
								 'peso'        => $dataBarra["peso"],
								 'peso_humedo' => $dataBarra["peso_humedo"],
								 'sucursal'    => $dataBarra["sucursal"]
				);

				array_push($barras, $newdata);

				$this->session->set_userdata('barras', $barras);

				echo  json_encode(array("error"=>0, "data"=>"Se agrego material correctamente."));
			}

		}else{
			
				$newdata = array( 0 => array('idBarra'     => $dataBarra["id"],
											 'descripcion' => $dataBarra["descripcion"],
											 'peso'        => $dataBarra["peso"],
											 'peso_humedo' => $dataBarra["peso_humedo"],
											 'sucursal'    => $dataBarra["sucursal"]
											)
				);

				$this->session->set_userdata('barras', $newdata);	

				echo  json_encode(array("error"=>0, "data"=>"Se agrego material correctamente."));
		}
	}	


	public function delBarra(){

		$data = $_POST;

		if($this->session->userdata('barras')){

			$barras = $this->session->userdata('barras');

			$this->session->set_userdata('barras', array());

			foreach($barras as $key => $row){

				if($row["idBarra"] == $data["id"]){

					unset($barras[$key]);	
				}
			}		
			
			$this->session->set_userdata('barras', $barras);

			echo  json_encode(array("error"=>0, "data"=>"Se agrego material correctamente."));			
		}
	}	
	

	public function searchForId($id, $array) {

		foreach ($array as $key => $val) {

			if ($val['idBarra'] === $id) {
				
				return true;
			}
		}
		
		return false;	
	}
	
	
	public function guardar(){

		$data = $_POST;
		$material = $this->session->userdata('barras');
		$usuario = $this->session->userdata('data');
        $idUsuario = $usuario['id_usuario'];	

		$a_dataCab = array("fecha"=>date("Y-m-d h:i:s"),
						   "lugar"=>"Medellin",
						   "idUsuario" => $idUsuario,
						   "idSucursal"=>$data["idSucursal"],
						   "idTercero"=>$data["idTercero"],
						   "ip"=>$_SERVER["REMOTE_ADDR"],
						   "estado"=>"A");

		$a_validaMaterial = $this->validaMaterial($material);

		if($a_validaMaterial != false){

			$this->session->set_flashdata("msg",$a_validaMaterial);			
			redirect(base_url()."compras/creacion");

		}else{

			$b_resSave = $this->compras_model->save($a_dataCab, $material);	

			if($b_resSave != false){

				$this->session->set_userdata('barras', array());
				$this->session->set_flashdata("msg_success","Se creo un nuevo acta de ingreso satisfactoriamente.");
				$this->session->set_flashdata("recent", $b_resSave);			
				redirect(base_url()."compras/recepcion");

			}else{

				$this->session->set_flashdata("msg","Problemas al generar el acta de ingreso, valide la información e intente de nuevo.");			
				redirect(base_url()."compras/creacion");
			}
		}
	}


	public function loadActa(){

		echo json_encode($this->compras_model->loadActa($_POST["id"]));
	}

	public function loadBarras(){

		echo json_encode($this->compras_model->loadBarras($_POST["id"]));
	}

	/*public function loadBarras(){

		$idActa = $_POST["id"];	
				
		$a_resReceiveMaterial = $this->compras_model->loadBarras($idActa);

		if($a_resReceiveMaterial != false){

			echo json_encode($a_resReceiveMaterial);

		}else{

			echo json_encode(array("error"=>"1", "mns"=>"Problemas al cargar las barras."));
		}
	}*/

	private function validaMaterial($data){

		$a_res = "";
		$a_cant = 0;

		foreach($data as $key){

			$res =  $this->compras_model->validaMaterial($key["idBarra"]);

			if($res == true){

				$a_res .= "<li>".$key["descripcion"]." - Peso: ".$key["peso"]." Grs"."</li>";

				$a_cant++;
			}			
		}

		if($a_cant > 0){

			//return false;

			return "<p>El siguiente material ya se encuentra registrado y no se puede ingresar de nuevo.</p><ol>".$a_res."</ol>";

		}else{
			
			return false;
		}		
		
	}

	public function pdfExport($sha){

		if($sha == ""){

			redirect(base_url()."compras/recepcion");
		}	

		$b_veriSha = $this->compras_model->veriSha($sha);

		if($b_veriSha == false){

			$this->session->set_flashdata("msg","El documento solicitado no existe.");
			redirect(base_url()."compras/recepcion");
		}

		$this->load->library('pdf');	
		$ruta = "private/actas/".hash("sha256",date("Ymdhis"));

		$content = file_get_contents("formats/operaciones/FTLO02/ftlo02.php"); 

		ob_start();
		echo $content;
		$html = ob_get_contents();
		ob_clean();

		$pdf = $this->pdf->create($html, $ruta, "P");

	}

}
