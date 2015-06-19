<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class View extends CI_Controller {

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
        $data['latestPage'] = $this->viewmodel->get_latest_page();
        $data['latestPost'] = $this->viewmodel->get_latest_post();
        $data['latestNews'] = $this->viewmodel->get_event_news();
        $data['latestEvents'] = $this->viewmodel->get_event_events();
        $this->load->view('default/template/header', $data);
        
         $this->load->view('default/template/slider', $data);
         $this->load->view('default/template/latestPage', $data);
         $this->load->view('default/template/latestPost', $data);
          $this->load->view('default/template/latestNews', $data);
          $this->load->view('default/template/gadgets', $data);
          $this->load->view('default/template/footer', $data);
    }
    

    public function allevents(){
        $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
            $config = array();
            $config["base_url"] = base_url() . "view/allevent";
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
       $class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push('Home', '/');
$this->breadcrumbs->push($method, '/'.$class.'/'.$method);
//$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show();
$data['pageTitle'] = 'Events';
        $this->load->view('default/template/header', $data);
         $this->load->view('default/template/breadcrumbLink', $data);
         $this->load->view('default/template/events',$data);
         $this->load->view('default/template/footer',$data);
    }
    
    public function allnews(){
        $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
          $data['contact'] = $this->contact_model->get_contact_form();
            $config = array();
            $config["base_url"] = base_url() . "view/allevent";
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
    $class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push('Home', '/');
$this->breadcrumbs->push($method, '/'.$class.'/'.$method);
//$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show();
$data['pageTitle'] = 'News';
        $this->load->view('default/template/header', $data);
         $this->load->view('default/template/breadcrumbLink', $data);
         $this->load->view('default/template/news',$data);
         $this->load->view('default/template/footer',$data);
    }
    
    public function event($id=null)
    {
         $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $data['singleEvent'] = $this->viewmodel->get_event_by_id($id);
          $data['contact'] = $this->contact_model->get_contact_form();
          if(!empty($data['singleEvent'])){
          foreach ($data['singleEvent'] as $news){
            $title = $news->title;
          }}
         else{
             $title = "";
         }
        
$class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push('Home', '/');
$this->breadcrumbs->push($method, '/'.$class.'/allevents');
$this->breadcrumbs->push($title, '/'.$class.'/'.$method.'/'.$title);
//$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show();

         $data['pageTitle'] = $title;

        $this->load->view('default/template/header', $data);
         $this->load->view('default/template/breadcrumbLink', $data);
         $this->load->view('default/template/singleEvent',$data);
         $this->load->view('default/template/footer',$data);
    }
     public function news($id=null)
    {
         $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
          $data['contact'] = $this->contact_model->get_contact_form();
        $data['singleNews'] = $this->viewmodel->get_event_by_id_for_news($id);
        if(!empty($data['singleEvent'])){
          foreach ($data['singleNews'] as $news){
            $title = $news->title;
          }}
            else{
             $title = "";
         }
        
$class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push('Home', '/');
$this->breadcrumbs->push($method, '/'.$class.'/allnews');
$this->breadcrumbs->push($title, '/'.$class.'/'.$method.'/'.$title);
//$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show();
       
         $data['pageTitle'] = $title;

        $this->load->view('default/template/header', $data);
         $this->load->view('default/template/breadcrumbLink', $data);
         $this->load->view('default/template/singleNews',$data);
         $this->load->view('default/template/footer',$data);
    }

    public function gallery()
    {
        $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $data['contact'] = $this->contact_model->get_contact_form();
        $data['albumquery'] = $this->viewmodel->get_album();
         $class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push('Home', '/');
$this->breadcrumbs->push($method, '/'.$class.'/'.$method);
//$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show();
       $data['pageTitle'] = "Gallery";
        $this->load->view('default/template/header', $data);
         $this->load->view('default/template/breadcrumbLink', $data);
         $this->load->view('default/template/album',$data);
         $this->load->view('default/template/footer',$data);
    }
    
    public function photo($id=null)
    {
        $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $data['contact'] = $this->contact_model->get_contact_form();
        $data['albumName'] = $this->viewmodel->get_album_name_by_id($id);
         $data['selectedalbumquery'] =  $this->viewmodel->get_selected_album($id);
         if(!empty($data['albumName'])){
         foreach ($data['albumName'] as $galls){
             $title= $galls->album_name;
         }}else{
             $title = "";
         }
       $class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push('Home', '/');
$this->breadcrumbs->push($method, '/'.$class.'/gallery');
$this->breadcrumbs->push($title, '/'.$class.'/'.$method.'/'.$title);
//$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show();
$data['pageTitle'] = $title;
        $this->load->view('default/template/header', $data);
         $this->load->view('default/template/breadcrumbLink', $data);
         $this->load->view('default/template/photo',$data);
         $this->load->view('default/template/footer',$data);
    }
    
    public function contactUs()
    {
        $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $data['contact'] = $this->contact_model->get_contact_form();
         $class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push('Home', '/');
$this->breadcrumbs->push($method, '/'.$class.'/'.$method);
//$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show();
         $data['pageTitle'] = "Contact Us";
          $this->load->library('captcha');
$data['captcha'] = $this->captcha->main();
$this->session->set_userdata('captcha_info', $data['captcha']);
        $this->load->view('default/template/header', $data);
         $this->load->view('default/template/breadcrumbLink', $data);
         $this->load->view('default/template/contactForm',$data);
         $this->load->view('default/template/footer',$data);
    }
    
    public function page($id=NULL)
    {
        $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $data['contact'] = $this->contact_model->get_contact_form();
        $data['selectedpagequery'] = $this->viewmodel->get_desired_page($id);
        if(!empty($data['selectedpagequery'])){
        foreach ($data['selectedpagequery'] as $name){
            $title = $name->page_name;
        }}
        else{
            $title = "";
        }
        $class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push('Home', '/');
$this->breadcrumbs->push($method, '/'.$class.'/index');
$this->breadcrumbs->push($title, '/'.$class.'/'.$method.'/'.$title);
//$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show(); 
        $data['pageTitle'] = $title;
        $this->load->view('default/template/header', $data);
         $this->load->view('default/template/breadcrumbLink', $data);
         $this->load->view('default/template/page',$data);
         $this->load->view('default/template/footer',$data);
    }

    public function post($id=NULL) {
         $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $data['contact'] = $this->contact_model->get_contact_form();
        $data['selectedpostquery'] = $this->viewmodel->get_desired_post($id);
        if(!empty($data['selectedpostquery'])){
        foreach ($data['selectedpostquery'] as $name){
            $title = $name->post_title;
        }}
        else{
            $title = "";
        }
       
$class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push('Home', '/');
$this->breadcrumbs->push($method, '/'.$class.'/index');
$this->breadcrumbs->push($title, '/'.$class.'/'.$method.'/'.$title);
//$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show(); 
          $data['pageTitle'] = $title;
        $this->load->view('default/template/header', $data);
         $this->load->view('default/template/breadcrumbLink', $data);
         $this->load->view('default/template/posts',$data);
         $this->load->view('default/template/footer',$data);
    }

    

   

  

}
