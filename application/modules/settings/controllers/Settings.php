<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends CI_Controller {
    	
	private $controller = "register";
		
	public function __construct()
    {
        parent::__construct();
        $this->load->model('settings_model');
        $this->load->helper('url','form');
							  		
    }
	public function index()
	{
		$this->load->library('pdf');
		
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
			
			redirect(base_url());
		}
	}
	
	
	public function commercial()
	{
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
						
			//Static Data	
			$data['title'] = "Configuración del Modulo Comercial";	
			$data['content'] = "settings_edit";			
			//Styled Data
			$data['js_files'] = array();	
			$data['css_files'] = array();	
			//Model Data
			$data["status"] = $this->settings_model->load_status();
			$data["data"] = $this->settings_model->load_conf();
			//Session Data		
			$data['session'] = $this->session->userdata('data');
			$this->load->view('templates/v1/template_v1',$data);
		}
	}
	
	
	public function save(){
		
		$session = $this->session->userdata('data');
				
		$data = array("Codigo"=>date("YmdHisu"),
					  "TerceroId"=>$_POST["TerceroId"],
					  "FechaSolicitud"=>date("Y-m-d"),
					  "HoraSolicitud"=>date("H:i:s"),
					  "CodigoRUCOM"=>$this->input->post("CodigoRUCOM"),
					  "Token"=>$this->input->post("token"),
					  "DireccionId"=>$_SERVER['REMOTE_ADDR'],
					  "UsuarioRegId"=>$session["id_usuario"]
					  );
					  
		$Result = $this->register_model->save($data);		
		
		if($Result > 0){			
						
			$this->session->set_flashdata("msg","Se inserto un registro satisfactoriamente");			
			redirect(base_url()."register/lista/");		
			
		}else{
			
			$this->session->set_flashdata("msg","Problemas al insertar el registro");
			redirect($this->index());
		}		
	}
	
	private function set_upload_options(){   
		//upload an image options
		$config = array();
		$config['upload_path'] = './private/files/register';
		$config['allowed_types'] = 'gif|jpg|png|doc|pdf|docx|xls|xlsx';
		$config['max_size']      = '0';
		$config['encrypt_name']	= true;
		$config['overwrite']     = FALSE;
	
		return $config;
	}
	
}