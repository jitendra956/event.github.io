<?php
class Terms extends CI_Controller{
    public function __construct(){    
    parent::__construct();
    error_reporting(0);
    $this->data['theme'] = 'admin';
    $this->data['module'] = 'terms';
    $this->load->model('admin_panel_model');    
}
    public function index()
	{         	
        $this->data['page'] = 'index';
        $this->data['terms'] = $this->admin_panel_model->get_terms();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
	}
    public function add_term()
    {           
        $this->data['page'] = 'add_term';
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
    public function insert_term()
    {           
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
       $insert = $this->db->insert('terms_services',$termArray);
       if($insert)
       {
            $this->session->set_flashdata('term_add_s','Term Added Sucessfully.');
       }
       else
       {
            $this->session->set_flashdata('term_add_f','Failed to Add Term.');
       }
       redirect(base_url().'terms');
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
    public function term_delete()
    {           
        $id = $this->input->post('delete_term_id');
        $delete_term = $this->admin_panel_model->delete_term($id); 
        if($delete_term)
        {
            $this->session->set_flashdata("term_delete_s","Term Deleted Successfully.");
        }
        else
        {
            $this->session->set_flashdata("term_delete_f","Failed to Delete Term!");
        }
        redirect(base_url('terms'));
    }

    public function change_term_status()
    {        
        $termid = $this->input->post('termid');   
        $term = $this->admin_panel_model->get_single_term($termid);
        if($term)
        {
            if($term["term_status"] == 0){
                $status = 1;
            }
            else{
                $status = 0;
            }
            $termArray = array('term_status' => $status);
            $term_update = $this->admin_panel_model->update_term($termid,$termArray);
            if($term_update)
            {
                echo json_encode(array('status'=>'true','message'=>'Term status Changed.','title'=>'Success.','type'=>'success'));
            }
            else
            {
                echo json_encode(array('status'=>'failed','message'=>'Term status can not be Changed!','title'=>'Warning!','type'=>'warning'));
            }

        }
        else
        {
            echo json_encode(array('status'=>'failed','message'=>'Failed to change Term status!','title'=>'Failed!.','type'=>'danger'));
        }
    }
   
}

?>
