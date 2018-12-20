<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index()
    {
        if($this->session->userdata('logged_in') != true)
        {
           redirect('users','refresh');
        }
        
        $this->load->view('template/header');
        $this->load->view('home');
		$this->load->view('template/footer');
    }

}

/* End of file Dashboard.php */