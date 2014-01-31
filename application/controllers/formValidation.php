<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class formValidation extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dbmodel');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index() {


        $this->load->view('form');
    }

    function validation() {
        $this->form_validation->set_rules('username', 'User Name', 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|max_length[200]');
        if (($this->form_validation->run() == TRUE)) {
            echo "Form Submited";
        } else {
            $data['errorMessage'] = "Problem with form";
            $this->load->view('form', $data);
        }
    }

}

?>