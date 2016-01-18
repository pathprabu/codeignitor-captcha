<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {



	
  public function __construct()
  {
    parent::__construct();
    
    /* Load the libraries and helpers */
    $this->load->library('form_validation');
    $this->load->library('Session');
    $this->load->helper(array('form', 'url', 'captcha','string'));
  }
   
   
  /* The default function that gets called when visiting the page */
	public function index()
	{
    
    $userCaptcha = set_value('captcha');
    $this->form_validation->set_rules('name', "Name", 'required');
    $this->form_validation->set_rules('captcha', "Captcha", 'required');
    
  
   

    $word = $this->session->userdata('captchaWord');

 
      
      
      
    /* Check if form (and captcha) passed validation*/
    if ($this->form_validation->run() == TRUE &&
        strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0)
    {
      /** Validation was successful; show the Success view **/
      
      
      /* Clear the session variable */
      $this->session->unset_userdata('captchaWord');
      
      
      /* Get the user's name from the form */
      $name = set_value('name');
    
      /* Pass in the user input to the success view for display */
      $data = array('name' => $name);
      $this->load->view('success-view', $data);


    }
    else 
    {
      
      /** Validation was not successful - Generate a captcha **/
      $rand= random_string('alnum', 4);
      
      
      /* Setup vals to pass into the create_captcha function */
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
      /* Store the captcha value (or 'word') in a session to retrieve later */
      $this->session->set_userdata('captchaWord',$rand);
      
      /* Load the captcha view containing the form (located under the 'views' folder) */
      $this->load->view('captcha-view.php',$k);
    }
		
	}
  
}






