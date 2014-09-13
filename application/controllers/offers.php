<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Offers extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dbmodel');
        $this->load->model('dbdashboard');
        $this->load->model('dbevent');
        $this->load->model('dboffers');
        $this->load->model('dbsetting');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
    }

    public function index() {
        redirect('bnw');
    }
    //============================= START OFFER =====================================//
    public function posts() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/offers/posts";
            $config["total_rows"] = $this->dboffers->record_count_post();
            $config["per_page"] = 6;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data["query"] = $this->dboffers->get_all_posts($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbsetting->get_meta_data();

            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/posts/postListing', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
     public function addpost() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $username = $this->session->userdata('username');
            $data['username'] = ($this->session->userdata('admin_logged_in'));
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            // $config['max_size'] = '500';
            // $config['max_width'] = '1024';
            // $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data['query'] = $this->dboffers->get_posts();
            $data['query'] = $this->dbsetting->get_misc_setting();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->helper('date');
            $this->load->library(array('form_validation', 'session'));
            $listOfCategory = $this->dbdashboard->get_list_of_category();
            $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();

//            if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
//                $categoryName = $_POST['selectCategory'];
//                $post_category_info = $this->dbmodel->get_post_category_info($categoryName);
//                foreach ($post_category_info as $pid) {
//                    $post_category_id = $pid->id;
//                }
//            }
            //set validation rules
            $this->form_validation->set_rules('post_title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('post_content', 'Body', 'required|xss_clean');



            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['offreImage']['name'] !== "") {
                    if (!$this->upload->do_upload('offreImage')) {
                        $error = array('error' => $this->upload->display_errors('offreImage'));
                        $this->load->view('bnw/posts/addNewPost', $error);
                    } else {
                        // die('img');
                        include_once 'imagemanipulator.php';

                        $manipulator = new ImageManipulator($_FILES['offreImage']['tmp_name']);
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
                        $manipulator->save('./content/uploads/images/' . $_FILES['offreImage']['name']);
                         $data = $this->upload->data();
                        $image = $data['file_name'];
                       // die($image);
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
                        $data = array('upload_data' => $this->upload->data('offreImage'));
                        $image = $data['upload_data']['file_name'];
                        $post_title = $this->input->post('post_title');
                        $post_content = $this->input->post('post_content');
                        $string = $this->input->post('post_content');
                        $post_summary = substr("$string", 0, 100);
                        $post_status = $this->input->post('post_status');

                        $this->dboffers->add_new_post($post_title, $post_content, $post_summary, $post_status, $image);
                        $this->session->set_flashdata('message', 'One offer added sucessfully');
                        redirect('offers/posts');
                    }
                } else {
                    //die('not');
                    $image = NULL;
                    $post_title = $this->input->post('post_title');
                    $post_content = $this->input->post('post_content');
                    $post_author_info = $this->dboffers->get_post_author_id($username);
                    foreach ($post_author_info as $pid) {
                        $post_author_id = $pid->id;
                    }
                    $string = $this->input->post('post_content');
                    $post_summary = substr("$string", 0, 100);
                    $post_status = $this->input->post('post_status');
                    $post_comment_status = $this->input->post('comment_status');
                    $post_tags = $this->input->post('post_tags');
                    // $post_category_info = $this->dbmodel->get_post_category_info($categoryName);
                    $allowComment = $this->input->post('allow_comment');
                    $allowLike = $this->input->post('allow_like');
                    $allowShare = $this->input->post('allow_share');
                    $this->dboffers->add_new_post($post_title, $post_content, $post_summary, $post_status, $image);
                    // $this->dbmodel->add_new_post($post_title, $post_content, $post_author_id, $post_summary, $post_status, $post_comment_status, $post_tags, $post_category_id, $allowComment, $allowLike, $allowShare);
                    $this->session->set_flashdata('message', 'One Offer added sucessfully');
                    redirect('offers/posts');
                }
            } else {

                $this->load->view('bnw/posts/addNewPost', $data);
            }

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
     function editpost($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dboffers->findpost($id);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data['miscSetting'] = $this->dbsetting->get_misc_setting();
            $data['id'] = $id;
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/posts/editPost', $data);

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
     public function deletepost($id = 0) {
//        $url = current_url();
//        if ($this->session->userdata('admin_logged_in')) {
//           // $this->dboffers->deletepost($id);
//         
//            $this->session->set_flashdata('message', 'Data Deleted Sucessfully');
//            redirect('offers/posts');
//        } else {
//            redirect('login/index/?url=' . $url, 'refresh');
//        }
          $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            //$id = $_GET['id'];
            $data['query'] = $this->dboffers->findpost($id);
            foreach ($data['query'] as $a) {
                $img = $a->image;
            }
            // die($img);
            if ($img == !NULL) {
                unlink('./content/uploads/images/' . $img);
                unlink('./content/uploads/images/thumb_' . $img);
            }
            $this->dboffers->offerImgdelete($id);
            $this->dboffers->deletepost($id);
             $this->session->set_flashdata('message', 'Data Deleted Sucessfully');
           redirect('offers/posts');
            //$this->editpost($id);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    
     public function updatepost() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            //$config['max_size'] = '500';
           // $config['max_width'] = '1024';
           // $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data['miscSetting'] = $this->dbsetting->get_misc_setting();
            $data['query'] = $this->dboffers->get_posts();
            $username = $this->session->userdata('username');
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $listOfCategory = $this->dbdashboard->get_list_of_category();

            $data["listOfCategory"] = $this->dbdashboard->get_list_of_category();
            $id = $this->input->post('id');
            $data['query'] = $this->dboffers->findpost($id);

//            if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
//                $categoryName = $_POST['selectCategory'];
//                $post_category_info = $this->dbmodel->get_post_category_info($categoryName);
//                foreach ($post_category_info as $pid) {
//                    $post_category_id = $pid->id;
//                }
//            }
            //set validation rules
            $this->form_validation->set_rules('post_title', 'Page Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('post_content', 'Body', 'required|xss_clean');


            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('file')) {
                       
                        $data['error'] = $this->upload->display_errors('file');
                        $id = $this->input->post('id');
                        $data['query'] = $this->dboffers->findpost($id);
                        $this->load->view('bnw/posts/editPost', $data);
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
                         $data = $this->upload->data();
                        $image = $data['file_name'];
                       // die($image);
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
                        $id = $this->input->post('id');
                        $post_title = $this->input->post('post_title');
                        $post_content = $this->input->post('post_content');
                        $data = array('upload_data' => $this->upload->data('file'));
                        $image = $data['upload_data']['file_name'];
                        
//                        $post_author_info = $this->dbmodel->get_post_author_id($username);
//                        foreach ($post_author_info as $pid) {
//                            $post_author_id = $pid->id;
//                        }
                        $string = $this->input->post('post_content');
                        $post_summary = substr("$string", 0, 100);
//                        $post_status = $this->input->post('page_status');
//                        $post_comment_status = $this->input->post('comment_status');
//                        $post_tags = $this->input->post('post_tags');
//                        $allowComment = $this->input->post('allow_comment');
//                        $allowLike = $this->input->post('allow_like');
//                        $allowShare = $this->input->post('allow_share');
                        $this->dboffers->update_post($id, $post_title, $post_content, $post_summary, $image);
                        $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                        redirect('offers/posts');
                    }
                } else {
                    $id = $this->input->post('id');
                    $post_title = $this->input->post('post_title');
                    $post_content = $this->input->post('post_content');
//                    $post_author_info = $this->dbmodel->get_post_author_id($username);
//                    foreach ($post_author_info as $pid) {
//                        $post_author_id = $pid->id;
//                    }
                    $string = $this->input->post('post_content');
                    $post_summary = substr("$string", 0, 100);
                    $post_image = $this->input->post('hidden_image');
//                    $post_status = $this->input->post('page_status');
//                    $post_comment_status = $this->input->post('comment_status');
//                    $post_tags = $this->input->post('post_tags');
//                    $allowComment = $this->input->post('allow_comment');
//                    $allowLike = $this->input->post('allow_like');
//                    $allowShare = $this->input->post('allow_share');
                    $this->dboffers->update_post($id, $post_title, $post_content, $post_summary, $post_image);
                    $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                    redirect('offers/posts');
                }
            } else {
                $id = $this->input->post('id');
                $data['query'] = $this->dboffers->findpost($id);
                $this->load->view('bnw/posts/editPost', $data);
            }

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    function offerImgdelete($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $id = $_GET['id'];
            $data['query'] = $this->dboffers->findpost($id);
            foreach ($data['query'] as $a) {
                $img = $a->image;
            }
             die($img);
            if ($img == !NULL) {
                unlink('./content/uploads/images/' . $img);
                unlink('./content/uploads/images/thumb_' . $img);
            }
            $this->dboffers->offerImgdelete($id);

            $this->editpost($id);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
}