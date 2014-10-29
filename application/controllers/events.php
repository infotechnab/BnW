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
    function event() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $config = array();
            $config["base_url"] = base_url() . "index.php/events/event";
            $config["total_rows"] = $this->dbevent->get_event();

            $config["per_page"] = 6;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data["event"] = $this->dbevent->get_event_data($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data["query"] = $this->dbdashboard->get_menu();
            //  $data["event"] = $this->dbmodel->get_event_data();
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
            ;
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data['event'] = $this->dbevent->get_event_id($id);

            // $data['id'] = $id;
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/event/editEvent', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    function delevent($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['event'] = $this->dbevent->get_event_id($id);
            foreach ($data['event'] as $a) {
                $img = $a->image;
            }
            // die($img);
            if ($img == !NULL) {
               // die($img);
                unlink('./content/uploads/images/' . $img);
                 unlink('./content/uploads/images/thumb_'.$img);
            }
            $this->dbevent->delete($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('events/event');
        } else {


            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    function update_event() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            // $config['max_size'] = '500';
            // $config['max_width'] = '1024';
            // $config['max_height'] = '768';
            $this->load->library('upload',$config);
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('Name', 'Name', 'required|xss_clean|max_length[200]');

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
                          unlink('./content/uploads/images/'.$name);
                         
                       // $imgname = $img_name;
                        $image_thumb = dirname('thumb_' . $image . '/demo');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './content/uploads/images/' . $image;
                        $config['new_image'] = $image_thumb;
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 100;
                        $config['height'] = 100;
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                        $id = $this->input->post('id');
                        $title = $this->input->post('Name');
                        $content = $this->input->post('description');
                     

                        $string = $this->input->post('description');
                        $summary = substr("$string", 0, 100);
                        $location = $this->input->post('location');
                        $date = $this->input->post('date');
                        $hour = $this->input->post('hour');
                        $min = $this->input->post('min');
                        $sec = 0;
                        $dateTime = $date . ' ' . $hour . ':' . $min . ':' . $sec;
                        $this->dbevent->update_event($id, $title, $content, $summary, $location, $image, $dateTime);
                        $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                        redirect('events/event');
                    }
                } else {
                    // die('not');
                    $id = $this->input->post('id');
                    $title = $this->input->post('Name');
                    $content = $this->input->post('description');

                    $image = $this->input->post('hidden_image');

                    $string = $this->input->post('description');
                    $summary = substr("$string", 0, 100);
                    $location = $this->input->post('location');
                    $date = $this->input->post('date');
                    $hour = $this->input->post('hour');
                    $min = $this->input->post('min');
                    $sec = 0;
                    $dateTime = $date . ' ' . $hour . ':' . $min . ':' . $sec;
                    $this->dbevent->update_event($id, $title, $content, $summary, $location, $image, $dateTime);
                    $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                    redirect('events/event');
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
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
           $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
           
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data["links"] = $this->pagination->create_links();
            $data["query"] = $this->dbdashboard->get_menu();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
             $this->load->library('upload');
          
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('event_name', 'Name', 'required|xss_clean|max_length[200]');

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
                          unlink('./content/uploads/images/'.$name);
                          
                       // $imgname = $img_name;
                        $image_thumb = dirname('thumb_' . $image . '/demo');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './content/uploads/images/' . $image;
                        $config['new_image'] = $image_thumb;
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 100;
                        $config['height'] = 100;
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                         $eventName = $this->input->post('event_name');
                        $detail = $this->input->post('detail');
                        $location = $this->input->post('location');
                        $date = $this->input->post('date');
                        $hour = $this->input->post('hour');
                        $min = $this->input->post('min');
                        $sec = 0;
                        $dateTime = $date . ' ' . $hour . ':' . $min . ':' . $sec;
                      
                        $this->dbevent->add_event($eventName, $detail, $location, $dateTime, $image);
                        $this->session->set_flashdata('message', 'One event added sucessfully');
                        redirect('events/event');
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
                    $date = $this->input->post('date');
                    $hour = $this->input->post('hour');
                    $min = $this->input->post('min');
                    $sec = 0;
                    $dateTime = $date . ' ' . $hour . ':' . $min . ':' . $sec;
                    $this->dbevent->add_event($name, $detail, $location, $dateTime, $image);
                    $this->session->set_flashdata('message', 'One event added sucessfully');
                    redirect('events/event');
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
                unlink('./content/uploads/images/'.$img);
               
            }
            $this->dbevent->Imgdelete($id);

            $this->editevent($id);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    //=============================== CLOSE EVENTS ================================================//
}
