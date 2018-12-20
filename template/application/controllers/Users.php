<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Users extends CI_Controller {


    //login
    public function index()
    {
        $this->load->model('users_m');
        if($this->input->post('submit'))
        {
            $this->users_m->check_login(); 
        }
        else
        {  
            $this->load->view('login_view');   
        }
    }


    //users list
    public function user_list()
    {
        if($this->session->userdata('logged_in') != true)
        {
            redirect('users','refresh');   
        }
        $this->load->model('users_m');
        $this->load->library("pagination");
        $config = array();
        $config["base_url"] = base_url() . "users/list";
        $config["total_rows"] = $this->users_m->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['num_links'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        //First Link
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        //Last Link
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        //Next Link
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        //Previous Link
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        //Current link
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</li></a>';
        //Digits Link
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $page_num = $page-1;
        $page_num = ($page_num<0)?'0':$page_num;
        $page = $page_num*$config["per_page"];
        $data["users"] = $this->users_m->get_users($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $this->load->view('template/header');
        $this->load->view('template/admin_bar');
        $this->load->view('users/list', $data);
        $this->load->view('template/footer');
    }
       
    /* End of file Users.php */
    
}

?>