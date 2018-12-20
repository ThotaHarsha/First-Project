<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Users_m extends CI_Model {

        public function check_login()
        {
            $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
            if($this->form_validation->run('login_rules'))
            {
                $user_name = $this->input->post('user_name');
                $password = md5($this->input->post('password'));
                $Q = $this->db->where(['email' => $user_name, 'password' => $password])->get('admin');

                if($Q->num_rows() == 1)
                {
                    $admin_id = $Q->row()->admin_id;
                    $session_data = array(      
                        'admin_id' => $admin_id,      
                        'logged_in' => true     
                    );
                    $this->session->set_userdata($session_data);
                    $this->session->set_flashdata('success', 'Welcome to admin dashboard');
                    redirect('dashboard','refresh');
                }
                else
                {
                    $this->session->set_flashdata('failed', 'Invalid Username or Password');
                    redirect('users');
                }
            }
            else
            { 
                $this->load->view('login_view');
            }
        }
}
?>