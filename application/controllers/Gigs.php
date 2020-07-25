<?php

class Gigs extends CI_Controller{

  public function __construct() {

    parent::__construct();

    $this->load->helper('currency');

    $this->data['title']          = 'Gigs';

    $this->data['theme']          = 'user';

    $this->data['module']         = 'gigs';

    $user_id = $this->session->userdata('SESSION_USER_ID');

  }
  public function index()
  {
    redirect(base_url()."admin");
  }
}

?>
