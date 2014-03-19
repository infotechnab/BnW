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
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['headerdescription']= $this->viewmodel->get_header_description();
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
        $this->load->view('menuview/pages',$data);
        $this->load->view('menuview/footer',$data);
        
    }
    
    public function page($id)
    {
        
        $data['pagequery'] = $this->viewmodel->get_page();
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['headerdescription']= $this->viewmodel->get_header_description();
        $data['selectedpagequery'] = $this->viewmodel->get_desired_page($id);
        
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
        $this->load->view('menuview/selectedPage',$data);
        $this->load->view('menuview/footer',$data);  
        
    }
  
}