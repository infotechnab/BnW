<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class comment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dbmodel');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        //$this->load->library("pagination");
    }



public function addcomment(){
       
    $this->load->view('bnw/templates/footer');
    
    
    
    
    
    
    
    
    
    
    
    }
    
    
}   ?>