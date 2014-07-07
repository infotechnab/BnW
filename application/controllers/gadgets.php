<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gadgets extends CI_Controller {

    function __construct() {
    parent::__construct();
    $this->load->model('dbmodel');
    $this->load->model('model1');
    $this->load->model('dbsetting');
    $this->load->helper('url');
    $this->load->helper(array('form', 'url'));
    $this->load->library("pagination");
    }
	
	public function index()
	{
            
              if ($this->session->userdata('logged_in')) {
            $data['username'] = Array($this->session->userdata('logged_in'));
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu', $data);

            $data['gaget']= $this->model1->get_gaget();
            $display = $this->input->post('wheretodisplay');
            
            
            $dataa['gadget']= $this->model1->get_gaget_display($display);
           $this->load->view('bnw/gadget/gadgetsListing', $data,$dataa);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }          
	}
        
        
        function addText(){
            if ($this->session->userdata('logged_in')) {
             $this->load->model('model1');
            $data['gaget']= $this->model1->get_gaget();
             $data['meta'] = $this->dbsetting->get_meta_data();
            $name = $this->input->post('name_gadget');
            $type = $this->input->post('type_gadget');
             $display  = $this->input->post('wheretodisplay');
             $textBox  = $this->input->post('textBox');
            
             $this->model1->addText($name,$textBox,$type,$display);
            
             redirect('gadgets', 'refresh');
             
            
            } else {
            redirect('login');
        } 
            
        }
        
        
        function updateText(){
            if ($this->session->userdata('logged_in')) {
             $this->load->model('model1');
            $data['gaget']= $this->model1->get_gaget();
             $data['meta'] = $this->dbsetting->get_meta_data();
       
             
            $updateDisplay = $this->input->post('display');
            
            
            $gadget_name = $this->input->post('gadget_name');
            $gadget_type = $this->input->post('gadget_type');
           
            
            $this->model1->updateText($gadget_name, $gadget_type, $updateDisplay);
            
             redirect('gadgets', 'refresh');
             
            
            } else {
            redirect('login', 'refresh');
        } 
            
        }
        
        
               function delete()
          {
               if ($this->session->userdata('logged_in')) {
             $this->load->model('model1');
            $data['gaget']= $this->model1->get_gaget();
             $data['meta'] = $this->dbsetting->get_meta_data();
            
             $name_hide = $this->input->post('name_hide');
            $gadget_delete = $this->input->post('display');
            $this->model1->delete($gadget_delete, $name_hide);
           redirect('gadgets', 'refresh');
            } else {
            redirect('login', 'refresh');
        } 
          }
          
          function defaultGadget()      //inserting value from default gadget.
          {
               if ($this->session->userdata('logged_in')) {
             $this->load->model('model1');
            $data['gaget']= $this->model1->get_gaget();
             $data['meta'] = $this->dbsetting->get_meta_data();
            
            $name_title = $this->input->post('name_gadget');
            $recentPost = $this->input->post('recentPost_gadget');
            $display_recentPost  = $this->input->post('wheretodisplay');
            $NoOfPost = $this->input->post('noOfPost');
            $titleBold = $this->input->post('titleBold');
            $titleUnderline = $this->input->post('titleUnderline');
             $titleColor = $this->input->post('titleColor');
            $arr = "post=$NoOfPost&titleBold=$titleBold&titleUnderline=$titleUnderline&titleColor=$titleColor";
            $this->model1->defaultGadget($name_title,$recentPost,$display_recentPost,$arr);
           redirect('gadgets', 'refresh');
            } else {
            redirect('login', 'refresh');
          }
          }
          
          
          function defaultGadgetUpdate()
          {
               if ($this->session->userdata('logged_in')) {
             $this->load->model('model1');
            $data['gaget']= $this->model1->get_gaget();
             $data['meta'] = $this->dbsetting->get_meta_data();
            
            $name_title = $this->input->post('name_gadget');
            $recentPost = $this->input->post('recentPost_gadget');
            
            $NoOfPost = $this->input->post('noOfPost');
            $titleBold = $this->input->post('titleBold');
            $titleUnderline = $this->input->post('titleUnderline');
             $titleColor = $this->input->post('titleColor');
              $gadget_update = $this->input->post('display');
             
            $arr = "post=$NoOfPost&titleBold=$titleBold&titleUnderline=$titleUnderline&titleColor=$titleColor";
            $this->model1->defaultGadgetUpdate($name_title,$recentPost,$arr,$gadget_update);
           redirect('gadgets', 'refresh');
            } else {
            redirect('login', 'refresh');
          } 
          }
          
          function textBoxUpdate()
          {
               if ($this->session->userdata('logged_in')) {
             $this->load->model('model1');
            $data['gaget']= $this->model1->get_gaget();
             $data['meta'] = $this->dbsetting->get_meta_data();
            
            $name_title = $this->input->post('name_gadget');
            $type = $this->input->post('type');
           
            $gadget_update = $this->input->post('display');
           
            $this->model1->textBoxUpdate($name_title,$type,$gadget_update);
           redirect('gadgets', 'refresh');
            } else {
            redirect('login', 'refresh');
          } 
          }
}