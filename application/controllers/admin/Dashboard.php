<?php
class Dashboard extends CI_Controller{
    public function __construct(){    
    parent::__construct();
    error_reporting(0);
    $this->data['theme'] = 'admin';
    $this->data['module'] = 'dashboard';
    $this->load->model('admin_panel_model');    
}
    public function index()
	{         	
        $this->data['page'] = 'index';
        $this->data['total_ads'] = $this->admin_panel_model->get_all_products();  
        $this->data['active_ads'] = $this->admin_panel_model->get_active_products();     
        $this->data['pending_ads'] = $this->admin_panel_model->get_pending_products(); 
        $this->data['expired_ads'] = $this->admin_panel_model->get_expire_products();
        $this->data['users'] = $this->admin_panel_model->get_users();
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
	}
   
}

?>
