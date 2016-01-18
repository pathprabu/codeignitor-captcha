<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {



	
  public function __construct()
  {
    parent::__construct();
    
 
    $this->load->library('form_validation');
    $this->load->library('Session');
    $this->load->helper(array('form', 'url', 'captcha','string'));
  }
   
   

	public function index()
	{
    
    $userCaptcha = set_value('captcha');
    $this->form_validation->set_rules('name', "Name", 'required');
    $this->form_validation->set_rules('captcha', "Captcha", 'required');
    
  
   

    $word = $this->session->userdata('captchaWord');

 
      
      
      
  
    if ($this->form_validation->run() == TRUE &&
        strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0)
    {
    
      
      
   
      $this->session->unset_userdata('captchaWord');
      
      
    
      $name = set_value('name');
    
     
      $data = array('name' => $name);
      $this->load->view('success-view', $data);


    }
    else 
    {
      
 
      $rand= random_string('alnum', 4);
      
      
     
    $vals = array(
    'word'	=> $rand,
    'img_path'	=> './cap/',
    'img_url'	=> 'http://localhost/ci/cap',
    'font_path'	=> 'fonts/texb.ttf',
    'img_width'	=> '190',
    'img_height' => 60,
    'expiration' => 7200
    );
    





$cap1 = create_captcha($vals);
      
      $k=array('cap'=>$cap1);
     
      $this->session->set_userdata('captchaWord',$rand);
      
   
      $this->load->view('captcha-view.php',$k);
    }
		
	}
  
}






