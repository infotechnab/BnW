<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Media extends CI_Controller {

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

       public function medias() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            
           $config = array();
            $config["base_url"] = base_url() . "media/medias";
            $config["total_rows"] = $this->dbalbum->record_count_media();
            $config["per_page"] = 6;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data['query'] = $this->dbalbum->get_all_media($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->session->set_userdata("urlPagination", $config["base_url"]."/".$page);
            
           
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/media/mediaListing', $data);
            $this->load->view('bnw/templates/footer', $data);
            
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
      public function addmedia() {
          ini_set('memory_limit', '-1');
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc|ppt|odt|pptx|docx|xls|xlsx|key|txt';
            $config['max_size'] = '20000';
            $config['max_width'] = '10000';
            $config['max_height'] = '10000';
            $this->load->library('upload', $config);
            $listOfAlbum = $this->dbalbum->get_list_of_album();
            $data["listOfAlbum"] = $this->dbalbum->get_list_of_album();
            $data['meta'] = $this->dbalbum->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
                $mediaName = $this->input->post("selectAlbum");
                
                $media_association_info = $this->dbalbum->get_media_association_info($mediaName);
                if(!empty($media_association_info)){
                foreach ($media_association_info as $id) {
                    $media_association_id = $id->id;
                }
                }else{
                    $media_association_id = NULL;
                }
            }
            
            $this->form_validation->set_rules('media_name', 'media Name', 'required|xss_clean|max_length[200]');
            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file_name'))) {
                $data['error'] = $this->upload->display_errors();
                $this->load->view('bnw/media/addNew', $data);
            } else {   //if valid
                
                 $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];
               
              //  $data = $this->upload->data();
               // $image = $data['file_name'];
                // $imgname = $img_name;
                $image_thumb = dirname('thumb_' . $image . '/demo');
                $config['image_library'] = 'gd2';
                $config['source_image'] = './content/uploads/images/' . $image;
                $config['new_image'] = $image_thumb;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 240;
                $config['height'] = 180;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $data = array('upload_data' => $this->upload->data());
                $medianame = $this->input->post('media_name');
                $mediatype = $data['upload_data']['file_name'];
                $medialink = base_url() . 'content/images/' . $mediatype;
                $this->dbalbum->add_new_media($medianame, $mediatype, $media_association_id, $medialink);
                $this->session->set_flashdata('message', 'One media added sucessfully');
                
                redirect('media/medias');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
     public function editmedia($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbalbum->findmedia($id);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/media/editMedia', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    function updatemedia() {
        ini_set('memory_limit', '-1');
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|ppt|odt|pptx|docx|xls|xlsx|key.';
            $config['max_size'] = '2000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $listOfAlbum = $this->dbalbum->get_list_of_album();
            $data["listOfAlbum"] = $this->dbalbum->get_list_of_album();
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
                $mediaName = $_POST['selectAlbum'];
                $media_association_info = $this->dbalbum->get_media_association_info($mediaName);
                foreach ($media_association_info as $id) {
                    $media_association_id = $id->id;
                }
            }
            $this->form_validation->set_rules('media_name', 'media Name', 'required|xss_clean|max_length[200]');
            if ($this->form_validation->run() == FALSE) {
                $id = $this->input->post('id');
                $data['query'] = $this->dbalbum->findmedia($id);
                $this->load->view('bnw/media/editMedia', $data);
            } else {  //if valid
                if (empty($_FILES['file_name']['name'])) {
                    $id = $this->input->post('id');
                    $medianame = $this->input->post('media_name');
                    $mediatype = $this->input->post('prevfile');
                    $medialink = $this->input->post('media_link');
                    $this->dbalbum->update_media($id, $medianame, $mediatype, $media_association_id, $medialink);
                    $this->session->set_flashdata('message', 'Media data Modified Sucessfully');
                    $redirectPagination = $this->session->userdata("urlPagination");
                    redirect($redirectPagination);
                } else {
                    $id = $this->input->post('id');
                    $this->upload->do_upload('file_name');
                    $data = array('upload_data' => $this->upload->data());
                $medianame = $this->input->post('media_name');
                $mediatype = $data['upload_data']['file_name'];
                
                $image = $data['upload_data']['file_name'];
               
              //  $data = $this->upload->data();
               // $image = $data['file_name'];
                // $imgname = $img_name;
                $image_thumb = dirname('thumb_' . $image . '/demo');
                $config['image_library'] = 'gd2';
                $config['source_image'] = './content/uploads/images/' . $image;
                $config['new_image'] = $image_thumb;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 240;
                $config['height'] = 180;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                
                    $medialink = $this->input->post('media_link');
                    $this->dbalbum->update_media($id, $medianame, $mediatype, $media_association_id, $medialink);
                    $this->session->set_flashdata('message', 'Media data Modified Sucessfully');
                    $redirectPagination = $this->session->userdata("urlPagination");
                    redirect($redirectPagination);
                }
                $this->load->view('bnw/templates/footer', $data);
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
     public function deletemedia() {
        $id = $_POST['id'];
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $media = $this->dbalbum->get_imagename($id);
            foreach ($media as $med){
                $media_type = $med->media_type;
                $filename1 = './content/uploads/images/' . $media_type;
             $filename2 = './content/uploads/images/thumb_' . $media_type;
                if (file_exists($filename1)) {
                    unlink($filename1);
                } else {}
                if (file_exists($filename2)) {
                    unlink($filename2);
                } else {}
            }
          
            $this->dbalbum->delete_media($id);
//            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
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