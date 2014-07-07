<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('dbmodel');
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
               
                $data['link'] = base_url().'index.php/bnw';
            }
            
        if ($this->session->userdata('admin_logged_in')&& $this->session->userdata('admin')) {
             redirect('login', 'refresh');
        } else {
            $this->session->sess_destroy();
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view('bnw/templates/loginTemplate', $data);
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
             if($link == base_url().'index.php/bnw/logout')
             {
                 redirect('bnw/index','refresh');
                
             }
             else{
                 redirect($link);
             }
            } else { // incorrect username or password
                $this->session->set_flashdata('message', 'Username or password incorrect');
                redirect('login');
            }
        }
    }

    public function forgotPassword() {
        $this->load->library('session');
        if (!$this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbsetting->get_meta_data();
            $this->load->view('bnw/templates/forgotPassword', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            $this->session->set_flashdata('message', 'Incorrect User Email');
            redirect('login/forgotPassword');
        }
    }

    public function email() {
        $data['meta'] = $this->dbsetting->get_meta_data();
        $this->load->view('bnw/templates/header', $data);

        $useremail = $_POST['username'];

        $username = $this->dbmodel->get_selected_user($useremail);

        foreach ($username as $dbemail) {
            $to = $dbemail->user_email;
        }
        if ($to == $useremail) {
            $token = $this->getRandomString(10);
            $this->dbmodel->update_emailed_user($to, $token);
            $this->test($token);

            $this->mailresetlink($to, $token);
        } else {
            $this->session->set_flashdata('message', 'Please type valid Email Address');
            redirect("view/forgotPassword");
        }
        $this->load->view('templates/footer');
    }

    public function test($token) {

        $data['query'] = $this->dbmodel->find_user_auth_key($token);
        $this->load->view('bnw/templates/messageSent', $data);
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
    
    

    function mailresetlink($to, $token) {
        //   $to
        /* $subject = "Forgot Password on Megarush.net";
          $uri = 'http://'. $_SERVER['HTTP_HOST'] ;
          $message = '
          <html>
          <head>
          <title></title>
          </head>
          <body>
          <p>Click on the given link to reset your password <a href="'.$uri.'/reset.php?token='.$token.'">Reset Password</a></p>

          </body>
          </html>
          ';
          //$headers = "MIME-Version: 1.0" . "\r\n";
          //$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
          //$headers .= 'From: Admin<webmaster@example.com>' . "\r\n";
          $headers .= 'rsubedi@salyani.com.np';

          mail('bhomnath@salyani.com.np',$subject,$message,$headers);
          //echo "We have sent the password reset link to your  email id <b>".$to."</b>"; */
    }

    // public function resetPassword() {
    //           $data['meta'] = $this->dbmodel->get_meta_data();
    //           $this->load->view("bnw/templates/header", $data);
    //          $this->load->view("bnw/templates/resetPassword", $data);
    //          $this->load->view('bnw/templates/footer', $data);
    // }   

    public function resetPassword() {
        $id = $_GET['resetPassword'];
        $email = $_GET['id'];
       
        $data['meta'] = $this->dbmodel->get_meta_data();
        $keys = $this->dbmodel->get_userKey($id);

        foreach ($keys as $uName) {
            $userName = $uName->user_email;
        }
        $blank = $this->dbmodel->user_key($email);
       
        $this->load->view("bnw/templates/header", $data);
        if (isset($userName)) {
            if ($email == $userName) {
                $this->load->view("bnw/templates/resetPassword", $data);
            } else {
                $this->load->view("bnw/templates/tokenexpiremsg");
            }
        } else {
            $this->load->view("bnw/templates/tokenexpiremsg");
        }
        $this->load->view('bnw/templates/footer', $data);
    }

    public function setpassword() {
        $data['meta'] = $this->dbsetting->get_meta_data();
        $this->load->view('bnw/templates/header', $data);

        //$this->form_validation->set_rules('user_pass', 'Password', 'required|xss_clean|md5|max_length[200]');
        //$this->form_validation->set_rules('user_confirm_pass', 'Password', 'required|xss_clean|md5|max_length[200]');


        $password = $_POST['user_pass'];
        $token = $_POST['tokenid'];

        $confirmPassword = $_POST['user_confirm_pass'];
        if ($password == $confirmPassword) {

            $userPassword = $this->input->post('user_pass');

            $this->dbmodel->update_user_password($token, $userPassword);

            $this->session->set_flashdata('message', 'Your password has been changed successfully');
            redirect('login', 'refresh');
        } else {

            $this->session->set_flashdata('message', 'Password didnot match');
            redirect('login/forgotPassword', 'refresh');
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