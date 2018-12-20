<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('logged_in') != true)
        {
            redirect('users','refresh');   
        }
            $this->load->model('slider_m');
            $data["slider"] = $this->slider_m->get_slider();

            $this->load->view('template/header');
            $this->load->view('slider/list', $data);
            $this->load->view('template/footer');
	}

	public function new_slider()
	{
		if($this->session->userdata('logged_in') != true)
        {
            redirect('users','refresh');   
        }
        $this->load->model('slider_m');
        $this->load->model('tours_m');
        if($this->input->post('submit'))
        {
        	$this->slider_m->insert_slider_image();
        }
        $data['cities'] = $this->tours_m->get_cities();

	    $this->load->view('template/header');
	    $this->load->view('slider/new', $data);
	    $this->load->view('template/footer');
	}

    public function edit($slider_id)
    {
        //echo "$tour_id";
        $this->load->model('slider_m');
       $data['slider']=  $this->slider_m->find_slider($slider_id);
       $data['cities']= $this->slider_m->get_cities();
       
        //    echo "<pre>";
        //    print_r ($data);
        //    echo "</pre>";
        //    exit;
       $this->load->view('template/header');
       $this->load->view('slider/image_edit_view', $data);
       $this->load->view('template/footer');
       
    }

     public function update_slider($slider_id)
        {
            echo $slider_id;
            exit;
            if($this->form_validation->run('slider_insert_rules'))
            {
                $data= array(
                    'city_id'=>$this->input->post('select_city')
                ); 
                
                // echo "<pre>";
                // print_r($data);
                // echo "</pre>";
                // exit;  
                $this->load->model('slider_m');
                if($this->tours_m->update_slider($slider_id, $data))
                {
                    $this->session->set_flashdata('success', 'Updated Succesfully');
                    $this->session->set_flashdata('success_class','alert-success');
                }
                else{
                    $this->session->set_flashdata('failed', 'please try again....not Updated');
                    $this->session->set_flashdata('failed_class', 'alert-danger');
                } 
               return redirect('slider');
            }
            else{
                
                redirect("slider/edit/$slider_id");
            }
        }
        
        public function update_slider_image()
        {
            $images_id = $this->uri->segment(3);
            $city_id = $this->uri->segment(4);
            
            //echo $images_id;
            $this->load->model('slider_m');
            $this->slider_m->update_slider_image($images_id, $slider_id);
        }

    public function images($slider_id)
    {
        
        // echo "<pre>";
        // print_r ($tour_id);
        // echo "</pre>";
        // exit;
        $this->load->model('slider_m');
        $data['images']= $this->slider_m->images($slider_id);

        if($data['images']){
            $this->load->view('template/header');
            $this->load->view('slider/image_view', $data);
            $this->load->view('template/footer');
        }else{
        return redirect('slider/index');
        }
    }

    public function images_edit($images_id)
    {
        
        $this->load->model('slider_m');
        $data['images']= $this->slider_m->find_images($images_id);

        $this->load->view('template/header');
        $this->load->view('slider/image_edit', $data);
        $this->load->view('template/footer');
    }

    public function images_delete($id)
    {
        //$images_id= $this->uri->segment(3);
        //$tour_id = $this->uri->segment(4);
       
        
        // echo "<pre>";
        // print_r ($id);
        // echo "</pre>";
        // exit;
        $slider_id = $this->uri->segment(3);

        $this->load->model('slider_m');
        $this->tours_m->images_delete($id, $slider_id);
    }
}


/* End of file Slider.php */
/* Location: ./application/controllers/Slider.php */