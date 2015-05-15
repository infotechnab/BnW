<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dbmodel');
        $this->load->model('dbdashboard');
        $this->load->model('dbsetting');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
    }

    public function index() {
        redirect('bnw');
    }

  //================================ HEADER =====================================//
    
     public function header() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $set['query'] = $this->dbsetting->get_design_setup();
            // var_dump($set);
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/setup/addHeader', $set);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function headerupdate() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '786';

            $this->load->library('upload', $config);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data['query'] = $this->dbsetting->get_design_setup();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('header_title', 'Title', 'required|xss_clean|max_length[200]');


            if ($this->form_validation->run() == FALSE) {
                //die('not image');
//                $data['error'] = $this->upload->display_errors();

                $this->load->view('bnw/setup/addHeader', $data);
            } else {
                    if (empty($_FILES['file_name']['name'])) {

                $headerTitle = $this->input->post('header_title');
                $headerLogo = $this->input->post('existingImg');
                $headerDescription = $this->input->post('header_description');
                $headerBgColor = null;
                $this->dbsetting->update_design_header_setup($headerTitle, $headerLogo, $headerDescription, $headerBgColor);
                $this->session->set_flashdata('message', 'Header setting done sucessfully');
                redirect('setting/header');
                    } else {
                //if valid
                        $this->upload->do_upload('file_name');
//                $data = array('upload_data' => $this->upload->data('file'));

                $headerTitle = $this->input->post('header_title');
//                $headerLogo = $data['upload_data']['file_name'];
                $headerLogo = $_FILES['file_name']['name'];
                $headerDescription = $this->input->post('header_description');
                $headerBgColor = null;
                $this->dbsetting->update_design_header_setup($headerTitle, $headerLogo, $headerDescription, $headerBgColor);
                $this->session->set_flashdata('message', 'Header setting done sucessfully');
                redirect('setting/header');
            } }
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    //================================================================================================================//
 //======================================== SIDEBAR =================================================================//
    
     public function sidebar() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $set['query'] = $this->dbsetting->get_design_setup();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/setup/addSidebar', $set);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function sidebarupdate() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('sidebar_title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('sidebar_description', 'Description', 'required|xss_clean');
            
            // $this->form_validation->set_rules('header_bgcolor', 'Description', 'required|xss_clean');
            if (($this->form_validation->run() == FALSE)) {

                $data['meta'] = $this->dbsetting->get_meta_data();
                $set['query'] = $this->dbsetting->get_design_setup();
                $this->load->view("bnw/templates/header", $data);
                $this->load->view("bnw/templates/menu");
                $this->load->view('bnw/setup/addSidebar', $set);
            } else {
                $sideBarTitle = $this->input->post('sidebar_title');
                $sideBarDescription = $this->input->post('sidebar_description');
                $sideBarBgColor = NULL;

                $this->dbsetting->update_design_sidebar_setup($sideBarTitle, $sideBarDescription, $sideBarBgColor);
                redirect('bnw');
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
        
    }
    //========================================================================================================//
    //=====================================Miscellaneous Setting===============================================/
    public function miscsetting() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data['query'] = $this->dbsetting->get_misc_setting();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/setup/miscSetting');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function miscsettingupdate() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $this->load->library('session');
            $data['query'] = $this->dbsetting->get_misc_setting();

            $allowComment = $this->input->post('allow_comment');
            $allowLike = $this->input->post('allow_like');
            $allowShare = $this->input->post('allow_share');
            $maximunPost = $this->input->post('max_post_to_show');
            $maximumPage = $this->input->post('max_page_to_show');
            $slideHeight = $this->input->post('slide_height');
            $slideWidth = $this->input->post('slide_width');


            $this->dbsetting->update_misc_setting($allowComment, $allowLike, $allowShare, $maximunPost, $maximumPage, $slideHeight, $slideWidth);
            $this->session->set_flashdata("misc","Miscellenious Settings Updated.");
            redirect('setting/miscsetting');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    //===================================== SETUP ==========================================================//
    
     public function setup() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $header = "bnw/templates/";
            $this->load->view($header . 'header', $data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/setup/index', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function deletefavicone($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $this->dbsetting->delete_favicone($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('setting/setup');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function setupupdate() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png|ico';
            $config['max_size'] = '500';
            $config['max_width'] = '70';
            $config['max_height'] = '70';
            $this->load->library('upload', $config);

            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('url', 'Url', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
            $this->form_validation->set_rules('keyword', 'Keyword', 'required|xss_clean');
            $this->form_validation->set_rules('description', 'Description', 'required|xss_clean');
            if (($this->form_validation->run() == FALSE)) {
                $data['error'] = $this->upload->display_errors();
                $data['meta'] = $this->dbsetting->get_meta_data();
                $header = "bnw/templates/";
                $this->load->view($header . 'header', $data);
                $this->load->view($header . 'menu');
                $this->load->view('bnw/setup/index', $data);
            } else {
                if (!$this->upload->do_upload('file_name')) {


                    $favicone = $this->input->post('faviconeName');
                    //die($favicone);
                    $url = $this->input->post('url');
                    $title = $this->input->post('title');
                    $keyword = $this->input->post('keyword');
                    $description = $this->input->post('description');
                    $this->dbsetting->update_meta_data($url, $title, $keyword, $description, $favicone);
                } else {
                    $data = array('upload_data' => $this->upload->data('file'));

                    $favicone = $data['upload_data']['file_name'];

                    $url = $this->input->post('url');
                    $title = $this->input->post('title');
                    $keyword = $this->input->post('keyword');
                    $description = $this->input->post('description');
                    $this->dbsetting->update_meta_data($url, $title, $keyword, $description, $favicone);
                }
                $this->session->set_flashdata("message","Page setup Updated.");
                redirect('setting/setup');
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
}
?>