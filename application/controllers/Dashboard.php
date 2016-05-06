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
        $this->load->model('dboffers');
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
            $this->form_validation->set_rules('menu_name', 'Name', 'required|callback_xss_clean|max_length[200]');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('bnw/menu/addnew');
            } else {
                $menuname = $this->input->post('menu_name');
                $listOfMenu = $this->dbdashboard->get_list_of_menu();
                foreach($listOfMenu as $menus){
                    $checkmenu = $menus->menu_name;
                    $compare = strcasecmp("$checkmenu","$menuname");
                    $comTrue = true;
                    if($compare == 0){
                        $comTrue = false;
                        $this->session->set_flashdata('message', 'Menu name "'.$menuname.'" already exists. Try giving another name.');
                        redirect('dashboard/addmenu');
                    }
                }
                if($comTrue == TRUE){
                        $this->dbdashboard->add_new_menu($menuname);
                        $this->session->set_flashdata('message', 'One menu added sucessfully');
                        redirect('dashboard/addmenu');
                    }
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
            $this->form_validation->set_rules('menu_name', 'Name', 'required|callback_xss_clean|max_length[200]');


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

    public function deletemenu() {
        if($_POST['id']){
        $id = $_POST['id'];
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $menuNo = $this->dbdashboard->check_navigation_for_menu($id);
            if ($menuNo > 0) {
                echo "This menu contains Navigation item associated. So delete navigation item associated with it first.";
//                $this->session->set_flashdata('message', 'This menu contains Navigation item associated. So to delete this menu delete navigation item associated with it first.');
//                redirect('dashboard/addmenu');
            } else {
                $this->dbdashboard->delete_menu($id);
//                $this->session->set_flashdata('message', 'Data Delete Sucessfully');
//                redirect('dashboard/addmenu');
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    } else {
        $id = NULL;
        var_dump("ASF");
        die;
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
            $data['listOfPost'] = $this->dboffers->get_list_of_post();
            $data["listOfPage"] = $this->dbpage->get_list_of_pages();
            $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
            $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
            $data["listOfNavigation"] = $this->dbdashboard->get_list_of_navigation();
            $data["listOfNavigationID"] = $this->dbdashboard->get_list_of_navigationID();

            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('bnw/navigation/listOfItems', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function fetchMenu() {
        $id = $_POST['id'];
        $navigationList = $this->dbdashboard->get_list_of_navigation_from_menuID($id);
        echo json_encode($navigationList);
    }

    public function renew_menu() {
        $listOfMenu = $this->dbdashboard->get_list_of_menu();
        echo json_encode($listOfMenu);
    }

    public function editnavigation($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {




            $data['query'] = $this->dbdashboard->findnavigation($id);

            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/navigation/editNavigation', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function showNavigation($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();

            $data['query'] = $this->dbdashboard->get_list_of_selected_menu_navigation($id);
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/navigation/navigationListing', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function manageNavigation() {
        $id = $_POST['menu_id_next'];
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();

            $data['query'] = $this->dbdashboard->get_list_of_selected_menu_navigation($id);
            $this->load->view('bnw/navigation/manageNavigation', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function up() {
        $id = $_POST['id'];
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            if ($id == !0) {
                $parent = $this->dbdashboard->get_parent_id($id);
                //  var_dump($parent);
                if (!empty($parent)) {
                    foreach ($parent as $pid) {
                        $parentID = $pid->parent_id;
                    }

                    $getID = $this->dbdashboard->get_data($parentID);

                    $previousID = 0;
                    if($id < 99999) {
                        $tempID = 99999;
                    } else {
                        $getotalrows = $this->dbdashboard->get_nav_count();
                       
                        $tempID = $getotalrows + 10;
                    }
                    
                    foreach ($getID as $data) {
                        if ($id == $data->id) {
                            break;
                        } else {

                            $previousID = $data->id;
                        }
                    }
                    //die($previousID." ".$tempID);
                    if ($previousID !== 0) {
                        // die('not work');
                        $updateID = $this->dbdashboard->update_navID($id, $tempID);
                        $updateParentID = $this->dbdashboard->update_navParentID($id, $tempID);
                        $updatePreviousID = $this->dbdashboard->update_previousID($id, $previousID);
                        $updatePreviousParentID = $this->dbdashboard->update_Previous_ParentID($id, $previousID);
                        $updateUP = $this->dbdashboard->update_up($tempID, $previousID);
                        $updateParentID_UP = $this->dbdashboard->update_parentID_UP($tempID, $previousID);
                    } else {
                        $this->session->set_flashdata('message', 'Upper level not available');
                    }
                } else {

                    $data['token_error'] = 'Page not found';

                    $data['meta'] = $this->dbsetting->get_meta_data();

                    $data['query'] = $this->dbdashboard->get_list_of_selected_menu_navigation($id);
//            $this->load->view("bnw/templates/header", $data);
//            $this->load->view("bnw/templates/menu");
//            $this->load->view('bnw/templetes/error_landing_page', $data);
//            
                }
            } else {

                $data['token_error'] = 'Page not found';

                $data['meta'] = $this->dbsetting->get_meta_data();

                $data['query'] = $this->dbdashboard->get_list_of_selected_menu_navigation($id);
//            $this->load->view("bnw/templates/header", $data);
//            $this->load->view("bnw/templates/menu");
//            $this->load->view('bnw/templetes/error_landing_page', $data);
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function down() {
        $id = $_POST['id'];
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            if ($id == !0) {
                $parent = $this->dbdashboard->get_parent_id_down($id);
                //  var_dump($parent);
                if (!empty($parent)) {
                    foreach ($parent as $pid) {
                        $parentID = $pid->parent_id;
                    }

                    $getID = $this->dbdashboard->get_data_down($parentID);
                    $previousID = 0;
                    $tempID = 999;
                    foreach ($getID as $data) {
                        if ($id == $data->id) {
                            break;
                        } else {

                            $previousID = $data->id;
                        }
                    }
                    // die($previousID);

                    if ($previousID !== 0) {
                        // die('not work');
                        $updateID = $this->dbdashboard->update_navID($id, $tempID);
                        $updateParentID = $this->dbdashboard->update_navParentID($id, $tempID);
                        $updatePreviousID = $this->dbdashboard->update_previousID($id, $previousID);
                        $updatePreviousParentID = $this->dbdashboard->update_Previous_ParentID($id, $previousID);
                        $updateUP = $this->dbdashboard->update_up($tempID, $previousID);
                        $updateParentID_UP = $this->dbdashboard->update_parentID_UP($tempID, $previousID);
//           redirect('dashboard/navigation');
                    } else {
                        // echo 'Can not process';
                        $this->session->set_flashdata('message', 'Lower level not available');
//           redirect('dashboard/navigation');
                    }
                } else {

                    $data['token_error'] = 'Page not found';

                    $data['meta'] = $this->dbsetting->get_meta_data();

                    $data['query'] = $this->dddashboard->get_list_of_selected_menu_navigation($id);
//            $this->load->view("bnw/templates/header", $data);
//            $this->load->view("bnw/templates/menu");
//            $this->load->view('templates/error_landing_page', $data);
                }
            } else {
                $data['token_error'] = 'Page not found';

                $data['meta'] = $this->dbsetting->get_meta_data();

                $data['query'] = $this->dbdashboard->get_list_of_selected_menu_navigation($id);
//            $this->load->view("bnw/templates/header", $data);
//            $this->load->view("bnw/templates/menu");
//            $this->load->view('templates/error_landing_page', $data);
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function updatenavigation() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            //if valid
            $id = $_POST['id'];
            $navigationname = $_POST['navName'];
            // $navigationlink = $this->input->post('navigation_link');
            //  $pid = $this->input->post('parent_id');
            //  $navigationtype = $this->input->post('navigation_type');
            // $navigationslug = $this->input->post('navigation_slug');
            // $mid = $this->input->post('menu_id');
            $this->dbdashboard->update_edited_navigation($id, $navigationname);
            //  $this->session->set_flashdata('message', 'Navigation Menu Modified Sucessfully');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function deletenavigation() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $id = $_POST['id'];
            $this->dbdashboard->delnavigation($id);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function addPageForNavigation() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $listOfPost = $this->dboffers->get_list_of_post();
            $listOfPage = $this->dbpage->get_list_of_pages();
            $listOfMenu = $this->dbdashboard->get_list_of_menu();
            $data['listOfPost'] = $this->dboffers->get_list_of_post();
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

                if ($menuSelected == !"0") {
                    $menu_info = $this->dbdashboard->get_menu_info($menuSelected);
                    foreach ($menu_info as $id) {
                        $menu_id = $id->id;
                    }
                    $navigationName = $_POST['jobs'];
                    if ($navigationName == 'Make Parent')
                        $parent_id = '0';
                    else {
                        $parent_id = $navigationName;
                    }

                    foreach ($listOfSelectedMenu as $myData) {
                        foreach ($myData as $k => $v) {
                            $navigation_type = "page";
                            $navigation_name = $v;
                            $page_id = $k;
                            $navigation_link = base_url() . "view/" . $navigation_type . "/" . $k;
                            $navigation_slug = preg_replace('/\s+/', '', $v);
                        }
                        $category_id =NULL;
                        $post_id = NULL;
                        $this->dbdashboard->add_new_navigation_item($navigation_name, $navigation_link, $parent_id, $navigation_type, $navigation_slug, $menuSelected, $page_id, $category_id, $post_id);
                    }
                    $this->session->set_flashdata("message", "Navigation Added Successfully.");
                    redirect('dashboard/navigation');
                } else {
                    $data['token_error'] = ' Select at least one menu list!';
                    $config["total_rows"] = $this->dbdashboard->record_count_navigation();

                    $config["per_navigation"] = 6;
                    $this->pagination->initialize($config);
                    $navigation = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

                    $data["query"] = $this->dbdashboard->get_navigation($config["per_navigation"], $navigation);
                    $data["links"] = $this->pagination->create_links();
                    $data['meta'] = $this->dbsetting->get_meta_data();
                    $data['listOfPost'] = $this->dboffers->get_list_of_post();
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
                $data['listOfPost'] = $this->dboffers->get_list_of_post();
                $data["listOfPage"] = $this->dbpage->get_list_of_pages();
                $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
                $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
                $this->load->view('bnw/templates/header', $data);
                $this->load->view('bnw/templates/menu', $data);
                $this->load->view('bnw/navigation/listOfItems', $data);
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    
     public function addPostForNavigation() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $listOfPost = $this->dboffers->get_list_of_post();
            $listOfPage = $this->dbpage->get_list_of_pages();
            $listOfMenu = $this->dbdashboard->get_list_of_menu();
            $data['listOfPost'] = $this->dboffers->get_list_of_post();
            $data["listOfPage"] = $this->dbpage->get_list_of_pages();
            $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
            $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
            $listOfNavigation = $this->dbdashboard->get_list_of_navigation();
            $data["listOfNavigation"] = $this->dbdashboard->get_list_of_navigation();

            $listOfSelectedMenu = Array();

            if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
                foreach ($listOfPost as $myData) {
                    if (isset($_POST[preg_replace('/\s+/', '', $myData->post_title)])) {
                        array_push($listOfSelectedMenu, array($myData->id => $myData->post_title));
                    }
                }
                
                $menuSelected = $_POST['departments'];

                if ($menuSelected == !"0") {
                    $menu_info = $this->dbdashboard->get_menu_info($menuSelected);
                    foreach ($menu_info as $id) {
                        $menu_id = $id->id;
                    }
                    $navigationName = $_POST['jobs'];
                    if ($navigationName == 'Make Parent')
                        $parent_id = '0';
                    else {
                        $parent_id = $navigationName;
                    }

                    foreach ($listOfSelectedMenu as $myData) {
                        foreach ($myData as $k => $v) {
                            $navigation_type = "post";
                            $navigation_name = $v;
                            $post_id = $k;
                            $navigation_link = base_url() . "view/" . $navigation_type . "/" . $k;
                            $navigation_slug = preg_replace('/\s+/', '', $v);
                        }
                        $category_id =NULL;
                        $page_id = NULL;
                        $this->dbdashboard->add_new_navigation_item($navigation_name, $navigation_link, $parent_id, $navigation_type, $navigation_slug, $menuSelected, $page_id, $category_id, $post_id);
                    }
                    $this->session->set_flashdata("message", "Navigation Added Successfully.");
                    redirect('dashboard/navigation');
                } else {
                    $data['token_error'] = ' Select at least one menu list!';
                    $config["total_rows"] = $this->dbdashboard->record_count_navigation();

                    $config["per_navigation"] = 6;
                    $this->pagination->initialize($config);
                    $navigation = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

                    $data["query"] = $this->dbdashboard->get_navigation($config["per_navigation"], $navigation);
                    $data["links"] = $this->pagination->create_links();
                    $data['meta'] = $this->dbsetting->get_meta_data();
                    $data['listOfPost'] = $this->dboffers->get_list_of_post();
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
                $data['listOfPost'] = $this->dboffers->get_list_of_post();
                $data["listOfPage"] = $this->dbpage->get_list_of_pages();
                $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
                $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
                $this->load->view('bnw/templates/header', $data);
                $this->load->view('bnw/templates/menu', $data);
                $this->load->view('bnw/navigation/listOfItems', $data);
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }



    public function addCategoryForNavigation() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $listOfPost = $this->dboffers->get_list_of_post();
            $listOfPage = $this->dbpage->get_list_of_pages();
            $listOfMenu = $this->dbdashboard->get_list_of_menu();
            $data['listOfPost'] = $this->dboffers->get_list_of_post();
            $data["listOfPage"] = $this->dbpage->get_list_of_pages();
            $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
            $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
            $listOfCategory = $this->dbdashboard->get_list_of_category();
            $listOfNavigation = $this->dbdashboard->get_list_of_navigation();
            $data["listOfNavigation"] = $this->dbdashboard->get_list_of_navigation();


            if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
                $menuSelected = $_POST['departments'];
                if ($menuSelected == !"0") {
                    $menu_info = $this->dbdashboard->get_menu_info($menuSelected);

                    foreach ($menu_info as $id) {
                        $menu_id = $id->id;
                    }


                    $navigationName = $_POST['jobs'];
                    if ($navigationName == 'Make Parent')
                        $parent_id = '0';
                    else {
                        $parent_id = $navigationName;
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
                            $navigation_link = base_url() . "view/" . $navigation_type . "/" . $k;
                            $navigation_slug = preg_replace('/\s+/', '', $v);
                            $category_id = $k;
                        }
                        $page_id = null;
                        $post_id = NULL;
                        $this->dbdashboard->add_new_navigation_item($navigation_name, $navigation_link, $parent_id, $navigation_type, $navigation_slug, $menuSelected,$page_id, $category_id, $post_id);
                    }
                $this->session->set_flashdata("message", "Navigation Added Successfully.");
                    redirect('dashboard/navigation');

                } else {
                    $data['token_error'] = ' Select at least one menu list!';
                    $config["total_rows"] = $this->dbdashboard->record_count_navigation();

                    $config["per_navigation"] = 6;
                    $this->pagination->initialize($config);
                    $navigation = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

                    $data["query"] = $this->dbdashboard->get_navigation($config["per_navigation"], $navigation);
                    $data["links"] = $this->pagination->create_links();
                    $data['meta'] = $this->dbsetting->get_meta_data();
                    $data['listOfPost'] = $this->dboffers->get_list_of_post();
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
                $data['listOfPost'] = $this->dboffers->get_list_of_post();
                $data["listOfPage"] = $this->dbpage->get_list_of_pages();
                $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
                $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
                $this->load->view('bnw/templates/header', $data);
                $this->load->view('bnw/templates/menu', $data);
                $this->load->view('bnw/navigation/listOfItems', $data);
            }
        } else {
            redirect('dashboard/navigation', 'refresh');
        }
    }

    public function addCustomLink() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $listOfMenu = $this->dbdashboard->get_list_of_menu();
            $data['listOfPost'] = $this->dboffers->get_list_of_post();
            $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
            $data["listOfPage"] = $this->dbpage->get_list_of_pages();
            $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
            $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
            $data["links"] = $this->pagination->create_links();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));

            $this->form_validation->set_rules('navigation_name', 'Name', 'required|callback_xss_clean|max_length[200]');
            $this->form_validation->set_rules('navigation_link', 'Link', 'required|callback_xss_clean|max_length[200]');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('bnw/navigation/listOfItems', $data);
            } else {
                    $menuSelected = $_POST['departments'];
                    if ($menuSelected == !"0") {
                        $menu_info = $this->dbdashboard->get_menu_info($menuSelected);

                        foreach ($menu_info as $id) {
                            $menu_id = $id->id;
                        }

                        $navigationName = $_POST['jobs'];
                        if ($navigationName == 'Make Parent') {
                            $parent_id = '0';
                        } else {
                            $parent_id = $navigationName;
                        }
                         $navigationName = $this->input->post('navigation_name');
                $navigationLink = $this->input->post('navigation_link');
                $parentID = $parent_id;
                $navigationType = "";
                $navigation_slug = preg_replace('/\s+/', '', $navigationName);
                $page_id = NULL;
                $category_id = null;
                $this->dbdashboard->add_new_custom_link($navigationName, $navigationLink, $parentID, $navigationType, $navigation_slug, $menuSelected, $page_id, $category_id);               
                $this->session->set_flashdata('message', 'One Navigation item added sucessfully');
                redirect('dashboard/navigation');
                    }else {
                         $data['token_error'] = ' Select at least one menu list!';
                    $config["total_rows"] = $this->dbdashboard->record_count_navigation();

                    $config["per_navigation"] = 6;
                    $this->pagination->initialize($config);
                    $navigation = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

                    $data["query"] = $this->dbdashboard->get_navigation($config["per_navigation"], $navigation);
                    $data["links"] = $this->pagination->create_links();
                    $data['meta'] = $this->dbsetting->get_meta_data();
                    $data['listOfPost'] = $this->dboffers->get_list_of_post();
                    $data["listOfPage"] = $this->dbpage->get_list_of_pages();
                    $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
                    $data["listOfMenu"] = $this->dbdashboard->get_list_of_menu();
                    $data["listOfNavigation"] = $this->dbdashboard->get_list_of_navigation();
                    $data["listOfNavigationID"] = $this->dbdashboard->get_list_of_navigationID();
                    $this->load->view('bnw/navigation/listOfItems', $data);
                    }
                }
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //============================ CLOSE NAVIGATION =====================================//
    //============================= START CATEGORY ======================================//

    public function category() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {


            $config = array();
            $config["base_url"] = base_url() . "index.php/dashboard/category";
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
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function addcategory() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $data['meta'] = $this->dbsetting->get_meta_data();
            $data["links"] = $this->pagination->create_links();
            $data['query'] = $this->dbdashboard->get_category();

            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('category_name', 'Category Name', 'required|callback_xss_clean|max_length[200]');
            if (($this->form_validation->run() == TRUE)) {
                    $categoryname = $this->input->post('category_name');
                    $this->dbdashboard->add_new_category($categoryname);
                    $this->session->set_flashdata('message', 'One category added sucessfully');
                    redirect('dashboard/category');
                }
             else {

                $this->load->view('bnw/category/addCategory', $data);
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function editcategory($id = 0) {
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
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function updatecategory() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $data['meta'] = $this->dbsetting->get_meta_data();
            $data["links"] = $this->pagination->create_links();


            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $id = $this->input->post('id');
            //set validation rules
            $this->form_validation->set_rules('category_name', 'Category Name', 'required|callback_xss_clean|max_length[200]');
            if (($this->form_validation->run() == TRUE)) {
                    $categoryname = $this->input->post('category_name');
                     $navigationName = $categoryname;
                        $navigationLink = base_url() . "view/category/" . $id;
                        $navigationSlug = preg_replace('/\s+/', '', $categoryname);
                        $categoryId = $id;
                    $this->dbdashboard->update_category($id, $categoryname);
                    $this->dbdashboard->update_navigation_on_category_update($categoryId, $navigationName, $navigationLink, $navigationSlug);
                    $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                    redirect('dashboard/category');
            } else {
                $id = $this->input->post('id');
                $data['query'] = $this->dbdashboard->findcategory($id);
                $this->load->view('bnw/category/edit', $data);
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function deletecategory() {
        $id = $_POST['id'];
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
           $menuNo = $this->dbdashboard->check_navigation_for_category($id);
            if ($menuNo > 0) {
                echo "This category contains Navigation item associated. So delete navigation item associated with it first.";
            } else {
               $this->dbdashboard->delete_category($id);
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function delete_category($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data['category'] = $this->dbdashboard->get_category_id($id);
            // $data['category_list'] = $this->dbmodel->get_category();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu', $data);
            $this->load->view('bnw/category/delcategory', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function get_media() {
        $media = $this->dbdashboard->get_media();
        echo json_encode($media);
    }
    
    public function uploads() {
        if (!empty($_FILES['images']['name'][0])) {

            $this->load->library('image_lib');

            $files = $_FILES['images'];
            $count = 0;
            $uploaded = array();
            $failed = array();
            $allowed = array('jpg', 'png', 'gif', 'jpeg');
            foreach ($files['name'] as $position => $file_name) {
                $file_tmp = $files['tmp_name'][$position];
                $file_size = $files['size'][$position];
                $file_error = $files['error'][$position];
                $file_ext = explode('.', $file_name);
                $file_ext = strtolower(end($file_ext));

                if (in_array($file_ext, $allowed)) {
                    if ($file_error === 0) {

                        if ($file_size <= 2097152123) {      //max size 40mb
                            $file_name_new = uniqid('', true) . '.' . $file_ext;

                            $file_destination = 'content/uploads/images/' . $file_name_new;
                            if (move_uploaded_file($file_tmp, $file_destination)) {
                                $uploaded[$position] = $file_destination;
                                $unique_name[$position] = $file_name_new;


                                //resize
                                $config['max_size'] = '1000000';
                                $config['image_library'] = 'GD2';
                                $config['source_image'] = 'content/uploads/images/' . $unique_name[$position];
                                $config['new_image'] = 'content/uploads/images/thumbnail/' . $unique_name[$position];
                                $config['create_thumb'] = false;
                                $config['maintain_ratio'] = true;

                                $config['dynamic_output'] = false;
                                $config['master_dim'] = 'auto';
                                $config['quality'] = '100%';
                                $config['width'] = 100;

                                $config['height'] = 100;

                                $this->image_lib->clear();
                                $this->image_lib->initialize($config);
                                $this->image_lib->resize();


                                //resize
                            } else {
                                $failed[$position] = "[{$file_name}] failed to upload";
                            }
                        } else {
                            $failed[$position] = "[{$file_name}] is too large.";
                        }
                    } else {
                        $failed[$position] = "[$file_name] error with code {$file_error}";
                    }
                } else {
                    $failed[$position] = "[{$file_name}] file extension '{$file_ext}' is not allowed";
                }

                $count++;
            }

            if ($count < 5) {
                $image_name = implode(',', $unique_name);
                // var_dump($image_name);
//            if(!empty($uploaded)){
//                echo "file sucessfully uploaded";
//            }
                if ($failed) {
                    echo "error in uploading images.";
                }

                $data['post_info'] = $this->dbdashboard->set_files($image_name);

//                redirect("welcome");
            } else {
                echo "Atleast one photo should be selected. Maximum number of photos 4.";
//                redirect("welcome");
            }
        }
    }
    
public function xss_clean($str)
	{
		if ($this->security->xss_clean($str, TRUE) === FALSE)
		{
			$this->form_validation->set_message('xss_clean', 'The %s is invalid charactor');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    //============================= CLOSE CATEGORY ========================================//
}
