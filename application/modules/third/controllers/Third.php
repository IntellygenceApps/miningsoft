<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Third extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('home_model');
        $this->load->helper('url');       		
    }
	public function index()
	{
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
				
			$data['title'] = "Inicio";	
			$data['content'] = "home";
			$data['session'] = $this->session->userdata('data');
			$this->load->view('templates/v1/template_v1',$data);
		}
	}
}
