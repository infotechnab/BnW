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
            $display = $this->input->post('wheretodisplay');
            
            
            $dataa['gadget']= $this->database_model->get_gaget_display($display);
           $this->load->view('bnw/gadget/gadgetsListing', $data,$dataa);
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
             $display  = $this->input->post('wheretodisplay');
        
            
            //$default_template = $this->input->post('display');
            //$updateDisplay = trim($default_template, "/");
            
            //$this->database_model->updateText($updateDisplay);
             $this->database_model->addText($name,$type,$display);
             //$this->session->set_flashdata('mess','Data added sucessfully !!! ');
             redirect('gadgets', 'refresh');
             
            
            } else {
            redirect('login');
        } 
            
        }
        
        
        function updateText(){
            if ($this->session->userdata('logged_in')) {
             $this->load->model('database_model');
            $data['gaget']= $this->database_model->get_gaget();
             $data['meta'] = $this->dbmodel->get_meta_data();
       
             
            $updateDisplay = $this->input->post('display');
            
            
            $gadget_name = $this->input->post('gadget_name');
            $gadget_type = $this->input->post('gadget_type');
            //echo $gadget_name;
            
            $this->database_model->updateText($gadget_name, $gadget_type, $updateDisplay);
             //$this->session->set_flashdata('mess','Data added sucessfully !!! ');
             redirect('gadgets', 'refresh');
             
            
            } else {
            redirect('login', 'refresh');
        } 
            
        }
        
          function hide()
          {
               if ($this->session->userdata('logged_in')) {
             $this->load->model('database_model');
            $data['gaget']= $this->database_model->get_gaget();
             $data['meta'] = $this->dbmodel->get_meta_data();
       
             
            $gadget_hide = $this->input->post('hide');
            $name_hide = $this->input->post('name_hide');
            $this->database_model->hide($gadget_hide, $name_hide);
             //$this->session->set_flashdata('mess','Data added sucessfully !!! ');
            
            redirect('gadgets', 'refresh');
             
            
            } else {
            redirect('login', 'refresh');
        } 
          }  
        
               function delete()
          {
               if ($this->session->userdata('logged_in')) {
             $this->load->model('database_model');
            $data['gaget']= $this->database_model->get_gaget();
             $data['meta'] = $this->dbmodel->get_meta_data();
            
             $name_hide = $this->input->post('name_hide');
            $gadget_delete = $this->input->post('delete');
            $this->database_model->delete($gadget_delete, $name_hide);
             
            
            redirect('gadgets', 'refresh');
             
            
            } else {
            redirect('login', 'refresh');
        } 
          }
        
}