<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dbmodel');
        $this->load->model('dbdashboard');
        $this->load->model('dbsetting');
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
                $status = $this->input->post('user_status');
                $user_type = $this->input->post('user_type');
                $contact = $this->input->post('phone');
                $address = $this->input->post('address');
                $this->dbuser->add_new_user($name, $fname, $lname, $email, $pass, $status, $user_type, $contact, $address);
                $this->session->set_flashdata('message', 'One user added sucessfully');
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
                $status = $this->input->post('user_status');
                $user_type = $this->input->post('user_type');
               
                $this->dbuser->update_user($id, $name, $fname, $lname, $email, $pass, $status, $user_type);
                $this->session->set_flashdata('message', 'User data Modified Sucessfully');

                redirect('user/users');
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function deleteuser($id = 0) {
        $url = current_url();
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
                $this->session->set_flashdata('message', 'Data Delete Sucessfully');
                redirect('user/users');
            } else {
                // echo 'Sory you can not be delete this user because user is Login!';
                $data['token_error'] = "Sory you can not be delete this user because user is Login!";
                $this->load->view("bnw/templates/header", $data);
                $this->load->view("bnw/templates/menu");
                $this->load->view('templates/error_landing_page', $data);
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