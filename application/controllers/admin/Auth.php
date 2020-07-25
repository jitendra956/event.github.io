<?php
class Auth extends CI_Controller{
    public function __construct(){    
    parent::__construct();
    error_reporting(0);
    $this->data['theme'] = 'admin';
    $this->load->model('admin_login_model');    
}
    public function index()
	{         	
        $this->data['page'] = 'index';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
	}
    public function is_valid_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');    
        $result = $this->admin_login_model->is_valid_login($username,$password);   
        if(!empty($result))
        {                
            $this->session->set_userdata('ADMINID',$result['ADMINID']);  
            $this->session->set_userdata('SESSION_USER_ID',$result['ADMINID']);  
            $this->session->set_userdata('user_role',$result['user_role']);   
            echo json_encode(array('status'=>'true','message'=>''));
        }
     else 
        { 
            // $this->session->set_flashdata('message','wrong login credantiales!');
            echo json_encode(array('status'=>'fasle','message'=>'<div class="alert alert-danger"><center>Wrong login credantiales!</center></div>'));
            
        }
    }
    public function logout() 
    {
        if (!empty($this->session->userdata['ADMINID'])) 
            {
                $this->session->unset_userdata('ADMINID');
                $this->session->unset_userdata('user_role');
                $this->session->unset_userdata('SESSION_ADMINID_ID');
            }
        redirect(base_url($this->data['theme']));
    }
}

?>
