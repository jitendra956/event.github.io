<?php
class Chat extends CI_Controller{
    public function __construct(){    
    parent::__construct();
    error_reporting(0);
    $this->data['theme'] = 'admin';
    $this->data['module'] = 'chat';
    $this->load->model('admin_panel_model');    
}
    public function index()
	{         	
        $this->data['page'] = 'index';
        $this->data['chats'] = $this->admin_panel_model->get_chats();        
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
      
	}
    public function get_chat()
    {           
        $by = $this->input->post('by');
        $to = $this->input->post('to');
        $of=$by."','".$to;
        $chats = $this->db->query("SELECT * FROM chat_message WHERE send_by IN('".$of."') and send_to IN('".$of."') ORDER BY `chat_message`.`date_time` ASC")->result_array();
        $send_by_user = $chats[0]['send_by'];
        $send_to_user = $chats[0]['send_to'];
        $userby = $this->admin_panel_model->get_single_users($send_by_user);  
        $userto = $this->admin_panel_model->get_single_users($send_to_user);  
        $chat_data = '';      
        $chat_data .= '<div class="chat-header clearfix">';
        if($userby['user_photo']){ $byphoto = base_url().'uploads/users/'.$userby['user_photo']; } else { $byphoto =  base_url().'/assets/images/users/avatar-1.jpg'; }
        $chat_data .= '<img src="'.$byphoto.'" alt="avatar" />
        
        <div class="chat-about">
          <div class="chat-with">'.$userby['full_name'].'</div>
          <div class="chat-with">'.$userby['email'].'</div>
        </div>
      </div>';
      $chat_data .= '<div class="chat-header clearfix">';
      if($userto['user_photo']){ $tophoto = base_url().'uploads/users/'.$userto['user_photo']; } else { $tophoto =  base_url().'/assets/images/users/avatar-1.jpg'; }
        $chat_data .= '<img src="'.$tophoto.'" alt="avatar"/>
        
        <div class="chat-about">
          <div class="chat-with">'.$userto['full_name'].'</div>
          <div class="chat-with">'.$userto['email'].'</div>
        </div>
      </div>
      
      <div class="chat-history">
        <ul>';
        foreach ($chats as $chat) {
            if($chat['send_by'] == $send_by_user)
            {
                $chat_data .= '<li class="clearfix">
                <div class="message-data align-right">
                  <span class="message-data-time" >'.$chat['chat_time'].', '.$chat['chat_date'].'</span> &nbsp; &nbsp;
                  <span class="message-data-name" >'.$userby['full_name'].'</span> <i class="fa fa-circle me"></i>
                  
                </div>
                <div class="message other-message float-right">
                  '.$chat['message'].'
                </div>
              </li>';
            }
            else
            {
                $chat_data .= '<li>
                <div class="message-data">
                  <span class="message-data-name"><i class="fa fa-circle online"></i> '.$userto['full_name'].'</span>
                  <span class="message-data-time">'.$chat['chat_time'].', '.$chat['chat_date'].'
                </div>
                <div class="message my-message">
                  '.$chat['message'].'
                </div>
              </li>';
            }          
          

        }
                  
         
       $chat_data .= '</ul>
        
      </div>';

    echo json_encode(array('chat' => $chat_data));
      
    }
    
   
}

?>
