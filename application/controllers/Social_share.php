<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class social_share extends CI_Controller {

    function __construct() {
    parent::__construct();
    $this->load->model('dbmodel');
    $this->load->model('dbsetting');
    $this->load->helper('url');
    $this->load->helper(array('form', 'url'));
    $this->load->library("pagination");
    }
    
    public function index() {
        if ($this->session->userdata('logged_in')) {
            $data['username'] = Array($this->session->userdata('logged_in'));
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu', $data);
            $this->load->view('bnw/socialShare/default', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }
  }