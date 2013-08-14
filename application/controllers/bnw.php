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
            $header = "bnw/templates/";
            $this->load->view($header . 'header', $data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/index');
            $this->load->view('bnw/templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    function logout() {
        $this->session->sess_destroy();
        $this->index();
        redirect('login', 'refresh');
    }

    //Page

    public function pages() {
        if ($this->session->userdata('logged_in')) {

            $data['query'] = $this->dbmodel->get_all_pages();
            $header = "bnw/templates/";

            $this->load->view($header . 'header');
            $this->load->view($header . 'menu');
            $this->load->view('bnw/pages/index', $data);
            $this->load->view('bnw/templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function addpage() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $header = "bnw/templates/header";
            $this->load->view($header);
            $this->load->view('bnw/templates/menu');
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
                  $this->load->view('bnw/pages/addnew', $error);
                 }
                 else
                 {
                $data = array('upload_data' => $this->upload->data('file'));
                $image = $data['upload_data']['file_name'];

                $name = $this->input->post('title');
                $body = $this->input->post('body');
                $status = $this->input->post('status');
                $this->dbmodel->add_new_page($name, $body, $image, $status);
                $this->session->set_flashdata('message', 'One pages added sucessfully');
                redirect('bnw/pages');

                 }
             }
             else
             {
                $image = "";
                $name = $this->input->post('title');
                $body = $this->input->post('body');
                $status = $this->input->post('status');
                $this->dbmodel->add_new_page($name, $body, $image, $status);
                $this->session->set_flashdata('message', 'One pages added sucessfully');
                redirect('bnw/pages');

             }
            }

            else
            {

                $this->load->view('bnw/pages/addnew');
            }

            $this->load->view('bnw/templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }


    function editpage($pid) {
        if ($this->session->userdata('logged_in')) {
        $data['query'] = $this->dbmodel->findpage($pid);
        //$data['id'] = $pid;

        $header = "bnw/templates/";
        $this->load->view($header . 'header');
        $this->load->view($header . 'menu');
        $this->load->view('bnw/pages/edit', $data);

        $this->load->view('bnw/templates/footer');
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

            $header = "bnw/templates/header";
            $this->load->view($header);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $id = $this->input->post('id');
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
                  $this->load->view('bnw/pages/addnew', $error);
                 }
                 else
                 {
                $data = array('upload_data' => $this->upload->data('file'));
                $image = $data['upload_data']['file_name'];

                $name = $this->input->post('title');
                $body = $this->input->post('body');
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
                $body = $this->input->post('body');
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
                $this->load->view('bnw/pages/addnew');
            }

            $this->load->view('bnw/templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function deletepage($pid) {
          if ($this->session->userdata('logged_in')) {
        $this->dbmodel->delete_page($pid);
        $this->session->set_flashdata('message', 'Data Delete Sucessfully');
        redirect('bnw/pages');
        }
        else {
            redirect('login', 'refresh');
        }
    }

     public function delete_page_image($pid)
    {
        if ($this->session->userdata('logged_in')) {
        $this->dbmodel->delete_page_image($pid);
        $this->session->set_flashdata('message', 'Data Delete Sucessfully');
        redirect('bnw/pages');
        }
        else {
            redirect('login', 'refresh');
        }
    }



    //notice

    public function notice() {

        if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->get_all_notices();
            $header = "bnw/templates/";
            echo $this->load->view('tinyMCE', base_url(), true);
            $this->load->view($header . 'header');
            $this->load->view($header . 'menu');
            $this->load->view('sresadmin/notice/index', $data);
            $this->load->view('sresadmin/templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function addnotice() {
        if ($this->session->userdata('logged_in')) {
            $header = "sresadmin/templates/header";
            $this->load->view($header);
            $this->load->view('sresadmin/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                //if not valid
                $this->load->view('sresadmin/notice/addnew');
            } else {
                //if valid
                $name = $this->input->post('title');
                $body = $this->input->post('body');
                $status = $this->input->post('status');
                $this->dbmodel->add_new_notices($name, $body, $status);
                $this->session->set_flashdata('message', 'One pages added sucessfully');
                redirect('sresadmin/notice');
            }

            $this->load->view('sresadmin/templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function editnotice($nid) {
          if ($this->session->userdata('logged_in')) {
        $data['query'] = $this->dbmodel->findnotice($nid);
        //$data['id'] = $pid;
        $header = "sresadmin/templates/";
        $this->load->view($header . 'header');
        $this->load->view($header . 'menu');
        $this->load->view('sresadmin/notice/edit', $data);
        $this->load->view('sresadmin/templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function updatenotice() {
        if ($this->session->userdata('logged_in')) {
            $header = "sresadmin/templates/header";
            $this->load->view($header);
            $this->load->view('sresadmin/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                //if not valid
                $this->load->view('sresadmin/notice/edit');
            } else {
                //if valid
                $id = $this->input->post('id');
                $title = $this->input->post('title');
                $body = $this->input->post('body');
                $status = $this->input->post('status');
                $this->dbmodel->update_notice($id, $title, $body, $status);
                $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                redirect('sresadmin/notice');
            }
            $this->load->view('sresadmin/templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function deletenotice($nid) {
        if ($this->session->userdata('logged_in')) {
        $this->dbmodel->delete_notice($nid);
        redirect('sresadmin/notice');
        } else {
            redirect('login', 'refresh');
        }
    }

    //Activities controler
    public function activities() {

        if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->get_all_activities();
            $header = "admin/templates/";

            $this->load->view($header . 'header');
            $this->load->view($header . 'menu');
            $this->load->view('admin/activities/index', $data);
            $this->load->view('admin/templates/footer');
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

            $this->load->view('admin/templates/header');
            $this->load->view('admin/templates/menu');
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
                  $this->load->view('admin/activities/addnew',$error);
                 }
                 else
                 {
                 $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];
                //$imagedata = Array($this->upload->data());
                $name = $this->input->post('title');
                $body = $this->input->post('body');
                //$image = $imagedata['file_name'];
                $status = $this->input->post('status');
                $this->dbmodel->add_new_activities($name, $body, $image, $status);
                $this->session->set_flashdata('message', 'One Activities added sucessfully');
                redirect('admin/activities');

                 }
             }
             else
             {
                $image = "";
                $name = $this->input->post('title');
                $body = $this->input->post('body');
                //$image = $imagedata['file_name'];
                $status = $this->input->post('status');
                $this->dbmodel->add_new_activities($name, $body, $image, $status);
                $this->session->set_flashdata('message', 'One Activities added sucessfully');
                redirect('admin/activities');

             }
            }

            else
            {

                $this->load->view('admin/activities/addnew');
            }
            $this->load->view('admin/templates/footer');
        } else {

            redirect('login', 'refresh');
        }
    }

    function editactivities($aid) {
        if ($this->session->userdata('logged_in')) {
        $data['query'] = $this->dbmodel->findactivities($aid);
        //$data['id'] = $pid;
        $header = "admin/templates/";
        $this->load->view($header . 'header');
        $this->load->view($header . 'menu');
        $this->load->view('admin/activities/edit', $data);
        $this->load->view('admin/templates/footer');
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
            $header = "admin/templates/header";
            $this->load->view($header);
            $this->load->view('admin/templates/menu');
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
                  $this->load->view('admin/activities/addnew',$error);
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
                redirect('admin/activities');
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
                redirect('admin/activities');

             }
            }

            else
            {

                $this->load->view('admin/activities/addnew');
            }
            $this->load->view('admin/templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    function deleteactivities($aid) {
         if ($this->session->userdata('logged_in')) {

        $this->dbmodel->deleteactivities($aid);
        $this->session->set_flashdata('message', 'One Acticity deleted sucessfully');
        redirect('admin/activities');
        } else {

            redirect('login', 'refresh');
        }
    }

    //Result management controler
    public function downloads() {
        if ($this->session->userdata('logged_in')) {
            $data['username'] = Array($this->session->userdata('logged_in'));
            $data['query']= $this->dbmodel->get_documents();
            $header = "sresadmin/templates/";
            $this->load->view($header . 'header');
            $this->load->view($header . 'menu');
            $this->load->view('sresadmin/downloads/index', $data);
            $this->load->view('sresadmin/templates/footer');
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
            $this->load->view('sresadmin/templates/header');
            $this->load->view('sresadmin/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
           // $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload())) {

                //if not valid

                $error = array('error' => $this->upload->display_errors());
                $this->load->view('sresadmin/downloads/upload_form', $error);
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
                redirect('sresadmin/downloads');
            }
            $this->load->view('sresadmin/templates/footer');
        } else {

            redirect('login', 'refresh');
        }
    }

    function deletedocument($did)
    {
        if ($this->session->userdata('logged_in'))
            {
        $this->dbmodel->delete_document($did);
        $this->session->set_flashdata('message', 'One Document deleted sucessfully');
        redirect('sresadmin/downloads');

            }
           else {

            redirect('login', 'refresh');
        }


        }




    //Dashboard setup page
    function setup()
            {
        if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->get_meta_data();
            $header = "admin/templates/";
            $this->load->view($header . 'header');
            $this->load->view($header . 'menu');
            $this->load->view('admin/setup/index',$data);
            $this->load->view('admin/templates/footer');
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

            $data['query'] = $this->dbmodel->get_meta_data();
            $header = "admin/templates/";
            $this->load->view($header . 'header');
            $this->load->view($header . 'menu');
            $this->load->view('admin/setup/index',$data);
            $this->load->view('admin/templates/footer');

            }

            else
            {
                $url = $this->input->post('url');
                $title = $this->input->post('title');
                $keyword = $this->input->post('keyword');
                $description = $this->input->post('description');
                $this->dbmodel->update_meta_data($url, $title, $keyword, $description);
                redirect('admin/setup');
            }

        } else
            {
            redirect('login', 'refresh');
        }


    }



    //alumnae controlers

    //Gadget starts here
    public function gadget() {
        if ($this->session->userdata('logged_in')) {
            //$data['username'] = Array($this->session->userdata('logged_in'));
            $data['query'] = $this->dbmodel->get_gadgets();
            $header = "admin/templates/";
            $this->load->view($header . 'header');
            $this->load->view($header . 'menu');
            $this->load->view('admin/gadget/index', $data);
            $this->load->view('admin/templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    function editgadget($gid)
    {
        if ($this->session->userdata('logged_in')) {
        $data['query'] = $this->dbmodel->findgadget($gid);
        //$data['id'] = $pid;
        $header = "admin/templates/";
        $this->load->view($header . 'header');
        $this->load->view($header . 'menu');
        $this->load->view('admin/gadget/edit', $data);
        $this->load->view('admin/templates/footer');
        }
        else {
            redirect('login', 'refresh');
        }
    }

    function deletegadget($gid) {
         if ($this->session->userdata('logged_in')) {
        $this->dbmodel->delete_gadget($gid);
        redirect('admin/gadget');
         }
         else {
            redirect('login', 'refresh');
        }

    }

    function updategadget() {
        if ($this->session->userdata('logged_in')) {
            $header = "admin/templates/header";
            $this->load->view($header);
            $this->load->view('admin/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                //if not valid
                $data['query'] = $this->dbmodel->findgadget($gid);
                $this->load->view('admin/gadget/edit',$data);
            } else {
                //if valid
                $id = $this->input->post('id');
                $title = $this->input->post('title');
                $body = $this->input->post('body');
                $status = $this->input->post('status');
                $this->dbmodel->update_gadget($id, $title, $body, $status);
                $this->session->set_flashdata('message', 'Data Modified Sucessfully');

                redirect('admin/gadget');
            }
            $this->load->view('admin/templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    function addgadget() {
        if ($this->session->userdata('logged_in')) {
            $header = "admin/templates/header";
            $this->load->view($header);
            $this->load->view('admin/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                //if not valid
                $this->load->view('admin/gadget/addnew');
            } else {
                //if valid
                $name = $this->input->post('title');
                $body = $this->input->post('body');
                $status = $this->input->post('status');
                $this->dbmodel->add_new_gadget($name, $body, $status);
                $this->session->set_flashdata('message', 'One gadget added sucessfully');
                redirect('admin/gadget');
            }

            $this->load->view('admin/templates/footer');
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
       $this->load->view('bnw/templates/header');
       $this->load->view('bnw/templates/menu');
       $this->load->view('bnw/album/index');



     //   $this->load->view('admin/album/index',$data);
        $this->load->view('bnw/templates/footer');
    }


    function add_album()
    {
        if ($this->session->userdata('logged_in')) {

            $this->load->view('bnw/templates/header');
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('addtext', 'Album Name', 'required|xss_clean|max_length[200]');

            if (($this->form_validation->run() == FALSE)) {

                //if not valid
                $error = array('error' => $this->upload->display_errors());


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
            $this->load->view('bnw/templates/footer');
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
        $data['album_id'] = $aid;
        $this->load->view('bnw/templates/header');
        $this->load->view('bwn/templates/menu');
        $this->load->view('bnw/album/gallery',$data);
        $this->load->view('bnw/templates/footer');
    }

    //--------------------------------gallery---------------

    function gallery()
    {
        if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->get_all_photos();
            $header = "bnw/templates/";
            //echo $this->load->view('tinyMCE', base_url(), true);
            $this->load->view($header . 'header');
            $this->load->view($header . 'menu');
            $this->load->view('bnw/gallery/index', $data);
            $this->load->view('bnw/templates/footer');
        } else {
            redirect('login', 'refresh');
        }

    }

    function addphoto()
    {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './gallery/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);
            $this->load->view('bnw/templates/header');
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
            $this->load->view('bnw/templates/footer');
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
        redirect('admin/photos/'.$aid);

            }
           else {

            redirect('login', 'refresh');
        }


    }


  //  ===================== slider ===========================================

    public function slider()
    {
         if ($this->session->userdata('logged_in')) {
            $data['query'] = $this->dbmodel->get_slider();
            $header = "admin/templates/";
            //echo $this->load->view('tinyMCE', base_url(), true);
            $this->load->view($header . 'header');
            $this->load->view($header . 'menu');
            $this->load->view('admin/slider/index', $data);
            $this->load->view('admin/templates/footer');
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
            $this->load->view('admin/templates/header');
            $this->load->view('admin/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
            //$this->form_validation->set_rules('body', 'Body', 'required|xss_clean');


            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file'))) {
                $data['error']=$this->upload->display_errors();

               $this->load->view('admin/slider/addnew', $data);
            } else {

                //if valid
                $data = array('upload_data' => $this->upload->data('file'));
                $image = $data['upload_data']['file_name'];
                $name = $this->input->post('title');
                $this->dbmodel->add_new_slider($name, $image);
                $this->session->set_flashdata('message', 'One slider added sucessfully');
                redirect('admin/slider');
            }
            $this->load->view('admin/templates/footer');
        } else
            {

            redirect('login', 'refresh');
        }
    }

    function editslider($sid)
    {
        if ($this->session->userdata('logged_in')) {
        $data['query'] = $this->dbmodel->findslider($sid);
        //$data['id'] = $pid;
        $header = "admin/templates/";
        $this->load->view($header . 'header');
        $this->load->view($header . 'menu');
        $this->load->view('admin/slider/edit', $data);
        $this->load->view('admin/templates/footer');
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

            $header = "admin/templates/header";
            $this->load->view($header);
            $this->load->view('admin/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');


            if (($this->form_validation->run() == FALSE)||(!$this->upload->do_upload())) {
                //if not valid
                $sid = $this->input->post('id');
                $data['query'] = $this->dbmodel->findslider($sid);
                $data['error']=$this->upload->display_errors();
                $this->load->view('admin/slider/edit');
            } else {
                //if valid
                 $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];

                $id = $this->input->post('id');
                $title = $this->input->post('title');

                $this->dbmodel->update_slider($id, $title, $image);
                $this->session->set_flashdata('message', 'Image Modified Sucessfully');

                redirect('admin/slider/index');
            }
            $this->load->view('admin/templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function deleteslider($sid) {
          if ($this->session->userdata('logged_in')) {
        $this->dbmodel->delete_slider($sid);
        $this->session->set_flashdata('message', 'Data Delete Sucessfully');
        redirect('admin/slider');
        }
        else {
            redirect('login', 'refresh');
        }
    }



}
?>