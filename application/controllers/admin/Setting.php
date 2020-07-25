<?php 
class Setting extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->data['theme'] = 'admin';
        $this->data['module'] = 'setting';
        $this->load->model('admin_panel_model');
        $this->load->library('form_validation');
        
    }
    public function index()
    {

        $this->data['page']='index';
        $this->data['settings'] = $this->admin_panel_model->get_settings();
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
        

    } 

    public function change_password()
    {

        $this->data['page']='change_password';
        // $this->data['list'] = $this->admin_panel_model->get_password();
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
        

    }  
    
    
    
public function change()
{
        
    $this->form_validation->set_rules('oldp','old password','required');
    $this->form_validation->set_rules('newp','new password','required'); 
    $this->form_validation->set_rules('conp','confirm password','required'); 
    if($this->form_validation->run())
    {
    
        $old_pass=$this->input->post('oldp');
        $new_pass=$this->input->post('newp');
        $con_pass=$this->input->post('conp');  
       
       
        
        $userid = '1';
        $pass = $this->admin_panel_model->getcurrentpassword($userid);
        if($new_pass == $con_pass){
            
        }else{
            // echo "confirm password doesn't match!";
              $warning="confirm password doesn't match!";
$this->session->set_flashdata("warning",$warning);
        }
        if($pass->password == md5($old_pass)) {
             if($this->admin_panel_model->updatepassword(md5($new_pass), $userid))
        {
            // $this->session->set_flashdata('message', 'password updated successfully.');
            // $this->session->keep_flashdata('message');
// var_dump($this->session->flashdata('message'));
            //  echo "password updated successfully";
        //   echo '<script>alert("password updated successfully.");</script>';
            //   redirect('admin/setting');
            $message='Password updated  successfully.';

					 $this->session->set_flashdata('message',$message);
				// 	 redirect('admin/setting');
            //  ?>
            // <script>
            // window.location.href=<?php echo  base_url(); ?>;
            //     alert("fsdsfsad");
            // </script>
            // <?php
            
        }
        else{
            // echo "failed to update";
            
            //  ?>
            // <script>
            //       window.location.href=<?php echo  base_url(); ?>;
            //     alert("fsdsfsad");
            // </script>
            // <?php
            
        }
    } else{
            // echo "old password is not correct";
             $warni="Old password is not correct!";
$this->session->set_flashdata("warni",$warni);
            //  ?>
            // <script>
            //      window.location.href=<?php echo  base_url(); ?>;
            //     alert("fsdsfsad");
            // </script>
            // <?php
            
        }
    }
    else{
        // echo "plz enter the correct values";
         $warn="Please enter correct values!";
$this->session->set_flashdata("warn",$warn);
        //  ?>
        //     <script>
        //     alert("fsdsfsad");
        //         // window.location.href=<?php echo  base_url(); ?>;
        //         // window.location=BASE_URL+"admin/setting";
        //         // header("location:../../admin/setting");
        //          redirect ("admin/setting");
                
        //     </script>
        //     <?php
            
    }
  redirect ("change-password");
}


    public function update_settings()
    {
        $updated_data = $this->input->post();
        $this->db->where('SETTINGID','1')->update('settings', $updated_data);
        if($this->db->affected_rows() > 0){

          $this->session->set_flashdata("update_s",'Settings update successfully.');

        }else{

            $this->session->set_flashdata("update_f",'Warning, Nothing to change!');

        } 
        // var_dump($this->db->last_query());
        redirect(base_url('setting'));
    }  
  
}
    ?>