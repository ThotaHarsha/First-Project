<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Tours extends CI_Controller {
    
        public function index()
        {
            if($this->session->userdata('logged_in') != true)
            {
                redirect('users','refresh');   
            }
            $this->load->model('tours_m');
            $this->load->library("pagination");
            $config = array();
            $config["base_url"] = base_url() . "tours/index";
            $config["total_rows"] = $this->tours_m->record_count();
            
            $config["per_page"] = 5;
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
           // Next Link
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
            $data["tours"] = $this->tours_m->get_tours($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data["count"] = $this->tours_m->record_count();

            $this->load->view('template/header');
            $this->load->view('tours/tours_list_view', $data);
            $this->load->view('template/footer');
        }
        
        public function insert_form()
        {
            $this->load->model('tours_m');
            $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
            if($this->form_validation->run('tours_insert_rules'))
            {
                $this->tours_m->insert_tours();
            }
            else
            {
                $data['cities'] = $this->tours_m->get_cities();
                $data['category'] = $this->tours_m->get_category();

                $this->load->view('template/header');
                $this->load->view('tours/tours_insert_view', $data);
                $this->load->view('template/footer');
            }
            
        }
        public function add()
        {
            $this->load->model('tours_m');
            $this->tours_m->insert_tours();
        }
        public function del_tour($id)
        { 

            $this->load->model('tours_m');
            $this->tours_m->del($id);

        }

        public function edit($tour_id)
        {
            if($this->session->userdata('logged_in') != true)
            {
                redirect('users','refresh');   
            }
            $this->load->model('tours_m');
            $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
            if($this->form_validation->run('tours_insert_rules'))
            {
                $this->tours_m->updatetour(); 
            }
            else
            {
                $data['tours']=  $this->tours_m->findtour($tour_id);
                $data['cities']= $this->tours_m->get_cities($tour_id);
                $data['category'] = $this->tours_m->get_category($tour_id);   

                $this->load->view('template/header');
                $this->load->view('tours/tours_edit_view', $data);
                $this->load->view('template/footer');
            }
           
        }
        
        public function images($tour_id)
        {
            
            // echo "<pre>";
            // print_r ($tour_id);
            // echo "</pre>";
            // exit;
            $this->load->model('tours_m');
            $data['images']= $this->tours_m->images($tour_id);

            if($data['images']){
                $this->load->view('template/header');
                $this->load->view('tours/tour_images_view', $data);
                $this->load->view('template/footer');
            }else{
            return redirect('tours/index');
            }
        }
        public function images_delete($id)
        {
            //$images_id= $this->uri->segment(3);
            //$tour_id = $this->uri->segment(4);
           
            
            // echo "<pre>";
            // print_r ($id);
            // echo "</pre>";
            // exit;
            $tour_id = $this->uri->segment(3);

            $this->load->model('tours_m');
            $this->tours_m->images_delete($id, $tour_id);
            
        }
        public function images_edit($images_id)
        {
            
            // echo "<pre>";
            // print_r ($images_id);
            // echo "</pre>";
            // exit;
            
            $this->load->model('tours_m');
           $data['images']= $this->tours_m->find_images($images_id);

           $this->load->view('template/header');
           $this->load->view('tours/images_update_view', $data);
           $this->load->view('template/footer');
        }
        public function update_image()
        {
            $images_id = $this->uri->segment(3);
            $tour_id = $this->uri->segment(4);
            
            //echo $images_id;
            $this->load->model('tours_m');
            $this->tours_m->update_image($images_id, $tour_id);
        }
        public function change_status()
        {
            if($this->session->userdata('logged_in') != true)
            {
                redirect('users','refresh');   
            }
            $this->load->model('tours_m');
            $this->tours_m->change_status();
        }
    }
    
    /* End of file Tours.php */
    
?>