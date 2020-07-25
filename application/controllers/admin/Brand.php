<?php
class Brand extends CI_Controller{
    public function __construct(){    
    parent::__construct();
    error_reporting(0);
    $this->data['theme'] = 'admin';
    $this->data['module'] = 'brand';
    $this->load->model('admin_panel_model');    
}
    public function index()
	{         	
        $this->data['page'] = 'index';
        $this->data['brands'] = $this->admin_panel_model->get_brands();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
	}
    public function add_brand()
    {           
        $this->data['page'] = 'brand_add';
        $this->data['categories'] = $this->admin_panel_model->get_categories();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
    }
    public function insert_brand()
    {           
        $brand_logo=isset($_FILES['brandlogo']) && $_FILES["brandlogo"]["error"] == 0;
        if($brand_logo)
        {
            $file_name      =   $_FILES['brandlogo']['name'];

            $file_type      =   $_FILES['brandlogo']['type'];

            $tmp_name       =   $_FILES['brandlogo']['tmp_name'];

            $error          =   $_FILES['brandlogo']['error'];

            $file_size      =   $_FILES['brandlogo']['size'];

            $file_ext       =   explode('.',$file_name);

            $ext            =   strtolower(end($file_ext));

            $_icon_image        =   'brandlogo-'.uniqid().'.'.$ext;

            $store='uploads/brands/'.$_icon_image;

            if(move_uploaded_file($tmp_name,$store))
            {
                $brandlogo = $_icon_image;
            }
            else
            {
                $brandlogo = "";
            }
        }
        else
        {
          $brandlogo = "";   
        }
         $arraybrand = array(
                'pcatID' => $this->input->post('brandcat_id'), 
                'catID' => $this->input->post('brandsubcat_id'),  
                'brand_name' =>  $this->input->post('brandname'), 
                'brand_name_ar' =>  $this->input->post('brandname_ar'), 
                'brand_image' => $brandlogo, 
                'brand_created_date' =>date("Y-m-d h:i:s A")
            );
            $add_brand = $this->admin_panel_model->insert_brand($arraybrand);
            if($add_brand){
                 $this->session->set_flashdata('brand_add_s','Brand Add Sucessfully.');
            }
            else{
                 $this->session->set_flashdata('brand_add_f','Failed to Add Brand!');
            }
            redirect (base_url().'add-brand');
    }
    public function brand_delete()
    {           
        $brand_id = $this->input->post('delete_brand_id');
        $brand_delete = $this->admin_panel_model->brand_delete($brand_id); 
        if($brand_delete)
        {
            $this->session->set_flashdata("brand_delete_s","Brand Deleted Successfully.");
        }
        else
        {
            $this->session->set_flashdata("brand_delete_f","Failed to Delete Brand!");
        }
        redirect(base_url('manage-brand'));       
      
    }
    public function edit_brand()
    {           
        $id = $this->uri->segment(2);
        $this->data['page'] = 'edit_brand';        
        $this->data['brand'] = $brand = $this->admin_panel_model->get_brand_single($id);     
        $this->data['categories'] = $this->admin_panel_model->get_categories();
        $this->data['subcategories'] = $this->admin_panel_model->get_sub_categories($brand['pcatID']);   
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');  
      
    }
    public function update_brand()
    {           
        $brandID = $this->input->post('brandID');    
        $newbrandimg=isset($_FILES['newbrandimg']) && $_FILES["newbrandimg"]["error"] == 0;
        if($newbrandimg)
        {
            $file_name      =   $_FILES['newbrandimg']['name'];

            $file_type      =   $_FILES['newbrandimg']['type'];

            $tmp_name       =   $_FILES['newbrandimg']['tmp_name'];

            $error          =   $_FILES['newbrandimg']['error'];

            $file_size      =   $_FILES['newbrandimg']['size'];

            $file_ext       =   explode('.',$file_name);

            $ext            =   strtolower(end($file_ext));

            $newbrandimg_name        =   'brandlogo-'.uniqid().'.'.$ext;

            $store='uploads/brands/'.$newbrandimg_name;

            if(move_uploaded_file($tmp_name,$store))
            {
                $brandimg = $newbrandimg_name;
            }
            else
            {
                $brandimg = "";
            }
        }
        else
        {
          $brandimg = $this->input->post('oldbrandimg');   
        }  
        $arraybrand = array(
                'pcatID' => $this->input->post('brandcat_id'), 
                'catID' => $this->input->post('brandsubcat_id'),  
                'brand_name' =>  $this->input->post('brandname'),
                'brand_name_ar' =>  $this->input->post('brandname_ar'), 
                'brand_image' => $brandimg
        );
        $update_brand = $this->admin_panel_model->brand_update($brandID,$arraybrand);
        if($update_brand){
             $this->session->set_flashdata('brand_update_s','Brand Updated Sucessfully.');
        }
        else{
             $this->session->set_flashdata('brand_update_f','Failed to Update Brand!');
        }
        redirect (base_url().'edit-brand/'.$brandID);

    }
    public function multiBrand_delete()
    {   
        $ids =  $this->input->post('checkbox_value');
        $delete_brand = $this->admin_panel_model->multiple_delete_brand($ids);     
        if($delete_brand)
        {
            echo json_encode(array('status'=>'true','message'=>"Brands deleted Successfully.",'title'=>'Success.','type'=>'success'));
        }
        else
        {
             echo json_encode(array('status'=>'failed','message'=>"Failed to delete Brands !",'title'=>'Warning!','type'=>'warning'));
        }
    }
}

?>
