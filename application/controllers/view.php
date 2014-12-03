<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class view extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('viewmodel');
        $this->load->model('dbmodel');
        $this->load->model('contact_model');
        $this->load->model('dbsetting');
        $this->load->model('model1');
         $this->load->library('pagination');
    }

    public function index() {
        $data['meta'] = $this->dbsetting->get_meta_data();

        $data['gadget'] = $this->model1->get_gaget();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $slidequery = $this->viewmodel->get_slider();
        $slider = json_encode($slidequery);
        $data["slider_json"] = $slider;
        $data['contact'] = $this->contact_model->get_contact_form();
        $data["news"] = $this->viewmodel->get_event_news();
        $data["events"] = $this->viewmodel->get_event_events();
        $data['testimonials'] = $this->viewmodel->get_post_for_testimonials();
        $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
        $this->load->view('gardenResort/slide',$data);
        $this->load->view('gardenResort/reservation');
        $this->load->view('gardenResort/services');
         $this->load->view('gardenResort/rooms');
        $this->load->view('gardenResort/mailSubscription');
        $this->load->view('gardenResort/testimonials', $data);
        $this->load->view('gardenResort/slogan');
        $this->load->view('gardenResort/map');
        $this->load->view('gardenResort/footer',$data);
    }

    public function map()
    {
         $this->load->view('gardenResort/map');
    }

    public function maps()
    {
        $this->load->view('gardenResort/map');
    }

    public function reserve()
    {
        $data['meta'] = $this->dbsetting->get_meta_data();

        $data['gadget'] = $this->model1->get_gaget();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $data['contact'] = $this->contact_model->get_contact_form();
        $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
        $this->load->view('gardenResort/reserve');
        $this->load->view('gardenResort/mailSubscription');
        $this->load->view('gardenResort/footer',$data);

    }

    

    public function allevents(){
        $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
            $config = array();
            $config["base_url"] = base_url() . "index.php/view/allevent";
            $config["total_rows"] = $this->viewmodel->count_events();           
            $config["per_page"] = 12;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $data['allevents'] = $this->viewmodel->get_event_for_all_event($config["per_page"], $page);
           $data['contact'] = $this->contact_model->get_contact_form();
            $data["links"] = $this->pagination->create_links();
          $data['gadget'] = $this->model1->get_gaget();    
           $data['headerlogo']= $this->viewmodel->get_header_logo();//for all gadget
              $data['gadget'] = $this->model1->get_gaget();                    //for all gadget
        $data['recentPost']= $this->model1->get_gaget_recentPost(); 
       
         $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
         $this->load->view('gardenResort/events',$data);
         $this->load->view('gardenResort/footer',$data);
    }
    
    public function allnews(){
        $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
          $data['contact'] = $this->contact_model->get_contact_form();
            $config = array();
            $config["base_url"] = base_url() . "index.php/view/allevent";
            $config["total_rows"] = $this->viewmodel->count_events_news();           
            $config["per_page"] = 12;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $data['allevents'] = $this->viewmodel->get_event_for_all_news($config["per_page"], $page);
           $data['contact'] = $this->contact_model->get_contact_form();
            $data["links"] = $this->pagination->create_links();
          $data['gadget'] = $this->model1->get_gaget();    
           $data['headerlogo']= $this->viewmodel->get_header_logo();//for all gadget
              $data['gadget'] = $this->model1->get_gaget();                    //for all gadget
        $data['recentPost']= $this->model1->get_gaget_recentPost(); 
       
         $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
         $this->load->view('gardenResort/news',$data);
         $this->load->view('gardenResort/footer',$data);
    }
    
    public function event($id=null)
    {
         $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $data['singleEvent'] = $this->viewmodel->get_event_by_id($id);
          $data['contact'] = $this->contact_model->get_contact_form();
         $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
         $this->load->view('gardenResort/singleEvent', $data);
        $this->load->view('gardenResort/footer',$data);
    }
     public function news($id=null)
    {
         $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
          $data['contact'] = $this->contact_model->get_contact_form();
        $data['singleNews'] = $this->viewmodel->get_event_by_id_for_news($id);
         $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
         $this->load->view('gardenResort/singleNews', $data);
        $this->load->view('gardenResort/footer',$data);
    }

    public function gallery()
    {
        $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $data['contact'] = $this->contact_model->get_contact_form();
        $data['albumquery'] = $this->viewmodel->get_album();
        $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
        $this->load->view('gardenResort/album',$data);
        $this->load->view('gardenResort/footer',$data);
    }
    
    public function photo($id=null)
    {
        $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $data['contact'] = $this->contact_model->get_contact_form();
        $data['albumName'] = $this->viewmodel->get_album_name_by_id($id);
         $data['selectedalbumquery'] =  $this->viewmodel->get_selected_album($id);
        
         $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
        $this->load->view('gardenResort/photo', $data);
         $this->load->view('gardenResort/footer',$data);
    }
    
    public function contactUs()
    {
        $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $data['contact'] = $this->contact_model->get_contact_form();
         $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
        $this->load->view('gardenResort/contactForm', $data);
         $this->load->view('gardenResort/footer',$data);
    }
    
    public function page($id=NULL)
    {
        $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $data['contact'] = $this->contact_model->get_contact_form();
        $data['selectedpagequery'] = $this->viewmodel->get_desired_page($id);
        
         $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
         $this->load->view('gardenResort/page', $data);
         $this->load->view('gardenResort/footer',$data);
    }

    public function post($id=NULL) {
         $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $data['contact'] = $this->contact_model->get_contact_form();
        $data['selectedpostquery'] = $this->viewmodel->get_desired_post($id);
       

        $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
         $this->load->view('gardenResort/posts', $data);
         $this->load->view('gardenResort/footer',$data);
    }

    

   

  

}
