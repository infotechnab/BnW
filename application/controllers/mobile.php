<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mobile extends CI_Controller {
 public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('viewmodel');
    }
public function index()
    {
     $data['query'] = $this->viewmodel->get_menu();
        $data['event'] = $this->viewmodel->get_event();
        $data['slider'] = $this->viewmodel->get_slider();
        $data['download'] = $this->viewmodel->get_download();
        
        
        //foreach($data['query'] as $d)
        //{
        //    $id = $d->id;
       // }
        //$data['menu'] = $this->viewmodel->listing($id); 
        $this->load->view('mobile/left',$data);
        
    }
}