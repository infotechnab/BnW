<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class demo extends CI_Controller {
 public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('viewmodel');
        $this->load->model('dbmodel');
        $this->load->model('dbsetting');
        $this->load->model('model1');
    }
public function index()
    {
        $limit['page_limit']=$this->viewmodel->get_max_page_to_show();
        $data['pagequery'] = $this->viewmodel->get_page($limit["page_limit"]);
        $limit['post_limit']=$this->viewmodel->get_max_post_to_show();
        $data['postquery'] = $this->viewmodel->get_post($limit["post_limit"]);
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerColor']= $this->viewmodel->get_header_color();
         $data['sidebarColor']= $this->viewmodel->get_sidebar_color();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
      
        $data['allpostquery'] = $this->viewmodel->get_all_post();
      
        $data['meta'] = $this->dbsetting->get_meta_data();
        $data['headerdescription']= $this->viewmodel->get_header_description();
      
        $data['gadget'] = $this->model1->get_gaget();                    //for all gadget
        $data['recentPost']= $this->model1->get_gaget_recentPost();   //for recent post gadget.
       
         foreach ($data['recentPost'] as $dat)
        {
             $setting = $dat->setting;
        
           $post = parse_str($setting);  //parsing from database gadget table settings field.
           
            
           
             $data['noOfRecentPost'] = $this->viewmodel->recentpost_get_post($post);  
             
        }
   $data['albumquery'] = $this->viewmodel->get_album();
     $data['slider_json'] = json_encode($data['slidequery']);
       // $this->load->view('document/documentation');
       
                $this->load->view('demo/header', $data);   
                $this->load->view('demo/slider', $data);
                $this->load->view('demo/pages', $data);
                $this->load->view('demo/posts', $data);
                $this->load->view('demo/gallery', $data);
                $this->load->view('demo/download');
                $this->load->view('demo/follow');
                $this->load->view('demo/footer');
        
    }
     public function newform()
    {
         $this->load->view('demo/angularjs');
         $this->load->view('demo/datatable');
         
    }
    public function page($id)
    {
        $nav= $this->uri->uri_string();
        $assc_id= str_replace('view/','', $nav);
        $data['meta'] = $this->dbsetting->get_meta_data();
        $limit['post_limit']=$this->viewmodel->get_max_post_to_show();
        $data['postquery'] = $this->viewmodel->get_post($limit["post_limit"]);
        $limit['page_limit']=$this->viewmodel->get_max_page_to_show();
        $data['pagequery'] = $this->viewmodel->get_page($limit["page_limit"]);
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerColor']= $this->viewmodel->get_header_color();
         $data['sidebarColor']= $this->viewmodel->get_sidebar_color();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();
        $data['commentallowquery']= $this->viewmodel->get_comment_allow();
        $data['headerdescription']= $this->viewmodel->get_header_description();
        $data['selectedpagequery'] = $this->viewmodel->get_desired_page($id);
       $data['commentallowquery']= $this->viewmodel->get_comment_allow();
        $data['likeallowquery']= $this->viewmodel->get_like_allow();
        $data['shareallowquery']= $this->viewmodel->get_share_allow();
       $data['gadget'] = $this->model1->get_gaget();                    //for all gadget
        $data['recentPost']= $this->model1->get_gaget_recentPost();   //for recent post gadget.
         foreach ($data['recentPost'] as $dat)
        {
             $setting = $dat->setting;
             parse_str($setting);
            
        }
         $data['noOfRecentPost'] = $this->viewmodel->recentpost_get_post($post);
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
        $this->load->view('menuview/selectedPage',$data);
        $this->load->view('menuview/footer',$data);  
        
    }
    
    public function pages(){
         $nav= $this->uri->uri_string();
        $assc_id= str_replace('view/','', $nav);
        $data['meta'] = $this->dbsetting->get_meta_data();
        $limit['post_limit']=$this->viewmodel->get_max_post_to_show();
        $data['postquery'] = $this->viewmodel->get_post($limit["post_limit"]);
       // $limit['page_limit']=$this->viewmodel->get_max_page_to_show();
        $data['pagequery'] = $this->viewmodel->get_all_pages();
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerColor']= $this->viewmodel->get_header_color();
         $data['sidebarColor']= $this->viewmodel->get_sidebar_color();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();
        $data['commentallowquery']= $this->viewmodel->get_comment_allow();
        $data['headerdescription']= $this->viewmodel->get_header_description();
        //$data['selectedpagequery'] = $this->viewmodel->get_desired_page($id);
       $data['commentallowquery']= $this->viewmodel->get_comment_allow();
        $data['likeallowquery']= $this->viewmodel->get_like_allow();
        $data['shareallowquery']= $this->viewmodel->get_share_allow();
       $data['gadget'] = $this->model1->get_gaget();                    //for all gadget
        $data['recentPost']= $this->model1->get_gaget_recentPost();   //for recent post gadget.
         foreach ($data['recentPost'] as $dat)
        {
             $setting = $dat->setting;
             parse_str($setting);
            
        }
         $data['noOfRecentPost'] = $this->viewmodel->recentpost_get_post($post);
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
        $this->load->view('menuview/pages',$data);
        $this->load->view('menuview/footer',$data);  
    }
    
    public function category($id)
    {
        $nav= $this->uri->uri_string();
        $assc_id= str_replace('view/','', $nav);
        $data['meta'] = $this->dbsetting->get_meta_data();
       $limit['post_limit']=$this->viewmodel->get_max_post_to_show();
        $data['postquery'] = $this->viewmodel->get_post($limit["post_limit"]);
    
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerColor']= $this->viewmodel->get_header_color();
         $data['sidebarColor']= $this->viewmodel->get_sidebar_color();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();
        $data['commentallowquery']= $this->viewmodel->get_comment_allow();
        $data['headerdescription']= $this->viewmodel->get_header_description();
        $data['selectedcategoryquery'] = $this->viewmodel->get_desired_category($id);
         $data['viewcomments'] = $this->viewmodel->get_comments($assc_id);
       $data['gadget'] = $this->model1->get_gaget();                    //for all gadget
        $data['recentPost']= $this->model1->get_gaget_recentPost();   //for recent post gadget.
         foreach ($data['recentPost'] as $dat)
        {
             $setting = $dat->setting;
             parse_str($setting);
           
        }
         $data['noOfRecentPost'] = $this->viewmodel->recentpost_get_post($post);
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
        $this->load->view('menuview/selectedCategory',$data);
        $this->load->view('menuview/footer',$data);  
        
    }
   

    public function post($id)
    {
        $nav= $this->uri->uri_string();
        $assc_id= str_replace('view/','', $nav);
        $data['meta'] = $this->dbsetting->get_meta_data();
        $limit['post_limit']=$this->viewmodel->get_max_post_to_show();
        $data['postquery'] = $this->viewmodel->get_post($limit["post_limit"]);
        $limit['page_limit']=$this->viewmodel->get_max_page_to_show();
        $data['pagequery'] = $this->viewmodel->get_page($limit["page_limit"]);
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerColor']= $this->viewmodel->get_header_color();
         $data['sidebarColor']= $this->viewmodel->get_sidebar_color();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();
        $data['commentallowquery']= $this->viewmodel->get_comment_allow();
        $data['likeallowquery']= $this->viewmodel->get_like_allow();
        $data['shareallowquery']= $this->viewmodel->get_share_allow();
        
        $data['viewcomments'] = $this->viewmodel->get_comments($assc_id);
        $data['headerdescription']= $this->viewmodel->get_header_description();
        $data['selectedpostquery'] = $this->viewmodel->get_desired_post($id, $limit);
        $data['gadget'] = $this->model1->get_gaget();                    //for all gadget
        $data['recentPost']= $this->model1->get_gaget_recentPost();   //for recent post gadget.
         foreach ($data['recentPost'] as $dat)
        {
             $setting = $dat->setting;
             parse_str($setting);
           
        }
        $data['noOfRecentPost'] = $this->viewmodel->recentpost_get_post($post);
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
      
        $this->load->view('menuview/selectedPost', $data);
        $this->load->view('menuview/footer',$data);
        
        
    }
    public function posts()
    {
        $nav= $this->uri->uri_string();
        $assc_id= str_replace('view/','', $nav);
        $data['meta'] = $this->dbsetting->get_meta_data();
        $limit['post_limit']=$this->viewmodel->get_max_post_to_show();
        $data['postquery'] = $this->viewmodel->get_post($limit["post_limit"]);
        $data['allpostquery'] = $this->viewmodel->get_all_post();
        $limit['page_limit']=$this->viewmodel->get_max_page_to_show();
        $data['pagequery'] = $this->viewmodel->get_page($limit["page_limit"]);
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerColor']= $this->viewmodel->get_header_color();
         $data['sidebarColor']= $this->viewmodel->get_sidebar_color();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();        
       $data['headerdescription']= $this->viewmodel->get_header_description();
       $data['gadget'] = $this->model1->get_gaget();                    //for all gadget
        $data['recentPost']= $this->model1->get_gaget_recentPost();   //for recent post gadget.
         foreach ($data['recentPost'] as $dat)
        {
             $setting = $dat->setting;
             parse_str($setting);
           
        }
       $data['noOfRecentPost'] = $this->viewmodel->recentpost_get_post($post);
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
        $this->load->view('menuview/posts',$data);
      
        $this->load->view('menuview/footer',$data);
        
        
    }
    
    
    
    public function photos()
    {
        $data['meta'] = $this->dbsetting->get_meta_data();
       $limit['post_limit']=$this->viewmodel->get_max_post_to_show();
        $data['postquery'] = $this->viewmodel->get_post($limit["post_limit"]);
        $limit['page_limit']=$this->viewmodel->get_max_page_to_show();
        $data['pagequery'] = $this->viewmodel->get_page($limit["page_limit"]);
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerColor']= $this->viewmodel->get_header_color();
         $data['sidebarColor']= $this->viewmodel->get_sidebar_color();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();
        $data['headerdescription']= $this->viewmodel->get_header_description();
        $data['albumquery'] = $this->viewmodel->get_album();
       $data['gadget'] = $this->model1->get_gaget();                    //for all gadget
        $data['recentPost']= $this->model1->get_gaget_recentPost();   //for recent post gadget.
         foreach ($data['recentPost'] as $dat)
        {
             $setting = $dat->setting;
             parse_str($setting);
            
        }
        $data['noOfRecentPost'] = $this->viewmodel->recentpost_get_post($post);
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
        $this->load->view('menuview/album',$data);
        $this->load->view('menuview/footer',$data);  
        
    }
    
    public function photo($id)
    {
        $data['meta'] = $this->dbsetting->get_meta_data();
        $limit['post_limit']=$this->viewmodel->get_max_post_to_show();
        $data['postquery'] = $this->viewmodel->get_post($limit["post_limit"]);
        $limit['page_limit']=$this->viewmodel->get_max_page_to_show();
        $data['pagequery'] = $this->viewmodel->get_page($limit["page_limit"]);
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerColor']= $this->viewmodel->get_header_color();
         $data['sidebarColor']= $this->viewmodel->get_sidebar_color();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();
        $data['headerdescription']= $this->viewmodel->get_header_description();
        $data['albumquery'] = $this->viewmodel->get_album();
        $data['gadget'] = $this->model1->get_gaget();                    //for all gadget
        $data['recentPost']= $this->model1->get_gaget_recentPost();   //for recent post gadget.
         foreach ($data['recentPost'] as $dat)
        {
             $setting = $dat->setting;
             parse_str($setting);
           
        }
        $data['noOfRecentPost'] = $this->viewmodel->recentpost_get_post($post);
        
        $data['selectedalbumquery'] =  $this->viewmodel->get_selected_album($id);
        
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
        $this->load->view('menuview/photos',$data);
        $this->load->view('menuview/footer',$data);  
        
    }
    public function addcomment()
    {
        
        $a=$_GET['post_id'];
        
        $comment_association_id=$a;
        $user_name=' ';
        $comment = $this->input->post('comment');   
            
        $this->dbmodel->add_new_comment($comment, $comment_association_id, $user_name);
        
        redirect('view/'.$a );
    }
    
     public function downloads(){
      $data['meta'] = $this->dbsetting->get_meta_data();
        $limit['post_limit']=$this->viewmodel->get_max_post_to_show();
        $data['postquery'] = $this->viewmodel->get_post($limit["post_limit"]);
        $limit['page_limit']=$this->viewmodel->get_max_page_to_show();
        $data['pagequery'] = $this->viewmodel->get_page($limit["page_limit"]);
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerColor']= $this->viewmodel->get_header_color();
         $data['sidebarColor']= $this->viewmodel->get_sidebar_color();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();
        $data['headerdescription']= $this->viewmodel->get_header_description();
        $data['mediaquery']= $this->viewmodel->get_all_media();        
        $data['gadget'] = $this->model1->get_gaget();                    //for all gadget
        $data['recentPost']= $this->model1->get_gaget_recentPost();   //for recent post gadget.
         foreach ($data['recentPost'] as $dat)
        {
             $setting = $dat->setting;
             parse_str($setting);
            
        }
        $data['noOfRecentPost'] = $this->viewmodel->recentpost_get_post($post);
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
        $this->load->view('menuview/downloads',$data);
        $this->load->view('menuview/footer',$data); 

    }
    
  public function download(){
$this->load->helper('download');

      $filename= $_GET['download'];
 $data = file_get_contents("./content/images/".$filename); // Read the file's contents
$name = $filename;

force_download($name, $data);      


exit;
        
  }
  
  
  
}