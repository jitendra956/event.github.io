<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Twilio_api extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		$this->load->library('twilio');
		$from = '+12162796694';
		$to = '+918962334644';
		$message = 'Preferred Client Tranjection OTP is '.rand(11111,99999);
		$response = $this->twilio->sms($from, $to, $message);
		if($response->IsError)
			echo 'Error: ' . $response->ErrorMessage;
		else
			echo 'Sent message to ' . $to;
	}
}