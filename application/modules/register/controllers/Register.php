<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends CI_Controller {
    	
	private $controller = "register";
		
	public function __construct()
    {
        parent::__construct();
        $this->load->model('register_model');
        $this->load->helper('url','form');
							  		
    }
	public function index()
	{
		$this->load->library('pdf');
		
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
			
			//Security Data
			$barcodeobj = new TCPDF2DBarcode(strtoupper(sha1(date("Ymdhis"))), 'PDF417');
			$data['token'] = strtoupper(sha1(date("Ymdhis")));
			$data['barcode'] = $barcodeobj->getBarcodeHTML(4, 2, 'black');			
			//Static Data	
			$data['title'] = "Formulario de Registro";	
			$data['content'] = "register_form";
			$data['action'] = "register/save";
			//Styled Data
			$data['js_files'] = array("0"=>"js/modules/register/register");	
			$data['css_files'] = array();	
			//Model Data
			$data["third"] = $this->register_model->third();
			//Session Data		
			$data['session'] = $this->session->userdata('data');
			$this->load->view('templates/v1/template_v1',$data);
		}
	}
	
	
	public function lista()
	{
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
						
			//Static Data	
			$data['title'] = "Listado de Registros";	
			$data['content'] = "register_lista";
			$data['session'] = $this->session->userdata('data');		
			//Styled Data
			$data['js_files'] = array("0"=>"js/DataTables-1.10.12/media/js/jquery.dataTables.min",
									  "1"=>"js/modules/register/lista");	
			$data['css_files'] = array("0"=>"js/DataTables-1.10.12/media/css/jquery.dataTables.min");	
			
			//Model Data
			$data["data"] = $this->register_model->lista();
						
			//Session Data		
			$data['session'] = $this->session->userdata('data');
			$this->load->view('templates/v1/template_v1',$data);
		}
	}
	
	public function lista_general()
	{
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
						
			//Static Data	
			$data['title'] = "Listado de Registros";	
			$data['content'] = "register_lista_general";
			$data['session'] = $this->session->userdata('data');		
			//Styled Data
			$data['js_files'] = array("0"=>"js/DataTables-1.10.12/media/js/jquery.dataTables.min",
									  "1"=>"js/modules/register/lista");	
			$data['css_files'] = array("0"=>"js/DataTables-1.10.12/media/css/jquery.dataTables.min");	
			
			//Model Data
			$data["data"] = $this->register_model->lista_general();
						
			//Session Data		
			$data['session'] = $this->session->userdata('data');
			$this->load->view('templates/v1/template_v1',$data);
		}
	}
	
	public function upload_requirements($id)
	{
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
			
			$Session = $this->session->userdata('data');
			
			//Static Data	
			$data['title'] = "Registro";	
			$data['content'] = "register_upload_requirements";
			$data['action'] = $this->controller."/upload_requirements_save";	
			$data['session'] = $Session;
					
			//Model Data
			$data['register_valoration'] = $this->register_model->register_valoration($Session["id_usuario"],$id); //retorna un array de datos o false				
			$data['register_status'] = $this->register_model->register_status(); //retorna un array de datos o false			
			$data['registro_id'] = $id;
			
			//Styled Data
			$data['js_files'] = array("0"=>"js/DataTables-1.10.12/media/js/jquery.dataTables.min",
									  "1"=>"js/modules/register/upload");	
			$data['css_files'] = array("0"=>"js/DataTables-1.10.12/media/css/jquery.dataTables.min");	
			//Model Data
			$data["data"] = $this->register_model->verify_process($id);
			//Session Data		
			$data['session'] = $this->session->userdata('data');
			$this->load->view('templates/v1/template_v1',$data);
		}
	}
	
	
	public function view($id)
	{
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
			
			$Session = $this->session->userdata('data');
			
			//Static Data	
			$data['title'] = "Registro";	
			$data['content'] = "view";
			$data['action'] = $this->controller."/upload_requirements_save";	
			$data['session'] = $Session;
			
			//Model Data
			$data['register_valoration'] = $this->register_model->register_valoration_view($id); //retorna un array de datos o false				
			$data['register_status'] = $this->register_model->register_status(); //retorna un array de datos o false			
			$data['registro_id'] = $id;
			
			//Styled Data
			$data['js_files'] = array("0"=>"js/DataTables-1.10.12/media/js/jquery.dataTables.min",
									  "1"=>"js/modules/register/upload");	
			$data['css_files'] = array("0"=>"js/DataTables-1.10.12/media/css/jquery.dataTables.min");	
			//Model Data
			$data["data"] = $this->register_model->verify_process($id);
			//Session Data		
			$data['session'] = $this->session->userdata('data');
			$this->load->view('templates/v1/template_v1',$data);
		}
	}
	
	
	public function verify_process($id)
	{
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
			
			$Session = $this->session->userdata('data');
			
			//Static Data	
			$data['title'] = "Registro";	
			$data['content'] = "register_verify_process";
			$data['action'] = $this->controller."/verify_process_save";	
			$data['session'] = $Session;
			
			//$data['detValorations'] = $this->register_model->detValorations($id); 						
			//$data['register_valoration'] = $this->register_model->register_valoration($Session["id_usuario"]); //retorna un array de datos o false				
			$data['register_valoration'] = $this->register_model->register_valoration($Session["id_usuario"],$id);
			
			$data['register_status'] = $this->register_model->register_status(); //retorna un array de datos o false			
			$data['registro_id'] = $id;
			
			//Styled Data
			$data['js_files'] = array("0"=>"js/DataTables-1.10.12/media/js/jquery.dataTables.min",
									  "1"=>"js/modules/register/upload");	
			$data['css_files'] = array("0"=>"js/DataTables-1.10.12/media/css/jquery.dataTables.min");	
			//Model Data
			$data["data"] = $this->register_model->verify_process($id);
			//Session Data		
			$data['session'] = $this->session->userdata('data');
			$this->load->view('templates/v1/template_v1',$data);
		}
	}
	
	
	public function complete_register($id,$status)
	{
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
			
			$Session = $this->session->userdata('data');
			
			//Static Data	
			$data['title'] = "Complete el registro";	
			$data['content'] = "complete_register";
			$data['action'] = $this->controller."/complete_register_save";	
			$data['session'] = $Session;			
			$data['registro_id'] = $id;
			$data['status'] = $status;
			$data['register_status'] = $this->register_model->register_status_complete($status); //retorna un array de datos o false			
			
			//Styled Data
			$data['js_files'] = array("0"=>"js/DataTables-1.10.12/media/js/jquery.dataTables.min",
									  "1"=>"js/modules/register/upload");	
			$data['css_files'] = array("0"=>"js/DataTables-1.10.12/media/css/jquery.dataTables.min");	
			//Model Data
			$data["data"] = $this->register_model->verify_process($id);
			//Session Data		
			$data['session'] = $this->session->userdata('data');
			$this->load->view('templates/v1/template_v1',$data);
		}
	}
	
	public function complete_register_save()
	{
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
			
			$count = "";
			$post = $this->input->post();					
			$data = array();			
			$Session = $this->session->userdata('data');			
			
			$data = array("ObservacionesGenerales"=>$post["ObservacionesGenerales"],
						  "UsuarioFinalizaId"	  =>$post["UsuarioId"],						  
						  "RegistroEstadoId"	  =>$post["RegistroEstadoId"],
						  "Finalizado"	  		  =>1);						  
										
			$result = $this->register_model->complete_register_save($data,$post["RegistroId"]);
			
			if($result != false){			
						
				$this->session->set_flashdata("msg","Se completo el registro satisfactoriamente");			
				redirect(base_url()."register/lista/");		
			
			}else{
				
				$this->session->set_flashdata("msg","Problemas al completar el registro");
				redirect($this->index());
			}		
				
											
			redirect(base_url()."register/lista");				
		}
	}
	
	
	public function verify_process_save()
	{
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
			
			$count = "";
			$post = $this->input->post();					
			$data = array();			
			$Session = $this->session->userdata('data');			
			
			for($x=0; $x<count($post["Valoracion"]);$x++){
				
				//if($post["RegistroEstadoId"][$x] > 0){
				
					$data = array("RegistroId"=>$post["RegistroId"],
								  "ValoracionId"=>$post["ValoracionId"][$x],
								  "Valoracion"=>$post["Valoracion"][$x],
								  "RegistroEstadoId"=>$post["RegistroEstadoId"][$x],
								  "FechaRegistro"=>date("Y-m-d"),
								  "HoraRegistro"=>date("H:i:s"),
								  "UsuarioId"=>$Session["id_usuario"]);	
					
					$resVerifyValoration = $this->register_model->VerifyValoration($post["ValoracionId"][$x],$post["RegistroId"]);
					
					$count = $resVerifyValoration.$count;
																	
					if($resVerifyValoration == "No"){
												
						$result = $this->register_model->verify_process_save($data);
									
					}else{
												
						$dataUpdate = array("Valoracion"=>$post["Valoracion"][$x],
											"RegistroEstadoId"=>$post["RegistroEstadoId"][$x],											
											"UsuarioId"=>$Session["id_usuario"]);
						
						$result = $this->register_model->verify_process_update($dataUpdate, $post["RegistroId"], $post["ValoracionId"][$x]);
					}
				//}
											
			}	
								
			redirect(base_url()."register/lista");	
			
		}
	}
	
	
	public function AjaxLoadThird(){
					
		if (!$this->input->is_ajax_request()) {
		   
		   exit('No direct script access allowed');
		}else{									
			
			$Id = $this->input->post("Id");	
							
			$ThirdData = $this->register_model->AjaxLoadDataThird($Id); //Vista			
				
			print_r($ThirdData);
		}
	}	
	
	public function AjaxLoadRequirements(){
					
		if (!$this->input->is_ajax_request()) {
		   
		   exit('No direct script access allowed');
		   
		}else{									
			
			$Id = $this->input->post("Id");	
			
			if($Id > 0 || $Id != ""){
			
				$ThirdClassId = $this->register_model->AjaxLoadThirdClass($Id);
											
				$Requirements = $this->register_model->AjaxLoadRequirements($ThirdClassId["ClaseTerceroId"]); //Vista			
					
				print_r($Requirements);
				
			}else{
				
				return false;				
			}
		}
	}
	
	public function save(){
		
		$session = $this->session->userdata('data');
				
		$data = array("Codigo"=>date("YmdHisu"),
					  "Clave"=>substr($this->input->post("token"),0,8),
					  "TerceroId"=>$_POST["TerceroId"],
					  "FechaSolicitud"=>date("Y-m-d"),
					  "HoraSolicitud"=>date("H:i:s"),
					  "Token"=>$this->input->post("token"),
					  "DireccionId"=>$_SERVER['REMOTE_ADDR'],
					  "UsuarioRegId"=>$session["id_usuario"]
					  );
					  
		$Result = $this->register_model->save($data);
		$valorations = $this->register_model->valorations();
		
		if($Result > 0){			
			
			for($x=0; $x<count($valorations);$x++){
				
				$dataValoration = array("RegistroId"=>$Result,
										"ValoracionId"=>$valorations[$x]->ValoracionId);								 
								
				$ResultDetail = $this->register_model->saveValoration($dataValoration);
				
				/* Aqui envio email a cada dirigente de area */
				
				
				
				/* Fin envio email*/									
			}	
				
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