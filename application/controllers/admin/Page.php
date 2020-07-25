<?php
class Page extends CI_Controller{
    public function __construct(){    
    parent::__construct();
    error_reporting(0);
    $this->data['theme'] = 'admin';
    $this->data['module'] = 'page';
    $this->load->library('email');
    $this->load->model('admin_panel_model');
    $settings = $this->admin_panel_model->get_settings();
    $config = array(
                'protocol'  => $settings['smtp_protocol'],
                'smtp_host' => $settings['smtp_host'],
                'smtp_crypto' => $settings['smtp_crypto'],
                'smtp_port' => $settings['smtp_port'],
                'smtpdebug' => 4,
                'smtp_user' => $settings['smtp_username'],
                'smtp_pass' => $settings['smtp_password'],
                'mailtype'  => 'html',
                'charset'   => 'utf-8',
                'priority'  => 1,
            );
    $this->email->initialize($config);
    $this->email->set_mailtype("html");
    $this->email->set_newline("\r\n");    
}
    public function privacy_policy()
	{         	
		$settings = $this->admin_panel_model->get_settings();
        // $this->data['page'] = 'index';
        $this->data['terms'] = $this->admin_panel_model->get_terms();        
        $this->data['privacy_policy'] = $settings['privacy_policy'];        
        // $this->load->vars($this->data);
        // $this->load->view($this->data['theme'].'/template');
        $this->load->view('admin/modules/page/privacy_policy',$this->data);
      
	}
    public function contact()
    {           
        $this->load->view('admin/modules/page/contact');
    }
    // public function support ()
    // {           
    //     $this->load->view('admin/modules/page/support');
    // }
    public function submit_contact()
    {     
        $settings = $this->admin_panel_model->get_settings();
        $mail_message = $this->input->post('name').'<br>'.$this->input->post('lastname').'<br>'.$this->input->post('email').'<br>'.$this->input->post('subject').'<br>'.$this->input->post('message');
        $this->email->to($this->input->post('email'));
        $this->email->from($settings['smtp_username'], $settings['site_name']);
        $this->email->subject($this->input->post('subject'));
        $this->email->message($mail_message);
        // $this->email->send();
        if($this->email->send())
        {
           echo json_encode(array("type" => "success","message" => "Sucess , We will reach you soon."));
        }
        else
        {
            // echo $this->email->print_debugger();
            echo json_encode(array("type" => "warning","message" => "Something went wrong!, Please try after Sometime."));
        }
    }
   
}

?>
