<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('dbmodel');
        $this->load->model('dbuser');
        $this->load->model('dbsetting');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
    }

    function index() {
            if(isset($_GET['url'])){
        $data['link'] = $_GET['url'];
            }
            else{
               
                $data['link'] = base_url().'bnw';
            }
            
        if ($this->session->userdata('admin_logged_in')&& $this->session->userdata('admin')) {
             redirect('login', 'refresh');
        } else {
            //$this->session->sess_destroy();
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view('bnw/login/loginTemplate', $data);
            $this->load->view('bnw/templates/footer', $data);
        }
    }

    function validate_credentials() {
         
        $this->load->library('session');
        if (isset($_POST['checkMe'])) {

            $this->session->sess_expiration = 60 * 60 * 24 * 7;
            $this->session->sess_expire_on_close = FALSE;
        } else {
            $this->session->sess_expiration = 60 * 60;
            $this->session->sess_expire_on_close = FALSE;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $this->load->model('dbmodel');
           
            $query = $this->dbmodel->validate();
            if ($query) {
                // if the user's credentials validated...
               $link = $this->input->post('requersUrl');
                $data = array(
                    'username' => $this->input->post('username'),
                    'admin_logged_in' => true,
                    'logged_in' =>true
                   
                );
                $this->session->set_userdata($data);
             if($link == base_url().'/bnw/logout')
             {
                 redirect('bnw/index','refresh');
                
             }
             else{
                 redirect($link);
             }
            } else { // incorrect username or password
                 $data['meta'] = $this->dbsetting->get_meta_data();
                $this->session->set_flashdata('message', 'Username or password incorrect');
               $data['link'] = base_url().'bnw';
            $this->load->view('bnw/templates/loginTemplate', $data);
            $this->load->view('bnw/templates/footer', $data);
            }
        }
    }

        function logout() {
        $this->session->sess_destroy();
        $this->index();
        // redirect('login', 'refresh');
    }

    
    public function forgotPassword() {
         $this->load->library('session');
        if (!$this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
           $this->load->view('bnw/login/forgotPassword', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            $this->session->set_flashdata('message', 'Incorrect Email');
            redirect('login/index');
        }

    }

    public function email() {
        $data['meta'] = $this->dbsetting->get_meta_data();
        $this->load->view('bnw/templates/header', $data);

        $useremail = $_POST['user_email'];
        $username = $this->dbuser->get_selected_user($useremail);
        if(!empty($username)){
        foreach ($username as $dbemail) {
            $to = $dbemail->user_email;
            $user = $dbemail->full_name;
        }
            $token = $this->getRandomString(10);
            $this->dbuser->update_emailed_user($to, $token);
            $this->passwordresetemail($to, $user, $token);
              $this->session->set_flashdata('message', 'Instructions to reset your password has been emailed to you.Please check your inbox.');
             redirect('login/index');
        } else {
            $this->session->set_flashdata('message', 'Please type valid Email Address');
            redirect("login/forgotPassword");
        }
      
      
    }


    function getRandomString($length) {
        $validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
        $validCharNumber = strlen($validCharacters);
        $result = "";

        for ($i = 0; $i < $length; $i++) {
            $index = mt_rand(0, $validCharNumber - 1);
            $result .= $validCharacters[$index];
        }
        return $result;
    }
    
    

   public function passwordresetemail($to=null, $userName=null, $token=null) {
        $this->load->helper('emailsend_helper');
        $subject = "Password Reset";
         $imglink = base_url()."content/bnw/images/bnw.png";
        $link = base_url();
        $message = password_reset_email($to, $userName, $token, $link, $imglink);
        send_password_reset_email($to, $subject, $message);
    }
    
    public function resetPassword() {
         if (isset($_GET['resetPassword'])) {
            $token =  $_GET['resetPassword'];
        }else{$token =NULL;}
        if(isset($_GET['id'])){
            $email = $_GET['id'];
        }else{
            $email = NULL;
        }
               
        $data['meta'] = $this->dbmodel->get_meta_data();
        $data['query'] = $this->dbmodel->get_user_email($token, $email);

        $this->load->view("bnw/templates/header", $data);
         if (!empty($data['query'])) {
                $this->load->view("bnw/login/resetPassword", $data);
            } else {
                $this->load->view("bnw/login/tokenexpiremsg");
            } 
        $this->load->view('bnw/templates/footer', $data);
    }

    public function setpassword() {
        
         if (isset($_POST['resetPassword'])) {
            $token =  $_POST['resetPassword'];
        }else{$token =NULL;}
        if(isset($_POST['email'])) {
            $email =  $_POST['email'];
        }else{$email =NULL;}
        $data['query'] = $this->dbmodel->get_user_email($token, $email);
        
        $data['meta'] = $this->dbsetting->get_meta_data();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_pass', 'Password', 'required|xss_clean|max_length[200]|matches[user_confirm_pass]');
        $this->form_validation->set_rules('user_confirm_pass', 'Re-Password', 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/login/resetPassword", $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            $userPassword = $this->input->post('user_pass');
            $this->dbmodel->update_user_password($email, $userPassword);
            $this->session->set_flashdata('message', 'Your password has been reseted. Please login with new password.');
            redirect('login', 'refresh');
        } 
    }

    function userregister()
    {
      
        $user = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $check = $this->dbmodel->check_data($email);
         if (!empty($check)) { //if the data exists show error message
            echo 'FALSE';     
                           
         }
      else {
          
          $registred = $this->dbmodel->add_ajax_user($user,$email, $pass);
         $data = array(
                    'useremail' => $email,
                    'username' => $user,
                    'logged_in' => true);
                
                $this->session->set_userdata($data);
                $this->registerEmail($email, $name);
         
          echo 'TRUE';
          
        }
  
        }
        
       
}

?>