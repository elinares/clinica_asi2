<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Superadministrador extends CI_Controller {
	
	public function inicio()
	{
		$data['user_info'] = $this->session->userdata('user_info');
		$data['titulo'] = 'Super Administrador - Clínicas Municipales';
		$this->load->view('sadm_dashboard', $data);
	}

}