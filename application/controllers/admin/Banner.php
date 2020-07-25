<?php
class Banner extends CI_Controller{
    public function __construct(){    
    parent::__construct();
    error_reporting(0);
    $this->data['theme'] = 'admin';
    $this->data['module'] = 'banner';
    $this->load->model('admin_panel_model');    
}
    public function index()
	{         	
        $this->data['page'] = 'index';
        $this->data['banners'] = $this->admin_panel_model->get_banners();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
	}
    public function add_banner()
    {           
        $this->data['page'] = 'add_banner';
        $this->data['banners'] = $this->admin_panel_model->get_banners();
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
    }
    public function edit_term()
    {           
        $termid = $this->uri->segment(2);
        $this->data['page'] = 'edit_term';
        $this->data['term'] = $this->admin_panel_model->get_single_term($termid);
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
    }
    public function insert_banner()
    {           
      $banner_image=isset($_FILES['banner_image']) && $_FILES["banner_image"]["error"] == 0;
      if($banner_image)
      {
        $file_name      =   $_FILES['banner_image']['name'];

        $file_type      =   $_FILES['banner_image']['type'];

        $tmp_name     =   $_FILES['banner_image']['tmp_name'];

        $error        =   $_FILES['banner_image']['error'];

        $file_size      =   $_FILES['banner_image']['size'];

        $file_ext     =   explode('.',$file_name);

        $ext      = strtolower(end($file_ext));

        $_banner_image    = 'banner-'.uniqid().'.'.$ext;

        $store='uploads/banner/'.$_banner_image;

        if(move_uploaded_file($tmp_name,$store))
        {
          $banner = $_banner_image;
        }
        else
        {
          $banner = "";
        }

        if($this->input->post('status'))
        {
          $status = 0;
        }
        else
        {
          $status = 1;
        }
        $arraybanner = array(
          'banner_order' => $this->input->post('order'), 
          'banner_url' => $this->input->post('banner_url'), 
          'banner_image' => $banner, 
          'banner_date' =>date("Y-m-d H:i:s A"), 
          'banner_status' =>$status 
        );
        $addbanner = $this->db->insert('banner',$arraybanner);
        if($addbanner){
           $this->session->set_flashdata('banner_add_s','Banner Add Sucessfully.');
        }
        else{
           $this->session->set_flashdata('banner_add_f','Failed to Add Banner!');
        }
      }
      redirect (base_url().'add-banner');
    }
    public function update_term()
    {           
       $termid = $this->input->post('termId');
       $title_en = $this->input->post('title_en');
       $title_ar = $this->input->post('title_ar');
       $term_en = $this->input->post('term_en');
       $term_ar = $this->input->post('term_ar');

       $termArray = array(
        'term_title' => $title_en, 
        'term_title_ar' => $title_ar, 
        'term' => $term_en, 
        'term_ar' => $term_ar
       );
      $term_update = $this->admin_panel_model->update_term($termid,$termArray);
      if($term_update)
       {
            $this->session->set_flashdata('term_update_s','Term update Sucessfully.');
       }
       else
       {
            $this->session->set_flashdata('term_update_f','Failed to update Term.');
       }
       redirect(base_url().'edit-term/'.$termid);
    }
    public function banner_delete()
    {           
        $id = $this->input->post('delete_banner_id');
        $delete_banner = $this->admin_panel_model->delete_banner($id); 
        if($delete_banner)
        {
            $this->session->set_flashdata("banner_delete_s","Banner Deleted Successfully.");
        }
        else
        {
            $this->session->set_flashdata("banner_delete_f","Failed to Delete Banner!");
        }
        redirect(base_url('banner'));
    }

    public function change_banner_status()
    {        
        $bannerid = $this->input->post('bannerid');   
        $banner = $this->admin_panel_model->get_single_banner($bannerid);
        if($banner)
        {
            if($banner["banner_status"] == 0){
                $status = 1;
            }
            else{
                $status = 0;
            }
            $bannerArray = array('banner_status' => $status);
            $banner_update = $this->admin_panel_model->update_banner($bannerid,$bannerArray);
            if($banner_update)
            {
                echo json_encode(array('status'=>'true','message'=>'Banner status Changed.','title'=>'Success.','type'=>'success'));
            }
            else
            {
                echo json_encode(array('status'=>'failed','message'=>'Banner status can not be Changed!','title'=>'Warning!','type'=>'warning'));
            }

        }
        else
        {
            echo json_encode(array('status'=>'failed','message'=>'Failed to change Banner status!','title'=>'Failed!.','type'=>'danger'));
        }
    }
   
}

?>
