<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Subscribers extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('contact_model');
        $this->load->model('dbsetting');
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
        }
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
    
    public function deletesubs($id=null)
    {
       if ($this->session->userdata('admin_logged_in')) {
            $this->contact_model->delete_subscription($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('subscribers/viewSubscriber');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
    public function deleteRemarks($id=null)
    {
       if ($this->session->userdata('admin_logged_in')) {
            $this->contact_model->delete_subscription($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('subscribers/viewContact');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    
     public function addFeedback()
    {
        if(isset($_POST['email']))
        {
            $email = $_POST['email'];
        }
         if(isset($_POST['remarks']))
        {
            $remark = $_POST['remarks'];
        }
        $type="feedback";
        $this->contact_model->add_new_contact_feedback($email, $remark, $type);
        echo "Thank you for your feedback";
    }
    
    
    
    
    
    
    
}
