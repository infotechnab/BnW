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
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
    }
    public function index() {
          if ($this->session->userdata('admin_logged_in')) {  
         $data['meta'] = $this->dbsetting->get_meta_data();
          $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('bnw/contact/contactForm');            
             $this->load->view('bnw/templates/footer', $data);   
             } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
          } 
    
    public function addContact()
    {
       if ($this->session->userdata('admin_logged_in')) {  
           $data['meta'] = $this->dbsetting->get_meta_data();
                $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('title', 'Organization Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('street', 'Street', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('city', 'City', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('district', 'District', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('country', 'Country', 'required|xss_clean|md5|max_length[200]');
            $this->form_validation->set_rules('contact1', 'Contact1', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|max_length[200]');
            if ($this->form_validation->run() == FALSE) {
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('bnw/contact/contactForm');            
             $this->load->view('bnw/templates/footer', $data);
            } else {
                $name = $this->input->post('user_name');
                $fname = $this->input->post('user_fname');
                $lname = $this->input->post('user_lname');
                $email = $this->input->post('user_email');
                $pass = $this->input->post('user_pass');
                $status = $this->input->post('user_status');
                $user_type = $this->input->post('user_type');
                $contact = $this->input->post('phone');
                $address = $this->input->post('address');
                $this->dbuser->add_new_user($name, $fname, $lname, $email, $pass, $status, $user_type, $contact, $address);
                $this->session->set_flashdata('message', 'One user added sucessfully');
                redirect('user/users');
            }
    } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
            
       }
    
    
    
    
    
    
    
}