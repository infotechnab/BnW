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
        
        $data['query'] = $this->viewmodel->get_menu();
        
        
        //foreach($data['query'] as $d)
        //{
        //    $id = $d->id;
       // }
        //$data['menu'] = $this->viewmodel->listing($id); 
        $this->load->view('menuview/index',$data);
        
    }
}