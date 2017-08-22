<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        // Load the user_login Class        
        $this->load->helper(array('form', 'html','url'));
		$this->load->model('login_model');
    }

    public function index(){
				
		$perfil = $this->session->userdata('data');
				 
		switch ($perfil['perfil']) {
			case '':
				$data['token'] = $this->token();
				$data["title"] = "Login";
				$data["action"] = "login/validate";
				$data["content"] = "login_form";
				$this->load->view('templates/v1/login_v1',$data);
				break;
			case 'administrador':
				redirect(base_url().'home');
				break;
			case 'editor':
				redirect(base_url().'editor');
				break;	
			case 'suscriptor':
				redirect(base_url().'suscriptor');
				break;
			default:		
				$data["title"] = "Login";
				$data["content"] = "login_form";
				$data["action"] = "login/validate";
				$this->load->view('templates/v1/login_v1',$data);
				break;		
		}		
    }
	
	
	public function force_close_session(){
				
		$perfil = $this->session->userdata('data');
				 
		switch ($perfil['perfil']) {
			case '':
				$data['token'] = $this->token();
				$data["title"] = "Login";
				$data["action"] = "login/force_close_session_save";
				$data["content"] = "force_close_session";
				$this->load->view('templates/v1/login_v1',$data);
				break;
			case 'administrador':
				redirect(base_url().'home');
				break;
			case 'editor':
				redirect(base_url().'editor');
				break;	
			case 'suscriptor':
				redirect(base_url().'suscriptor');
				break;
			default:		
				$data["title"] = "Login";
				$data["content"] = "force_close_session";
				$data["action"] = "login/force_close_session_save";
				$this->load->view('templates/v1/login_v1',$data);
				break;		
		}		
    }
	
	
	public function force_close_session_save()
    {		
		
	   $post = $this->input->post();
	   $Result = $this->login_model->validateEmail($post["Email"]);
	   
	   if($Result != false)	   
       {		   
	   		$data = array('FechaFin'=> 	date("Y-m-d"),
						  'HoraFin' => 	date("H:i:s"),
						  'Status'	=>	0);	
			
			$ResultUpdate = $this->login_model->closeSession($Result->UsuarioId);
			
			if($ResultUpdate == TRUE)
			{				
				$this->index();
								
			}else{
				
				
				$this->session->set_flashdata('usuario_incorrecto','Problemas al cerrar la sesión.');		
				$this->index();							
						
			}
		}else{
			redirect(base_url().'login');
		}
    }
	
	
    
    public function validate()
    {		   
       if($this->input->post('token') && $this->input->post('token'))
		{	
		
            $this->form_validation->set_rules('username', 'nombre de usuario', 'required|trim|min_length[2]');
            $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[2]');
            			 
			if($this->form_validation->run() == FALSE)
			{				
				$this->session->set_flashdata('usuario_incorrecto','Los datos ingresados no cumplen los requisitos');		
				$this->index();
								
			}else{
				
				$username = $this->input->post('username');
				$password = sha1($this->input->post('password'));
				$check_user = $this->login_model->validate($username,$password);
				
				if($check_user == TRUE){ //Si el usuario y la clave estan correctas
					
					$validSession = $this->login_model->validSession($check_user->UsuarioId);					
						
					if($validSession == FALSE){	 //Valida que la sesion no este activa
						
						$insertSession = $this->login_model->insertSession($check_user->UsuarioId,$this->token());
							
						if($insertSession == TRUE){ // Si se inserto correctamente la session

							session_start();

							$data = array('is_logued_in'=> 		TRUE,
										  'id_usuario' 	=> 		$check_user->UsuarioId,
										  'perfil'		=>		$check_user->perfil,
										  'username' 	=> 		$check_user->Nombres,
										  'secondname' 	=> 		$check_user->Apellidos,
										  'position'   	=> 		$check_user->Cargo,
										  'picture'   	=> 		$check_user->Foto,
										  'CargoId'   	=> 		$check_user->CargoId,);
												
							$this->session->set_userdata('data',$data);
																					
							$this->index();							
						
						}else{
							
							$this->session->set_flashdata('usuario_incorrecto','Ya se encuentra una Sesion activa en otro equipo');		
							$this->index();							
						}
								
					}else{
						
						$this->session->set_flashdata('usuario_incorrecto','Ya hay una sesión abierta, debes cerrarla primero '."<a href='".base_url()."login/force_close_session'>Desbloquear.</a>");		
						$this->index();						
					}								
					
				}else{
					
						redirect(base_url().'login');
				}
			}
		}else{
			redirect(base_url().'login');
		}
    }
    
	public function get_password(){
				
		$perfil = $this->session->userdata('data');
				 
		switch ($perfil['perfil']) {
			case '':
				$data['token'] = $this->token();
				$data["title"] = "Login";
				$data["content"] = "get_password";
				$data["action"] = "login/send_password";
				$this->load->view('templates/v1/login_v1',$data);
				break;
			case 'administrador':
				redirect(base_url().'home');
				break;
			case 'editor':
				redirect(base_url().'editor');
				break;	
			case 'suscriptor':
				redirect(base_url().'suscriptor');
				break;
			default:		
				$data["title"] = "Login";
				$data["content"] = "get_password";
				$data["action"] = "login/send_password";
				$this->load->view('templates/v1/login_v1',$data);
				break;		
		}
		
    }
	
	
	public function send_password()
    {		   
       if($this->input->post('token') && $this->input->post('token'))
		{	
		
            $this->form_validation->set_rules('email', 'Email', 'required|trim|min_length[2]');
           
			if($this->form_validation->run() == FALSE)
			{				
				$this->session->set_flashdata('email_invalido','No tenemos registros de este email en nuestra base de datos');		
				$this->index();
								
			}else{
				
				$email = $this->input->post('email');				
				$check_user = $this->login_model->validateEmail($email);
				
				if($check_user != FALSE){ //Si el email es incorrecto
					
							
					
				}else{
					
						redirect(base_url().'login');
				}
			}
		}else{
			redirect(base_url().'login');
		}
    }
	
    public function token()
	{
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}
	
	public function logout_ci()
	{	
		$data = $this->session->userdata('data');
		
		$closeSession = $this->login_model->closeSession($data["id_usuario"]);
		
		if($closeSession == TRUE){
			
		   $this->session->unset_userdata('data'); 
		   $this->session->sess_destroy();
		   redirect(base_url().'login');
				
		}else{
			
		   $this->session->set_flashdata('usuario_incorrecto','Problemas al cerrar la Sesion, por favor solicite cierre manual.');		
		   $this->index();	
			
		}		
	}
}