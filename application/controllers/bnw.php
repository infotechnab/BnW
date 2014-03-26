<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class bnw extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dbmodel');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
    }


    public function index() {
        if ($this->session->userdata('logged_in')) {
            $data['username'] = Array($this->session->userdata('logged_in'));
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu', $data);
            $this->load->view('bnw/index', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    function logout() {
        $this->session->sess_destroy();
        $this->index();
        redirect('login', 'refresh');
    }

    public function addPageForNavigation() {
        if ($this->session->userdata('logged_in')) {            
            $data['meta'] = $this->dbmodel->get_meta_data();
            $listOfPage = $this->dbmodel->get_list_of_pages();           
            $listOfMenu = $this->dbmodel->get_list_of_menu();
            $data["listOfPage"] = $this->dbmodel->get_list_of_pages();           
            $data["listOfMenu"] = $this->dbmodel->get_list_of_menu();
            $data["listOfCategory"] = $this->dbmodel->get_list_of_category();
            $listOfNavigation = $this->dbmodel->get_list_of_navigation();
            $data["listOfNavigation"] = $this->dbmodel->get_list_of_navigation();
            $listOfSelectedMenu = Array();
            
            if(($_SERVER['REQUEST_METHOD'] == 'POST'))
            {  
                foreach ($listOfPage as $myData)
            {
                if(isset($_POST[preg_replace('/\s+/', '', $myData->page_name)]))
                {
                    
                    array_push($listOfSelectedMenu, array($myData->id=>$myData->page_name));
                }
            }
            $menuSelected = $_POST['selectMenu'];
            foreach ($listOfSelectedMenu as $myData)
            {
                foreach ($myData as $k=>$v)
                {
                     $navigation_type="page";
                 $navigation_name= $v;
                 $navigation_link= $navigation_type."/".$k;
                 if(($_SERVER['REQUEST_METHOD'] == 'POST'))
            {
                //$navigationName = $_POST['selectNavigation'];
               //die($navigationName);
//                 if(isset ($_POST['selectNavigation'])){
//                    
//                    
//                }else
                 if(isset($_POST['parent'])){
                    $parent_id='0';
                    
                }
               
                else {    
                    $navigationName = $_POST['selectNavigation'];
                   //die($navigationName);
                 $post_category_info = $this->dbmodel->get_navigation_info($navigationName);  
                foreach($post_category_info as $pid)
                {
                    $parent_id= $pid->id;
                }
                }            }    
                
                 $navigation_slug= preg_replace('/\s+/', '', $v);
                 
                 $menu_info = $this->dbmodel->get_menu_info($menuSelected);
                 //print_r($menu_info);
                }
                 foreach ($menu_info as $id)
                 {
                     $menu_id = $id->id;
                 }
                 //die($parent_id);
                $this->dbmodel->add_new_navigation_item($navigation_name, $navigation_link, $parent_id, $navigation_type, $navigation_slug, $menu_id);
                 
            }
            
//            $this->load->view('bnw/templates/header', $data);
//            $this->load->view('bnw/templates/menu',$data);
//            $this->load->view('bnw/menu/listOfItems',$data);
//            $this->load->view('bnw/templates/footer', $data);
            redirect('bnw/navigation');
        }
        else 
        {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data["listOfPage"] = $this->dbmodel->get_list_of_pages();
            $data["listOfCategory"] = $this->dbmodel->get_list_of_category();
            $data["listOfMenu"] = $this->dbmodel->get_list_of_menu();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu',$data);
            $this->load->view('bnw/menu/listOfItems',$data);
            $this->load->view('bnw/templates/footer', $data);
        }
        } else {
            redirect('login', 'refresh');
        }
    }
    public function addCategoryForNavigation()
    {
         if ($this->session->userdata('logged_in')) {
             $data['meta'] = $this->dbmodel->get_meta_data();
            $listOfPage = $this->dbmodel->get_list_of_pages();           
            $listOfMenu = $this->dbmodel->get_list_of_menu();
            $data["listOfPage"] = $this->dbmodel->get_list_of_pages();           
            $data["listOfMenu"] = $this->dbmodel->get_list_of_menu();
            $data["listOfCategory"] = $this->dbmodel->get_list_of_category();
            $listOfCategory = $this->dbmodel->get_list_of_category(); 
            $listOfNavigation = $this->dbmodel->get_list_of_navigation();
            $data["listOfNavigation"] = $this->dbmodel->get_list_of_navigation();
             
            
            if(($_SERVER['REQUEST_METHOD'] == 'POST'))
            {
                $navigationName = $_POST['selectNavigation'];
                if($navigationName==" "){
                    $parent_id='0';
                }  else {              
                 $post_category_info = $this->dbmodel->get_navigation_info($navigationName);
                 
                foreach($post_category_info as $pid)
                {
                    $parent_id= $pid->id;
                }
                }            }
                
                
            if(($_SERVER['REQUEST_METHOD'] == 'POST'))
            {
                $menuSelected = $_POST['selectMenuCategory'];
           
            $categoryList = Array();
            foreach ($listOfCategory as $myData) {
                
                 {
                if(isset($_POST[preg_replace('/\s+/', '', $myData->category_name)]))
                {
                    
                    array_push($categoryList, array($myData->id=>$myData->category_name));
                }
                    
                }
            }
            

            foreach ($categoryList as $myData)
            {
                foreach ($myData as $k=>$v)
                {
                $navigation_name= $v;
                 $navigation_type="category";
                 $navigation_link= $navigation_type."/".$k;
                 $navigation_slug= preg_replace('/\s+/', '', $v); ;
                 $menu_info = $this->dbmodel->get_menu_info($menuSelected);
                }
                 foreach ($menu_info as $id)
                 {
                     $menu_id = $id->id;
                 }
                $this->dbmodel->add_new_navigation_item($navigation_name, $navigation_link, $parent_id, $navigation_type, $navigation_slug, $menu_id);
                 
            }
            
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu',$data);
            $this->load->view('bnw/menu/listOfItems',$data);
            $this->load->view('bnw/templates/footer', $data);
            }
            else 
            {
                $data['meta'] = $this->dbmodel->get_meta_data();
            $data["listOfPage"] = $this->dbmodel->get_list_of_pages();
            $data["listOfCategory"] = $this->dbmodel->get_list_of_category();
            $data["listOfMenu"] = $this->dbmodel->get_list_of_menu();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu',$data);
            $this->load->view('bnw/menu/listOfItems',$data);
            $this->load->view('bnw/templates/footer', $data);           
        
            }
    }
        
    else{
             redirect('login', 'refresh');
    }
         
    }
    
    public function addCustomLink(){
         if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $listOfMenu = $this->dbmodel->get_list_of_menu();           
            $data["listOfMenu"] = $this->dbmodel->get_list_of_menu();
            $data["listOfPage"] = $this->dbmodel->get_list_of_pages();
            $data["listOfCategory"] = $this->dbmodel->get_list_of_category();
            $data["listOfMenu"] = $this->dbmodel->get_list_of_menu();
            $data["links"] = $this->pagination->create_links();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            
            if(($_SERVER['REQUEST_METHOD'] == 'POST'))
            {
                $menuSelected = $_POST['selectMenu'];
                 $menu_info = $this->dbmodel->get_menu_info($menuSelected);
                foreach ($menu_info as $id)
                 {
                     $menu_id = $id->id;
                 }
            }
            
            $this->form_validation->set_rules('navigation_name', 'Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('navigation_link', 'Link', 'required|xss_clean|max_length[200]');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('bnw/menu/listOfItems');
            } else {

                //if valid
                $navigationName= $this->input->post('navigation_name');
                $navigationLink= $this->input->post('navigation_link');
                $parentID="0";
                $navigationType= " ";
                $navigation_slug= preg_replace('/\s+/', '', $navigationName); 
                $this->dbmodel->add_new_custom_link($navigationName, $navigationLink, $parentID, $navigationType, $navigation_slug, $menu_id);
                //$this->session->set_flashdata('message', 'One N added sucessfully');
                redirect('bnw/addCustomLink');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login', 'refresh');
        }
    }

    //=====================================================================================================
    //===================================Navigation========================================================
    //=====================================================================================================
    public function getAjax($a){
        die($a);
        $id = $this->input->post('select');
        die($id);
        if($id == !0 || $id == ! NULL){
       $identity = $this->dbmodel->get_identity($id);
       
         foreach ($identity as $menu){
             echo "<option>".$menu->navigation_name."</option>";
             var_dump($identity);
    }
        }else{
            $id= 1;
            $identity = $this->dbmodel->get_identity($id);
            var_dump($identity);
         foreach ($identity as $menu){
             echo "<option>".$menu->navigation_name."</option>";  
    }
        }
    
    }
    public function navigation() {
        if ($this->session->userdata('logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/menu";
            $config["total_rows"] = $this->dbmodel->record_count_navigation();
            $config["per_navigation"] = 6;
            $this->pagination->initialize($config);
            $navigation = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data["query"] = $this->dbmodel->get_navigation($config["per_navigation"], $navigation);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data["listOfPage"] = $this->dbmodel->get_list_of_pages();
            $data["listOfCategory"] = $this->dbmodel->get_list_of_category();
            $data["listOfMenu"] = $this->dbmodel->get_list_of_menu();
            $data["listOfNavigation"] = $this->dbmodel->get_list_of_navigation();
            $data["listOfNavigationID"] = $this->dbmodel->get_list_of_navigationID();
            //$data['menulisting']= $this->dbmodel->get_menu_list();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('bnw/menu/listOfItems', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    //===========================================To Add Navigation=====================================================

    public function addnavigation() {
        if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('navigation_name', 'Navigation Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('navigation_link', 'Link', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('navigation_type', 'Type', 'required|xss_clean|max_length[200]');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('bnw/menu/addNavigation');
            } else {

                //if valid
                $navigationname = $this->input->post('navigation_name');
                $navigationlink = $this->input->post('navigation_link');
                $pid = $this->input->post('parent_id');
                $navigationtype = $this->input->post('navigation_type');
                $navigationslug = $this->input->post('navigation_slug');
                $mid = $this->input->post('menu_id');
                $this->dbmodel->add_new_navigation($navigationname, $navigationlink, $pid, $navigationtype, $navigationslug, $mid);
                $this->session->set_flashdata('message', 'One Navigation Menu added sucessfully');
                //redirect('bnw/menu/navigationListing');
            }
            redirect('bnw/menu/navigation');
        } else {

            redirect('login', 'refresh');
        }
    }

    public function editnavigation($id) {
        if ($this->session->userdata('logged_in')) {
            $id = $this->input->post('id');
            $data['query'] = $this->dbmodel->findnavigation($id);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/menu/editNavigation', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function updatenavigation() {
        if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('navigation_name', 'Navigation Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('navigation_link', 'Link', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('navigation_type', 'Type', 'required|xss_clean|max_length[200]');


            if ($this->form_validation->run() == FALSE) {
                //if not valid
                $data['query'] = $this->dbmodel->findnavigation($id);
                $this->load->view('bnw/menu/navigationListing', $data);
            } else {
                //if valid
                $id = $this->input->post('id');
                $navigationname = $this->input->post('navigation_name');
                $navigationlink = $this->input->post('navigation_link');
                $pid = $this->input->post('parent_id');
                $navigationtype = $this->input->post('navigation_type');
                $navigationslug = $this->input->post('navigation_slug');
                $mid = $this->input->post('menu_id');
                $this->dbmodel->update_navigation($id, $navigationname, $navigationlink, $pid, $navigationtype, $navigationslug, $mid);
                $this->session->set_flashdata('message', 'NAvigation Menu Modified Sucessfully');

                redirect('bnw/menu/navigationListing');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    //======================================================================================================
    //====================================Category==========================================================
    //======================================================================================================

    public function category() {
        if ($this->session->userdata('logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/category";
            $config["total_rows"] = $this->dbmodel->record_count_category();
            $config["per_category"] = 6;
            $this->pagination->initialize($config);
            $category = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data["query"] = $this->dbmodel->get_all_category($config["per_category"], $category);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbmodel->get_meta_data();
           

            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/category/addCategory', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

//========================================to add category===================================================

    public function addcategory() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './content/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data["links"] = $this->pagination->create_links();
            $data['query'] = $this->dbmodel->get_category();
           
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $categoryname = $this->input->post('category_name');

            $this->form_validation->set_rules('category_name', 'Category Name', 'required|xss_clean|max_length[200]');



            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('file')) {
                        $error = array('error' => $this->upload->display_errors('file'));
                        $this->load->view('bnw/category/addCategory', $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data('file'));
                        $image = $data['upload_data']['file_name'];


                        $this->dbmodel->add_new_category($categoryname);
                        $this->session->set_flashdata('message', 'One category item added sucessfully');
                        redirect('bnw/category/addCategory');
                    }
                } else {
                    $categoryname = $this->input->post('category_name');

                    $this->dbmodel->add_new_category($categoryname);

                    $pages = $this->dbmodel->find_category_id($categoryname);
                    $this->session->set_flashdata('message', 'One category added sucessfully');
                    redirect('bnw/category/addCategory');
                }
            } else {

                $this->load->view('bnw/category/addCategory', $data);
            }

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    //==================================To edit category=======================================================
    public function editcategory($id) {
        if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->findcategory($id);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data["links"] = $this->pagination->create_links();
            $data['id'] = $id;
            
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/category/edit', $data);

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function updatecategory() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './content/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data["links"] = $this->pagination->create_links();

            
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $id = $this->input->post('id');
            //set validation rules
            $this->form_validation->set_rules('category_name', 'Category Name', 'required|xss_clean|max_length[200]');




            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('file')) {
                        $data['error'] = $this->upload->display_errors('file');
                        $id = $this->input->post('id');
                        $data['query'] = $this->dbmodel->findcategory($id);
                        $this->load->view('bnw/category/edit', $data);
                    } else {
                        $categoryname = $this->input->post('category_name');
                        $this->dbmodel->update_category($id, $categoryname);
                        $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                        redirect('bnw/category/addCategory');
                    }
                } else {


                    $categoryname = $this->input->post('category_name');
                    $this->dbmodel->update_category($id, $categoryname);
                    $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                    redirect('bnw/category/addCategory');
                }
            } else {
                $id = $this->input->post('id');
                $data['query'] = $this->dbmodel->findcategory($id);
                $this->load->view('bnw/category/edit', $data);
            }

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    //========================================To delete category=============================================


    public function deletecategory($id) {
        if ($this->session->userdata('logged_in')) {
            $this->dbmodel->delete_category($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/category');
        } else {
            redirect('login', 'refresh');
        }
    }
    
    //==========================================================================================================//
    //====================================POST==================================================================//
    //===========================================================================================================//

    public function posts(){
        if ($this->session->userdata('logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/posts";
            $config["total_rows"] = $this->dbmodel->record_count_post();
            $config["per_page"] = 6;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data["query"] = $this->dbmodel->get_all_posts($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbmodel->get_meta_data();
           

            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/posts/postListing', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }
    
    //============================To Add New Post=======================================//
    
    public function addpost()
    {
         if ($this->session->userdata('logged_in')) {
            $username = $this->session->userdata( 'username' );
            $data['username'] = ($this->session->userdata('logged_in'));
            $config['upload_path'] = './content/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['query'] = $this->dbmodel->get_posts();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
             $this->load->helper('date');
            $this->load->library(array('form_validation', 'session'));
             $listOfCategory = $this->dbmodel->get_list_of_category();
             $data["listOfCategory"] = $this->dbmodel->get_list_of_category();
                               
            if(($_SERVER['REQUEST_METHOD'] == 'POST'))
            {
                $categoryName = $_POST['selectCategory'];
                 $post_category_info = $this->dbmodel->get_post_category_info($categoryName);
                foreach($post_category_info as $pid)
                {
                    $post_category_id= $pid->id;
                }
            }
           
            //set validation rules
            $this->form_validation->set_rules('post_title', 'Page Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('post_content', 'Body', 'required|xss_clean');
          


            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('file')) {
                        $error = array('error' => $this->upload->display_errors('file'));
                        $this->load->view('bnw/posts/addNewPost', $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data('file'));
                        $image = $data['upload_data']['file_name'];
                        
                        $this->dbmodel->add_new_post($post_title, $post_content, $post_author_id, $post_summary, $post_status, $post_comment_status, $post_tags, $post_category_id);
                        $this->session->set_flashdata('message', 'One pages added sucessfully');
                        redirect('bnw/posts/postListing');
                    }
                } else {
                     $post_title = $this->input->post('post_title');
            $post_content = $this->input->post('post_content');
            $post_author_info = $this->dbmodel->get_post_author_id($username);
                 foreach($post_author_info as $pid)
                 {    
                 $post_author_id= $pid->id;
                 }
            $string = $this->input->post('post_content');
                           $post_summary= substr("$string", 0, 100);
            $post_status = $this->input->post('post_status');
            $post_comment_status = $this->input->post('comment_status');
            $post_tags = $this->input->post('post_tags');
            $post_category_info = $this->dbmodel->get_post_category_info($categoryName);
            $allowComment = $this->input->post('allow_comment');
            $allowLike = $this->input->post('allow_like');
            $allowShare = $this->input->post('allow_share');
             
            $this->dbmodel->add_new_post($post_title, $post_content, $post_author_id, $post_summary, $post_status, $post_comment_status, $post_tags, $post_category_id, $allowComment, $allowLike, $allowShare);
            $this->session->set_flashdata('message', 'One post added sucessfully');
               redirect('bnw/posts/postListing');
                }
            } else {

                $this->load->view('bnw/posts/addNewPost', $data);
            }

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }
    
    //======================================To Edit Post===========================================================//
    
    function editpost($id) {
        if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->findpost($id);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['id'] = $id;
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/posts/editPost', $data);

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }
    
    //=========================================To Delete Post======================================================//
    public function deletepost($id) {
        if ($this->session->userdata('logged_in')) {
            $this->dbmodel->deletepost($id);
            $this->session->set_flashdata('message', 'Data Deleted Sucessfully');
            redirect('bnw/posts');
        } else {
            redirect('login', 'refresh');
        }
    }
    
    //===================================To Update Edited Post======================================================//
    public function updatepost()
    {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './content/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['query'] = $this->dbmodel->get_posts();
            $username = $this->session->userdata( 'username' );         
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $listOfCategory = $this->dbmodel->get_list_of_category();
            $data["listOfCategory"] = $this->dbmodel->get_list_of_category(); 
            $id = $this->input->post('id');
            $data['query'] = $this->dbmodel->findpost($id);
            
            if(($_SERVER['REQUEST_METHOD'] == 'POST'))
                        {
                        $categoryName = $_POST['selectCategory'];
                        $post_category_info = $this->dbmodel->get_post_category_info($categoryName);
                            foreach($post_category_info as $pid)
                        {
                        $post_category_id= $pid->id;
                             }
                        }
            //set validation rules
             $this->form_validation->set_rules('post_title', 'Page Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('post_content', 'Body', 'required|xss_clean');
            

            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('slide_image')) {
                        $data['error'] = $this->upload->display_errors('file');
                        $id = $this->input->post('id');
                        $data['query'] = $this->dbmodel->findpost($id);
                        $this->load->view('bnw/posts/editPost', $data);
                    } else {
                        //$data = array('upload_data' => $this->upload->data('file'));
                        //$image = $data['upload_data']['file_name'];
                        $id = $this->input->post('id');
                        $post_title = $this->input->post('post_title');
                        $post_content = $this->input->post('post_content');
                        $post_author_info = $this->dbmodel->get_post_author_id($username);
                            foreach($post_author_info as $pid)
                        {    
                            $post_author_id= $pid->id;
                         }
                        $string = $this->input->post('post_content');
                           $post_summary= substr("$string", 0, 100);
                        $post_status = $this->input->post('page_status');
                        $post_comment_status = $this->input->post('comment_status');
                        $post_tags = $this->input->post('post_tags');
                        $allowComment = $this->input->post('allow_comment');
                        $allowLike = $this->input->post('allow_like');
                        $allowShare = $this->input->post('allow_share');
                        $this->dbmodel->update_post($id, $post_title, $post_content, $post_author_id, $post_summary, $post_status, $post_comment_status, $post_tags, $post_category_id, $allowComment, $allowLike, $allowShare);
                        $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                        redirect('bnw/posts/postListing');
                    }
                } else {     
                        $id = $this->input->post('id');
                        $post_title = $this->input->post('post_title');
                        $post_content = $this->input->post('post_content');
                        $post_author_info = $this->dbmodel->get_post_author_id($username);
                            foreach($post_author_info as $pid)
                        {    
                            $post_author_id= $pid->id;
                         }
                         $string = $this->input->post('post_content');
                           $post_summary= substr("$string", 0, 100);
                        $post_status = $this->input->post('page_status');
                        $post_comment_status = $this->input->post('comment_status');
                        $post_tags = $this->input->post('post_tags');
                        $allowComment = $this->input->post('allow_comment');
                        $allowLike = $this->input->post('allow_like');
                        $allowShare = $this->input->post('allow_share');
                        $this->dbmodel->update_post($id, $post_title, $post_content, $post_author_id, $post_summary, $post_status, $post_comment_status, $post_tags, $post_category_id, $allowComment, $allowLike, $allowShare);
                        $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                        redirect('bnw/posts/postListing');
                } 
            } else {
                $id = $this->input->post('id');
                $data['query'] = $this->dbmodel->findpost($id);
                $this->load->view('bnw/posts/editPost', $data);
            }

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }


    //==================================== Page ============================//

    public function pages() {
        if ($this->session->userdata('logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/pages";
            $config["total_rows"] = $this->dbmodel->record_count_page();
            $config["per_page"] = 6;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $pagedata["query"] = $this->dbmodel->get_all_pages($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbmodel->get_meta_data();
           

            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/pages/pageListing', $pagedata);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    //============== ADD PAGE ==============//
    public function addpage() {
        if ($this->session->userdata('logged_in')) {
            $username = $this->session->userdata( 'username' );
            $data['username'] = ($this->session->userdata('logged_in'));
            $config['upload_path'] = './content/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $pagedata['query'] = $this->dbmodel->get_pages();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
             $this->load->helper('date');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $name = $this->input->post('page_name');
            $body = $this->input->post('page_content');
            $page_author_info = $this->dbmodel->get_page_author_id($username);
                 foreach($page_author_info as $id)
                 {    
                 $page_author_id= $id->id;
                 }
                 $string = $this->input->post('page_content');
                  $summary= substr("$string", 0, 100);
            $status = $this->input->post('page_status');
            $order = $this->input->post('page_order');
            $type = $this->input->post('page_type');
            $tags = $this->input->post('page_tags');
            $allowComment = $this->input->post('allow_comment');
            $allowLike = $this->input->post('allow_like');
            $allowShare = $this->input->post('allow_share');
            $this->form_validation->set_rules('page_name', 'Page Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('page_content', 'Body', 'required|xss_clean');
            $this->form_validation->set_rules('page_summary', 'Summary', 'xss_clean');


            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('file')) {
                        $error = array('error' => $this->upload->display_errors('file'));
                        $this->load->view('bnw/pages/addnew', $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data('file'));
                        $image = $data['upload_data']['file_name'];
                        $this->dbmodel->add_new_page($name, $body,$page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare);
                        $this->session->set_flashdata('message', 'One pages added sucessfully');
                        redirect('bnw/pages/pageListing');
                    }
                } else {
                    
                    $name = $this->input->post('page_name');
                    $body = $this->input->post('page_content');
                    $page_author_info = $this->dbmodel->get_page_author_id($username);
                        foreach($page_author_info as $id)
                        {   
                            $page_author_id= $id->id;
                        } 
                        
                      $string = $this->input->post('page_content');
                           $summary= substr("$string", 0, 100);
                         
                    //$summary = $this->input->post('page_summary');
                    $status = $this->input->post('page_status');
                    $order = $this->input->post('page_order');
                    
                    $type = $this->input->post('page_type');
                    $tags = $this->input->post('page_tags');
                    $allowComment = $this->input->post('allow_comment');
                    $allowLike = $this->input->post('allow_like');
                    $allowShare = $this->input->post('allow_share');
                   $this->dbmodel->add_new_page($name, $body,$page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare);

                    $page = $this->dbmodel->find_page_id($name);
                    $this->session->set_flashdata('message', 'One pages added sucessfully');
                    redirect('bnw/pages/pageListing');
                }
            } else {

                $this->load->view('bnw/pages/addnew', $data);
            }

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    //======================EDIT PAGE===============================//

    function editpage($id) {
        if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->findpage($id);
            //$myarray = array('ram'=>'shayam', 'hari'=>'Bikash');
            //echo "<pre>".$myarray;
            //var_dump($data);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['id'] = $id;
           
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/pages/edit', $data);

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    //======================UPDATE EDITED PAGE===============================//


    public function updatepage() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './content/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $username = $this->session->userdata( 'username' );
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
           
            //set validation rules
            $this->form_validation->set_rules('page_name', 'Page Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('page_content', 'Body', 'required|xss_clean');
          //  $this->form_validation->set_rules('page_summary', 'Page summary', 'required|xss_clean');



            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('slide_image')) {
                        $data['error'] = $this->upload->display_errors('file');
                        $id = $this->input->post('id');
                        $data['query'] = $this->dbmodel->findpage($id);
                        $this->load->view('bnw/pages/edit', $data);
                    } else {
                        //$data = array('upload_data' => $this->upload->data('file'));
                        //$image = $data['upload_data']['file_name'];

                        $id = $this->input->post('id');
                        $name = $this->input->post('page_name');
                        $body = $this->input->post('page_content');
                        $page_author_info = $this->dbmodel->get_page_author_id($username);
                        foreach($page_author_info as $pid)
                        {   
                            $page_author_id= $pid->id;
                        }
                         $string = $this->input->post('page_content');
                           $summary= substr("$string", 0, 100);
                        $status = $this->input->post('page_status');
                        $order = $this->input->post('page_order');
                        $type = $this->input->post('page_type');
                        $tags = $this->input->post('page_tags');
                        $allowComment = $this->input->post('allow_comment');
                        $allowLike = $this->input->post('allow_like');
                        $allowShare = $this->input->post('allow_share');
                        $this->dbmodel->update_page($id, $name, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare);
                        $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                        redirect('bnw/pages/pageListing');
                    }
                } else {

                    $id = $this->input->post('id');
                    $name = $this->input->post('page_name');
                    $body = $this->input->post('page_content');
                    $page_author_info = $this->dbmodel->get_page_author_id($username);
                        foreach($page_author_info as $pid)
                        {   
                            $page_author_id= $pid->id;
                        }
                     $string = $this->input->post('page_content');
                           $summary= substr("$string", 0, 100);
                    $status = $this->input->post('page_status');
                    $order = $this->input->post('page_order');
                    $type = $this->input->post('page_type');
                    $tags = $this->input->post('page_tags');
                    $allowComment = $this->input->post('allow_comment');
                    $allowLike = $this->input->post('allow_like');
                    $allowShare = $this->input->post('allow_share');
                    $this->dbmodel->update_page($id, $name, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare);
                    $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                    redirect('bnw/pages/pageListing');
                }
            } else {
                $id = $this->input->post('id');
                $data['query'] = $this->dbmodel->findpage($id);
                $this->load->view('bnw/pages/edit', $data);
            }

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function deletepage($id) {
        if ($this->session->userdata('logged_in')) {
            $this->dbmodel->delete_page($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/pages');
        } else {
            redirect('login', 'refresh');
        }
    }

   /* public function delete_page_image($id) {
        if ($this->session->userdata('logged_in')) {
            $this->dbmodel->delete_page_image($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/pages');
        } else {
            redirect('login', 'refresh');
        }
    }*/

    //============================================================================//
    //=============================USER===========================================//
    //============================================================================//
    public function users() {
        if ($this->session->userdata('logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/users";
            $config["total_rows"] = $this->dbmodel->record_count_user();
            $config["per_user"] = 6;


            $this->pagination->initialize($config);

            $user = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbmodel->get_all_user($config["per_user"], $user);
            $data["links"] = $this->pagination->create_links();
            $data['query'] = $this->dbmodel->get_user();
            $data['meta'] = $this->dbmodel->get_meta_data();
            
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/users/userListing', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function adduser() {
        if ($this->session->userdata('logged_in')) {
            
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('user_name', 'User Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('user_fname', 'First Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('user_lname', 'Last Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('user_email', 'User email', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('user_pass', 'Password', 'required|xss_clean|md5|max_length[200]');
            $this->form_validation->set_rules('user_type', 'User Type', 'required|xss_clean|max_length[200]');   
            if ($this->form_validation->run() == FALSE) {

                $this->load->view('bnw/users/addNew');
            } else {

                //if valid

                $name = $this->input->post('user_name');
                $fname = $this->input->post('user_fname');
                $lname = $this->input->post('user_lname');
                $email = $this->input->post('user_email');
                $pass = $this->input->post('user_pass');
                $status = $this->input->post('user_status');
                $user_type = $this->input->post('user_type');
                $this->dbmodel->add_new_user($name, $fname, $lname, $email, $pass, $status, $user_type);
                $this->session->set_flashdata('message', 'One user added sucessfully');
                redirect('bnw/users/userListing');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login', 'refresh');
        }
    }

    public function edituser($id) {
        if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->finduser($id);
            $data['meta'] = $this->dbmodel->get_meta_data();
            //var_dump($data);
            
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/users/editUser', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function updateuser() {
        if ($this->session->userdata('logged_in')) {
           
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('user_name', 'User Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('user_fname', 'First Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('user_lname', 'Last Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('user_email', 'User email', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('user_pass', 'Password', 'required|xss_clean|md5|max_length[200]');
            $this->form_validation->set_rules('user_type', 'User Type', 'required|xss_clean|max_length[200]');

            if ($this->form_validation->run() == FALSE) {
                //if not valid
                $id = $this->input->post('id');
                $data['query'] = $this->dbmodel->finduser($id);
                $this->load->view('bnw/user/userListing', $data);
            } else {
                //if valid
                $id = $this->input->post('id');
                $name = $this->input->post('user_name');
                $fname = $this->input->post('user_fname');
                $lname = $this->input->post('user_lname');
                $email = $this->input->post('user_email');
                $pass = $this->input->post('user_pass');
                $status = $this->input->post('user_status');
                $user_type = $this->input->post('user_type');
                $this->dbmodel->update_user($id, $name, $fname, $lname, $email, $pass, $status, $user_type);
                $this->session->set_flashdata('message', 'User data Modified Sucessfully');

                redirect('bnw/users/userListing');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function deleteuser($id) {
        if ($this->session->userdata('logged_in')) {
            $this->dbmodel->delete_user($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/users');
        } else {
            redirect('login', 'refresh');
        }
    }
    
    public function profile(){
        if ($this->session->userdata('logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/users";
            $config["total_rows"] = $this->dbmodel->record_count_user();
            $config["per_user"] = 6;


            $this->pagination->initialize($config);

            $user = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbmodel->get_all_user($config["per_user"], $user);
            $data["links"] = $this->pagination->create_links();
            $username=  $this->session->userdata('username');
            $data['query'] = $this->dbmodel->get_user_info($username);
            $data['meta'] = $this->dbmodel->get_meta_data();
            
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/users/userProfiler', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    //=========================================================================================================
    //====================================MEDIA================================================================
    //=========================================================================================================

    public function media() {
        if ($this->session->userdata('logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/media";
            $config["total_rows"] = $this->dbmodel->record_count_user();
            $config["per_media"] = 6;
            $this->pagination->initialize($config);
            $media = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbmodel->get_all_user($config["per_media"], $media);
            $data["links"] = $this->pagination->create_links();
            $data['query'] = $this->dbmodel->get_all_media();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/media/mediaListing', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    //===============================to add media=================================================
    public function addmedia() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './content/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|ppt|odt|pptx|docx|xls|xlsx|key';
            $config['max_size'] = '2000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);
            $listOfAlbum = $this->dbmodel->get_list_of_album();
            $data["listOfAlbum"] = $this->dbmodel->get_list_of_album();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            
            if(($_SERVER['REQUEST_METHOD'] == 'POST'))
            {
                $mediaName = $_POST['selectAlbum'];
                 $media_association_info = $this->dbmodel->get_media_association_info($mediaName);
                foreach($media_association_info as $id)
                {
                    $media_association_id= $id->id;
                }
            }
            $this->form_validation->set_rules('media_name', 'media Name', 'required|xss_clean|max_length[200]');
            //$this->form_validation->set_rules('media_type', 'Type of Media', 'required|xss_clean|max_length[200]');


            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file_name'))) {
                $data['error'] = $this->upload->display_errors();
                  
                $this->load->view('bnw/media/addNew', $data);
            } else {

                //if valid
                $data = array('upload_data' => $this->upload->data('file'));
                $medianame = $this->input->post('media_name');
                $mediatype = $data['upload_data']['file_name'];
                $medialink = base_url().'content/images/'.$mediatype;
                $this->dbmodel->add_new_media($medianame, $mediatype, $media_association_id, $medialink);
                $this->session->set_flashdata('message', 'One media added sucessfully');
                redirect('bnw/media/mediaListing');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login', 'refresh');
        }
    }

    //==================================To edit media==================================================

    public function editmedia($id) {
        if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->findmedia($id);
            $data['meta'] = $this->dbmodel->get_meta_data();
            
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/media/editMedia', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    //======================================To update edited media=========================================

    function updatemedia() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './content/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|ppt|odt|pptx|docx|xls|xlsx|key.';
            $config['max_size'] = '2000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);
            $listOfAlbum = $this->dbmodel->get_list_of_album();
            $data["listOfAlbum"] = $this->dbmodel->get_list_of_album();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            
            if(($_SERVER['REQUEST_METHOD'] == 'POST'))
            {
                $mediaName = $_POST['selectAlbum'];
                 $media_association_info = $this->dbmodel->get_media_association_info($mediaName);
                foreach($media_association_info as $id)
                {
                    $media_association_id= $id->id;
                }
            }
            $this->form_validation->set_rules('media_name', 'media Name', 'required|xss_clean|max_length[200]');
            //$this->form_validation->set_rules('media_type', 'Type of Media', 'required|xss_clean|max_length[200]');

            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file_name'))) {
                $data['error'] = $this->upload->display_errors();
                
                
                
                //if not valid
                $data['query'] = $this->dbmodel->findmedia($id);
                $this->load->view('bnw/media/mediaListing', $data);
            } else {
                //if valid
                $id = $this->input->post('id');
                $data = array('upload_data' => $this->upload->data('file'));
                $medianame = $this->input->post('media_name');
                $mediatype = $data['upload_data']['file_name'];
                $medialink = $this->input->post('media_link');
                $this->dbmodel->update_media($id, $medianame, $mediatype, $media_association_id, $medialink);
                $this->session->set_flashdata('message', 'Media data Modified Sucessfully');

                redirect('bnw/media/mediaListing');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function deletemedia($id) {
        if ($this->session->userdata('logged_in')) {
            $this->dbmodel->delete_media($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/media');
        } else {
            redirect('login', 'refresh');
        }
    }
    
    //==========================================================================================================//
    //===================================ALBUM==================================================================//
    //==========================================================================================================//
    
    public function album() {
        if ($this->session->userdata('logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/album";
            $config["total_rows"] = $this->dbmodel->record_count_album();
            $config["per_user"] = 6;
            $this->pagination->initialize($config);

            $user = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbmodel->get_all_user($config["per_user"], $user);
            $data["links"] = $this->pagination->create_links();
            $data['query'] = $this->dbmodel->get_album();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('bnw/album/index');
            $this->load->view('bnw/templates/footer', $data);
        }
    }

    public function addalbum() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './content/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['query'] = $this->dbmodel->get_album();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('album_name', 'Album Name', 'required|xss_clean|max_length[200]');

            if (($this->form_validation->run() == FALSE)) {

                //if not valid
                $error = "Enter Album Name";


                $this->load->view('bnw/album/index', $error);
            } else {

                //if valid
                //$imagedata = Array($this->upload->data());
                $name = $this->input->post('album_name');

                $this->dbmodel->add_new_album($name);
                $this->session->set_flashdata('message', 'One Album added sucessfully');
                redirect('bnw/album/index');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login', 'refresh');
        }
    }
    
    //===============================To Add Photo================================================================//
    public function addphoto() {
        if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $config['upload_path'] = './content/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            
            $albumid = $this->input->post('id');
            $data['query'] = $this->dbmodel->get_album();
            
            
            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload())) {
                $data['error'] = $this->upload->display_errors();
                
                $this->load->view('bnw/album/index', $data);
            } else {

                //if valid
                $data = array('upload_data' => $this->upload->data());
                //$photoid= $data->this->input->post('id');
                $mediatype = $data['upload_data']['file_name'];
                $medianame = $this->input->post('title');
                $albumid = $this->input->post('id');
                $medialink = $this->input->post('media_link');
                $this->dbmodel->add_new_photo($medianame, $mediatype, $albumid, $medialink);
                $this->session->set_flashdata('message', 'One photo added sucessfully');
                redirect('bnw/addalbum');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login', 'refresh');
        }
    }

    public function deletephoto($id) {
       
        if ($this->session->userdata('logged_in')) {
           
            $this->dbmodel->delete_photo($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/addalbum');
        } else {
            redirect('login', 'refresh');
        }
    }
    
    //============================================================================================================//
    //====================================SLIDER==================================================================//
    //============================================================================================================/

    public function slider() {
        if ($this->session->userdata('logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/slider";
            $config["total_rows"] = $this->dbmodel->record_count_slider();
            $config["per_page"] = 6;
            //$config["uri_segment"] = 3;

            $this->pagination->initialize($config);

            $slide = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbmodel->get_slider($config["per_page"], $slide);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/slider/index', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function addslider() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './content/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);

            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('slide_name', 'Title', 'required|xss_clean|max_length[200]');
            //$this->form_validation->set_rules('slide_image', 'Image', 'required|xss_clean|max_length[200]');


            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file_name'))) {
                $data['error'] = $this->upload->display_errors();
                  
                $this->load->view('bnw/slider/addnew', $data);
            } else {

                //if valid
                $data = array('upload_data' => $this->upload->data('file'));
                $slidename = $this->input->post('slide_name');
                $slideimage = $data['upload_data']['file_name'];
                $slidecontent = $this->input->post('slide_content');
                
                $this->dbmodel->add_new_slider($slidename, $slideimage, $slidecontent);
                $this->session->set_flashdata('message', 'One slider added sucessfully');
                redirect('bnw/slider');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login', 'refresh');
        }
    }

    public function editslider($id) {
        if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->findslider($id);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/slider/edit', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function updateslider() {
         if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './content/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);

            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('slide_name', 'Title', 'required|xss_clean|max_length[200]');
            //$this->form_validation->set_rules('slide_image', 'Image', 'required|xss_clean|max_length[200]');


            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file_name'))) {
                $data['error'] = $this->upload->display_errors();
                $id = $this->input->post('id');
                $data['query'] = $this->dbmodel->findslider($id);  
                $this->load->view('bnw/slider/edit', $data);
            } else {

                //if valid
                $id = $this->input->post('id');
                $data = array('upload_data' => $this->upload->data('file'));
                $slidename = $this->input->post('slide_name');
                $slideimage = $data['upload_data']['file_name'];
                $slidecontent = $this->input->post('slide_content');
                
                $this->dbmodel->update_slider($id, $slidename, $slideimage, $slidecontent);
                $this->session->set_flashdata('message', 'One slider added sucessfully');
                redirect('bnw/slider');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login', 'refresh');
        }
    }

    public function deleteslider($id) {
        if ($this->session->userdata('logged_in')) {
            $this->dbmodel->delete_slider($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/slider');
        } else {
            redirect('login', 'refresh');
        }
    }

    //==========================================================================================================//
    //===============================Setting/ Gadgets===========================================================//
    //==========================================================================================================//
    
     public function gadgets() {
        if ($this->session->userdata('logged_in')) {
            //$data['username'] = Array($this->session->userdata('logged_in'));
            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/pages";
            $config["total_rows"] = $this->dbmodel->record_count_gadget();
            $config["per_page"] = 6;
            //$config["uri_segment"] = 3;

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data["query"] = $this->dbmodel->get_gadgets($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data['query'] = $this->dbmodel->get_gadgets();
            $data['meta'] = $this->dbmodel->get_meta_data();
           
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/gadget/index', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function editgadget($id) {
        if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->findgadget($id);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/gadget/edit', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    function deletegadget($id) {
        if ($this->session->userdata('logged_in')) {
            $this->dbmodel->delete_gadget($id);
            redirect('bnw/gadget');
        } else {
            redirect('login', 'refresh');
        }
    }

    function updategadget() {
        if ($this->session->userdata('logged_in')) {
            $header = "bnw/templates/header";
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view($header, $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                //if not valid
                $data['query'] = $this->dbmodel->findgadget($gid);
                $this->load->view('bnw/gadget/edit', $data);
            } else {
                //if valid
                $type = $this->input->post('type');
                $id = $this->input->post('id');
                $title = $this->input->post('title');
                $body = $this->input->post('body');
                $status = $this->input->post('status');
                $this->dbmodel->update_gadget($id, $title, $body, $status, $type);
                $this->session->set_flashdata('message', 'Data Modified Sucessfully');

                redirect('bnw/gadget');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    function addgadget() {
        if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/header";
            $this->load->view($header, $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                //if not valid
                $this->load->view('bnw/gadget/addnew');
            } else {
                //if valid
                $type = $this->input->post('type');
                $name = $this->input->post('title');
                $body = $this->input->post('body');
                $status = $this->input->post('status');
                $this->dbmodel->add_new_gadget($name, $body, $status, $type);
                $this->session->set_flashdata('message', 'One gadget added sucessfully');
                redirect('bnw/gadget');
            }

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    //============================================================================================================//
    //================================Settings/ Setup ============================================================//
    //============================================================================================================//
    
    public function setup() {
        if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/";
            $this->load->view($header . 'header', $data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/setup/index', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function setupupdate() {
        if ($this->session->userdata('logged_in')) {
            
            $config['upload_path'] = './content/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '786';
            $this->load->library('upload', $config);

            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('url', 'Url', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
            $this->form_validation->set_rules('keyword', 'Keyword', 'required|xss_clean');
            $this->form_validation->set_rules('description', 'Description', 'required|xss_clean');
            if (($this->form_validation->run() == FALSE|| (!$this->upload->do_upload('file_name')))) {
                $data['error'] = $this->upload->display_errors();
                $data['meta'] = $this->dbmodel->get_meta_data();
                $header = "bnw/templates/";
                $this->load->view($header . 'header', $data);
                $this->load->view($header . 'menu');
                $this->load->view('bnw/setup/index', $data);
                $this->load->view('bnw/templates/footer', $data);
            } else {
                $data = array('upload_data' => $this->upload->data('file'));
                $favicone = $data['upload_data']['file_name'];
                
                $url = $this->input->post('url');
                $title = $this->input->post('title');
                $keyword = $this->input->post('keyword');
                $description = $this->input->post('description');
                $this->dbmodel->update_meta_data($url, $title, $keyword, $description,$favicone);
                redirect('bnw/setup');
            }
        } else {
            redirect('login', 'refresh');
        }
    }
    
    public function header()
 {
     if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $set['query'] = $this->dbmodel->get_design_setup();
           // var_dump($set);
            $this->load->view("bnw/templates/header" , $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/setup/addHeader', $set);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
 }
 
 
 public function headerupdate(){
     if ($this->session->userdata('logged_in')) {
                     
            $config['upload_path'] = './content/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '786';

            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['query'] = $this->dbmodel->get_design_setup();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('header_title', 'Title', 'required|xss_clean|max_length[200]');
            
            
            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file_name'))) {
                //die('not image');
                $data['error'] = $this->upload->display_errors();
                
                $this->load->view('bnw/setup/addHeader', $data);
            } else {

                //if valid
                $data = array('upload_data' => $this->upload->data('file'));
                
                $headerTitle = $this->input->post('header_title');
                $headerLogo = $data['upload_data']['file_name'];
                //var_dump($headerLogo);
                $headerDescription = $this->input->post('header_description');
                $headerBgColor = $this->input->post('header_bgcolor');
                $this->dbmodel->update_design_header_setup($headerTitle, $headerLogo, $headerDescription, $headerBgColor);
                $this->session->set_flashdata('message', 'Header setting done sucessfully');
                redirect('bnw');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login', 'refresh');
        
     }
 }


 public function sidebar()
 {
     if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $set['query'] = $this->dbmodel->get_design_setup();
            $this->load->view("bnw/templates/header" , $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/setup/addSidebar', $set);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
 }
 
 public function sidebarupdate(){
     if ($this->session->userdata('logged_in')) {

            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('sidebar_title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('sidebar_description', 'Description', 'required|xss_clean');
            $this->form_validation->set_rules('sidebar_bgcolor', 'Background Color', 'required|xss_clean');
           // $this->form_validation->set_rules('header_bgcolor', 'Description', 'required|xss_clean');
            if (($this->form_validation->run() == FALSE)) {

                $data['meta'] = $this->dbmodel->get_meta_data();
                $this->load->view("bnw/templates/header" , $data);
                $this->load->view("bnw/templates/menu");
                $this->load->view('bnw/setup/addSidebar');
                $this->load->view('bnw/templates/footer', $data);
            } else {
                $sideBarTitle = $this->input->post('sidebar_title');
                $sideBarDescription = $this->input->post('sidebar_description');
                $sideBarBgColor = $this->input->post('sidebar_bgcolor');
                
                $this->dbmodel->update_design_sidebar_setup($sideBarTitle, $sideBarDescription, $sideBarBgColor);
                redirect('bnw');
            }
        } else {
            redirect('login', 'refresh');
        }
 }
 
 //=====================================Miscellaneous Setting===============================================/
 public function miscsetting()
 {
     if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $set['query'] = $this->dbmodel->get_design_setup();
            $this->load->view("bnw/templates/header" , $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/setup/miscSetting', $set);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
 }
 
 public function miscsettingupdate(){
     if ($this->session->userdata('logged_in')) {

            $this->load->library(array('form_validation', 'session'));
            //$this->form_validation->set_rules('sidebar_title', 'Title', 'required|xss_clean|max_length[200]');
            //$this->form_validation->set_rules('sidebar_description', 'Description', 'required|xss_clean');
            //$this->form_validation->set_rules('sidebar_bgcolor', 'Background Color', 'required|xss_clean');
           // $this->form_validation->set_rules('header_bgcolor', 'Description', 'required|xss_clean');
            if (($this->form_validation->run() == FALSE)) {

                $data['meta'] = $this->dbmodel->get_meta_data();
                $this->load->view("bnw/templates/header" , $data);
                $this->load->view("bnw/templates/menu");
                $this->load->view('bnw/setup/miscSetting');
                $this->load->view('bnw/templates/footer', $data);
            } else {
                $allowComment = $this->input->post('allow_comment');
                $allowLike = $this->input->post('allow_like');
                $allowShare = $this->input->post('allow_share');
                
                $this->dbmodel->update_misc_setting($allowComment, $allowLike, $allowShare);
                redirect('bnw');
            }
        } else {
            redirect('login', 'refresh');
        }
 }
 
 
    //=========================notice==============================//

   /* public function notice() {

        if ($this->session->userdata('logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/notice";
            $config["total_rows"] = $this->dbmodel->record_count_notice();
            $config["per_page"] = 6;
            //$config["uri_segment"] = 3;

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data["query"] = $this->dbmodel->get_all_notices($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            //$data['query'] = $this->dbmodel->get_all_notices();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/";

            $this->load->view($header . 'header', $data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/notice/index', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function addnotice() {
        if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/header";
            $this->load->view($header, $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                //if not valid
                $this->load->view('bnw/notice/addnew');
            } else {
                //if valid
                $type = $this->input->post('type');
                $name = $this->input->post('title');
                $body = $this->input->post('body');
                $status = $this->input->post('status');
                $this->dbmodel->add_new_notices($name, $body, $status, $type);
                $this->session->set_flashdata('message', 'One notice added sucessfully');
                redirect('bnw/notice');
            }

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function editnotice($nid) {
        if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->findnotice($nid);
            $data['meta'] = $this->dbmodel->get_meta_data();
            //$data['id'] = $pid;
            $header = "bnw/templates/";
            $this->load->view($header . 'header', $data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/notice/edit', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function updatenotice() {
        if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/header";
            $this->load->view($header, $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                //if not valid
                $this->load->view('bnw/notice/edit');
            } else {
                //if valid
                $id = $this->input->post('id');
                $title = $this->input->post('title');
                $body = $this->input->post('body');
                $status = $this->input->post('status');
                $this->dbmodel->update_notice($id, $title, $body, $status);
                $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                redirect('bnw/notice');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function deletenotice($nid) {
        if ($this->session->userdata('logged_in')) {
            $this->dbmodel->delete_notice($nid);
            redirect('bnw/notice');
        } else {
            redirect('login', 'refresh');
        }
    }

    //=======================Activities controler=========================//
    public function activities() {

        if ($this->session->userdata('logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/activities";
            $config["total_rows"] = $this->dbmodel->record_count_activities();
            $config["per_page"] = 6;
            //$config["uri_segment"] = 3;

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbmodel->get_all_activities($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();

            //$data['query'] = $this->dbmodel->get_all_activities();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/";

            $this->load->view($header . 'header', $data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/activities/index', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function addactivity() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('file')) {
                        $error = array('error' => $this->upload->display_errors('file'));
                        $this->load->view('bnw/activities/addnew', $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $image = $data['upload_data']['file_name'];
                        //$imagedata = Array($this->upload->data());
                        $name = $this->input->post('title');
                        $body = $this->input->post('body');
                        $type = $this->input->post('type');
                        //$image = $imagedata['file_name'];
                        $status = $this->input->post('status');
                        $this->dbmodel->add_new_activities($name, $body, $image, $status, $type);
                        $this->session->set_flashdata('message', 'One Activities added sucessfully');
                        redirect('bnw/activities');
                    }
                } else {
                    $image = "";
                    $name = $this->input->post('title');
                    $body = $this->input->post('body');
                    //$image = $imagedata['file_name'];
                    $status = $this->input->post('status');
                    $type = $this->input->post('type');
                    $this->dbmodel->add_new_activities($name, $body, $image, $status, $type);
                    $this->session->set_flashdata('message', 'One Activities added sucessfully');
                    redirect('bnw/activities');
                }
            } else {

                $this->load->view('bnw/activities/addnew');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login', 'refresh');
        }
    }

    function editactivities($id) {
        if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->findactivities($id);
            $data['meta'] = $this->dbmodel->get_meta_data();
            //$data['id'] = $pid;
            $header = "bnw/templates/";
            $this->load->view($header . 'header', $data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/activities/edit', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login', 'refresh');
        }
    }

    public function updateactivities() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/header";
            $this->load->view($header, $data);
            $this->load->view('bnw/templates/menu');
            $id = $this->input->post('id');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');
            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('file')) {
                        $error = array('error' => $this->upload->display_errors('file'));
                        $this->load->view('bnw/activities/edit', $error);
                    } else {
                        //if valid


                        $data = array('upload_data' => $this->upload->data());
                        $image = $data['upload_data']['file_name'];
                        $id = $this->input->post('id');
                        $title = $this->input->post('title');
                        $body = $this->input->post('body');
                        $status = $this->input->post('status');
                        $this->dbmodel->update_activities($id, $title, $body, $image, $status);
                        $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                        redirect('bnw/activities');
                    }
                } else {
                    $image = "";
                    $id = $this->input->post('id');
                    $title = $this->input->post('title');
                    $body = $this->input->post('body');
                    $status = $this->input->post('status');
                    $this->dbmodel->update_activities($id, $title, $body, $image, $status);
                    $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                    redirect('bnw/activities');
                }
            } else {
                $id = $this->input->post('id');
                $data['query'] = $this->dbmodel->findactivities($id);
                $this->load->view('bnw/activities/edit', $data);
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    function deleteactivities($aid) {
        if ($this->session->userdata('logged_in')) {

            $this->dbmodel->deleteactivities($aid);
            $this->session->set_flashdata('message', 'One Acticity deleted sucessfully');
            redirect('bnw/activities');
        } else {

            redirect('login', 'refresh');
        }
    }

    //==========================Result management controler

    public function download() {
        if ($this->session->userdata('logged_in')) {
            $data['username'] = Array($this->session->userdata('logged_in'));
            $data['query'] = $this->dbmodel->get_documents();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/";
            $this->load->view($header . 'header', $data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/download/index', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function upload() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './downloads/';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '500';
            //$config['max_width'] = '1024';
            //$config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            // $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload())) {

                //if not valid

                $error = array('error' => $this->upload->display_errors());
                $this->load->view('bnw/download/upload_form', $error);
            } else {

                //if valid
                $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];
                //$imagedata = Array($this->upload->data());
                $name = $this->input->post('title');
                //$body = $this->input->post('body');
                //$image = $imagedata['file_name'];
                $status = $this->input->post('status');
                $this->dbmodel->upload_documents($name, $image, $status);
                $this->session->set_flashdata('message', 'One Document added sucessfully');
                redirect('bnw/download');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login', 'refresh');
        }
    }

    public function deletedocument($id) {
        if ($this->session->userdata('logged_in')) {
            $this->dbmodel->delete_document($id);
            $this->session->set_flashdata('message', 'One Document deleted sucessfully');
            redirect('bnw/download');
        } else {

            redirect('login', 'refresh');
        }
    }
*/
    //======================================Dashboard setup page
    

    //alumnae controlers
    

    //----------------------------album----------------
    //============album=====


    
    public function add_new_album() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './content/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['query'] = $this->dbmodel->get_album();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('album_name', 'Album Name', 'required|xss_clean|max_length[200]');

            if (($this->form_validation->run() == FALSE)) {

                //if not valid
                $error = "Enter Album Name";


                $this->load->view('bnw/album/index', $error);
            } else {

                //if valid
                //$imagedata = Array($this->upload->data());
                $name = $this->input->post('album_name');

                $this->dbmodel->add_new_album($name);
                $this->session->set_flashdata('message', 'One Album added sucessfully');
                redirect('bnw/album/index');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login', 'refresh');
        }
    }

    function delete_album($id) {
        if ($this->session->userdata('logged_in')) {
            $this->dbmodel->delete_photo($id);
            $this->dbmodel->delete_album($id);
            redirect('bnw/album');
        } else {
            redirect('login', 'refresh');
        }
    }

    function editalbum($aid) {
        if ($this->session->userdata('logged_in')) {
            $this->dbmodel->edit_album($aid);
            redirect('bnw/album');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function photos($id) {

        $data['query'] = $this->dbmodel->get_media($id);
        $data['meta'] = $this->dbmodel->get_meta_data();
        $data['id'] = $id;
        $this->load->view('bnw/templates/header', $data);
        $this->load->view('bnw/templates/menu');
        $this->load->view('bnw/album/gallery', $data);
        $this->load->view('bnw/templates/footer', $data);
    }

    //--------------------------------gallery---------------

    public function gallery() {
        if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->get_all_photos();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/gallery/index', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    
    

    

    // ==================  MENU  ============================ //

    public function menu() {

        if ($this->session->userdata('logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/menu";
            $config["total_rows"] = $this->dbmodel->record_count_menu();
            $config["per_page"] = 6;
            //$config["uri_segment"] = 3;

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbmodel->get_menu($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            // $data['query'] = $this->dbmodel->get_menu();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/menu/index', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function addmenu() {
        if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data["links"] = $this->pagination->create_links();
            $data["query"] = $this->dbmodel->get_menu();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('menu_name', 'Name', 'required|xss_clean|max_length[200]');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('bnw/menu/addnew');
            } else {

                //if valid

                $menuname = $this->input->post('menu_name');
                $this->dbmodel->add_new_menu( $menuname);
                $this->session->set_flashdata('message', 'One menu added sucessfully');
                redirect('bnw/menu/index');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login', 'refresh');
        }
    }

    public function editmenu($mid) {
        if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->findmenu($mid);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/menu/edit', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function updatemenu() {
        if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            
            $this->load->view("bnw/templates/header", $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            
            $this->load->library(array('form_validation', 'session'));
            $id = $this->input->post('id');
            $data['query'] = $this->dbmodel->findmenu($id);
            //set validation rules
            $this->form_validation->set_rules('menu_name', 'Name', 'required|xss_clean|max_length[200]');


            if ($this->form_validation->run() == FALSE) {
                //if not valid
                $data['query'] = $this->dbmodel->findmenu($id);
                $id = $this->input->post('id');
                $this->load->view('bnw/menu/edit', $data);
            } else {
                //if valid
                $id = $this->input->post('id');
                $menuname = $this->input->post('menu_name');
                $this->dbmodel->update_menu($id, $menuname);
                $this->session->set_flashdata('message', 'Menu Modified Sucessfully');

                redirect('bnw/menu/index');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function deletemenu($id) {
        if ($this->session->userdata('logged_in')) {
            $this->dbmodel->delete_menu($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/menu/index');
        } else {
            redirect('login', 'refresh');
        }
    }

   /* public function blog() {
        if ($this->session->userdata('logged_in')) {
            $data['username'] = Array($this->session->userdata('logged_in'));
            $data['query'] = $this->dbmodel->get_blog();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/blogs/index', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function uploads() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './downloads/';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '500';
            //$config['max_width'] = '1024';
            //$config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            // $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload())) {

                //if not valid

                $error = array('error' => $this->upload->display_errors());
                $this->load->view('bnw/blogs/upload_form', $error);
            } else {

                //if valid
                $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];
                //$imagedata = Array($this->upload->data());
                $name = $this->input->post('title');
                //$body = $this->input->post('body');
                //$image = $imagedata['file_name'];
                $status = $this->input->post('status');
                $this->dbmodel->upload_blog($name, $image, $status);
                $this->session->set_flashdata('message', 'One Document added sucessfully');
                redirect('bnw/blog');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login', 'refresh');
        }
    }

    public function deleteblog($id) {
        if ($this->session->userdata('logged_in')) {
            $this->dbmodel->deleteblog($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/blog');
        } else {
            redirect('login', 'refresh');
        }
    }
   
    */
   /* public function test()
    {
         function query($parent_id) { //function to run a query
	//$query = mysql_query ( "SELECT * FROM menus WHERE parent_id=$parent_id" );
        $query = $this->dbmodel->get_list_by_parent_id($parent_id);
	return $query;
        
        }
   

function has_child($query) { //This function checks if the menus has childs or not
	$rows = mysql_num_rows ( $query );
	if ($rows > 0) {
		return true;
	} else {
		return false;
	}
}
function fetch_menu($query) {
	while ( $result = mysql_fetch_array ( $query ) ) {
		$menu_id = $result ['id'];
		$menu_name = $result ['menu_name'];
		$menu_link = $result ['menu_link'];
		echo "<li  class='has-sub '><a href='{$menu_link}'><span>{$menu_name}</span></a>";
		if (has_child ( query ( $menu_id ) )) {
			echo "<ul>";
			$this->fetch_menu( $this->dbmodel->get_list_by_parent_id($menu_id ) );
			echo "</ul>";
		}
		echo "</li>";
	}
}
fetch_menu (query(0)); //call this function with 0 parent id

		
    
    }*/
    
 
    }