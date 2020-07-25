<?php 
class Information extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->data['theme'] = 'admin';
        $this->data['module'] = 'information';
        $this->load->model('admin_panel_model');
        $this->load->library('form_validation');
        
    }
    public function index()
    {

        $this->data['page']='index';
        $this->data['information'] = $this->admin_panel_model->get_information();
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
        

    } 

    

    public function update_information()
    {
        $updated_data = $this->input->post();
        $this->db->where('INFOID','1')->update('information', $updated_data);
        if($this->db->affected_rows() > 0){

          $this->session->set_flashdata("update_information_s",'Information update successfully.');

        }else{

            $this->session->set_flashdata("update_information_f",'Warning, Nothing to change!');

        } 
        redirect(base_url('information'));
    }  
  
}
    ?>