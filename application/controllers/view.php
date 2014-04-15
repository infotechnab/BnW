<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class view extends CI_Controller {
 public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('viewmodel');
        $this->load->model('dbmodel');
        $this->load->model('dbmodel');
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
        $data['headerlogo']= $this->viewmodel->get_header_logo();
      
        $data['meta'] = $this->dbmodel->get_meta_data();
        $data['headerdescription']= $this->viewmodel->get_header_description();
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
        $this->load->view('menuview/pages',$data);
        $this->load->view('menuview/footer',$data);
        
    }
    
    public function page($id)
    {
        $nav= $this->uri->uri_string();
        $assc_id= str_replace('view/','', $nav);
        $data['meta'] = $this->dbmodel->get_meta_data();
        $limit['post_limit']=$this->viewmodel->get_max_post_to_show();
        $data['postquery'] = $this->viewmodel->get_post($limit["post_limit"]);
        $limit['page_limit']=$this->viewmodel->get_max_page_to_show();
        $data['pagequery'] = $this->viewmodel->get_page($limit["page_limit"]);
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();
        $data['commentallowquery']= $this->viewmodel->get_comment_allow();
        $data['headerdescription']= $this->viewmodel->get_header_description();
        $data['selectedpagequery'] = $this->viewmodel->get_desired_page($id);
         $data['viewcomments'] = $this->viewmodel->get_comments($assc_id);
        
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
        $this->load->view('menuview/selectedPage',$data);
        $this->load->view('menuview/footer',$data);  
        
    }
    public function category($id)
    {
        $nav= $this->uri->uri_string();
        $assc_id= str_replace('view/','', $nav);
        $data['meta'] = $this->dbmodel->get_meta_data();
       $limit['post_limit']=$this->viewmodel->get_max_post_to_show();
        $data['postquery'] = $this->viewmodel->get_post($limit["post_limit"]);
    
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();
        $data['commentallowquery']= $this->viewmodel->get_comment_allow();
        $data['headerdescription']= $this->viewmodel->get_header_description();
        $data['selectedcategoryquery'] = $this->viewmodel->get_desired_category($id);
         $data['viewcomments'] = $this->viewmodel->get_comments($assc_id);
        
        
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
        $data['meta'] = $this->dbmodel->get_meta_data();
        $limit['post_limit']=$this->viewmodel->get_max_post_to_show();
        $data['postquery'] = $this->viewmodel->get_post($limit["post_limit"]);
        $limit['page_limit']=$this->viewmodel->get_max_page_to_show();
        $data['pagequery'] = $this->viewmodel->get_page($limit["page_limit"]);
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();
        $data['commentallowquery']= $this->viewmodel->get_comment_allow();
         $data['likeallowquery']= $this->viewmodel->get_like_allow();
          $data['shareallowquery']= $this->viewmodel->get_share_allow();
        
        $data['viewcomments'] = $this->viewmodel->get_comments($assc_id);
        $data['headerdescription']= $this->viewmodel->get_header_description();
        $data['selectedpostquery'] = $this->viewmodel->get_desired_post($id, $limit);
        
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
       // $this->load->view('menuview/allPost',$data);
        $this->load->view('menuview/selectedPost', $data);
        $this->load->view('menuview/footer',$data);
        
        
    }
    public function posts()
    {
        $nav= $this->uri->uri_string();
        $assc_id= str_replace('view/','', $nav);
        $data['meta'] = $this->dbmodel->get_meta_data();
        $limit['post_limit']=$this->viewmodel->get_max_post_to_show();
        $data['postquery'] = $this->viewmodel->get_post($limit["post_limit"]);
        $data['allpostquery'] = $this->viewmodel->get_all_post();
        $limit['page_limit']=$this->viewmodel->get_max_page_to_show();
        $data['pagequery'] = $this->viewmodel->get_page($limit["page_limit"]);
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();        
       $data['headerdescription']= $this->viewmodel->get_header_description();
        
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
        $this->load->view('menuview/posts',$data);
       // $this->load->view('menuview/allPost',$data);
        //$this->load->view('menuview/selectedPost', $data);
        $this->load->view('menuview/footer',$data);
        
        
    }
    
    
    
    public function photos()
    {
        $data['meta'] = $this->dbmodel->get_meta_data();
       $limit['post_limit']=$this->viewmodel->get_max_post_to_show();
        $data['postquery'] = $this->viewmodel->get_post($limit["post_limit"]);
        $limit['page_limit']=$this->viewmodel->get_max_page_to_show();
        $data['pagequery'] = $this->viewmodel->get_page($limit["page_limit"]);
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();
        $data['headerdescription']= $this->viewmodel->get_header_description();
        $data['albumquery'] = $this->viewmodel->get_album();
        
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
        $this->load->view('menuview/album',$data);
        $this->load->view('menuview/footer',$data);  
        
    }
    
    public function photo($id)
    {
        $data['meta'] = $this->dbmodel->get_meta_data();
        $limit['post_limit']=$this->viewmodel->get_max_post_to_show();
        $data['postquery'] = $this->viewmodel->get_post($limit["post_limit"]);
        $limit['page_limit']=$this->viewmodel->get_max_page_to_show();
        $data['pagequery'] = $this->viewmodel->get_page($limit["page_limit"]);
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();
        $data['headerdescription']= $this->viewmodel->get_header_description();
        $data['albumquery'] = $this->viewmodel->get_album();
        
        
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
      $data['meta'] = $this->dbmodel->get_meta_data();
        $limit['post_limit']=$this->viewmodel->get_max_post_to_show();
        $data['postquery'] = $this->viewmodel->get_post($limit["post_limit"]);
        $limit['page_limit']=$this->viewmodel->get_max_page_to_show();
        $data['pagequery'] = $this->viewmodel->get_page($limit["page_limit"]);
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();
        $data['headerdescription']= $this->viewmodel->get_header_description();
        $data['mediaquery']= $this->viewmodel->get_all_media();        
        
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
        $this->load->view('menuview/downloads',$data);
        $this->load->view('menuview/footer',$data); 

    }
    
  public function download(){
      $filename= $_GET['download'];
      die($filename);
      
      header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: private', false); // required for certain browsers 
header('Content-Type: application/pdf');

header('Content-Disposition: attachment; filename="'. basename($filename) . '";');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($filename));

/*readfile(<?php echo base_url().'/contents/images/'.$filename; ?>);*/

exit;
        
  }
  
  
  
  
}