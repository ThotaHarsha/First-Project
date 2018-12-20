<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Cities extends CI_Controller {
    
        public function index()
        {
            if($this->session->userdata('logged_in') != true)
            {
                redirect('users','refresh');   
            }
            $this->load->model('city_m');
           
            $data["cities"] = $this->city_m->get_cities();
            
            
            $this->load->view('template/header');
            $this->load->view('cities/cities_list_view', $data);
            $this->load->view('template/footer');
        }

        public function insert_form()
        {
            if($this->session->userdata('logged_in') != true)
            {
                redirect('users','refresh');   
            }
            $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
            if($this->form_validation->run('insert_rules'))
            {
                //echo "inserted successfully";
                $this->load->model('city_m');
                $q= $this->city_m->insert_cities();
                if($q)
                {
                    return redirect('cities');
                }
            }
            else
            {
                $this->load->view('template/header');
                $this->load->view('cities/cities_insert_view');
               $this->load->view('template/footer');
            }            
        }
        public function del_city($id)
        {
            //$id= $this->input->post('id');
            $this->load->model('city_m','del_city');
            $this->del_city->del($id);
        }
        public function edit($id)
        {
            $this->load->model('city_m');
            $city= $this->city_m->getCitiesbyId($id);
            $this->load->view('template/header');
            $this->load->view('cities/city_edit_view',['cities'=>$city]);
            $this->load->view('template/footer');
            
        }
        public function update_city($city_id)
        {
            if($this->form_validation->run('insert_rules'))
            {
                $post= $this->input->post();
            
                $this->load->model('city_m', 'editupdate');
                if($this->editupdate->updatecity($city_id, $post))
                {
                    $this->session->set_flashdata('msg', 'Updated Succesfully');
                    $this->session->set_flashdata('msg_class','alert-success');
                }
                else{
                    $this->session->set_flashdata('msg', 'please try again....not Updated');
                    $this->session->set_flashdata('msg_class', 'alert-danger');
                }
               return redirect('cities');
            }
            else{
                $this->load->view('cities/cities_edit_view');
            }
            
        }
    }
    
    /* End of file Cities.php */
    
?>