<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class City_m extends CI_Model {

    public function insert_cities()
    {
        $name= $this->input->post('name');
        $lat= $this->input->post('lat');
        $lng=  $this->input->post('lng');
        $status= $this->input->post('status');
        
        $this->db->set('name',$name);
        $this->db->set('lat',$lat);
        $this->db->set('lng ',$lng);
        $this->db->set('status',$status);
        $q= $this->db->insert('cities');

        if($q)
        {
            return true;
        }
        else
        {
            return false;
        } 
    }

    public function record_count()
    {
        return $this->db->count_all('cities');
    }

    public function get_cities()
    {
        $q= $this->db->get('cities');
        if($q->num_rows() > 0)
        {
            return $q->result();
        }
        else{
            return FALSE;
        }
        
    }

    public function getCitiesbyId($id)
    {
       $q= $this->db->select(['name', 'lat', 'lng', 'status', 'city_id'])
                ->where('city_id',$id)
                ->get('cities');
                return $q->row();
    }

    public function updatecity($id, Array $cities)
    {
        return $this->db->where('city_id', $id)
                    ->update('cities', $cities);
    }

    public function del($id)
    {

        $this->db->delete('cities',['city_id'=>$id]);
        
        echo 'Deleted successfully.';
    }


}
/* End of file City_m.php */
?>