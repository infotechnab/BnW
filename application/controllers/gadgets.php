<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gadgets extends CI_Controller {

    function __construct() {
    parent::__construct();
    $this->load->model('dbmodel');
    $this->load->model('database_model');
    $this->load->helper('url');
    $this->load->helper(array('form', 'url'));
    $this->load->library("pagination");
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            
              if ($this->session->userdata('logged_in')) {
            $data['username'] = Array($this->session->userdata('logged_in'));
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu', $data);

		//$this->load->view('header',$querydata);
               // $this->load->view('body');
               // $this->load->view('footer');
            $data['gaget']= $this->database_model->get_gaget();
           // var_dump($data);
           $this->load->view('bnw/gadget/gadgetsListing', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }          
	}
        
        
        function addText(){
            if ($this->session->userdata('logged_in')) {
             $this->load->model('database_model');
            $data['gaget']= $this->database_model->get_gaget();
             $data['meta'] = $this->dbmodel->get_meta_data();
            $name = $this->input->post('name_gadget');
            $type = $this->input->post('type_gadget');
            
             $this->database_model->addText($name,$type);
             $this->session->set_flashdata('mess','Data added sucessfully !!! ');
             //redirect('welcome/index',$mess);
             //$mess='added data';
              $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu', $data);
             $this->load->view('bnw/gadget/gadgetsListing',$data);
            $this->load->view('bnw/templates/footer', $data);
             
            } else {
            redirect('login', 'refresh');
        } 
            
        }
       
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */