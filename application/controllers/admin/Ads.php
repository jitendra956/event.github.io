<?php
class Ads extends CI_Controller{
    public function __construct(){    
    parent::__construct();
    error_reporting(0);
    $this->data['theme'] = 'admin';
    $this->data['module'] = 'ads';
    $this->load->model('admin_panel_model');    
}
    public function index()
	{         	
        $this->data['page'] = 'all_ads_list';
        $this->data['ads'] = $this->admin_panel_model->get_all_products();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
	}
    public function active_ads()
    {           
        $this->data['page'] = 'active_ads';
        $this->data['ads'] = $this->admin_panel_model->get_active_products();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
    }
    public function features_ads()
    {           
        $this->data['page'] = 'features_ads';
        $this->data['ads'] = $this->admin_panel_model->get_features_products();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
    }
    public function pending_ads()
    {           
        $this->data['page'] = 'pending_ads';
        $this->data['ads'] = $this->admin_panel_model->get_pending_products();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
    }
    // public function hidden_ads()
    // {           
    //     $this->data['page'] = 'hidden_ads';
    //     $this->data['ads'] = $this->admin_panel_model->get_products();        
    //     $this->load->vars($this->data);
    //     $this->load->view($this->data['theme'].'/template');
      
    // }
    public function resubmitted_ads()
    {           
        $this->data['page'] = 'resubmitted_ads';
        $this->data['ads'] = $this->admin_panel_model->get_resubmitted_products();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
    }
    public function expire_ads()
    {           
        $this->data['page'] = 'expire_ads';
        $this->data['ads'] = $this->admin_panel_model->get_expire_products();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
    }
    public function approve_add()
    {           
        $productid = $this->input->post('productid');   
        $product = $this->admin_panel_model->get_single_products($productid);
        if($product)
        {
            if($product["product_status"] == 0){
                $status = 1;
            }
            else{
                $status = 0;
                $notificationsArray = array(
                    'userID' => $product['userID'], 
                    'notification_fromID' => $product['userID'],
                    'notification' => 'Your ad is now active.', 
                    'notification_ar' => 'إعلانك نشط الآن.', 
                    'notification_for_productID' => $product['PRODUCTID'], 
                    'notification_date' => date("d M Y"), 
                    'notification_time' => date("H:i"),
                    'notification_date_time' => date("Y-m-d H:i:s A")
                );
                $this->admin_panel_model->insert_notifications($notificationsArray);
            }
            $productArray = array('product_status' => $status);
            $product_update = $this->admin_panel_model->update_products($productid,$productArray);
            if($product_update)
            {
                echo json_encode(array('status'=>'true','message'=>"Ad's Verify status Changed.",'title'=>'Success.','type'=>'success'));
            }
            else
            {
                echo json_encode(array('status'=>'failed','message'=>"Ad's Verify status can not be Changed!",'title'=>'Warning!','type'=>'warning'));
            }

        }
        else
        {
            echo json_encode(array('status'=>'failed','message'=>"Failed to change Ad's Verify status!",'title'=>'Failed!.','type'=>'danger'));
        }     
    }
    public function set_product_features()
    {           
        $productid = $this->input->post('productid');   
        $product = $this->admin_panel_model->get_single_products($productid);
        if($product)
        {
            if($product["product_features"] == 0){
                $product_features = 1;
            }
            else{
                $product_features = 0;
            }
            $productArray = array('product_features' => $product_features);
            $product_update = $this->admin_panel_model->update_products($productid,$productArray);
            if($product_update)
            {
                echo json_encode(array('status'=>'true','message'=>"Ad's Features status Changed.",'title'=>'Success.','type'=>'success'));
            }
            else
            {
                echo json_encode(array('status'=>'failed','message'=>"Ad's Features status can not be Changed!",'title'=>'Warning!','type'=>'warning'));
            }

        }
        else
        {
            echo json_encode(array('status'=>'failed','message'=>"Failed to change Ad's Features status!",'title'=>'Failed!.','type'=>'danger'));
        }     
    }

    public function ads_delete()
    {        
        $productid = $this->input->post('delete_product_id');  
        $redirect = $this->input->post('redirect');  
        $delete_product = $this->admin_panel_model->delete_product($productid); 
        // $this->db->close();
        if($delete_product)
        {
            $this->session->set_flashdata("product_delete_s","Ad Deleted Successfully.");
        }
        else
        {
            $this->session->set_flashdata("product_delete_f","Failed to Delete Ad!");
        }
        redirect(base_url($redirect));
    }
    public function edit_ads()
    {        
        $productid = $this->uri->segment(2);
        $this->data['page'] = 'edit_ad';   
        $this->data['product'] = $product = $this->admin_panel_model->get_single_products($productid);
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
    }
    public function update_ad()
    {        
        $productid = $this->input->post('porductID');  
        $productArray = array(
            'product_title' => $this->input->post('product_title'), 
            'product_description' => $this->input->post('product_description'), 
            'product_duration' => $this->input->post('product_duration'), 
            'product_price' => $this->input->post('product_price'), 
        );
        $update_ad = $this->admin_panel_model->update_products($productid,$productArray); 
        if($update_ad)
        {
            $this->session->set_flashdata("ad_update_s","Ad Updated Successfully.");
        }
        else
        {
            $this->session->set_flashdata("ad_update_f","Failed to Update Ad!");
        }
        redirect(base_url('edit-ads/'.$productid));
    }
    public function reported_ads()
    {        
        $this->data['page'] = 'reported_ads';
        $this->data['reports'] = $this->admin_panel_model->get_reported_ads();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
    }
    public function multiads_delete()
    {   
        $ids =  $this->input->post('checkbox_value');
        $delete_ads = $this->admin_panel_model->multiple_delete_ads($ids);     
        if($delete_ads)
        {
            echo json_encode(array('status'=>'true','message'=>"Ad's deleted Successfully.",'title'=>'Success.','type'=>'success'));
        }
        else
        {
             echo json_encode(array('status'=>'failed','message'=>"Failed to delete Ad's !",'title'=>'Warning!','type'=>'warning'));
        }
    }
   
}

?>
