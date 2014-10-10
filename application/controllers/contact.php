<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Contact extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('dbmodel');
        $this->load->model('dbdashboard');
        $this->load->model('dbsetting');
        $this->load->model('dbuser');
        $this->load->model('dbalbum');
        $this->load->model('contact_model');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
    }
    public function index() {
        $url = current_url();
          if ($this->session->userdata('admin_logged_in')) {  
         $data['meta'] = $this->dbsetting->get_meta_data();
         $data['contact'] = $this->contact_model->get_contact_form();
          $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('bnw/contact/contactForm', $data);            
             $this->load->view('bnw/templates/footer', $data);   
             } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
          } 
    
    public function addContact()
    {
       if ($this->session->userdata('admin_logged_in')) {  
           $data['meta'] = $this->dbsetting->get_meta_data();
            $data['contact'] = $this->contact_model->get_contact_form();
                $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('title', 'Organization Name', 'trim|regex_match[/^[a-z,0-9,A-Z_\-. ]{5,100}$/]|required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('street', 'Street', 'trim|regex_match[/^[a-z,0-9,A-Z_\-. ]{5,100}$/]|required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('city', 'City', 'trim|regex_match[/^[a-z,0-9,A-Z_\-. ]{5,50}$/]|required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('district', 'District', 'trim|regex_match[/^[a-z,0-9,A-Z_\-. ]{5,50}$/]|required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('country', 'Country', 'trim|regex_match[/^[a-z,0-9,A-Z_\-. ]{5,35}$/]|required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('contact1', 'Contact1', 'trim|regex_match[/^[0-9_\-. +]{5,15}$/]|required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('email', 'Email', 'trim|regex_match[/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/]|required|xss_clean|max_length[200]');
            if ($this->form_validation->run() == FALSE) {
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('bnw/contact/contactForm', $data);            
             $this->load->view('bnw/templates/footer', $data);
            } else {
                $name = $this->input->post('title');
                $street = $this->input->post('street');
                $city = $this->input->post('city');
                $district = $this->input->post('district');
                $country = $this->input->post('country');
                $contact1 = $this->input->post('contact1');
                $contact2 = $this->input->post('contact2');
                $email = $this->input->post('email');
                $showForm = $this->input->post('showForm');
                $showMap = $this->input->post('showMap');
                $this->contact_model->add_contact_form($name, $street, $city, $district, $country, $contact1, $contact2, $email, $showForm, $showMap);
                $this->session->set_flashdata('message', 'Contact Address updated sucessfully');
                redirect('contact/index');
            }
    } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
            
       }
    
       public function updateContact()
       {
            if ($this->session->userdata('admin_logged_in')) {  
           $data['meta'] = $this->dbsetting->get_meta_data();
           $data['contact'] = $this->contact_model->get_contact_form();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('bnw/contact/contactForm', $data);            
             $this->load->view('bnw/templates/footer', $data);
            } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
       }
    
    
    
    
    
}