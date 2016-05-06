<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dbmodel');
        $this->load->model('dbdashboard');
        $this->load->model('dbsetting');
        $this->load->model('dbpage');
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

    public function pages($id = NULL) {
        if($id == "0") {
            redirect("page/pages");
            exit();
        }
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/page/pages";
            $config["total_rows"] = $this->dbpage->record_count_page();
            $config["per_page"] = 6;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $pagedata["query"] = $this->dbpage->get_all_pages($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->session->set_userdata("urlPagination", $config["base_url"]."/".$page);
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/pages/pageListing', $pagedata);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //============== ADD PAGE ==============//

    public function addpage() {
         ini_set('memory_limit', '-1');
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $username = $this->session->userdata('username');
            $data['username'] = ($this->session->userdata('admin_logged_in'));
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $pagedata['query'] = $this->dbpage->get_pages();
            $data['query'] = $this->dbsetting->get_misc_setting();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->helper('date');
            $this->load->library(array('form_validation', 'session'));

            $this->form_validation->set_rules('page_name', 'Title', 'required|callback_xss_clean|max_length[200]');
            $this->form_validation->set_rules('page_content', 'Body', 'required');


            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('file')) {
                        $data['error'] = array('error' => $this->upload->display_errors('file'));
                        $this->load->view('bnw/pages/addnew', $data);
                    } else {
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

                        $pageName = $this->input->post('page_name');
                        $body = $this->input->post('page_content');
                        $page_author_info = $this->dbpage->get_page_author_id($username);
                        foreach ($page_author_info as $id) {
                            $page_author_id = $id->id;
                        }
                        $summary = substr("$body", 0, 100);
                        $status = $this->input->post('page_status');
                        $order = $this->input->post('page_order');
                        $type = $this->input->post('page_type');
                        $tags = $this->input->post('page_tags');
                        $allowComment = $this->input->post('allow_comment');
                        $allowLike = $this->input->post('allow_like');
                        $allowShare = $this->input->post('allow_share');
                        $template = $this->input->post('page_template');
                        $config = array(
                            'field' => 'seo_title',
                            'table' => 'page',
                        );
                        $this->load->library('slug', $config);
                        $seoTitle = $this->slug->create_uri($pageName);
                        var_dump($seoTitle);
                        die;
                        $this->dbpage->add_new_page($pageName, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare, $image, $template, $seoTitle);
                        $this->session->set_flashdata('message', 'One pages added sucessfully');
                        redirect('page/pages');
                    }
                } else {
                    //die('not');
                    $image = "";
                    $pageName = $this->input->post('page_name');
                    $body = $this->input->post('page_content');
                    $page_author_info = $this->dbpage->get_page_author_id($username);
                    foreach ($page_author_info as $id) {
                        $page_author_id = $id->id;
                    }
                    $summary = substr("$body", 0, 100);
                    $status = $this->input->post('page_status');
                    $order = $this->input->post('page_order');
                    $type = $this->input->post('page_type');
                    $tags = $this->input->post('page_tags');
                    $allowComment = $this->input->post('allow_comment');
                    $allowLike = $this->input->post('allow_like');
                    $template = $this->input->post('page_template');
                    
                    if(isset($_POST["allow_share"])){
                        $allowShare = $this->input->post('allow_share');
                    }else{
                        $allowShare=0;
                    }
                    $config = array(
                        'field' => 'seo_title',
                        'table' => 'page',
                    );
                    $this->load->library('slug', $config);
                    $seoTitle = $this->slug->create_uri($pageName);
                    
                    $this->dbpage->add_new_page($pageName, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare, $image, $template, $seoTitle);
                    $this->session->set_flashdata('message', 'One pages added sucessfully');
                    redirect('page/pages');
                }
            } else {
                $this->load->view('bnw/pages/addnew', $data);
            }

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //======================EDIT PAGE===============================//

    function editpage($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbpage->findpage($id);

            $data['meta'] = $this->dbsetting->get_meta_data();
            $data['miscSetting'] = $this->dbsetting->get_misc_setting();
            $data['id'] = $id;

            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/pages/edit', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //======================UPDATE EDITED PAGE===============================//
  public function updatepage() {
      ini_set('memory_limit', '-1');
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
           
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data['miscSetting'] = $this->dbsetting->get_misc_setting();
            $username = $this->session->userdata('username');
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
           $id = $this->input->post('id');
                        $data['query'] = $this->dbpage->findpage($id);
            $this->form_validation->set_rules('page_name', 'Page Name', 'required|callback_xss_clean|max_length[200]');
            $this->form_validation->set_rules('page_content', 'Body', 'required');


            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('file')) {
                       
                        $data['error'] = $this->upload->display_errors('file');
                        $id = $this->input->post('id');
                        $data['query'] = $this->dbpage->findpage($id);
                        $this->load->view('bnw/pages/edit', $data);
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
                        $post_title = $this->input->post('post_title');
                        $pageName = $this->input->post('page_name');
                        $body = $this->input->post('page_content');
                        $page_author_info = $this->dbpage->get_page_author_id($username);
                        foreach ($page_author_info as $pid) {
                            $page_author_id = $pid->id;
                        }
                       
                        $summary = substr("$body", 0, 100);
                        $status = $this->input->post('page_status');
                        $order = $this->input->post('page_order');
                        $type = $this->input->post('page_type');
                        $tags = $this->input->post('page_tags');
                        $allowComment = $this->input->post('allow_comment');
                        $allowLike = $this->input->post('allow_like');
                        $allowShare = $this->input->post('allow_share');
                        $template = $this->input->post('page_template');
                        $config = array(
                            'field' => 'seo_title',
                            'table' => 'page',
                            'id'=> 'id'
                        );
                        $this->load->library('slug', $config);
                        $seoTitle = $this->slug->create_uri($pageName, $id);
                        $navigationName = $pageName;
                        $navigationLink = base_url() . "page/" . $seoTitle;
                        $navigationSlug = $seoTitle;
                        $pageid = $id;
                        $this->dbpage->update_page($id, $pageName, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare, $image, $template, $seoTitle);
                        $this->dbpage->update_navigation_on_page_update($pageid, $navigationName, $navigationLink, $navigationSlug);
                        $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                        $redirectPagination = $this->session->userdata("urlPagination");
                        redirect($redirectPagination);
                    }
                } else {
                    $id = $this->input->post('id');
                        $post_title = $this->input->post('post_title');
                        $pageName = $this->input->post('page_name');
                        $body = $this->input->post('page_content');
                        $page_author_info = $this->dbpage->get_page_author_id($username);
                        foreach ($page_author_info as $pid) {
                            $page_author_id = $pid->id;
                        }
                       
                        $summary = substr("$body", 0, 100);
                        $status = $this->input->post('page_status');
                        $order = $this->input->post('page_order');
                        $type = $this->input->post('page_type');
                        $tags = $this->input->post('page_tags');
                        $allowComment = $this->input->post('allow_comment');
                        $allowLike = $this->input->post('allow_like');
                        $allowShare = $this->input->post('allow_share');
                        $template = $this->input->post('page_template');
                        $config = array(
                            'field' => 'seo_title',
                            'table' => 'page',
                            'id'=> 'id'
                        );
                        $this->load->library('slug', $config);
                        $seoTitle = $this->slug->create_uri($pageName, $id);
                        $navigationName = $pageName;
                        $navigationLink = base_url() . "page/" . $seoTitle;
                        $navigationSlug = $seoTitle;
                        $pageid = $id;
                        $past_image = $this->input->post('imageName');
                        $this->dbpage->update_page($id, $pageName, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare, $past_image, $template, $seoTitle);
                        $this->dbpage->update_navigation_on_page_update($pageid, $navigationName, $navigationLink, $navigationSlug);
                        $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                        $redirectPagination = $this->session->userdata("urlPagination");
                        redirect($redirectPagination);
                }
            } else {
                $id = $this->input->post('id');
                $data['query'] = $this->dbpage->findpage($id);
                $this->load->view('bnw/pages/edit', $data);
            }

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

   
    public function deletepage() {
        if(isset($_POST['id'])){
        $id = $_POST['id'];
        } else {
            $id = 0;
        }
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbpage->findpage($id);
            foreach ($data['query'] as $a) {
                $img = $a->images;
            }
            if (isset($img) && $img == " ") {
                $filename1 = './content/uploads/images/' . $img;
                $filename2 = './content/uploads/images/thumb_' . $img;
                if (file_exists($filename1)) {
                    unlink($filename1);
                } else {
                    
                }
                if (file_exists($filename2)) {
                    unlink($filename2);
                } else {
                    
                }
            }
            $menuNo = $this->dbdashboard->check_navigation_for_page($id);
            if ($menuNo > 0) {
                echo "This page contains Navigation item associated. So delete navigation item associated with it first.";
//                $this->session->set_flashdata('message', 'This menu contains Navigation item associated. So to delete this menu delete navigation item associated with it first.');
//                redirect('dashboard/addmenu');
            } else {
                $this->dbpage->delete_page($id);
//                $this->session->set_flashdata('message', 'Data Delete Sucessfully');
//                redirect('dashboard/addmenu');
            }
//            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
//            redirect('page/pages');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function pageImgdelete($id = NULL) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $id = $_GET['id'];
            $data['query'] = $this->dbpage->findpage($id);
            foreach ($data['query'] as $a) {
                $img = $a->images;
            }

            if ($img == !NULL) {
                $filename1 = './content/uploads/images/' . $img;
                $filename2 = './content/uploads/images/thumb_' . $img;
                if (file_exists($filename1)) {
                    unlink($filename1);
                } else {
                    
                }
                if (file_exists($filename2)) {
                    unlink($filename2);
                } else {
                    
                }
            }
            $this->dbpage->delete_page_image($id);

            $this->editpage($id);
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
