<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class view extends CI_Controller {
 public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('viewmodel');
    }
public function index()
    {
        
        $data['query'] = $this->viewmodel->get_page();
        
        $this->load->view('menuview/header',$data);
        
        
        
    }
  
}