<?php if (!defined('BASEPATH'))
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
            $config["base_url"] = base_url() . "index.php/album/album";
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
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
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
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            
            $this->load->library('upload', $config);
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
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
                        $ratio = $realwidth/1000;
                        $ax1 = (int) $_POST['x']; 
                        $ay1 = (int) $_POST['y']; 
                        $x1 = $ax1*$ratio;
                        $y1 = $ay1*$ratio;
                        $height = $newHeight*$ratio;
                        $width = $newWidth*$ratio;
                        
                        $x2 = $x1 + $width; 
                        $y2 = $y1 + $height;    
                       
                        // center cropping to 200x130
                        $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
                        $name = $_FILES['file']['name'];
                        $key = $this->getRandomStringForCoupen(5);
                        $image = $key.$name;
                        $manipulator->save('./content/uploads/images/' .$image);
                          unlink('./content/uploads/images/'.$name);
                       // $imgname = $img_name;
                        $image_thumb = dirname('thumb_' . $image . '/demo');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './content/uploads/images/' . $image;
                        $config['new_image'] = $image_thumb;
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 100;
                        $config['height'] = 75;
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                $medianame = $this->input->post('title');
                $albumid = $this->input->post('id');
                $medialink = $this->input->post('media_link');
                $this->dbalbum->add_new_photo($medianame, $image, $albumid, $medialink);
                $this->session->set_flashdata('message', 'One photo added sucessfully');
                redirect('album/photos/'.$albumid);
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    public function delphoto($photoid = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbalbum->get_photo_media_id($photoid);

            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/album/deletePhoto', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    public function deletephoto($a = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $a = $_GET['image'];
            unlink('./content/uploads/images/' . $a);
            unlink('./content/uploads/images/thumb_' . $a);
            $this->dbalbum->delete_photo($a);
            $this->session->set_flashdata('message', 'Image Deleted Sucessfully');
            redirect('album/addalbum');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
     public function add_new_album() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
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
            redirect('login/index/?url=' . $url, 'refresh');        }
    }
    public function delalbum($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['photoquery'] = $this->dbalbum->get_all_photos($id);
            $data['albumquery'] = $this->dbalbum->get_selected_album($id);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/album/deleteAlbum', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    function delete_album($id) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['photoquery'] = $this->dbalbum->get_all_photos($id);
            foreach ($data['photoquery'] as $photo) {
                $image = $photo->media_type;
                unlink('./content/uploads/images/' . $image);
            }
            $this->dbalbum->delete_photo($id);
            $this->dbalbum->delete_album($id);
            $this->session->set_flashdata('message', 'One album Deleted Sucessfully');
                redirect('album/addalbum');
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
    //============================== media ============================================//
    public function media() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "index.php/album/media";
            $config["total_rows"] = $this->dbuser->record_count_user();
            $config["per_media"] = 6;
            $this->pagination->initialize($config);
            $media = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbuser->get_all_user($config["per_media"], $media);
            $data["links"] = $this->pagination->create_links();
            $data['query'] = $this->dbalbum->get_all_media();
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/media/mediaListing', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    //===============================to add media=================================================
    public function addmedia() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|ppt|odt|pptx|docx|xls|xlsx|key';
            $config['max_size'] = '2000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $listOfAlbum = $this->dbalbum->get_list_of_album();
            $data["listOfAlbum"] = $this->dbalbum->get_list_of_album();
            $data['meta'] = $this->dbalbum->get_meta_data();
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
            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file_name'))) {
                $data['error'] = $this->upload->display_errors();
                $this->load->view('bnw/media/addNew', $data);
            } else {   //if valid
                         $data = $this->upload->data();
                        $image = $data['file_name'];
                       // $imgname = $img_name;
                        $image_thumb = dirname('thumb_' . $image . '/demo');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './content/uploads/images/' . $image;
                        $config['new_image'] = $image_thumb;
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 100;
                        $config['height'] = 75;
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                $data = array('upload_data' => $this->upload->data('file'));
                $medianame = $this->input->post('media_name');
                $mediatype = $data['upload_data']['file_name'];
                $medialink = base_url() . 'content/images/' . $mediatype;
                $this->dbalbum->add_new_media($medianame, $mediatype, $media_association_id, $medialink);
                $this->session->set_flashdata('message', 'One media added sucessfully');
                redirect('album/media');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    //==================================To edit media==================================================
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
    //======================================To update edited media=========================================
    function updatemedia() {
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
          if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file_name'))) {
                $data['error'] = $this->upload->display_errors();  //if not valid
                $id = $this->input->post('id');
                $data['query'] = $this->dbalbum->findmedia($id);
                $this->load->view('bnw/media/editMedia', $data);
            } else {  //if valid
                $id = $this->input->post('id');
                $data = array('upload_data' => $this->upload->data('file'));
                $medianame = $this->input->post('media_name');
                $mediatype = $data['upload_data']['file_name'];
                $medialink = $this->input->post('media_link');
                $this->dbalbum->update_media($id, $medianame, $mediatype, $media_association_id, $medialink);
                $this->session->set_flashdata('message', 'Media data Modified Sucessfully');
                redirect('album/media');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }        
        }
    public function delmedia($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbalbum->findmedia($id);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/media/deleteMedia', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }        
        }
    public function deletemedia($id) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $id = $_GET['image'];
            unlink('./content/uploads/images/' . $id);
            unlink('./content/uploads/images/thumb_' . $id);
            $this->dbalbum->delete_media($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('album/media');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }//--------------------------------gallery---------------
    public function gallery() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbalbum->get_all_photos();
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/gallery/index', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }        
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
        }