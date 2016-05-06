<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class demo extends CI_Controller {
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
public function index()
    {
        $data['meta'] = $this->dbsetting->get_meta_data();

        $data['gadget'] = $this->model1->get_gaget();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $slidequery = $this->viewmodel->get_slider();
        $slider = json_encode($slidequery);
        $data["slider_json"] = $slider;
        $data['contact'] = $this->contact_model->get_contact_form();
        
        
        $this->load->view('template/topHead', $data);
         $this->load->view('template/navigation', $data);
         $this->load->view('template/slider', $data);
         $this->load->view('template/whatIsIt', $data);
          $this->load->view('template/download', $data);
          $this->load->view('template/features', $data);
          $this->load->view('template/gadgets', $data);
          $this->load->view('template/footer', $data);
        
    }
    
    /*
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
        $this->load->view('gardenResort/links', $data);
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
       $class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push($class, '/'.$class);
$this->breadcrumbs->push($method, '/'.$class.'/'.$method);
$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show();
         $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
         $this->load->view('gardenResort/links', $data);
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
    $class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push($class, '/'.$class);
$this->breadcrumbs->push($method, '/'.$class.'/'.$method);
$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show();

         $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
         $this->load->view('gardenResort/links', $data);
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
          foreach ($data['singleEvent'] as $news){
            $title = $news->title;
        }
        
$class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push($class, '/'.$class);
$this->breadcrumbs->push($method, '/'.$class.'/allevents');
$this->breadcrumbs->push($title, '/'.$class.'/'.$method.'/'.$title);
$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show();
         $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
         $this->load->view('gardenResort/links', $data);
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
        foreach ($data['singleNews'] as $news){
            $title = $news->title;
        }
        
$class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push($class, '/'.$class);
$this->breadcrumbs->push($method, '/'.$class.'/allnews');
$this->breadcrumbs->push($title, '/'.$class.'/'.$method.'/'.$title);
$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show();

         $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
         $this->load->view('gardenResort/links', $data);
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
         $class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push($class, '/'.$class);
$this->breadcrumbs->push($method, '/'.$class.'/'.$method);
$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show();
        $this->load->view('template/topHead', $data);
         $this->load->view('template/navigation', $data);
          $this->load->view('template/breadcrumbLink',$data);
        $this->load->view('template/album',$data);
          
        $this->load->view('template/gadgets', $data);
          $this->load->view('template/footer', $data);
    }
    
    public function photo($id=null)
    {
        $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $data['contact'] = $this->contact_model->get_contact_form();
        $data['albumName'] = $this->viewmodel->get_album_name_by_id($id);
         $data['selectedalbumquery'] =  $this->viewmodel->get_selected_album($id);
         foreach ($data['albumName'] as $galls){
             $title= $galls->album_name;
        }
       $class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push($class, '/'.$class);
$this->breadcrumbs->push($method, '/'.$class.'/gallery');
$this->breadcrumbs->push($title, '/'.$class.'/'.$method.'/'.$title);
$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show(); 
         $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
         $this->load->view('gardenResort/links', $data);
        $this->load->view('gardenResort/photo', $data);
         $this->load->view('gardenResort/footer',$data);
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
$this->breadcrumbs->push($class, '/'.$class);
$this->breadcrumbs->push($method, '/'.$class.'/'.$method);
$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show();
         $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
         $this->load->view('gardenResort/links', $data);
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
        foreach ($data['selectedpagequery'] as $name){
            $title = $name->page_title;
        }
        $class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push($class, '/'.$class);
$this->breadcrumbs->push($method, '/'.$class.'/index');
$this->breadcrumbs->push($title, '/'.$class.'/'.$method.'/'.$title);
$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show(); 
         $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
         $this->load->view('gardenResort/links', $data);
         $this->load->view('gardenResort/page', $data);
         $this->load->view('gardenResort/footer',$data);
    }

    public function post($id=NULL) {
         $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $data['contact'] = $this->contact_model->get_contact_form();
        $data['selectedpostquery'] = $this->viewmodel->get_desired_post($id);
        foreach ($data['selectedpostquery'] as $name){
            $title = $name->post_title;
        }
       
$class= $this->router->fetch_class();  
    $method = $this->router->fetch_method();    
        $this->load->library('breadcrumbs');
$this->breadcrumbs->push($class, '/'.$class);
$this->breadcrumbs->push($method, '/'.$class.'/index');
$this->breadcrumbs->push($title, '/'.$class.'/'.$method.'/'.$title);
$this->breadcrumbs->unshift('Home', '/');
$data['link'] = $this->breadcrumbs->show(); 
        $this->load->view('gardenResort/topHead', $data);
        $this->load->view('gardenResort/header', $data);
         $this->load->view('gardenResort/links', $data);
         $this->load->view('gardenResort/posts', $data);
         $this->load->view('gardenResort/footer',$data);
    }*/

    public function contactUs()
    {
         $data['meta'] = $this->dbsetting->get_meta_data();

        $data['gadget'] = $this->model1->get_gaget();
        $data['headertitle'] = $this->viewmodel->get_header_title();
        $data['headerlogo'] = $this->viewmodel->get_header_logo();
        $slidequery = $this->viewmodel->get_slider();
        $slider = json_encode($slidequery);
        $data["slider_json"] = $slider;
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
        $this->load->view('template/topHead', $data);
         $this->load->view('template/navigation', $data);
         $this->load->view('template/breadcrumbLink', $data);
         $this->load->view('template/contactForm',$data);
         $this->load->view('template/footer',$data);
    }
    
  public function download(){
$this->load->helper('download');

      $filename= 'BnW.zip';
 $data = file_get_contents("./content/download/".$filename); // Read the file's contents
$name = $filename;

force_download($name, $data);      


exit;
        
  }
  
  
  
}