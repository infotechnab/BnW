<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class bnw extends CI_Controller {

    public $load = "";

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
            $header = "bnw/templates/";
            /*$this->load->view($header . 'header',$data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/index');*/
            $this->load->view('bnw/templates/header',$data);
            $this->load->view('bnw/templates/menu',$data);
            $this->load->view('bnw/index',$data);
        } else {
            redirect('login', 'refresh');
        }
    }

    function logout() {
        $this->session->sess_destroy();
        $this->index();
        redirect('login', 'refresh');
    }

    //==================================== Page ============================//

    public function pages() {
        if ($this->session->userdata('logged_in')) {
            
            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/pages";
            $config["total_rows"] = $this->dbmodel->record_count_page();
            $config["per_page"] = 6;
            //$config["uri_segment"] = 3;

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            
            $data["query"] = $this->dbmodel->get_all_pages($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            
            

            //$data['query'] = $this->dbmodel->get_all_pages();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/";

            $this->load->view($header . 'header',$data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/pages/index', $data);
            $this->load->view('bnw/templates/footer',$data);
        } else {
            redirect('login', 'refresh');
        }
    }
                //============== ADD PAGE ==============//
    public function addpage() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['query'] = $this->dbmodel->get_pages();
            $header = "bnw/templates/header";
            $this->load->view($header,$data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('area1', 'Body', 'required|xss_clean');
            if (($this->form_validation->run() == TRUE))
            {
             if ($_FILES && $_FILES['file']['name'] !== "")
             {
                 if (!$this->upload->do_upload('file'))
                 {
                  $error = array('error' => $this->upload->display_errors('file'));
                  $this->load->view('bnw/pages/addnew', $error);
                 }
                 else
                 {
                $data = array('upload_data' => $this->upload->data('file'));
                $image = $data['upload_data']['file_name'];
                
                $type = $this->input->post('type');
                $name = $this->input->post('title');
                $body = $this->input->post('body');
                $status = $this->input->post('status');
                $listing = $this->input->post('listing');
                $order = $this->input->post('order');
                $this->dbmodel->add_new_page($name, $body, $image, $status,$type);
                die($name);
                 //$this->dbmodel->add_new_menu($name,$listing,$order);
                $this->session->set_flashdata('message', 'One pages added sucessfully');
                redirect('bnw/pages');

                 }
             }
             else
             {
                $image = "";
                $type = $this->input->post('type');
                $name = $this->input->post('title');
                $body = $this->input->post('area1');
                $status = $this->input->post('status');
                $listing = $this->input->post('listing');
                $order = $this->input->post('order');
               
                 $this->dbmodel->add_new_page($name, $body, $image, $status,$type);
                
                $pages = $this->dbmodel->find_page_id($name);
                                  
             
                foreach ($pages as $data)
                {
                    $id = $data->id;
                }
                
                 $this->dbmodel->add_new_menu($name,$listing,$order,$id);
                $this->session->set_flashdata('message', 'One pages added sucessfully');
                redirect('bnw/pages');

             }
            }

            else
            {

                $this->load->view('bnw/pages/addnew',$data);
            }

            $this->load->view('bnw/templates/footer',$data);
        } else {
            redirect('login', 'refresh');
        }
    }
            //======================EDIT PAGE===============================//

    function editpage($id) {
        if ($this->session->userdata('logged_in')) {
        $data['query'] = $this->dbmodel->findpage($id);
        $data['meta'] = $this->dbmodel->get_meta_data();
        //$data['id'] = $pid;

        $header = "bnw/templates/";
        $this->load->view($header . 'header',$data);
        $this->load->view($header . 'menu');
        $this->load->view('bnw/pages/edit', $data);

        $this->load->view('bnw/templates/footer',$data);
        }
        else {
            redirect('login', 'refresh');
        }
    }

    //delete page



    public function update() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();

            $header = "bnw/templates/header";
            $this->load->view($header,$data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $id = $this->input->post('id');
            //set validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('area1', 'Body', 'required|xss_clean');

             if (($this->form_validation->run() == TRUE))
            {
             if ($_FILES && $_FILES['file']['name'] !== "")
             {
                 if (!$this->upload->do_upload('file'))
                 {                
                  $data['error'] = $this->upload->display_errors('file');
                  $id = $this->input->post('id');
                  $data['query'] = $this->dbmodel->findpage($id);
                  $this->load->view('bnw/pages/edit', $data);
                  
                 }
                 else
                 {
                $data = array('upload_data' => $this->upload->data('file'));
                $image = $data['upload_data']['file_name'];

                $name = $this->input->post('title');
                $body = $this->input->post('area1');
                $status = $this->input->post('status');
                $this->dbmodel->update_page($id, $name, $body, $image, $status);
                $this->session->set_flashdata('message', 'Data Modified Sucessfully');
               redirect('bnw/pages');

                 }
             }
             else
             {

                $image = "";
                $name = $this->input->post('title');
                $body = $this->input->post('area1');
                $status = $this->input->post('status');
                $this->dbmodel->update_page($id, $name, $body, $image, $status);
                $this->session->set_flashdata('message', 'Data Modified Sucessfully');
               redirect('bnw/pages');

             }
            }

            else
            {
                $id = $this->input->post('id');
                $data['query'] = $this->dbmodel->findpage($id);
                $this->load->view('bnw/pages/edit',$data);
            }

            $this->load->view('bnw/templates/footer',$data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function deletepage($id) {
          if ($this->session->userdata('logged_in')) {
        $this->dbmodel->delete_page($id);
        $this->session->set_flashdata('message', 'Data Delete Sucessfully');
        redirect('bnw/pages');
        }
        else {
            redirect('login', 'refresh');
        }
    }

     public function delete_page_image($id)
    {
        if ($this->session->userdata('logged_in')) {
        $this->dbmodel->delete_page_image($id);
        $this->session->set_flashdata('message', 'Data Delete Sucessfully');
        redirect('bnw/pages');
        }
        else {
            redirect('login', 'refresh');
        }
    }



    //=========================notice==============================//

    public function notice() {

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
           
            $this->load->view($header . 'header',$data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/notice/index',$data);
            $this->load->view('bnw/templates/footer',$data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function addnotice() {
        if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/header";
            $this->load->view($header,$data);
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
                $this->dbmodel->add_new_notices($name, $body, $status,$type);
                $this->session->set_flashdata('message', 'One notice added sucessfully');
                redirect('bnw/notice');
            }

            $this->load->view('bnw/templates/footer',$data);
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
        $this->load->view($header . 'header',$data);
        $this->load->view($header . 'menu');
        $this->load->view('bnw/notice/edit', $data);
        $this->load->view('bnw/templates/footer',$data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function updatenotice() {
        if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/header";
            $this->load->view($header,$data);
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
            $this->load->view('bnw/templates/footer',$data);
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

            $this->load->view($header . 'header',$data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/activities/index', $data);
            $this->load->view('bnw/templates/footer',$data);
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
            $this->load->view('bnw/templates/header',$data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

            if (($this->form_validation->run() == TRUE))
            {
             if ($_FILES && $_FILES['file']['name'] !== "")
             {
                 if (!$this->upload->do_upload('file'))
                 {
                  $error = array('error' => $this->upload->display_errors('file'));
                  $this->load->view('bnw/activities/addnew',$error);
                 }
                 else
                 {
                 $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];
                //$imagedata = Array($this->upload->data());
                $name = $this->input->post('title');
                $body = $this->input->post('body');
                $type = $this->input->post('type');
                //$image = $imagedata['file_name'];
                $status = $this->input->post('status');
                $this->dbmodel->add_new_activities($name, $body, $image, $status,$type);
                $this->session->set_flashdata('message', 'One Activities added sucessfully');
                redirect('bnw/activities');

                 }
             }
             else
             {
                $image = "";
                $name = $this->input->post('title');
                $body = $this->input->post('body');
                //$image = $imagedata['file_name'];
                $status = $this->input->post('status');
                $type = $this->input->post('type');
                $this->dbmodel->add_new_activities($name, $body, $image, $status,$type);
                $this->session->set_flashdata('message', 'One Activities added sucessfully');
                redirect('bnw/activities');

             }
            }

            else
            {

                $this->load->view('bnw/activities/addnew');
            }
            $this->load->view('bnw/templates/footer',$data);
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
        $this->load->view($header . 'header',$data);
        $this->load->view($header . 'menu');
        $this->load->view('bnw/activities/edit', $data);
        $this->load->view('bnw/templates/footer',$data);
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
            $this->load->view($header,$data);
            $this->load->view('bnw/templates/menu');
            $id = $this->input->post('id');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');
             if (($this->form_validation->run() == TRUE))
            {
             if ($_FILES && $_FILES['file']['name'] !== "")
             {
                 if (!$this->upload->do_upload('file'))
                 {
                  $error = array('error' => $this->upload->display_errors('file'));
                  $this->load->view('bnw/activities/edit',$error);
                 }
                 else
                 {
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
             }
             else
             {
                $image = "";
                $id = $this->input->post('id');
                $title = $this->input->post('title');
                $body = $this->input->post('body');
                $status = $this->input->post('status');
                $this->dbmodel->update_activities($id, $title, $body, $image, $status);
                $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                redirect('bnw/activities');

             }
            }

            else
            {
                 $id = $this->input->post('id');
                 $data['query'] = $this->dbmodel->findactivities($id);
                $this->load->view('bnw/activities/edit',$data);
            }
            $this->load->view('bnw/templates/footer',$data);
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
            $data['query']= $this->dbmodel->get_documents();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/";
            $this->load->view($header . 'header',$data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/download/index', $data);
            $this->load->view('bnw/templates/footer',$data);
        } else {
            redirect('login', 'refresh');
        }
    }

    function upload()
    {
     if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './downloads/';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '500';
            //$config['max_width'] = '1024';
            //$config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header',$data);
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
            $this->load->view('bnw/templates/footer',$data);
        } else {

            redirect('login', 'refresh');
        }
    }

    function deletedocument($id)
    {
        if ($this->session->userdata('logged_in'))
            {
        $this->dbmodel->delete_document($id);
        $this->session->set_flashdata('message', 'One Document deleted sucessfully');
        redirect('bnw/download');

            }
           else {

            redirect('login', 'refresh');
        }


        }

    //======================================Dashboard setup page
    function setup()
            {
        if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/";
            $this->load->view($header . 'header',$data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/setup/index',$data);
            $this->load->view('bnw/templates/footer',$data);
        } else
            {
            redirect('login', 'refresh');
        }
    }

    function setupupdate()

    {
        if ($this->session->userdata('logged_in')) {

            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('url', 'Url', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
            $this->form_validation->set_rules('keyword', 'Keyword', 'required|xss_clean');
            $this->form_validation->set_rules('description', 'Description', 'required|xss_clean');
            if (($this->form_validation->run() == FALSE))
            {

            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/";
            $this->load->view($header . 'header',$data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/setup/index',$data);
            $this->load->view('bnw/templates/footer',$data);

            }

            else
            {
                $url = $this->input->post('url');
                $title = $this->input->post('title');
                $keyword = $this->input->post('keyword');
                $description = $this->input->post('description');
                $this->dbmodel->update_meta_data($url, $title, $keyword, $description);
                redirect('bnw/setup');
            }

        } else
            {
            redirect('login', 'refresh');
        }


    }



    //alumnae controlers

    //==================================Gadget starts here
    public function gadget() {
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
            //$data['query'] = $this->dbmodel->get_gadgets();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/";
            $this->load->view($header . 'header',$data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/gadget/index', $data);
            $this->load->view('bnw/templates/footer',$data);
        } else {
            redirect('login', 'refresh');
        }
    }

    function editgadget($id)
    {
        if ($this->session->userdata('logged_in')) {
        $data['query'] = $this->dbmodel->findgadget($id);
        $data['meta'] = $this->dbmodel->get_meta_data();
        //$data['id'] = $pid;
        $header = "bnw/templates/";
        $this->load->view($header . 'header',$data);
        $this->load->view($header . 'menu');
        $this->load->view('bnw/gadget/edit', $data);
        $this->load->view('bnw/templates/footer',$data);
        }
        else {
            redirect('login', 'refresh');
        }
    }

    function deletegadget($id) {
         if ($this->session->userdata('logged_in')) {
        $this->dbmodel->delete_gadget($id);
        redirect('bnw/gadget');
         }
         else {
            redirect('login', 'refresh');
        }

    }

    function updategadget() {
        if ($this->session->userdata('logged_in')) {
            $header = "bnw/templates/header";
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view($header,$data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                //if not valid
                $data['query'] = $this->dbmodel->findgadget($gid);
                $this->load->view('bnw/gadget/edit',$data);
            } else {
                //if valid
                $type = $this->input->post('type');
                $id = $this->input->post('id');
                $title = $this->input->post('title');
                $body = $this->input->post('body');
                $status = $this->input->post('status');
                $this->dbmodel->update_gadget($id, $title, $body, $status,$type);
                $this->session->set_flashdata('message', 'Data Modified Sucessfully');

                redirect('bnw/gadget');
            }
            $this->load->view('bnw/templates/footer',$data);
        } else {
            redirect('login', 'refresh');
        }
    }

    function addgadget() {
        if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/header";
            $this->load->view($header,$data);
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
                $this->dbmodel->add_new_gadget($name, $body, $status,$type);
                $this->session->set_flashdata('message', 'One gadget added sucessfully');
                redirect('bnw/gadget');
            }

            $this->load->view('bnw/templates/footer',$data);
        } else {
            redirect('login', 'refresh');
        }
    }

    //----------------------------album----------------



    //============album=====


     function album()
    {
        //$data['query']=  $this->dbmodel->get_album();

       // $imagesrc = array();
         $data['meta'] = $this->dbmodel->get_meta_data();
       $this->load->view('bnw/templates/header',$data);
       $this->load->view('bnw/templates/menu');
       $this->load->view('bnw/album/index');



     //   $this->load->view('bnw/album/index',$data);
        $this->load->view('bnw/templates/footer',$data);
    }


    function add_album()
    {
        if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header',$data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('addtext', 'Album Name', 'required|xss_clean|max_length[200]');

            if (($this->form_validation->run() == FALSE)) {

                //if not valid
                $error = "Enter Album Name";


                $this->load->view('bnw/album/index', $error);
            } else {

                //if valid
                //$imagedata = Array($this->upload->data());
                $name = $this->input->post('addtext');
                         //$image = $imagedata['file_name'];
               $this->dbmodel->add_album($name);
                $this->session->set_flashdata('message', 'One Album added sucessfully');
                redirect('bnw/album/index');
            }
            $this->load->view('bnw/templates/footer',$data);
        } else {

            redirect('login', 'refresh');
        }
    }



     function delete_album($aid) {
         if ($this->session->userdata('logged_in')) {
        $this->dbmodel->delete_album($aid);
        redirect('bnw/album');
         }
         else {
            redirect('login', 'refresh');
        }
    }




    public function photos($aid)
    {

        $data['query'] = $this->dbmodel->get_gallery($aid);
        $data['meta'] = $this->dbmodel->get_meta_data();
        $data['album_id'] = $aid;
        $this->load->view('bnw/templates/header',$data);
        $this->load->view('bnw/templates/menu');
        $this->load->view('bnw/album/gallery',$data);
        $this->load->view('bnw/templates/footer',$data);
    }

    //--------------------------------gallery---------------

    function gallery()
    {
        if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->get_all_photos();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/";
            //echo $this->load->view('tinyMCE', base_url(), true);
            $this->load->view($header . 'header',$data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/gallery/index', $data);
            $this->load->view('bnw/templates/footer',$data);
        } else {
            redirect('login', 'refresh');
        }

    }

    function addphoto()
    {
        if ($this->session->userdata('logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $config['upload_path'] = './gallery/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);
            $this->load->view('bnw/templates/header',$data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            //$this->form_validation->set_rules('body', 'Body', 'required|xss_clean');
            $aid = $this->input->post('p_aid');
            $data['query'] = $this->dbmodel->get_gallery($aid);
            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload())) {
                $data['error']=$this->upload->display_errors();
               $data['album_id'] = $aid;
               $this->load->view('bnw/album/gallery', $data);
            } else {

                //if valid
                $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];
                $name = $this->input->post('title');
                $aid = $this->input->post('p_aid');
                $this->dbmodel->add_new_photo($name, $image,$aid);
                $this->session->set_flashdata('message', 'One photo added sucessfully');
                redirect('bnw/photos/'.$aid);
            }
            $this->load->view('bnw/templates/footer',$data);
        } else
            {

            redirect('login', 'refresh');
        }

    }

    function deletephoto($id)
    {
         if ($this->session->userdata('logged_in'))
            {
             //$aid = $this->dbmodel->get_aid($id);
            $aid = $this->dbmodel->get_aid($id);
             foreach ($aid as $data)
             {
                 $aid = $data->aid;
             }
            $this->dbmodel->delete_photo($id);
            $this->session->set_flashdata('message', 'One photo deleted sucessfully');
        redirect('bnw/photos/'.$aid);

            }
           else {

            redirect('login', 'refresh');
        }


    }


  //  ===================== slider ===========================================

    public function slider()
    {
         if ($this->session->userdata('logged_in')) {
             $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/slider";
            $config["total_rows"] = $this->dbmodel->record_count_slider();
            $config["per_page"] = 6;
            //$config["uri_segment"] = 3;

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbmodel->get_slider($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
             
            //$data['query'] = $this->dbmodel->get_slider();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/";
            //echo $this->load->view('tinyMCE', base_url(), true);
            $this->load->view($header . 'header',$data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/slider/index', $data);
            $this->load->view('bnw/templates/footer',$data);
        } else {
            redirect('login', 'refresh');
        }
    }


    function addslider()
    {
         if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './slider/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header',$data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            //$this->form_validation->set_rules('body', 'Body', 'required|xss_clean');


            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file'))) {
                $data['error']=$this->upload->display_errors();

               $this->load->view('bnw/slider/addnew', $data);
            } else {

                //if valid
                $data = array('upload_data' => $this->upload->data('file'));
                $image = $data['upload_data']['file_name'];
                $name = $this->input->post('title');
                $this->dbmodel->add_new_slider($name, $image);
                $this->session->set_flashdata('message', 'One slider added sucessfully');
                redirect('bnw/slider');
            }
            $this->load->view('bnw/templates/footer',$data);
        } else
            {

            redirect('login', 'refresh');
        }
    }

    function editslider($sid)
    {
        if ($this->session->userdata('logged_in')) {
        $data['query'] = $this->dbmodel->findslider($sid);
        $data['meta'] = $this->dbmodel->get_meta_data();
        //$data['id'] = $pid;
        $header = "bnw/templates/";
        $this->load->view($header . 'header',$data);
        $this->load->view($header . 'menu');
        $this->load->view('bnw/slider/edit', $data);
        $this->load->view('bnw/templates/footer',$data);
        }
        else {
            redirect('login', 'refresh');
        }
    }

    public function updateslider() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './slider/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '596';
            $config['max_height'] = '220';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();

            $header = "bnw/templates/header";
            $this->load->view($header,$data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');


            if (($this->form_validation->run() == FALSE)||(!$this->upload->do_upload())) {
                //if not valid
                $sid = $this->input->post('id');
                $data['query'] = $this->dbmodel->findslider($sid);
                $data['error']=$this->upload->display_errors();
                $this->load->view('bnw/slider/edit');
            } else {
                //if valid
                 $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];

                $id = $this->input->post('id');
                $title = $this->input->post('title');

                $this->dbmodel->update_slider($id, $title, $image);
                $this->session->set_flashdata('message', 'Image Modified Sucessfully');

                redirect('bnw/slider/index');
            }
            $this->load->view('bnw/templates/footer',$data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function deleteslider($sid) {
          if ($this->session->userdata('logged_in')) {
        $this->dbmodel->delete_slider($sid);
        $this->session->set_flashdata('message', 'Data Delete Sucessfully');
        redirect('bnw/slider');
        }
        else {
            redirect('login', 'refresh');
        }
    }
    
    // ==================  MENU  ============================ //

    public function menu()
    {
        
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
            $header = "bnw/templates/";
            //echo $this->load->view('tinyMCE', base_url(), true);
            $this->load->view($header . 'header',$data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/menu/index', $data);
            $this->load->view('bnw/templates/footer',$data);
        } else {
            redirect('login', 'refresh');
        }
    
    }
    
    public function addmenu()
    {
        if($this->session->userdata('logged_in')){
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header',$data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            
             if ($this->form_validation->run() == FALSE) {
               
               $this->load->view('bnw/menu/addnew');
            } else {

                //if valid
                
                $tital = $this->input->post('title');
                $parmalink = $this->input->post('parmalink');
                $listing = $this->input->post('listing');
                $order = $this->input->post('order');
                $link = $this->input->post('link');
                $this->dbmodel->add_new_menu($tital, $parmalink, $listing, $order , $link);
                $this->session->set_flashdata('message', 'One slider added sucessfully');
                redirect('bnw/menu/index');
            }
            $this->load->view('bnw/templates/footer',$data);
        } else
            {

            redirect('login', 'refresh');
        }
    }
    
        
        
    


    function editmenu($id)
    {
        if ($this->session->userdata('logged_in')) {
        $data['query'] = $this->dbmodel->findmenu($id);
        $data['meta'] = $this->dbmodel->get_meta_data();
        //$data['id'] = $pid;
        $header = "bnw/templates/";
        $this->load->view($header . 'header',$data);
        $this->load->view($header . 'menu');
        $this->load->view('bnw/menu/edit', $data);
        $this->load->view('bnw/templates/footer',$data);
        }
        else {
            redirect('login', 'refresh');
        }
    }
    
        function updatemenu() {
        if ($this->session->userdata('logged_in')) {
            $header = "bnw/templates/header";
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view($header,$data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
           

            if ($this->form_validation->run() == FALSE) {
                //if not valid
                $data['query'] = $this->dbmodel->findmenu($id);
                $this->load->view('bnw/gadget/edit',$data);
            } else {
                //if valid
                $id = $this->input->post('id');
                $title = $this->input->post('title');
                $parmalink = $this->input->post('parmalink');
                $listing = $this->input->post('listing');
                $order = $this->input->post('order');
                $link = $this->input->post('link');
                $this->dbmodel->update_menu($id,$title,$parmalink,$listing,$order,$link);
                $this->session->set_flashdata('message', 'Menu Modified Sucessfully');

                redirect('bnw/menu/index');
            }
            $this->load->view('bnw/templates/footer',$data);
        } else {
            redirect('login', 'refresh');
        }
    }
    
    public function blog()
    {
         if ($this->session->userdata('logged_in')) {
            $data['username'] = Array($this->session->userdata('logged_in'));
            $data['query']= $this->dbmodel->get_blog();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/";
            $this->load->view($header . 'header',$data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/blogs/index', $data);
            $this->load->view('bnw/templates/footer',$data);
        } else {
            redirect('login', 'refresh');
        }
        
    }
    
     function uploads()
    {
         if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './downloads/';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '500';
            //$config['max_width'] = '1024';
            //$config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header',$data);
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
            $this->load->view('bnw/templates/footer',$data);
        } else {

            redirect('login', 'refresh');
        }
         
    }  
     public function deleteblog($id) {
          if ($this->session->userdata('logged_in')) {
        $this->dbmodel->deleteblog($id);
        $this->session->set_flashdata('message', 'Data Delete Sucessfully');
        redirect('bnw/blog');
        }
        else {
            redirect('login', 'refresh');
        }
    }
                
           



}
?>