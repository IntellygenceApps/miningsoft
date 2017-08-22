<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barras extends CI_Controller {
   
    public function __construct()
    {
	    parent::__construct();
		$this->load->database();
		$this->load->model('barras_model');
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');     		
    }
	
	public function index()
	{
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{

			$data['title'] = "Listado de Barras";	
			$data['content'] = "lista";
			$data['barras'] = $this->barras_model->lista();
			//Styled Data
			$data['js_files'] = array("0"=>"js/modules/barras/lista");
			//$data['css_files'] = array();
			//Model Data
			//$data["third"] = $this->register_model->third();
			//Session Data
			$data['session'] = $this->session->userdata('data');
			$this->load->view('templates/v1/template_v1', $data);
		}
	}
	
	
	public function _example_output($output = null)
	{		
		$this->load->view('templates/v1/GC_template_v1.php',$output);
	}
	
	//1.   Security Masters
	//1.1. [Usuarios]
	
	public function crear()
	{
		$data['title'] = "Listado de Barras";	
		$data['content'] = "creacion";
		$data['sucursales'] = $this->barras_model->sucursales();
		$data['productos'] = $this->barras_model->productos();
		//Styled Data
		$data['js_files'] = array("0"=>"js/modules/barras/creacion");	
		//$data['css_files'] = array();	
		//Model Data
		//$data["third"] = $this->register_model->third();
		//Session Data		
		$data['session'] = $this->session->userdata('data');
		$this->load->view('templates/v1/template_v1', $data);
	}

	public function guardar()
	{	
	    $session = $this->session->userdata('data');

		$data = array("idProducto"=>$_POST["idProducto"],
					  "descripcion"=>$_POST["descripcion"],
		 			  "peso"=>$_POST["peso"],
					  "peso_humedo"=>$_POST["peso_humedo"],
					  "fechaCreacion"=>date("Y-m-d h:i:s"),
					  "idUsuario"=>$session['id_usuario'],
					  "idSucursal"=>$_POST["idSucursal"],
					  "estado"=>1);

		$result = $this->barras_model->save("ms_mo_barras", $data);		  

		if($result == true){
					
			$this->session->set_flashdata("msg_success","Se creo una barra satisfactoriamente");			
			redirect(base_url()."barras/");
		
		}else{
			
			$this->session->set_flashdata("msg","Problemas al crear la barra");			
			redirect(base_url()."barras/");
		}
	
	}
	
	
	public function recepcion()
	{
		$data['title'] = "Lista de Actas";	
		$data['content'] = "lista";
		$data['actas'] = $this->actas();
		//Styled Data
		$data['js_files'] = array("0"=>"js/modules/register/register");	
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
		//Styled Data
		//$data['js_files'] = array("0"=>"js/modules/register/register");	
		//$data['css_files'] = array();	
		//Model Data
		//$data["third"] = $this->register_model->third();
		//Session Data		
		$data['session'] = $this->session->userdata('data');
		$this->load->view('templates/v1/template_v1', $data);
	}


	//1. lista de actas
	//1.1 Listado de actas
	public function actas(){

		$usuario = $this->session->userdata('data');

		$actas = $this->compras_model->actas($usuario['id_usuario']);

		for ($i=0; $i <count($actas) ; $i++) { 

			$date = new DateTime($actas[$i]['fecha']);
			$fecha = $date->format('Y-m-d');
			$hora = $date->format('h:i:s');
			$actas[$i]['fecha'] = $fecha;
			$actas[$i]['hora'] = $hora;

		}

		return $actas;

	}
	
	
	
}
