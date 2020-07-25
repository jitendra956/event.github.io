<?php
class Reviews extends CI_Controller{
    public function __construct(){    
    parent::__construct();
    error_reporting(0);
    $this->data['theme'] = 'admin';
    $this->data['module'] = 'reviews';
    $this->load->model('admin_panel_model');    
}
    public function index()
	{         	
        $this->data['page'] = 'index';
        $this->data['reviews'] = $this->admin_panel_model->get_reviews();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
	}
    public function review_delete()
    {           
        $id = $this->input->post('delete_review_id');
        $delete_review = $this->admin_panel_model->delete_review($id); 
        if($delete_review)
        {
            $this->session->set_flashdata("review_delete_s","Review Deleted Successfully.");
        }
        else
        {
            $this->session->set_flashdata("review_delete_f","Failed to Delete Review!");
        }
        redirect(base_url('reviews'));
    }

    public function change_reviews_status()
    {        
        $reviewid = $this->input->post('reviewid');   
        $review = $this->admin_panel_model->get_single_review($reviewid);
        if($review)
        {
            if($review["review_status"] == 0){
                $status = 1;
            }
            else{
                $status = 0;
            }
            $reviewArray = array('review_status' => $status);
            $review_update = $this->admin_panel_model->update_review($reviewid,$reviewArray);
            if($review_update)
            {
                echo json_encode(array('status'=>'true','message'=>'Review status Changed.','title'=>'Success.','type'=>'success'));
            }
            else
            {
                echo json_encode(array('status'=>'failed','message'=>'Review status can not be Changed!','title'=>'Warning!','type'=>'warning'));
            }

        }
        else
        {
            echo json_encode(array('status'=>'failed','message'=>'Failed to change Review status!','title'=>'Failed!.','type'=>'danger'));
        }
    }
   
}

?>
