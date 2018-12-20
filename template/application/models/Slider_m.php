<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_m extends CI_Model {

	public function insert_slider_image()
    {
        $city_id   = $this->input->post('select_city');
        $title     = $this->input->post('title');
        $sub_title = $this->input->post('sub_title');

        $data = array(
            'city_id' => $city_id,
            'title' => $title,
            'sub_title' => $sub_title,
        );
        if($title !== "" && $sub_title !== "")
        {
            if(!empty($_FILES['userfile']['name']))
            {   

                $config = array(
                    'upload_path' => "./../experientia.in/assets/images/slider/",
                    'allowed_types' => "jpg|png|jpeg|gif",
                    'overwrite' => TRUE,
                    'max_size' => "5145728", // Can be set to particular file size , here it is 3 MB(3072 Kb)
                    //'max_height' => "2048",
                    //'max_width' => "2048"
                );
                $new_name = time().$_FILES["userfile"]['name'];
                $config['file_name'] = $new_name;
                
                $this->load->library('upload', $config);
                if($this->upload->do_upload('userfile')){
                    $upload_data = $this->upload->data();
                    $data['slider_image_url'] = "assets/images/slider/".$upload_data['file_name'];
                }
                else{
                    $this->session->set_flashdata('failed', 'something went wrong');
                    redirect('slider/new_slider','refresh');
                }
                $insert = $this->db->insert('slider_images', $data);
    	        if($this->db->insert_id() > 0)
                {
                    $this->session->set_flashdata('success', 'Successfully Inserted');
                    redirect('slider','refresh');
                }
                else
                {
                    $this->session->set_flashdata('failed', 'Unable to insert');
                    redirect('slider/new_slider','refresh');
                }
            }
            else
            {
                $this->session->set_flashdata('failed', 'Fields can\'t be empty!');
                redirect('slider/new_slider','refresh');
            }
        }
        else
        {
            $this->session->set_flashdata('failed', 'Fields can\'t be empty!');
            redirect('slider/new_slider','refresh');
        }
    }

    public function get_slider()
    {  
        $q = $this->db->select('c.city_id, c.name, s.slider_id, s.title, s.sub_title, s.slider_image_url')->join('cities c', 'c.city_id = s.city_id', 'left')->get('slider_images s');
        //echo $this->db->last_query();
        if($q->num_rows() > 0)
        {
            return $q->result();
        }
        else{
            return false;
        }
    }
    public function get_cities()
    {
        $q= $this->db->get('cities');
        if($q->num_rows()>0)
        {
            return $q->result();
        }else{
            return false;
        }

    }

    public function record_count()
    {
        return $this->db->count_all('slider_images');
    }

    public function find_slider($id)
    {
        $q= $this->db->select('city_id')
                 ->where('slider_id', $id )
                 ->get('slider_images');
                return $q->row();
    }

    public function find_images($images_id)
    {
        
        $q= $this->db->where('slider_id', $images_id)
                 ->get('slider_images');

         if($q->num_rows()>0)
         {
             return $q->row();
         }else{
             return FALSE;
         }
                 
    }

    public function update_slider($id, Array $slider)
        {
           return $this->db->where('slider_id',$id)
                       ->update('slider_images', $slider);

        }
	
	public function update_slider_image($images_id="", $slider_id="")
        {   
            if(!empty($_FILES['userFiles']['name']))
            {
                

                $uploadPath = 'uploads/slider';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFiles')){
                    $fileData = $this->upload->data();
                    $uploadData['slider_image_url'] =base_url()."uploads/slider/". $fileData['file_name'];
                    //$uploadData[$i]['slider_id'] = $last_id;
                    $update = $this->db->where('slider_id', $slider_id)
                                        ->update('slider_images', $uploadData);
                    $this->session->set_flashdata('success', 'Successfully Updated');
                    redirect("slider/images/$slider_id",'refresh');
                }else{
                    $this->session->set_flashdata('failed', 'Unable to update');
                    redirect("slider/images/$slider_id",'refresh');     
                
                }
            }
            else{
                $this->session->set_flashdata('failed', 'File cannot be empty');
                redirect('tours','refresh');
            }
        }

     public function images($slider_id)
    {
        
        // echo "<pre>";
        // print_r ($slider_id);
        // echo "</pre>";
        // exit;
        $q= $this->db->where('slider_id', $slider_id)
                     ->get('slider_images');
        
        // echo "<pre>";
        // print_r ($q->result());
        // echo "</pre>";
        // exit;
        if($q->num_rows()>0)
        {
            return $q->result();
        }
        else
        {
            return False;
        }
    }

    public function images_delete($id="", $slider_id="")
        {
            
            // echo "<pre>";
            // print_r ($images_id);
            // echo "</pre>";
            // exit;
            
           $this->db->where('images_id',$id)
                     ->delete('slider_images');
            //echo "Deleted Succeesfully";
            if($this->db->affected_rows()>0){
                $this->session->set_flashdata('success', 'Successfully Deleted');
                redirect("slider/images/$slider_id",'refresh');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to delete');
                redirect("slider/images/$slider_id",'refresh');     
            }
        }
}

/* End of file Slider_m.php */
/* Location: ./application/models/Slider_m.php */