<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dbmodel');
        $this->load->model('dbdashboard');
        $this->load->model('dbsetting');
        $this->load->model('viewmodel');
        $this->load->model('dbuser');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
    }

    public function index() {
        redirect('bnw');
    }

    //=============================USER===========================================//
    //============================================================================//
    public function users() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/user/users";
            $config["total_rows"] = $this->dbuser->record_count_user();
            $config["per_user"] = 6;


            $this->pagination->initialize($config);

            $user = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbuser->get_all_user($config["per_user"], $user);
            $data["links"] = $this->pagination->create_links();
            $data['query'] = $this->dbuser->get_user();
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->session->set_userdata("urlPagination", $config["base_url"] . "/" . $user);
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/users/userListing', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function adduser() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('user_name', 'User Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('user_fname', 'First Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('user_lname', 'Last Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('user_email', 'User email', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('user_pass', 'Password', 'required|xss_clean|md5|max_length[200]');
            $this->form_validation->set_rules('user_type', 'User Type', 'required|xss_clean|max_length[200]');
            if ($this->form_validation->run() == FALSE) {

                $this->load->view('bnw/users/addNew');
            } else {

                //if valid

                $name = $this->input->post('user_name');
                $fname = $this->input->post('user_fname');
                $lname = $this->input->post('user_lname');
                $email = $this->input->post('user_email');
                $pass = $this->input->post('user_pass');
                $status = $this->input->post('status');
                $user_type = $this->input->post('user_type');

                $check_user = $this->dbuser->check_email_username($name, $email);
                if ($check_user == true) {
                    $this->dbuser->add_new_user($name, $fname, $lname, $email, $pass, $status, $user_type);
                    $this->load->helper("emailsend_helper");
                    send_user_credentials($name, $fname, $lname, $email, $pass, $status);
                    $this->session->set_flashdata('message', 'One user added sucessfully');
                } elseif($check_user == false){
                    $this->session->set_flashdata('message', 'Username and Email already exist');
                } else {
                    $this->session->set_flashdata('message', 'Error. Please Try again later.');
                }
                redirect('user/users');
            }
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function edituser($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            // $this->load->helper('form');
            // $this->load->library(array('form_validation', 'session'));
            // $this->form_validation->set_rules('user_pass', 'Password', 'required|md5|xss_clean|max_length[200]');
            $data['query'] = $this->dbuser->finduser($id);
            $data['meta'] = $this->dbsetting->get_meta_data();

            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/users/editUser', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function updateuser() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $this->form_validation->set_rules('user_name', 'User Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('user_fname', 'First Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('user_lname', 'Last Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('user_email', 'User email', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('user_pass', 'Password', 'required|xss_clean|md5|max_length[200]');
            $this->form_validation->set_rules('user_type', 'User Type', 'required|xss_clean|max_length[200]');

            if ($this->form_validation->run() == FALSE) {
                //if not valid
                $id = $this->input->post('id');
                $data['query'] = $this->dbuser->finduser($id);
                $this->load->view('bnw/users/editUser', $data);
            } else {
                //if valid
                $id = $this->input->post('id');
                $name = $this->input->post('user_name');
                $fname = $this->input->post('user_fname');
                $lname = $this->input->post('user_lname');
                $email = $this->input->post('user_email');
                $pass = $this->input->post('user_pass');
                $status = $this->input->post('status');
                $user_type = $this->input->post('user_type');
                $headerlogo = $this->viewmodel->get_header_logo();
                foreach ($headerlogo as $headerData) {
                    $hlogo = $headerData->description;
                }
                $imglink = base_url() . 'content/uploads/images/' . $hlogo;
                $this->dbuser->update_user($id, $name, $fname, $lname, $email, $pass, $status, $user_type);
                $this->load->helper("emailsend_helper");
                send_user_credentials($name, $fname, $lname, $email, $pass, $imglink);

                if ($user_type == "Administrator" && $status == "0") {
                    redirect('bnw/logout');
                } else {
                    $this->session->set_flashdata('message', 'User data Modified Sucessfully');
                    $redirectPagination = $this->session->userdata("urlPagination");
                    redirect($redirectPagination);
                }
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function deleteuser() {
        $url = current_url();
        $id = $_POST['id'];
        if ($this->session->userdata('admin_logged_in')) {
            $uNAme = $this->session->userdata('username');
            //die($uNAme);
            $uNAme = "admin";
            //die($id);
            $userKey = $this->dbuser->check_user($id);
            // print_r($userKey);
            foreach ($userKey as $user) {
                $userid = $user->user_name;
            }
            if ($uNAme !== $userid) {
                // die($uNAme);
                $this->dbuser->delete_user($id);
//                $this->session->set_flashdata('message', 'Data Delete Sucessfully');
//                redirect('user/users');
            } else {
                // echo 'Sory you can not be delete this user because user is Login!';
                $data['token_error'] = "Sory you can not be delete this user because user is Login!";
                $this->load->view("bnw/templates/header", $data);
                $this->load->view("bnw/templates/menu");
                $this->load->view('template/errorPage', $data);
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function profile() {

        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/users";
            $config["total_rows"] = $this->dbuser->record_count_user();
            $config["per_user"] = 6;


            $this->pagination->initialize($config);

            $user = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbuser->get_all_user($config["per_user"], $user);
            $data["links"] = $this->pagination->create_links();
            $username = $this->session->userdata('username');
            $data['query'] = $this->dbuser->get_user_info($username);
            $data['meta'] = $this->dbsetting->get_meta_data();

            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/users/userProfiler', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

}
