<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Welcome_model');
        $this->load->helper('url');
        $this->load->database('default');
    }
	public function index()
	{
		// $data['grupo'] = $this->Welcome_model->consulta_grupo();
		
		$this->load->view('templates/v1/home');
	}
}
