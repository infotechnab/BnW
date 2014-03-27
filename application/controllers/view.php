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
        
        $data['pagequery'] = $this->viewmodel->get_page();
        $data['postquery'] = $this->viewmodel->get_post();
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        //$data['faviconicon']= $this->viewmodel->get_favicon_icon();
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
        $data['meta'] = $this->dbmodel->get_meta_data();
        $data['postquery'] = $this->viewmodel->get_post();
        $data['pagequery'] = $this->viewmodel->get_page();
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();
        $data['commentallowquery']= $this->viewmodel->get_comment_allow();
        $data['headerdescription']= $this->viewmodel->get_header_description();
        $data['selectedpagequery'] = $this->viewmodel->get_desired_page($id);
        
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
        $this->load->view('menuview/selectedPage',$data);
        $this->load->view('menuview/footer',$data);  
        
    }
    
    public function post($id)
    {
        $assc_id=  $this->uri->uri_string(2);
        var_dump($assc_id);
        $data['meta'] = $this->dbmodel->get_meta_data();
        $data['postquery'] = $this->viewmodel->get_post();
        $data['pagequery'] = $this->viewmodel->get_page();
        $data['slidequery'] = $this->viewmodel->get_slider();
        $data['headerquery']= $this->viewmodel->get_design_setup();
        $data['headertitle']= $this->viewmodel->get_header_title();
        $data['headerlogo']= $this->viewmodel->get_header_logo();
        $data['faviconicon']= $this->viewmodel->get_favicon_icon();
        $data['commentallowquery']= $this->viewmodel->get_comment_allow();
        $data['viewcomments'] = $this->viewmodel->get_comments($assc_id);
        $data['headerdescription']= $this->viewmodel->get_header_description();
        $data['selectedpostquery'] = $this->viewmodel->get_desired_post($id);
        
        
        $this->load->view('menuview/header',$data);
        $this->load->view('menuview/menu',$data);
        $this->load->view('menuview/event',$data);
        $this->load->view('menuview/slider',$data);
        $this->load->view('menuview/allPost',$data);
        $this->load->view('menuview/footer',$data);  
        
    }
    
    
    
    public function photos()
    {
        $data['meta'] = $this->dbmodel->get_meta_data();
        $data['postquery'] = $this->viewmodel->get_post();
        $data['pagequery'] = $this->viewmodel->get_page();
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
        $data['postquery'] = $this->viewmodel->get_post();
        $data['pagequery'] = $this->viewmodel->get_page();
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
        
        $comment = $this->input->post('comment');
       $comment_association_id='post/3';
        
            
        $this->dbmodel->add_new_comment($comment, $comment_association_id);
        $this->session->set_flashdata('message', 'Thank You for comment');
        redirect('view/index');
    }
    
    
    
  
}