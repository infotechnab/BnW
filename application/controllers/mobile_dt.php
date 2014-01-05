<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mobile_dt extends CI_Controller {
 public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('viewmodel');
    }
public function index()
    {
        
        $ismobile =  preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
        
 // If the user is on a mobile device, redirect them
if($ismobile)
{
   redirect('mobile/index');
}
 else {
    redirect('view/index');
    
    }        
    }
}


