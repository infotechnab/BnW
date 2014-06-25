<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Events extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dbmodel');
        $this->load->model('dbdashboard');
        $this->load->model('dbevent');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
    }

    public function index() {
        redirect('bnw');
    }
    
    //================================ START EVENTS ======================================================//
    function event() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/event";
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
            $data['meta'] = $this->dbmodel->get_meta_data();
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
                unlink('./content/uploads/images/' . $img);
            }
            $this->dbmodel->delete($id);
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
            $this->load->library('upload', $config);
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
                        //  die('image');
                        include_once 'imagemanipulator.php';

                        $manipulator = new ImageManipulator($_FILES['file']['tmp_name']);
                        $width = $manipulator->getWidth();
                        $height = $manipulator->getHeight();

                        $centreX = round($width / 2);

                        $centreY = round($height / 2);

                        // our dimensions will be 200x130
                        $x1 = $centreX - 374; // 200 / 2
                        $y1 = $centreY - 150; // 130 / 2

                        $x2 = $centreX + 374; // 200 / 2
                        $y2 = $centreY + 150; // 130 / 2
                        // center cropping to 200x130
                        $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
                        // saving file to uploads folder
                        $manipulator->save('./content/uploads/images/' . $_FILES['file']['name']);
                        $id = $this->input->post('id');
                        $title = $this->input->post('Name');
                        $content = $this->input->post('description');
                        $data = array('upload_data' => $this->upload->data('file'));
                        $image = $data['upload_data']['file_name'];

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
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);



            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data["links"] = $this->pagination->create_links();
            $data["query"] = $this->dbdashboard->get_menu();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('event_name', 'Name', 'required|xss_clean|max_length[200]');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('bnw/event/addEvent');
            } else {

                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('file')) {
                        $error = array('error' => $this->upload->display_errors('file'));
                        $this->load->view('bnw/event/addEvent', $error);
                    } else {
                        include_once 'imagemanipulator.php';

                        $manipulator = new ImageManipulator($_FILES['file']['tmp_name']);
                        $width = $manipulator->getWidth();
                        $height = $manipulator->getHeight();

                        $centreX = round($width / 2);

                        $centreY = round($height / 2);

                        // our dimensions will be 200x130
                        $x1 = $centreX - 374; // 200 / 2
                        $y1 = $centreY - 150; // 130 / 2

                        $x2 = $centreX + 374; // 200 / 2
                        $y2 = $centreY + 150; // 130 / 2
                        // center cropping to 200x130
                        $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
                        // saving file to uploads folder
                        $manipulator->save('./content/uploads/images/' . $_FILES['file']['name']);
                        $data = array('upload_data' => $this->upload->data('file'));
                        $image = $data['upload_data']['file_name'];
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
                } else {

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
    //=============================== CLOSE EVENTS ================================================//
}
