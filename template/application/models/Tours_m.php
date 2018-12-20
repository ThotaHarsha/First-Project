<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    ob_start();
    class Tours_m extends CI_Model {
    
        public function insert_tours()
        {
            $title        = $this->input->post('title');
            $des          = $this->input->post('des');
            $price          = $this->input->post('price');
            $city_id      = $this->input->post('select_city');
            $category_id  = $this->input->post('select_category');
            
            $data = array(
                'title'      =>$title,
                'des'        =>$des,
                'price'      => $price,
                'city_id'    =>$city_id,
                'category_id'=> $category_id,
                'status'     => 1   
            );
            $this->db->insert('tours', $data);

            $last_id= $this->db->insert_id();

            if($last_id && !empty($_FILES['userFiles']['name']))
            {
                $filesCount = count($_FILES['userFiles']['name']);
                for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name']     = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type']     = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error']    = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size']     = $_FILES['userFiles']['size'][$i];

                $uploadPath = 'uploads/tours';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['image_url']  = "assets/images/tours/".$fileData['file_name'];
                    $uploadData[$i]['tour_id']    = $last_id;
                    $insert = $this->db->insert('tour_images', $uploadData[$i]);
                }
            }
                $this->session->set_flashdata('success', 'Successfully Inserted');
                redirect('tours','refresh');
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to insert');
                redirect('tours/insert_form','refresh');
            }
        }

        //fetching all the cities in the 'cities' table from the database.
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
        public function get_category()
        {
            $Q = $this->db->get_where('categories', array('status' => 0));
            if($Q->num_rows() > 0)
            {
                return $Q->result();
            }
            else
            {
                return false;
            }
        }
        public function record_count()
        {
            return $this->db->count_all('tours');
        }
        public function get_tours($limit, $offset)
        {
            $this->db->select('t.*, c.name, d.category_name ');
            $this->db->join('cities as c', 'c.city_id = t.city_id', 'left');
            $this->db->join('categories as d', 'd.category_id = t.category_id', 'left');
            $q= $this->db->get('tours as t',$limit, $offset);
           // echo $this->db->last_query();
            if($q->num_rows()>0)
            {
                return $q->result();
            }
            else{
                return false;
            }
        }

        //updating a tour
        public function findtour($id)
        {
            $q= $this->db->select('title, des, tour_id, city_id, category_id, price')
                     ->where('tour_id', $id )
                     ->get('tours');
                    return $q->row();
        }
        public function updatetour()
        {
            $tour_id = $this->input->post('tour_id');
            $data= array(
                'title'=> $this->input->post('title'),
                'des'=>$this->input->post('des'),
                'city_id'=>$this->input->post('select_city'),
                'category_id'=>$this->input->post('select_category'),
                'price'  => $this->input->post('price'),
                'last_updated' => date('Y-m-d H:i:s')
            ); 
            $this->db->where('tour_id',$tour_id)->update('tours', $data);
            if($this->db->affected_rows())
            {
                $this->session->set_flashdata('success', 'Tour successfully updated');
                redirect('tours','refresh');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to update!');
                redirect("tours/edit/$tour_id");
            }
        }

        //Deleting a tour
        public function del($id)
        {
            //selecting two tables
            $tables = array('tours', 'tour_images');
            
            $this->db->where('tour_id', $id)->delete($tables);
            echo 'Deleted successfully.';
        }

        //fetching all images with specific tour_id
        public function images($tour_id)
        {
            
            // echo "<pre>";
            // print_r ($tour_id);
            // echo "</pre>";
            // exit;
            $q= $this->db->where('tour_id', $tour_id)
                         ->get('tour_images');
            
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

        //deleting an image with specific tour_id
        public function images_delete($id="", $tour_id="")
        {
            
            // echo "<pre>";
            // print_r ($images_id);
            // echo "</pre>";
            // exit;
            
           $this->db->where('images_id',$id)
                     ->delete('tour_images');
            //echo "Deleted Succeesfully";
            if($this->db->affected_rows()>0){
                $this->session->set_flashdata('success', 'Successfully Deleted');
                redirect("tours/images/$tour_id",'refresh');
            }else{
                $this->session->set_flashdata('failed', 'Unable to delete');
                redirect("tours/images/$tour_id",'refresh');     
            }
        }

        //updating an image with specific tour_id
        public function find_images($images_id)
        {
            
            // echo "<pre>";
            // print_r ($tour_id);
            // echo "</pre>";
            // exit;
            
            $q= $this->db->where('images_id', $images_id)
                     ->get('tour_images');
                     
                     
                    //  echo "<pre>";
                    //  print_r ($q->row());
                    //  echo "</pre>";
                    //  exit;
                     if($q->num_rows()>0)
                     {
                         return $q->row();
                     }else{
                         return FALSE;
                     }
                     
        }
        public function update_image($images_id="", $tour_id="")
        {
            
            // echo "<pre>";
            // print_r ($images_id);
            // echo "</pre>";
            // exit;   

            if(!empty($_FILES['userFiles']['name']))
            {
                

                $uploadPath = 'uploads/tours';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFiles')){
                    $fileData = $this->upload->data();
                    $uploadData['image_url'] =base_url()."uploads/tours/". $fileData['file_name'];
                    //$uploadData[$i]['tour_id'] = $last_id;
                    $update = $this->db->where('images_id', $images_id)
                                        ->update('tour_images', $uploadData);
                    $this->session->set_flashdata('success', 'Successfully Updated');
                    redirect("tours/images/$tour_id",'refresh');
                }else{
                    $this->session->set_flashdata('failed', 'Unable to update');
                    redirect("tours/images/$tour_id",'refresh');     
                
                }
            }
            else{
                $this->session->set_flashdata('failed', 'File cannot be empty');
                redirect('tours','refresh');
            }
        }
        public function change_status(){
          $id = $this->input->get('id');
          $status = $this->input->get('status');
          $this->db->where('tour_id',$id);
          $this->db->update('tours',array('status'=>$status));
          redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    /* End of file Tours_m.php */
    
?>  