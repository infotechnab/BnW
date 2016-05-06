<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Album extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dbmodel');
        $this->load->model('dbdashboard');
        $this->load->model('dbsetting');
        $this->load->model('dbuser');
        $this->load->model('dbalbum');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $this->load->helper("security");
    }

    public function index() {
        redirect('bnw');
    }

    function getRandomStringForCoupen($length) {
        $validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789abcdefghijklmnopqrstuvwxyz";
        $validCharNumber = strlen($validCharacters);
        $result = "";

        for ($i = 0; $i < $length; $i++) {
            $index = mt_rand(0, $validCharNumber - 1);
            $result .= $validCharacters[$index];
        }
        return $result;
    }

    public function album() {  //$url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "album/album";
            $config["total_rows"] = $this->dbalbum->record_count_album();
            $config["per_user"] = 6;
            $this->pagination->initialize($config);
            $user = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbuser->get_all_user($config["per_user"], $user);
            $data["links"] = $this->pagination->create_links();
            $data['query'] = $this->dbalbum->get_album();
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('bnw/album/index');
            $this->load->view('bnw/templates/footer', $data);
        }
    }

    public function addalbum() {
        ini_set('memory_limit', '-1');
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data['query'] = $this->dbalbum->get_album();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('album_name', 'Album Name', 'required|xss_clean|max_length[200]');
            if (($this->form_validation->run() == FALSE)) {  //if not valid
                $error = "Enter Album Name";
                $this->load->view('bnw/album/index', $error);
            } else {       //if valid
                $name = $this->input->post('album_name');
                $this->dbalbum->add_new_album($name);
                $this->session->set_flashdata('message', 'One Album added sucessfully');
                redirect('album/addalbum');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //===============================To Add Photo================================================================//
    public function addphoto() {
        ini_set('memory_limit', '-1');
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('title', 'Title', 'required|callback_xss_clean|max_length[200]');
            $albumid = $this->input->post('id');
            $data['query'] = $this->dbalbum->get_album();
            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file'))) {
                $data['error'] = $this->upload->display_errors();
                $data['query'] = $this->dbalbum->get_media($albumid);
                $data['id'] = $albumid;
                $this->load->view('bnw/album/gallery', $data);
            } else {
                //if valid
                include_once 'imagemanipulator.php';
                $manipulator = new ImageManipulator($_FILES['file']['tmp_name']);
                $realwidth = $manipulator->getWidth();

                $newWidth = (int) $_POST['w'];
                $newHeight = (int) $_POST['h'];
                $ratio = $realwidth / 1000;
                $ax1 = (int) $_POST['x'];
                $ay1 = (int) $_POST['y'];
                $x1 = $ax1 * $ratio;
                $y1 = $ay1 * $ratio;
                $height = $newHeight * $ratio;
                $width = $newWidth * $ratio;

                $x2 = $x1 + $width;
                $y2 = $y1 + $height;

                // center cropping to 200x130
                $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
                $name = $_FILES['file']['name'];
                $key = $this->getRandomStringForCoupen(5);
                $image = $key . $name;
                $manipulator->save('./content/uploads/images/' . $image);
                $filename1 = './content/uploads/images/' . $name;
                if (file_exists($filename1)) {
                    unlink($filename1);
                } else {
                    
                }
                $image_thumb = dirname('thumb_' . $image . '/demo');
                $config['image_library'] = 'gd2';
                $config['source_image'] = './content/uploads/images/' . $image;
                $config['new_image'] = $image_thumb;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 240;
                $config['height'] = 180;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $medianame = $this->input->post('title');
                $albumid = $this->input->post('id');
                $medialink = $this->input->post('media_link');
                $this->dbalbum->add_new_photo($medianame, $image, $albumid, $medialink);
                $this->session->set_flashdata('message', 'One photo added sucessfully');
                redirect('album/photos/' . $albumid);
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

     public function deletephoto() {
         $id = $_POST['id'];
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $media = $this->dbalbum->get_imagename($id);
            foreach ($media as $med){
                $media_type = $med->media_type;
            }
             $filename1 = './content/uploads/images/' . $media_type;
             $filename2 = './content/uploads/images/thumb_' . $media_type;
                if (file_exists($filename1)) {
                    unlink($filename1);
                } else {}
                if (file_exists($filename2)) {
                    unlink($filename2);
                } else {}
            $this->dbalbum->delete_photo($id);
//            $this->session->set_flashdata('message', 'Image Deleted Sucessfully');
//            redirect('album/addalbum');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function add_new_album() {
        ini_set('memory_limit', '-1');
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data['query'] = $this->dbalbum->get_album();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('album_name', 'Album Name', 'required|xss_clean|max_length[200]');
            if (($this->form_validation->run() == FALSE)) {        //if not valid
                $error = "Enter Album Name";
                $this->load->view('bnw/album/index', $error);
            } else {           //if valid
                $name = $this->input->post('album_name');
                $this->dbalbum->add_new_album($name);
                $this->session->set_flashdata('message', 'One Album added sucessfully');
                redirect('album/album/index');
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

     function delete_album() {
        $id = $_POST['id'];
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['photoquery'] = $this->dbalbum->get_all_photos($id);
            foreach ($data['photoquery'] as $photo) {
                $image = $photo->media_type;             
                $filename1 = './content/uploads/images/' . $image;
             $filename2 = './content/uploads/images/thumb_' . $image;
                if (file_exists($filename1)) {
                    unlink($filename1);
                } else {}
                if (file_exists($filename2)) {
                    unlink($filename2);
                } else {}
            }
            $this->dbalbum->delete_photo($id);
            $this->dbalbum->delete_album($id);
//            $this->session->set_flashdata('message', 'One album Deleted Sucessfully');
//            redirect('album/addalbum');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function editalbum($aid = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $this->dbalbum->edit_album($aid);
            redirect('album/album');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function photos($id = 0) {
        $data['query'] = $this->dbalbum->get_media($id);
        $data['meta'] = $this->dbsetting->get_meta_data();
        $data['id'] = $id;
        $this->load->view('bnw/templates/header', $data);
        $this->load->view('bnw/templates/menu');
        $this->load->view('bnw/album/gallery', $data);
        $this->load->view('bnw/templates/footer', $data);
    }


    // ==================  MENU  ============================ //
    public function menu() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/menu";
            $config["total_rows"] = $this->dbalbum->record_count_menu();
            $config["per_page"] = 6;
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $this->pagination->initialize($config);
            $data["query"] = $this->dbalbum->get_menu($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/menu/addnew', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
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
}
