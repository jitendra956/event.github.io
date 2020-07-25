<?php
class User extends CI_Controller{
    public function __construct(){    
    parent::__construct();
    error_reporting(0);
    $this->data['theme'] = 'admin';
    $this->data['module'] = 'user';
    $this->load->library('encrypt');
    $this->load->model('admin_panel_model');    
}
    public function index()
	{         	
        $this->data['page'] = 'index';
        $this->data['users'] = $this->admin_panel_model->get_users();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
	}

    public function update_contact_status()
    {        
        $userid = $this->input->post('userid');   
        $user = $this->admin_panel_model->get_single_users($userid);
        if($user)
        {
            if($user["verify"] == 0){
                $status = 1;
            }
            else{
                $status = 0;
            }
            $userArray = array('verify' => $status);
            $user_update = $this->admin_panel_model->update_user($userid,$userArray);
            if($user_update)
            {
                echo json_encode(array('status'=>'true','message'=>'User Phone Verify status Changed.','title'=>'Success.','type'=>'success'));
            }
            else
            {
                echo json_encode(array('status'=>'failed','message'=>'User Phone Verify status can not be Changed!','title'=>'Warning!','type'=>'warning'));
            }

        }
        else
        {
            echo json_encode(array('status'=>'failed','message'=>'Failed to change User Phone Verify status!','title'=>'Failed!.','type'=>'danger'));
        }
    }
    public function update_email_status()
    {        
        $userid = $this->input->post('userid');   
        $user = $this->admin_panel_model->get_single_users($userid);
        if($user)
        {
            if($user["email_verify"] == 0){
                $status = 1;
            }
            else{
                $status = 0;
            }
            $userArray = array('email_verify' => $status);
            $user_update = $this->admin_panel_model->update_user($userid,$userArray);
            if($user_update)
            {
                echo json_encode(array('status'=>'true','message'=>'User Email Verify status Changed.','title'=>'Success.','type'=>'success'));
            }
            else
            {
                echo json_encode(array('status'=>'failed','message'=>'User Email Verify status can not be Changed!','title'=>'Warning!','type'=>'warning'));
            }

        }
        else
        {
            echo json_encode(array('status'=>'failed','message'=>'Failed to change User Email Verify status!','title'=>'Failed!.','type'=>'danger'));
        }
    }
    public function user_delete()
    {        
        $userid = $this->input->post('delete_user_id');  
        $delete_user = $this->admin_panel_model->delete_user($userid); 
        // $this->db->close();
        if($delete_user)
        {
            $this->session->set_flashdata("user_delete_s","User Deleted Successfully.");
        }
        else
        {
            $this->session->set_flashdata("user_delete_f","Failed to Delete User!");
        }
        redirect(base_url('user'));
    }
    public function edit_user()
    {           
        $userID = $this->uri->segment(2);
        $this->data['page'] = 'edit_user';
        $this->data['user'] = $this->admin_panel_model->get_single_users($userID);        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
    }
    public function update_user()
    {   
        // var_dump($this->input->post());        
        $userid = $this->input->post('userID');
        $usernewimg=isset($_FILES['usernewimg']) && $_FILES["usernewimg"]["error"] == 0;
        if($usernewimg)
        {
            $file_name      =   $_FILES['usernewimg']['name'];

            $file_type      =   $_FILES['usernewimg']['type'];

            $tmp_name       =   $_FILES['usernewimg']['tmp_name'];

            $error          =   $_FILES['usernewimg']['error'];

            $file_size      =   $_FILES['usernewimg']['size'];

            $file_ext       =   explode('.',$file_name);

            $ext            =   strtolower(end($file_ext));

            $userimg_name        =   'user-'.$userid.'-'.uniqid().'.'.$ext;

            $store='uploads/users/'.$userimg_name;

            if(move_uploaded_file($tmp_name,$store))
            {
                $userimg = $userimg_name;
            }
            else
            {
                $userimg = "";
            }
        }
        else
        {
          $userimg = $this->input->post('useroldimg');   
        }  
        $userArray = array(
            'full_name' => $this->input->post('full_name'), 
            'email' => $this->input->post('email'), 
            'password' => $this->encrypt->encode($this->input->post('password')), 
            'country_code' => $this->input->post('country_code'),
            'contact' => $this->input->post('contact'),
            'user_photo' => $userimg,
            'user_about' => $this->input->post('about')
        );
        // var_dump($userArray);
        $update_user = $this->admin_panel_model->update_user($userid,$userArray); 
        $this->db->close();
        if($update_user)
        {
            $this->session->set_flashdata("user_update_s","User Updated Successfully.");
        }
        else
        {
            $this->session->set_flashdata("user_update_f","Failed to Update User!");
        }
        redirect(base_url('edit-user/'.$userid));
      
    }
    public function multiuser_delete()
    {   
        $ids =  $this->input->post('checkbox_value');
        $delete_users = $this->admin_panel_model->multiple_delete_user($ids);     
        if($delete_users)
        {
            echo json_encode(array('status'=>'true','message'=>"Users deleted Successfully.",'title'=>'Success.','type'=>'success'));
        }
        else
        {
             echo json_encode(array('status'=>'failed','message'=>"Failed to delete Users !",'title'=>'Warning!','type'=>'warning'));
        }
    }
   
}

?>
