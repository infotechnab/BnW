<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dbmodel');
        $this->load->model('dbdashboard');
        $this->load->model('dbsetting');
        $this->load->model('dbpage');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
    }

    public function index() {
        redirect('bnw');
    }

    //========================== START MENU ===========================================//
    
    public function addmenu() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data["links"] = $this->pagination->create_links();
            $data["query"] = $this->dbdashboard->get_menu();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('menu_name', 'Name', 'required|xss_clean|max_length[200]');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('bnw/menu/addnew');
            } else {
                $menuname = $this->input->post('menu_name');
                $this->dbdashboard->add_new_menu($menuname);
                $this->session->set_flashdata('message', 'One menu added sucessfully');
                redirect('dashboard/addmenu');
            }
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function editmenu($mid = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbdashboard->findmenu($mid);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/menu/edit', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function updatemenu() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();

            $this->load->view("bnw/templates/header", $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');

            $this->load->library(array('form_validation', 'session'));
            $id = $this->input->post('id');
            $data['query'] = $this->dbdashboard->findmenu($id);
            //set validation rules
            $this->form_validation->set_rules('menu_name', 'Name', 'required|xss_clean|max_length[200]');


            if ($this->form_validation->run() == FALSE) {
                //if not valid
                $data['query'] = $this->dbdashboard->findmenu($id);
                $id = $this->input->post('id');
                $this->load->view('bnw/menu/edit', $data);
            } else {
                //if valid
                $id = $this->input->post('id');
                $menuname = $this->input->post('menu_name');
                $this->dbdashboard->update_menu($id, $menuname);
                $this->session->set_flashdata('message', 'Menu Modified Sucessfully');

                redirect('dashboard/addmenu');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function deletemenu($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $this->dbdashboard->delete_menu($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('dashboard/addmenu');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    //=========================== CLOSE MENU ================================================//
    
    

    //=========================== START NAVIGATION ========================================//
    
    public function navigation() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config["total_rows"] = $this->dbdashboard->record_count_navigation();
          
            $config["per_navigation"] = 6;
            $this->pagination->initialize($config);
            $navigation = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data["query"] = $this->dbdashboard->get_navigation($config["per_navigation"], $navigation);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data["listOfPage"] = $this->dbpage->get_list_of_pages();
            $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
            $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
            $data["listOfNavigation"] = $this->dbdashboard->get_list_of_navigation();
            $data["listOfNavigationID"] = $this->dbdashboard->get_list_of_navigationID();

            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('bnw/navigation/listOfItems', $data);
           
        } else {
            redirect('login/index/?url='.$url, 'refresh');
        }
    }
    
    public function editnavigation($id=0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            
          
                
            
            $data['query'] = $this->dbdashboard->findnavigation($id);

            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/navigation/editNavigation', $data);
            
        }
       
        else {
            redirect('login/index/?url='.$url, 'refresh');
        }
    }
    
    public function showNavigation($id=0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();

            $data['query'] = $this->dbdashboard->get_list_of_selected_menu_navigation($id);
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/navigation/navigationListing', $data);
           
        } else {
            redirect('login/index/?url='.$url, 'refresh');
        }
    }
    
    function manageNavigation($id=0)
    {
        $url = current_url();
         if ($this->session->userdata('admin_logged_in')) {
         $data['meta'] = $this->dbsetting->get_meta_data();

            $data['query'] = $this->dbdashboard->get_list_of_selected_menu_navigation($id);
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/navigation/manageNavigation', $data);
            
             
             } else {
            redirect('login/index/?url='.$url, 'refresh');
        }
         
    }
    
    function up($id=0)
    {
        $url = current_url();
       if ($this->session->userdata('admin_logged_in')) {
          
         if($id == !0)
         {
           $parent = $this->dbdashboard->get_parent_id($id);
         //  var_dump($parent);
           if(!empty($parent))
           {
           foreach ($parent as $pid)
           {
               $parentID = $pid->parent_id;
           }
           
           $getID = $this->dbdashboard->get_data($parentID);
           
          $previousID = 0;
          $tempID = 999;
      foreach ($getID as $data)
      {
          if($id == $data->id )
          {
              break;
          }
          else
          {
             
              $previousID = $data->id;
          }
      }
           //die($previousID." ".$tempID);
           if($previousID !==0)
           {
              // die('not work');
           $updateID = $this->dbdashboard->update_navID($id , $tempID);
           $updateParentID = $this->dbdashboard->update_navParentID($id , $tempID);
           $updatePreviousID = $this->dbdashboard->update_previousID($id,$previousID);
           $updatePreviousParentID = $this->dbdashboard->update_Previous_ParentID($id,$previousID);
           $updateUP = $this->dbdashboard->update_up($tempID,$previousID);
           $updateParentID_UP = $this->dbdashboard->update_parentID_UP($tempID,$previousID);
           
           redirect('dashboard/manageNavigation/4');
           }
           else
           {
           ///   echo " sdlfjsdajfsldjf";
           $this->session->set_flashdata('message', 'Upper level not available');
           redirect('dashboard/manageNavigation/4');
           
           }
         } 
         else {
            
             $data['token_error'] = 'Page not found';
               
               $data['meta'] = $this->dbsetting->get_meta_data();

            $data['query'] = $this->dbdashboard->get_list_of_selected_menu_navigation($id);
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/templetes/error_landing_page', $data);
            
         }
       }
    else {
           
            $data['token_error'] = 'Page not found';
               
               $data['meta'] = $this->dbsetting->get_meta_data();

            $data['query'] = $this->dbdashboard->get_list_of_selected_menu_navigation($id);
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/templetes/error_landing_page', $data);
            
     
            }
       }
       
       else
       {
            redirect('login/index/?url='.$url, 'refresh');
       } 
    }
    
    function down($id)
    { $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
         
            if($id ==!0)
            {
             $parent = $this->dbdashboard->get_parent_id_down($id);
         //  var_dump($parent);
              if(!empty($parent))
           {
           foreach ($parent as $pid)
           {
               $parentID = $pid->parent_id;
           }
           
           $getID = $this->dbdashboard->get_data_down($parentID);
          $previousID = 0;
          $tempID = 999;
      foreach ($getID as $data)
      {
          if($id == $data->id )
          {
              break;
          }
          else
          {
             
              $previousID = $data->id;
          }
      }
          // die($previousID);
           
           if($previousID !==0)
           {
              // die('not work');
           $updateID = $this->dbdashboard->update_navID($id , $tempID);
           $updateParentID = $this->dbdashboard->update_navParentID($id , $tempID);
           $updatePreviousID = $this->dbdashboard->update_previousID($id,$previousID);
           $updatePreviousParentID = $this->dbdashboard->update_Previous_ParentID($id,$previousID);
           $updateUP = $this->dbdashboard->update_up($tempID,$previousID);
           $updateParentID_UP = $this->dbdashboard->update_parentID_UP($tempID,$previousID);
           
           redirect('dashboard/manageNavigation/4');
           }
           else
           {
              // echo 'Can not process';
              $this->session->set_flashdata('message', 'Lower level not available');
           redirect('dashboard/manageNavigation/4');
           }
           }
           else{
           
               $data['token_error'] = 'Page not found';
               
               $data['meta'] = $this->dbsetting->get_meta_data();

            $data['query'] = $this->dddashboard->get_list_of_selected_menu_navigation($id);
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('templates/error_landing_page', $data);
            
           }
           }
       else{
          $data['token_error'] = 'Page not found';
               
               $data['meta'] = $this->dbsetting->get_meta_data();

            $data['query'] = $this->dbdashboard->get_list_of_selected_menu_navigation($id);
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('templates/error_landing_page', $data);
            
       }
        }
       else
       {
          redirect('login/index/?url='.$url, 'refresh');
       } 
    }
    
    public function updatenavigation() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('navigation_name', 'Navigation Name', 'required|xss_clean|max_length[200]');
            // $this->form_validation->set_rules('navigation_link', 'Link', 'required|xss_clean|max_length[200]');
            // $this->form_validation->set_rules('navigation_type', 'Type', 'required|xss_clean|max_length[200]');


            if ($this->form_validation->run() == FALSE) {
                
            } else {
                //if valid
                $id = $this->input->post('id');
                $navigationname = $this->input->post('navigation_name');
                // $navigationlink = $this->input->post('navigation_link');
                //  $pid = $this->input->post('parent_id');
                //  $navigationtype = $this->input->post('navigation_type');
                // $navigationslug = $this->input->post('navigation_slug');
                // $mid = $this->input->post('menu_id');
                $this->dbdashboard->update_edited_navigation($id, $navigationname);
                //  $this->session->set_flashdata('message', 'Navigation Menu Modified Sucessfully');

                redirect('dashboard/navigation');
            }
            
        } else {
            redirect('login/index/?url='.$url, 'refresh');
        }
    }

    function deletenavigation($id=0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $this->dbdashboard->delnavigation($id);
            //die($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            //$this->showNavigation($id);
            redirect('dashboard/showNavigation/4');
        } else {
            redirect('login/index/?url='.$url, 'refresh');
        }
    }
    
    public function addPageForNavigation() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $listOfPage = $this->dbpage->get_list_of_pages();
            $listOfMenu = $this->dbdashboard->get_list_of_menu();
            $data["listOfPage"] = $this->dbpage->get_list_of_pages();
            $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
            $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
            $listOfNavigation = $this->dbdashboard->get_list_of_navigation();
            $data["listOfNavigation"] = $this->dbdashboard->get_list_of_navigation();
            $listOfSelectedMenu = Array();

            if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
                foreach ($listOfPage as $myData) {
                    if (isset($_POST[preg_replace('/\s+/', '', $myData->page_name)])) {

                        array_push($listOfSelectedMenu, array($myData->id => $myData->page_name));
                    }
                }
                $menuSelected = $_POST['departments'];
                 if($menuSelected==!"0")
                {
                $menu_info = $this->dbdashboard->get_menu_info($menuSelected);
                foreach ($menu_info as $id) {
                    $menu_id = $id->id;
                }
                $navigationName = $_POST['jobs'];
                if ($navigationName == 'Make Parent')
                    $parent_id = '0';
                else {
                    $post_category_info = $this->dbdashboard->get_navigation_info($navigationName);
                    foreach ($post_category_info as $pid) {
                        $parent_id = $pid->id;
                    }
                }

                foreach ($listOfSelectedMenu as $myData) {
                    foreach ($myData as $k => $v) {
                        $navigation_type = "page";
                        $navigation_name = $v;
                        $navigation_link = base_url()."index.php/view/".$navigation_type . "/" . $k;
                        $navigation_slug = preg_replace('/\s+/', '', $v);
                    }
                    $this->dbdashboard->add_new_navigation_item($navigation_name, $navigation_link, $parent_id, $navigation_type, $navigation_slug, $menu_id);
                }

                redirect('dashboard/navigation');
                }
                else{
                   $data['token_error'] = ' Select at least one menu list!'; 
                    $config["total_rows"] = $this->dbdashboard->record_count_navigation();
          
            $config["per_navigation"] = 6;
            $this->pagination->initialize($config);
            $navigation = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data["query"] = $this->dbdashboard->get_navigation($config["per_navigation"], $navigation);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data["listOfPage"] = $this->dbpage->get_list_of_pages();
            $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
            $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
            $data["listOfNavigation"] = $this->dbdashboard->get_list_of_navigation();
            $data["listOfNavigationID"] = $this->dbdashboard->get_list_of_navigationID();

            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('bnw/navigation/listOfItems', $data);
            
                }
            } 
            
            else {
                $data['meta'] = $this->dbsetting->get_meta_data();
                $data["listOfPage"] = $this->dbpage->get_list_of_pages();
                $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
                $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
                $this->load->view('bnw/templates/header', $data);
                $this->load->view('bnw/templates/menu', $data);
                $this->load->view('bnw/navigation/listOfItems', $data);
                
            }
        } else {
            redirect('login/index/?url='.$url, 'refresh');
        }
    }
    
    public function addCategoryForNavigation() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $listOfPage = $this->dbpage->get_list_of_pages();
            $listOfMenu = $this->dbdashboard->get_list_of_menu();
            $data["listOfPage"] = $this->dbpage->get_list_of_pages();
            $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
            $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
            $listOfCategory = $this->dbdashboard->get_list_of_category();
            $listOfNavigation = $this->dbdashboard->get_list_of_navigation();
            $data["listOfNavigation"] = $this->dbdashboard->get_list_of_navigation();


            if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
                $menuSelected = $_POST['departments'];
                if($menuSelected==!"0")
                {
                $menu_info = $this->dbdashboard->get_menu_info($menuSelected);
              
                foreach ($menu_info as $id) {
                    $menu_id = $id->id;
                }
               
              
                $navigationName = $_POST['jobs'];
                if ($navigationName == 'Make Parent')
                    $parent_id = '0';
                else {
                    $post_category_info = $this->dbdashboard->get_navigation_info($navigationName);
                    foreach ($post_category_info as $pid) {
                        $parent_id = $pid->id;
                    }
                }

                $categoryList = Array();
                foreach ($listOfCategory as $myData) { {
                        if (isset($_POST[preg_replace('/\s+/', '', $myData->category_name)])) {

                            array_push($categoryList, array($myData->id => $myData->category_name));
                        }
                    }
                }


                foreach ($categoryList as $myData) {
                    foreach ($myData as $k => $v) {
                        $navigation_name = $v;
                        $navigation_type = "category";
                        $navigation_link = base_url()."index.php/view/".$navigation_type . "/" . $k;
                        $navigation_slug = preg_replace('/\s+/', '', $v);
                        ;
                    }

                    $this->dbdashboard->add_new_navigation_item($navigation_name, $navigation_link, $parent_id, $navigation_type, $navigation_slug, $menu_id);
                }

                $this->load->view('bnw/templates/header', $data);
                $this->load->view('bnw/templates/menu', $data);
                $this->load->view('bnw/navigation/listOfItems', $data);
                
                }
                else{
                    
                    $data['token_error'] = ' Select at least one menu list!'; 
                    $config["total_rows"] = $this->dbdashboard->record_count_navigation();
          
            $config["per_navigation"] = 6;
            $this->pagination->initialize($config);
            $navigation = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data["query"] = $this->dbdashboard->get_navigation($config["per_navigation"], $navigation);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data["listOfPage"] = $this->dbpage->get_list_of_pages();
            $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
            $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
            $data["listOfNavigation"] = $this->dbdashboard->get_list_of_navigation();
            $data["listOfNavigationID"] = $this->dbdashboard->get_list_of_navigationID();

            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('bnw/navigation/listOfItems', $data);
            
                  
                }
            } else {
                $data['meta'] = $this->dbsetting->get_meta_data();
                $data["listOfPage"] = $this->dbpage->get_list_of_pages();
                $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
                $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
                $this->load->view('bnw/templates/header', $data);
                $this->load->view('bnw/templates/menu', $data);
                $this->load->view('bnw/navigation/listOfItems', $data);
                
            }
        } else {
            redirect('login/index/?url='.$url, 'refresh');
        }
    }
    
    public function addCustomLink() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $listOfMenu = $this->dbdashboard->get_list_of_menu();
            $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
            $data["listOfPage"] = $this->dbpage->get_list_of_pages();
            $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
            $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
            $data["links"] = $this->pagination->create_links();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));

            $this->form_validation->set_rules('navigation_name', 'Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('navigation_link', 'Link', 'required|xss_clean|max_length[200]');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('bnw/navigation/listOfItems', $data);
            } else {
                 if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
                $menuSelected = $_POST['departments'];
                if($menuSelected==!"0")
                {
                $menu_info = $this->dbdashboard->get_menu_info($menuSelected);
              
                foreach ($menu_info as $id) {
                    $menu_id = $id->id;
                }
               
              
                $navigationName = $_POST['jobs'];
                if ($navigationName == 'Make Parent'){
                $parent_id = '0';}
                else {
                    $post_category_info = $this->dbdashboard->get_navigation_info($navigationName);
                    foreach ($post_category_info as $pid) {
                        $parent_id = $pid->id;
                    }
                }
            }}
                
                $navigationName = $this->input->post('navigation_name');
                $navigationLink = $this->input->post('navigation_link');
                $parentID = $parent_id;
                $navigationType = "";
                $navigation_slug = preg_replace('/\s+/', '', $navigationName);
                $this->dbdashboard->add_new_custom_link($navigationName, $navigationLink, $parentID, $navigationType, $navigation_slug, $menu_id);
               // $data['token_sucess'] = ' One Navigation item added sucessfully';                
               $this->session->set_flashdata('message', 'One Navigation item added sucessfully');
                redirect('dashboard/navigation');
            }
            
        } else {

            redirect('login/index/?url='.$url, 'refresh');
        }
    }
    //============================ CLOSE NAVIGATION =====================================//
    
    
    //============================= START CATEGORY ======================================//
    
     function change_category() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $id = $_POST['id'];
            $cat_id = $_POST['categoryProduct'];
            // die($cat_id);
            $this->dbdashboard->change_category($id, $cat_id);
            $this->deletecategory($id);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function delete_Product_cat() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $id = $_POST['id'];
            $this->dbdashboard->delRelPro($id);
            $this->dbdashboard->delete_category($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/category');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
     public function category() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            
            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/category";
            $config["total_rows"] = $this->dbdashboard->record_count_category();
           // var_dump($config["total_rows"]);
            $config["per_page"] = 6;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data["query"] = $this->dbdashboard->get_all_category($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
           
            
            $data['meta'] = $this->dbsetting->get_meta_data();


            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/category/addCategory', $data);
            
        } else {
            redirect('login/index/?url='.$url, 'refresh');
        }
    }
    
    public function addcategory() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data["links"] = $this->pagination->create_links();
            $data['query'] = $this->dbdashboard->get_category();

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


                        $this->dbdashboard->add_new_category($categoryname);
                        $this->session->set_flashdata('message', 'One category item added sucessfully');
                        redirect('bnw/category/addCategory');
                    }
                } else {
                    $categoryname = $this->input->post('category_name');

                    $this->dbdashboard->add_new_category($categoryname);

                    $pages = $this->dbdashboard->find_category_id($categoryname);
                    $this->session->set_flashdata('message', 'One category added sucessfully');
                    redirect('dashboard/category');
                }
            } else {

                $this->load->view('bnw/category/addCategory', $data);
            }

           
        } else {
            redirect('login/index/?url='.$url, 'refresh');
        }
    }
    
    public function editcategory($id=0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbdashboard->findcategory($id);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data["links"] = $this->pagination->create_links();
            $data['id'] = $id;

            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/category/edit', $data);

          
        } else {
            redirect('login/index/?url='.$url, 'refresh');
        }
    }
    
    public function updatecategory() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbsetting->get_meta_data();
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
                        $data['query'] = $this->dbdashboard->findcategory($id);
                        $this->load->view('bnw/category/edit', $data);
                    } else {
                        $categoryname = $this->input->post('category_name');
                        $this->dbdashboard->update_category($id, $categoryname);
                        $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                        redirect('bnw/category/addCategory');
                    }
                } else {


                    $categoryname = $this->input->post('category_name');
                    $this->dbdashboard->update_category($id, $categoryname);
                    $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                    redirect('dashboard/category');
                }
            } else {
                $id = $this->input->post('id');
                $data['query'] = $this->dbdashboard->findcategory($id);
                $this->load->view('bnw/category/edit', $data);
            }

           
        } else {
            redirect('login/index/?url='.$url, 'refresh');
        }
    }
    
    public function deletecategory($id=0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
          $this->dbdashboard->delete_category($id);
              $this->session->set_flashdata('message', 'Data Delete Sucessfully');
                 redirect('dashboard/category');
                
          
        } else {
            redirect('login/index/?url='.$url, 'refresh');
        }
    }
    
    function delete_category($id=0)
    {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
             $data['meta'] = $this->dbsetting->get_meta_data();
             $data['category'] = $this->dbdashboard->get_category_id($id);
            // $data['category_list'] = $this->dbmodel->get_category();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu', $data);
            $this->load->view('bnw/category/delcategory', $data);
           
        }
        else
        {
             redirect('login/index/?url='.$url, 'refresh');
        }
        
    }
    
    //============================= CLOSE CATEGORY ========================================//
    
}