<?php if (!defined('BASEPATH'))
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



  function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
    {
      $ipaddress = getenv('HTTP_CLIENT_IP');
    }
    else if(getenv('HTTP_X_FORWARDED_FOR'))
    {
      $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    }
    else if(getenv('HTTP_X_FORWARDED'))
    {
      $ipaddress = getenv('HTTP_X_FORWARDED');
    }
    else if(getenv('HTTP_FORWARDED_FOR'))
    {
      $ipaddress = getenv('HTTP_FORWARDED_FOR');
    }
    else if(getenv('HTTP_FORWARDED'))
    {
      $ipaddress = getenv('HTTP_FORWARDED');
    }
    else if(getenv('REMOTE_ADDR'))
    {
      $ipaddress = getenv('REMOTE_ADDR');
    }
    else
    {
      $ipaddress = 'UNKNOWN';
    }

    return  $ipaddress;

      }

      function index() {
         if ($this->session->userdata('admin_logged_in') == true)
     {
        return  redirect('bnw/index' ,'refresh');
     }
        if(isset($_GET['url'])){
          $data['link'] = $_GET['url'];
        }
        else{

          $data['link'] = base_url().'bnw';
        }
        $data['meta'] = $this->dbsetting->get_meta_data();
        $this->load->view('bnw/login/loginTemplate', $data);
        $this->load->view('bnw/templates/footer', $data);
      }

/* **********************************************VALID FOR USER LOGIN ******************8 */
      function validate_credentials() {
        $this->load->library('session');
        $cookie_name = "attempts";
         // if the cookie extis block user for 15 minutes redire to login page
           if(isset($_COOKIE[$cookie_name]))
           {
             return  redirect('bnw/index','refresh');
           }
           else
           {
            $attempt= $this->session->userdata('attempt_session_value');

            if($attempt >=3)
            {
              $attempt=0;
              $data = array('attempt' => $attempt);
              $this->db->where('id','1');
              $this->db->update('login_attempt', $data);
            }
          }
          if (isset($_POST['checkMe'])) {

            $this->session->sess_expiration = 60 * 60 * 24 * 7;
            $this->session->sess_expire_on_close = FALSE;
          } else {
            $this->session->sess_expiration = 60 * 60;
            $this->session->sess_expire_on_close = FALSE;
          }
          $link = $this->input->post('requersUrl');
          $this->load->library('form_validation');
          $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_xss_clean');
          $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_xss_clean');
          if ($this->form_validation->run() == FALSE) {
            $this->index();
          } else {
            $query = $this->dbmodel->validate();
            if ($query) {
                // if the user's credentials validated...
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
           } else { // if user enter incorrect username or password
            $query = $this->dbmodel->login_attempt();
      }
      $data['meta'] = $this->dbsetting->get_meta_data();
      $this->session->set_flashdata('message', 'Username or password incorrect');
              //$data['link'] = base_url().'bnw';  by krishna
              //redirect('login');     by krishna
      redirect('login/index/?url=' . $link, 'refresh');
    }
  }

function logout() {
  if ($this->session->userdata('admin_logged_in') == TRUE) {
    $useremail = $this->session->userdata('username');
    $data = array(
      'username' => $useremail,
      'admin_logged_in' => true,
      'logged_in' =>true
      );
    $this->session->unset_userdata($data);
    $this->session->sess_destroy();
    //        $this->session->set_userdata(array('username' => '', 'admin_logged_in' => false)); by krishna
    redirect('login');
  }else{
   $this->session->sess_destroy();
   redirect('login');
 }
}


public function forgotPassword() {
 $this->load->library('session');
 if (!$this->session->userdata('admin_logged_in')) {
  $data['meta'] = $this->dbsetting->get_meta_data();
  $this->load->view('bnw/login/forgotPassword', $data);
  $this->load->view('bnw/templates/footer', $data);
} else {
 $this->session->sess_destroy();
 $this->session->set_flashdata('message', 'Currently logged In');
 redirect('login/forgotPassword');
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
      $user = $dbemail->user_name;
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

$data['meta'] = $this->dbsetting->get_meta_data();
$data['query'] = $this->dbmodel->get_user_email($token, $email);

if (!empty($data['query'])) {
  $this->load->view('bnw/login/rePassword', $data);
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

$data['tokene'] = $token;
$data['query'] = $this->dbmodel->get_user_email($token, $email);

$data['meta'] = $this->dbsetting->get_meta_data();
$this->load->library('form_validation');
$this->form_validation->set_rules('user_pass', 'Password', 'required|callback_xss_clean|max_length[200]|matches[user_confirm_pass]');
$this->form_validation->set_rules('user_confirm_pass', 'Re-Password', 'required|callback_xss_clean|max_length[200]');

if ($this->form_validation->run() == FALSE) {

  if (!empty($data['query'])) {
    $this->load->view('bnw/login/rePassword', $data);
  } else {
    $this->load->view("bnw/login/tokenexpiremsg");
  }
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

   ?>
