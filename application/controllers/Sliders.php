<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sliders extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dbmodel');
        $this->load->model('dbdashboard');
        $this->load->model('dbsetting');
        $this->load->model('dbslider');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
    }

    public function index() {
        redirect('bnw');
    }

    //====================================SLIDER==================================================================//
    //============================================================================================================/

    public function slider() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "index.php/sliders/slider";
            $config["total_rows"] = $this->dbslider->record_count_slider();
            $config["per_page"] = 6;
            //$config["uri_segment"] = 3;

            $this->pagination->initialize($config);

            $slide = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbslider->get_slider($config["per_page"], $slide);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->session->set_userdata("urlPagination", $config["base_url"]."/".$slide);
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/slider/slideListing', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function addslider() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/sliderImages/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '10000';
            $config['max_width'] = '5000';
            $config['max_height'] = '5000';

            $this->load->library('upload', $config);

            $data['meta'] = $this->dbsetting->get_meta_data();

            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('slide_name', 'Title', 'required|callback_xss_clean|max_length[200]');
            $this->form_validation->set_rules('slide_content', 'Content', 'trim|callback_xss_clean');
            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file_name'))) {
                
                $data['error'] = $this->upload->display_errors();

                $this->load->view('bnw/slider/addnew', $data);
            } else {

                //if valid

                $data = array('upload_data' => $this->upload->data());
                $slidename = $this->input->post('slide_name');
                $slideimage = $data['upload_data']['file_name'];
                $slidecontent = $this->input->post('slide_content');

                //for cropper
                //require_once(APPPATH.'Imagemanipulator.php');
                include_once 'imagemanipulator.php';

                $manipulator = new ImageManipulator($_FILES['file_name']['tmp_name']);
                $width = $manipulator->getWidth();
                $height = $manipulator->getHeight();


                $slideWidth = $this->dbslider->get_slide_width();
                foreach ($slideWidth as $a) {
                    $fullWidth = $a->description;
                }
                $slideHeight = $this->dbslider->get_slide_height();
                foreach ($slideHeight as $b) {
                    $fullHeight = $b->description;
                }
                $halfWidth = round($fullWidth / 2);
                $halfHeight = round($fullHeight / 2);



                $centreX = round($width / 2);

                $centreY = round($height / 2);

                // our dimensions will be 200x130
                $x1 = $centreX - $halfWidth; // 200 / 2
                $y1 = $centreY - $halfHeight; // 130 / 2

                $x2 = $centreX + $halfWidth; // 200 / 2
                $y2 = $centreY + $halfHeight; // 130 / 2
                // center cropping to 200x130
                $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
                // saving file to uploads folder

                $manipulator->save('./content/uploads/sliderImages/' . $_FILES['file_name']['name']);
                //cropper closed  
                $data = $this->upload->data();
                $image = $data['file_name'];
                // die($image);
                // $imgname = $img_name;
                $image_thumb = dirname('thumb_' . $image . '/demo');
                $config['image_library'] = 'gd2';
                $config['source_image'] = './content/uploads/sliderImages/' . $image;
                $config['new_image'] = $image_thumb;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 240;
                $config['height'] = 180;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $this->dbslider->add_new_slider($slidename, $slideimage, $slidecontent);
                $this->session->set_flashdata('message', 'One slide added sucessfully');
                redirect('sliders/slider');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function editslider($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbslider->findslider($id);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/slider/edit', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function updateslider() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/sliderImages/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            // $config['max_size'] = '2000';
            // $config['max_width'] = '2000';
            // $config['max_height'] = '2000';

             $this->load->library('upload', $config);

            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('slide_name', 'Title', 'required|callback_xss_clean|max_length[200]');

            $slidename = $this->input->post('slide_name');
            $slidecontent = $this->input->post('slide_content');
            if ($this->form_validation->run() == FALSE) {
                $id = $this->input->post('id');
                $data['query'] = $this->dbslider->findslider($id);
                $this->load->view('bnw/slider/edit', $data);
            } else {
                $id = $this->input->post('id');
                if (empty($_FILES['file_name']['name'])) {
                    
                    $slideimage = $this->input->post('prevImg');
                    $this->dbslider->update_slider($id, $slidename, $slideimage, $slidecontent);
                    $this->session->set_flashdata('message', 'One slide modified sucessfully');
                    redirect('sliders/slider');
                } else {
                    
                    //if valid
                    $id = $this->input->post('id');
                    $this->upload->do_upload('file_name');
                   $data = array('upload_data' => $this->upload->data(''));
                    $slideimage = $data['upload_data']['file_name'];

                    include_once 'imagemanipulator.php';

                    $manipulator = new ImageManipulator($_FILES['file_name']['tmp_name']);
                    $width = $manipulator->getWidth();
                    $height = $manipulator->getHeight();


                    $slideWidth = $this->dbslider->get_slide_width();
                    foreach ($slideWidth as $a) {
                        $fullWidth = $a->description;
                    }
                    $slideHeight = $this->dbslider->get_slide_height();
                    foreach ($slideHeight as $b) {
                        $fullHeight = $b->description;
                    }
                    $halfWidth = round($fullWidth / 2);
                    $halfHeight = round($fullHeight / 2);



                    $centreX = round($width / 2);

                    $centreY = round($height / 2);

                    // our dimensions will be 200x130
                    $x1 = $centreX - $halfWidth; // 200 / 2
                    $y1 = $centreY - $halfHeight; // 130 / 2

                    $x2 = $centreX + $halfWidth; // 200 / 2
                    $y2 = $centreY + $halfHeight; // 130 / 2
                    // center cropping to 200x130
                    $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
                    // saving file to uploads folder

                    $manipulator->save('./content/uploads/sliderImages/' . $_FILES['file_name']['name']);
                    $data = $this->upload->data();
                    $image = $data['file_name'];
                    // die($image);
                    // $imgname = $img_name;
                    $image_thumb = dirname('thumb_' . $image . '/demo');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './content/uploads/sliderImages/' . $image;
                    $config['new_image'] = $image_thumb;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 240;
                    $config['height'] = 180;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $this->dbslider->update_slider($id, $slidename, $slideimage, $slidecontent);
                    $this->session->set_flashdata('message', 'One slide modified sucessfully');
                    $redirectPagination = $this->session->userdata("urlPagination");
                    redirect($redirectPagination);
                }
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function deleteslider() {
        $id = $_POST['id'];
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $slider = $this->dbslider->get_imagename($id);
            foreach ($slider as $slide){
                $slider_img = $slide->slide_image;
            }
  
$filename1 = './content/uploads/sliderImages/' . $slider_img;
$filename2 = './content/uploads/sliderImages/thumb_' . $slider_img;
if (file_exists($filename1)) {
    unlink($filename1);
} else {}
if (file_exists($filename2)) {
    unlink($filename2);
} else {}
            $this->dbslider->delete_slider($id);
//            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
//            redirect('sliders/slider');
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
    //============================================================================================================//
}
