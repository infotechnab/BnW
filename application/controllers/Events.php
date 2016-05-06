<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Events extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dbmodel');
        $this->load->model('dbdashboard');
        $this->load->model('dbsetting');
        $this->load->model('dbevent');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $this->load->helper('seourl_helper');
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
    //================================ START EVENTS ======================================================//
    function allevents() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $config = array();
            $config["base_url"] = base_url() . "index.php/events/allevents";
            $config["total_rows"] = $this->dbevent->get_event();
            $config["per_page"] = 6;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["event"] = $this->dbevent->get_event_data($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data["query"] = $this->dbdashboard->get_menu();
            $this->session->set_userdata("urlPagination", $config["base_url"]."/".$page);
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('bnw/event/eventList', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

     function editevent($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data['event'] = $this->dbevent->get_event_id($id);
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/event/editEvent', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    function delevent() {
        $id = $_POST['id'];
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['event'] = $this->dbevent->get_event_id($id);
            foreach ($data['event'] as $a) {
                $img = $a->image;
            }
            if (!empty($img)) {
               $filename1 = './content/uploads/images/'.$img;
            $filename2 = './content/uploads/images/thumb_'.$img;
if (file_exists($filename1)) {
    unlink($filename1);
} else {}
if (file_exists($filename2)) {
    unlink($filename2);
} else {}
            }
            $this->dbevent->delete($id);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    function update_event() {
         ini_set('memory_limit', '-1');
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            
            $this->load->library('upload',$config);
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('Name', 'Name', 'required|callback_xss_clean|max_length[200]');

            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('file')) {

                        $data['error'] = $this->upload->display_errors('file');
                        $id = $this->input->post('id');
                        $data['query'] = $this->dbevent->get_event_id($id);
                        $this->load->view('bnw/event/editEvent', $data);
                    } else {
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
                        $filename1 = './content/uploads/images/'.$name;
if (file_exists($filename1)) {
    unlink($filename1);
} else {}
                         
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
                        $id = $this->input->post('id');
                        $title = $this->input->post('Name');
                        $content = $this->input->post('description');
                        $location = $this->input->post('location');
                        $type = $this->input->post('event_type');
                        $start_date = $this->input->post('start_date');
                        $end_date = $this->input->post('end_date');
                        $start_hour = $this->input->post('start_hour');
                        $end_hour = $this->input->post('end_hour');
                        $start_min = $this->input->post('start_min');
                         $end_min = $this->input->post('end_min');
                        $sec = 0;
                        $start_dateTime = $start_date . ' ' . $start_hour . ':' . $start_min . ':' . $sec;
                        $end_dateTime = $end_date . ' ' . $end_hour . ':' . $end_min . ':' . $sec;
                        date_default_timezone_set('Asia/Kathmandu');
                        $updatedOn = date('Y-m-d');
                        $config = array(
                            'field' => 'seo_title',
                            'table' => 'events',
                             'id'=> 'id'
                        );
                        $this->load->library('slug', $config);
                        $seoTitle = $this->slug->create_uri($title, $id);
                        $this->dbevent->update_event($id, $title, $content, $location, $image, $start_dateTime, $end_dateTime, $type, $updatedOn, $seoTitle);
                        $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                        $redirectPagination = $this->session->userdata("urlPagination");
                        redirect($redirectPagination);
                    }
                } else {
                    // die('not');
                    $id = $this->input->post('id');
                    $title = $this->input->post('Name');
                    $content = $this->input->post('description');

                    $image = $this->input->post('hidden_image');
                    $location = $this->input->post('location');
                    $type = $this->input->post('event_type');
                    $start_date = $this->input->post('start_date');
                        $end_date = $this->input->post('end_date');
                        $start_hour = $this->input->post('start_hour');
                        $end_hour = $this->input->post('end_hour');
                        $start_min = $this->input->post('start_min');
                         $end_min = $this->input->post('end_min');
                        $sec = 0;
                        $start_dateTime = $start_date . ' ' . $start_hour . ':' . $start_min . ':' . $sec;
                        $end_dateTime = $end_date . ' ' . $end_hour . ':' . $end_min . ':' . $sec;
                    date_default_timezone_set('Asia/Kathmandu');
                    $updatedOn = date('Y-m-d');
                    $config = array(
                            'field' => 'seo_title',
                            'table' => 'events',
                         'id'=> 'id'
                        );
                        $this->load->library('slug', $config);
                        $seoTitle = $this->slug->create_uri($title, $id);
                    $this->dbevent->update_event($id, $title, $content, $location, $image, $start_dateTime, $end_dateTime, $type, $updatedOn, $seoTitle);
                    $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                    $redirectPagination = $this->session->userdata("urlPagination");
                    redirect($redirectPagination);
                }
            } else {
                $id = $this->input->post('id');
                $data['query'] = $this->dbevent->get_event_id($id);
                $this->load->view('bnw/event/editEvent', $data);
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    function addevent() {
         ini_set('memory_limit', '-1');
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
           $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
           
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data["links"] = $this->pagination->create_links();
            $data["query"] = $this->dbdashboard->get_menu();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
             $this->load->library('upload');
          
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('event_name', 'Name', 'required|callback_xss_clean|max_length[200]');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('bnw/event/addEvent');
            } else {
                 if (!empty($_FILES['file']['name'])) {
                            
                    // Initialize config for File 1
                    $this->upload->initialize($config);
                    // Upload file 1
                    if ($this->upload->do_upload('file')) {     
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
                        $filename1 = './content/uploads/images/'.$name;
if (file_exists($filename1)) {
    unlink($filename1);
} else {}
                          
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
                         $name = $this->input->post('event_name');
                        $detail = $this->input->post('detail');
                        $location = $this->input->post('location');
                        $type = $this->input->post('event_type');
                        $start_date = $this->input->post('start_date');
                        $end_date = $this->input->post('end_date');
                        $start_hour = $this->input->post('start_hour');
                        $end_hour = $this->input->post('end_hour');
                        $start_min = $this->input->post('start_min');
                         $end_min = $this->input->post('end_min');
                        $sec = 0;
                        $start_dateTime = $start_date . ' ' . $start_hour . ':' . $start_min . ':' . $sec;
                        $end_dateTime = $end_date . ' ' . $end_hour . ':' . $end_min . ':' . $sec;
                        $dt = new DateTime();
                        $insert_date = $dt->format('Y-m-d H:i:s');
                        $config = array(
                            'field' => 'seo_title',
                            'table' => 'events',
                        );
                        $this->load->library('slug', $config);
                        $seoTitle = $this->slug->create_uri($name);
                      if($type == "news") {
                        $this->dbevent->add_news($name, $detail, $location, $insert_date, $image, $type, $seoTitle);
                        $this->session->set_flashdata('message', 'One news added sucessfully');
                      }
                      if($type == "event") {
                        $this->dbevent->add_event($name, $detail, $location, $start_dateTime,$end_dateTime, $insert_date, $image, $type, $seoTitle);
                        $this->session->set_flashdata('message', 'One event added sucessfully');
                      }
                        redirect('events/allevents');
                    } else {
                        $error = array('error' => $this->upload->display_errors('file'));
                        $this->load->view('bnw/event/addEvent', $error);
                    }              
               }
                else {
                    //if valid
                    $image = NULL;
                    $name = $this->input->post('event_name');
                    $detail = $this->input->post('detail');
                    $location = $this->input->post('location');
                    $type = $this->input->post('event_type');
                     $start_date = $this->input->post('start_date');
                        $end_date = $this->input->post('end_date');
                        $start_hour = $this->input->post('start_hour');
                        $end_hour = $this->input->post('end_hour');
                        $start_min = $this->input->post('start_min');
                         $end_min = $this->input->post('end_min');
                        $sec = 0;
                        $start_dateTime = $start_date . ' ' . $start_hour . ':' . $start_min . ':' . $sec;
                        $end_dateTime = $end_date . ' ' . $end_hour . ':' . $end_min . ':' . $sec;
                    $dt = new DateTime();
                    $insert_date = $dt->format('Y-m-d H:i:s');
                    $config = array(
                            'field' => 'seo_title',
                            'table' => 'events',
                        );
                        $this->load->library('slug', $config);
                        $seoTitle = $this->slug->create_uri($name);
                      if($type == "news") {
                        $this->dbevent->add_news($name, $detail, $location, $insert_date, $image, $type, $seoTitle);
                        $this->session->set_flashdata('message', 'One news added sucessfully');
                      }
                      if($type == "event") {
                        $this->dbevent->add_event($name, $detail, $location, $start_dateTime, $end_dateTime, $insert_date, $image, $type, $seoTitle);
                        $this->session->set_flashdata('message', 'One event added sucessfully');
                      }
                    redirect('events/allevents');
                }
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    function Imgdelete($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $id = $_GET['id'];
            $data['event'] = $this->dbevent->get_event_id($id);
            foreach ($data['event'] as $a) {
                $img = $a->image;
            }
            // die($img);
            if ($img == !NULL) {
               // die($img);
                $filename1 = './content/uploads/images/'.$img;
            $filename2 = './content/uploads/images/thumb_'.$img;
if (file_exists($filename1)) {
    unlink($filename1);
} else {}
if (file_exists($filename2)) {
    unlink($filename2);
} else {}
            }
            $this->dbevent->Imgdelete($id);

            $this->editevent($id);
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
    //=============================== CLOSE EVENTS ================================================//
}
