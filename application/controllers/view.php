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
        
        $data['pagequery'] = $this->viewmodel->get_page();
        $data['slidequery'] = $this->viewmodel->get_slider();
        
        $this->load->view('menuview/header',$data);
        
        
        
    }
  
}