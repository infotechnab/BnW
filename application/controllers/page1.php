<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends CI_Controller {

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
    public function pages() {
        $url = current_url();
       
        if ($this->session->userdata('admin_logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/page/pages";
            $config["total_rows"] = $this->dbpage->record_count_page();
            $config["per_page"] = 6;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $pagedata["query"] = $this->dbpage->get_all_pages($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbsetting->get_meta_data();


            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/pages/pageListing', $pagedata);
        } else {
            
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //============== ADD PAGE ==============//
    public function addpage() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $username = $this->session->userdata('username');
            $data['username'] = ($this->session->userdata('admin_logged_in'));
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $pagedata['query'] = $this->dbpage->get_pages();
            $data['query'] = $this->dbsetting->get_misc_setting();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->helper('date');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $name = $this->input->post('page_name');
            $body = $this->input->post('page_content');
            $page_author_info = $this->dbpage->get_page_author_id($username);
            foreach ($page_author_info as $id) {
                $page_author_id = $id->id;
            }
            $string = $this->input->post('page_content');
            $summary = substr("$string", 0, 100);
            $status = $this->input->post('page_status');
            $order = $this->input->post('page_order');
            $type = $this->input->post('page_type');
            $tags = $this->input->post('page_tags');
            $allowComment = $this->input->post('allow_comment');
            $allowLike = $this->input->post('allow_like');
            $allowShare = $this->input->post('allow_share');
            $this->form_validation->set_rules('page_name', 'Page Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('page_content', 'Body', 'required|xss_clean');



            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('file')) {
                        $error = array('error' => $this->upload->display_errors('file'));
                        $this->load->view('bnw/pages/addnew', $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data('file'));
                        $image = $data['upload_data']['file_name'];
                        $this->dbpage->add_new_page($name, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare);
                        $this->session->set_flashdata('message', 'One pages added sucessfully');
                        redirect('page/pages');
                    }
                } else {

                    $name = $this->input->post('page_name');
                    $body = $this->input->post('page_content');
                    $page_author_info = $this->dbpage->get_page_author_id($username);
                    foreach ($page_author_info as $id) {
                        $page_author_id = $id->id;
                    }

                    $string = $this->input->post('page_content');
                    $summary = substr("$string", 0, 100);

                    $status = $this->input->post('page_status');
                    $order = $this->input->post('page_order');

                    $type = $this->input->post('page_type');
                    $tags = $this->input->post('page_tags');
                    $allowComment = $this->input->post('allow_comment');
                    $allowLike = $this->input->post('allow_like');
                    $allowShare = $this->input->post('allow_share');
                    $this->dbpage->add_new_page($name, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare);

                    $page = $this->dbpage->find_page_id($name);
                    $this->session->set_flashdata('message', 'One pages added sucessfully');
                    redirect('page/pages');
                }
            } else {

                $this->load->view('bnw/pages/addnew', $data);
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //======================EDIT PAGE===============================//

    function editpage($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbpage->findpage($id);

            $data['meta'] = $this->dbsetting->get_meta_data();
            $data['miscSetting'] = $this->dbsetting->get_misc_setting();
            $data['id'] = $id;

            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/pages/edit', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //======================UPDATE EDITED PAGE===============================//


    public function updatepage() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data['miscSetting'] = $this->dbsetting->get_misc_setting();
            $username = $this->session->userdata('username');
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));

            //set validation rules
            $this->form_validation->set_rules('page_name', 'Page Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('page_content', 'Body', 'required|xss_clean');




            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('slide_image')) {
                        $data['error'] = $this->upload->display_errors('file');
                        $id = $this->input->post('id');
                        $data['query'] = $this->dbpage->findpage($id);
                        $this->load->view('bnw/pages/edit', $data);
                    } else {


                        $id = $this->input->post('id');
                        $name = $this->input->post('page_name');
                        $body = $this->input->post('page_content');
                        $page_author_info = $this->dbpage->get_page_author_id($username);
                        foreach ($page_author_info as $pid) {
                            $page_author_id = $pid->id;
                        }
                        $string = $this->input->post('page_content');
                        $summary = substr("$string", 0, 100);
                        $status = $this->input->post('page_status');
                        $order = $this->input->post('page_order');
                        $type = $this->input->post('page_type');
                        $tags = $this->input->post('page_tags');
                        $allowComment = $this->input->post('allow_comment');
                        $allowLike = $this->input->post('allow_like');
                        $allowShare = $this->input->post('allow_share');
                        $navigationName = $name;
                        $navigationLink = 'page/' . $id;
                        $navigationSlug = preg_replace('/\s+/', '', $name);
                        $pageid = $id;
                        $this->dbpage->update_page($id, $name, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare);
                        $this->dbpage->update_navigation_on_page_update($pageid, $navigationName, $navigationLink, $navigationSlug);
                        $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                        redirect('page/pages');
                    }
                } else {

                    $id = $this->input->post('id');
                    $name = $this->input->post('page_name');
                    $body = $this->input->post('page_content');
                    $page_author_info = $this->dbpage->get_page_author_id($username);
                    foreach ($page_author_info as $pid) {
                        $page_author_id = $pid->id;
                    }
                    $string = $this->input->post('page_content');
                    $summary = substr("$string", 0, 100);
                    $status = $this->input->post('page_status');
                    $order = $this->input->post('page_order');
                    $type = $this->input->post('page_type');
                    $tags = $this->input->post('page_tags');
                    $allowComment = $this->input->post('allow_comment');
                    $allowLike = $this->input->post('allow_like');
                    $allowShare = $this->input->post('allow_share');
                    $navigationName = $name;
                    $navigationLink = 'page/' . $id;
                    $navigationSlug = preg_replace('/\s+/', '', $name);
                    $pageid = $id;
                    $this->dbpage->update_page($id, $name, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare);
                    $this->dbpage->update_navigation_on_page_update($pageid, $navigationName, $navigationLink, $navigationSlug);
                    $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                    redirect('page/pages');
                }
            } else {
                $id = $this->input->post('id');
                $data['query'] = $this->dbpage->findpage($id);
                $this->load->view('bnw/pages/edit', $data);
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function deletepage($id) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $this->dbpage->delete_page($id);
            $this->dbpage->delete_navigation_related_to_page($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('page/pages');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
}