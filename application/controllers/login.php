<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->library('session');
   $this->load->model('dbmodel');     
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
 }

 function index()
 {
      $this->load->library('session');
     if(!$this->session->userdata('logged_in'))
     {  $data['meta'] = $this->dbmodel->get_meta_data();
        $this->load->view('bnw/templates/loginTemplate',$data);            
        $this->load->view('bnw/templates/footer',$data);
     }
 else {
         redirect('bnw','refresh');
     }
 }
 
    function validate_credentials()
	{	$this->load->library('session');
    $a=$_POST['checkMe'];
   if($a==1)
{
   $this->session->sess_expiration = 60*60*24*31;
   $this->session->sess_expire_on_close = FALSE;
   
}
else
{
   $this->session->sess_expiration = 5;
   $this->session->sess_expire_on_close = FALSE;
}  
    
                $this->load->library('form_validation');
                $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
                if($this->form_validation->run() == FALSE)
                     {
                        $this->index();
                     }
                else
                    {
		$this->load->model('dbmodel');
		$query = $this->dbmodel->validate();
		if($query) // if the user's credentials validated...
		{
			$data = array(
				'username' => $this->input->post('username'),
				'logged_in' => true
                            
			);
			$this->session->set_userdata($data);
			redirect('bnw/index');
		}
		else // incorrect username or password
                    {
                        $this->session->set_flashdata('message', 'Username or password incorrect');
                        redirect('login');
                        
                    }
                    }
	}
        
        public function forgotPassword(){
        $this->load->library('session');
     if(!$this->session->userdata('logged_in'))
     {  $data['meta'] = $this->dbmodel->get_meta_data();
        $this->load->view('bnw/templates/forgotPassword',$data);            
        $this->load->view('bnw/templates/footer',$data);
     }
        else {
         $this->session->set_flashdata('message', 'UIncorrect User Email');
                        redirect('login/forgotPassword');
     } 
    }
    
    public function email(){
        $data['meta'] = $this->dbmodel->get_meta_data();
        $this->load->view('bnw/templates/header', $data);
        
        $useremail= $_POST['username'];
       
        $username =  $this->dbmodel->get_selected_user($useremail);
        
        foreach ($username as $dbemail){
            $to = $dbemail->user_email;
        }
        if ($to==$useremail) {                                       
               $token= $this->getRandomString(10);                          
                $this->dbmodel->update_emailed_user($to, $token);  
                $this->test($token);
                
                $this->mailresetlink($to, $token);
                
               
            } else {
                $this->session->set_flashdata('message', 'Please type valid Email Address');
                redirect("login/forgotPassword");
            }
            $this->load->view('bnw/templates/footer', $data);
    }
    
    public function test($token){
        
        $data['query'] = $this->dbmodel->find_user_auth_key($token);
        $this->load->view('bnw/templates/messageSent',$data);
    }
    
    function getRandomString($length) 
	   {
    $validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
    $validCharNumber = strlen($validCharacters);
    $result = "";

    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
    return $result;
    
    
           } 
           
  
function mailresetlink($to,$token){
 //   $to
/*$subject = "Forgot Password on Megarush.net";
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
         
           
  public function resetPassword() {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/resetPassword", $data);
            
            $this->load->view('bnw/templates/footer', $data);
         
    }        
 public function setpassword(){
   $data['meta'] = $this->dbmodel->get_meta_data();
   $this->load->view('bnw/templates/header', $data);
       
   //$this->form_validation->set_rules('user_pass', 'Password', 'required|xss_clean|md5|max_length[200]');
   //$this->form_validation->set_rules('user_confirm_pass', 'Password', 'required|xss_clean|md5|max_length[200]');
     
   
   $password= $_POST['user_pass'];
        $token = $_POST['tokenid'];
       
        $confirmPassword =  $_POST['user_confirm_pass'];
        if ($password==$confirmPassword) {                                       
               
            $userPassword=  $this->input->post('user_pass');
            
                $this->dbmodel->update_user_password($token, $userPassword);  
                
                $this->session->set_flashdata('message', 'Your password has been changed successfully');
                redirect('login', 'refresh');
               
            } else {
                
                $this->session->set_flashdata('message', 'Password didnot match');
               redirect('login/forgotPassword', 'refresh');
            }
            
      
 }

 
 
 
 
}
?>