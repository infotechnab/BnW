<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Subscribers extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('contact_model');
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
    
    public function addSubscriber()
    {
        if(isset($_POST['fullName']))
        {
            $name = $_POST['fullName'];
        } else { $name=""; }
         if(isset($_POST['email']))
        {
            $email = $_POST['email'];
        }
        $type="newsletter subs";
        $this->contact_model->add_new_contact($name, $email, $type);
        echo "Thank you for your subscription";
    }
    
    public function viewSubscriber()
    {
          if ($this->session->userdata('admin_logged_in')) {
              
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data['news'] = $this->contact_model->get_newsletter_subscribers();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('bnw/subscribers/viewSubscribers', $data);
            $this->load->view('bnw/templates/footer', $data);  
          }else
          {
              redirect('login/index/?url=' . $url, 'refresh');
          }
    }
    
    public function viewContact()
    {
          if ($this->session->userdata('admin_logged_in')) {
              
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data['news'] = $this->contact_model->get_feedback();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('bnw/subscribers/viewContacts', $data);
            $this->load->view('bnw/templates/footer', $data);  
          }else
          {
              redirect('login/index/?url=' . $url, 'refresh');
          }
    }
    
    public function deletesubs()
    {
        $id = $_POST['id'];
       if ($this->session->userdata('admin_logged_in')) {
            $this->contact_model->delete_subscription($id);
//            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
//            redirect('subscribers/viewSubscriber');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function deleteRemarks()
    {
        $id = $_POST['id'];
       if ($this->session->userdata('admin_logged_in')) {
            $this->contact_model->delete_subscription($id);
//            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
//            redirect('subscribers/viewContact');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
     public function addFeedback()
    {
       if(isset($_POST['name']))
        {
            $name = $_POST['name'];
        }
        if(isset($_POST['email']))
        {
            $email = $_POST['email'];
        }
        if(isset($_POST['phone']))
        {
            $phone = $_POST['phone'];
        }
         if(isset($_POST['message']))
        {
            $message = $_POST['message'];
        }
       if(isset($_POST['captcha']))
        {
            $captcha = $_POST['captcha'];
        }
        $captcha_info = $this->session->userdata('captcha_info');
if ($captcha_info['code'] != $captcha)
{
    echo "<strong>Sorry!</strong> Captcha did not match.";
}
else{
        $type="feedback";
        $this->contact_model->add_new_contact_feedback($name, $email, $message, $type);
        $this->sendhotelEmail($email, $name, $phone, $message);
        $this->sendUserEmail($email, $name);
        echo "<strong>Success!</strong> Your message has been sent successfully.";
    }
    } 
    
    public function sendhotelEmail($email, $name, $phone, $messagess)
    {
        $this->load->helper('emailsend_helper');
        $headerlogo = $this->viewmodel->get_header_logo();
        foreach ($headerlogo as $headerData)
        {
            $hlogo = $headerData->description;
        }
        $headertitle = $this->viewmodel->get_header_title();
        foreach($headertitle as $title){
                $htitle = $title->description;
            }
        $contact = $this->contact_model->get_contact_form();
        foreach ($contact as $con){
          $hotelEmail = $con->email;
     }
     
        $subject = "Contact Request from '.$name.'";
        $imglink = base_url().'content/uploads/images/'.$hlogo;
        $message = contact_email_hotel($name, $email, $phone, $imglink, $htitle, $messagess);
        send_contact_email_hotel($hotelEmail,$email, $subject, $message);
    }
    
    public function sendUserEmail($email, $name)
    {
        $this->load->helper('emailsend_helper');
        $headerlogo = $this->viewmodel->get_header_logo();
        foreach ($headerlogo as $headerData)
        {
            $hlogo = $headerData->description;
        }
        $headertitle = $this->viewmodel->get_header_title();
        foreach($headertitle as $title){
                $htitle = $title->description;
            }
        $contact = $this->contact_model->get_contact_form();
        foreach ($contact as $con){
          $hotelEmail = $con->email;
     }
     $imglink = base_url().'content/uploads/images/'.$hlogo;   
        $subject = "Contact Request to '.$htitle.'";
        $message = contact_email_user($name, $email, $imglink, $htitle);
        send_contact_email_user($hotelEmail,$email, $subject, $message);
    }
    
    
    
    
}

    
    
    
    
    

