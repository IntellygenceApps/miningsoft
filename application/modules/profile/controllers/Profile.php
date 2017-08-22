<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('profile_model');
        $this->load->helper('url');       		
    }
	
	public function index()
	{
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
				
			$data['title'] = "Perfil de Usuario";	
			$data['content'] = "view";
			$session = $this->session->userdata('data');
			$data['view'] = $this->profile_model->view($session['id_usuario']); 
			$data['session'] = $this->session->userdata('data');
			$this->load->view('templates/v1/template_v1',$data);	
		}
	}
	
	
}
