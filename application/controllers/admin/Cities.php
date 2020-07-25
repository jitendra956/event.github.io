<?php
class Cities extends CI_Controller{
    public function __construct(){    
    parent::__construct();
    error_reporting(0);
    $this->data['theme'] = 'admin';
    $this->data['module'] = 'city';
    $this->load->model('admin_panel_model');    
}
    public function index()
	{         	
        $this->data['page'] = 'index';
        $this->data['cities'] = $this->admin_panel_model->get_cities();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
	}
    public function add_city()
    {           
        $this->data['page'] = 'add_city';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
    }
    public function edit_city()
    {           
        $id = $this->uri->segment(2);
        $this->data['city'] = $this->admin_panel_model->get_single_city($id);
        $this->data['page'] = 'edit_city';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
    }
    public function insert_city()
    {           
       $name_en = $this->input->post('name_en');
       $name_ar = $this->input->post('name_ar');
       $latitude = $this->input->post('latitude');
       $longitude = $this->input->post('longitude');

       $cityArray = array(
        'name_ar' => $name_ar, 
        'name_en' => $name_en, 
        'latitude' => $latitude, 
        'longitude' => $longitude
       );
       $insert = $this->db->insert('city',$cityArray);
       if($insert)
       {
            $this->session->set_flashdata('city_add_s','City Add Sucessfully.');
       }
       else
       {
            $this->session->set_flashdata('city_add_f','Failed to Add City.');
       }
       redirect(base_url().'add-city');

    }
    public function update_city()
    {        
       $id = $this->input->post('cityId');
       $name_en = $this->input->post('name_en');
       $name_ar = $this->input->post('name_ar');
       $latitude = $this->input->post('latitude');
       $longitude = $this->input->post('longitude');

       $cityArray = array(
        'name_ar' => $name_ar, 
        'name_en' => $name_en, 
        'latitude' => $latitude, 
        'longitude' => $longitude
       );
       $update = $this->admin_panel_model->update_city($id,$cityArray);
       if($update)
       {
            $this->session->set_flashdata('city_update_s','City Update Sucessfully.');
       }
       else
       {
            $this->session->set_flashdata('city_update_f','Failed to Update City.');
       }
       redirect(base_url().'edit-city/'.$id);

    }

    public function city_delete()
    {           
        $id = $this->input->post('delete_city_id');
        $delete_review = $this->admin_panel_model->delete_city($id); 
        if($delete_review)
        {
            $this->session->set_flashdata("city_delete_s","City Deleted Successfully.");
        }
        else
        {
            $this->session->set_flashdata("city_delete_f","Failed to Delete City!");
        }
        redirect(base_url('cities'));
    }

    public function change_city_status()
    {        
        $cityid = $this->input->post('cityid');   
        $city = $this->admin_panel_model->get_single_city($cityid);
        if($city)
        {
            if($city["city_status"] == 0){
                $status = 1;
            }
            else{
                $status = 0;
            }
            $cityArray = array('city_status' => $status);
            $city_update = $this->admin_panel_model->update_city($cityid,$cityArray);
            if($city_update)
            {
                echo json_encode(array('status'=>'true','message'=>'City status Changed.','title'=>'Success.','type'=>'success'));
            }
            else
            {
                echo json_encode(array('status'=>'failed','message'=>'City status can not be Changed!','title'=>'Warning!','type'=>'warning'));
            }

        }
        else
        {
            echo json_encode(array('status'=>'failed','message'=>'Failed to change City status!','title'=>'Failed!.','type'=>'danger'));
        }
    }
   
}

?>
