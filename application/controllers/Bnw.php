<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class bnw extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('dbmodel');
        $this->load->model('dbsetting');
        $this->load->model('dbuser');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
    }
    public function index() {
        $url = base_url() . 'bnw';
        if ($this->session->userdata('admin_logged_in') == true) {
            $data['username'] = Array($this->session->userdata('admin_logged_in'));
            $data['meta'] = $this->dbsetting->get_meta_data();
            $data["post"] = $this->dbmodel->count_post();
            $data["page"] = $this->dbmodel->count_page();
            $data["events"] = $this->dbmodel->count_events();
            $data["news"] = $this->dbmodel->count_news();
//            $data["post"] = $this->dbmodel->count_post();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu', $data);
            $this->load->view('bnw/index', $data);
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }
    //========================== for Cart System =======================================================//
   function getRandomStringForCoupen($length) {
        $validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
        $validCharNumber = strlen($validCharacters);
        $result = "";

        for ($i = 0; $i < $length; $i++) {
            $index = mt_rand(0, $validCharNumber - 1);
            $result .= $validCharacters[$index];
        }
       
        return $result;
    }

    function getcoupon() {
        // die('work');
        $key = $this->getRandomStringForCoupen(5);
        echo '<input type="text" value="' . $key . '" name="key" />';
    }

    function checkcoupon() {
        $data['abc'] = array(
            'coupon' => $_POST['coupon'],
            'subtotal' => $_POST['subtotal']
        );
        // print_r($data['abc']);

        $key = $_POST['coupon'];
        $today = date("Y-m-d");
        $token = $this->dbmodel->getdate($key);
        if (!empty($token)) {
            foreach ($token as $expdate) {
                $date = $expdate->exp_date;
            }
            if ($today <= $date) {
                $validkey = $this->dbmodel->checkkey($key, $today);
                foreach ($validkey as $rate) {
                    $disRate = $rate->rate;
                }
                echo '<script> var rate =' . $disRate . '; </script> 
<p> You have a discount ' . $disRate . ' % </p> ';
            } else {
                // die('msdfdsfdsfdsf');
                echo "Coupon has been expired!";
            }
        } else {
            echo "Coupon does not exist!";
        }
    }

    function coupon() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['username'] = Array($this->session->userdata('admin_logged_in'));
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['category'] = $this->dbmodel->get_category();
            $data['coupon'] = $this->dbmodel->get_coupon();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('product/listcoupon', $data);
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
    function addcoupon() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['username'] = Array($this->session->userdata('admin_logged_in'));
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['category'] = $this->dbmodel->get_category();

            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');

            $this->load->view('bnw/templates/footer', $data);
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('key', 'Coupon Key', 'required|callback_xss_clean|max_length[200]');
            $this->form_validation->set_rules('rate', 'Discount Rate', 'required|callback_xss_clean|max_length[200]');
            $this->form_validation->set_rules('expdate', 'Expire Date', 'required|callback_xss_clean|max_length[200]');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('product/coupon');
            } else {

                //if valid

                $key = $this->input->post('key');
                $rate = $this->input->post('rate');
                $date = $this->input->post('expdate');

                $this->dbmodel->add_coupon($key, $rate, $date);
                $this->session->set_flashdata('message', 'One Coupon Created sucessfully');
                redirect('bnw/coupon');
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //========================== Add Product ======================================================//

    function product() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['username'] = Array($this->session->userdata('admin_logged_in'));
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['category'] = $this->dbmodel->get_category();

            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('product/addProduct', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function addproduct() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['category'] = $this->dbmodel->get_category();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('pName', 'Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('pPrice', 'Price', 'required|xss_clean|max_length[200]');

            if (($this->form_validation->run() == FALSE)) {
                $data['error'] = $this->upload->display_errors();

                $this->load->view('product/addProduct', $data);
            } else {

                //if valid
                if ($this->upload->do_upload('myfile')) {
                    $data = array('upload_data' => $this->upload->data('myfile'));
                    $productImg = $data['upload_data']['file_name'];

                    //if valid
                    $data = array('upload_data' => $this->upload->data('file'));
                    $slidename = $this->input->post('slide_name');
                    $slideimage = $data['upload_data']['file_name'];
                    $slidecontent = $this->input->post('slide_content');

                    //for cropper
                    //require_once(APPPATH.'Imagemanipulator.php');
                    include_once 'imagemanipulator.php';

                    $manipulator = new ImageManipulator($_FILES['myfile']['tmp_name']);
                    $width = $manipulator->getWidth();
                    $height = $manipulator->getHeight();

                    $centreX = round($width / 2);

                    $centreY = round($height / 2);

                    // our dimensions will be 200x130
                    $x1 = $centreX - 300; // 200 / 2
                    $y1 = $centreY - 400; // 130 / 2

                    $x2 = $centreX + 300; // 200 / 2
                    $y2 = $centreY + 400; // 130 / 2
                    // center cropping to 200x130
                    $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
                    // saving file to uploads folder
                    $manipulator->save('./content/uploads/images/' . $_FILES['myfile']['name']);
                    //cropper closed               
                } else {
                    $productImg = NULL;
                }
                if ($this->upload->do_upload('myfileTwo')) {
                    $data = array('upload_data' => $this->upload->data('myfileTwo'));
                    $productImgTwo = $data['upload_data']['file_name'];

                    //for cropper
                    //require_once(APPPATH.'Imagemanipulator.php');
                    include_once 'imagemanipulator.php';

                    $manipulator = new ImageManipulator($_FILES['myfileTwo']['tmp_name']);
                    $width = $manipulator->getWidth();
                    $height = $manipulator->getHeight();

                    $centreX = round($width / 2);

                    $centreY = round($height / 2);

                    // our dimensions will be 200x130
                    $x1 = $centreX - 300; // 200 / 2
                    $y1 = $centreY - 400; // 130 / 2

                    $x2 = $centreX + 300; // 200 / 2
                    $y2 = $centreY + 400; // 130 / 2
                    // center cropping to 200x130
                    $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
                    // saving file to uploads folder
                    $manipulator->save('./content/uploads/images/' . $_FILES['myfileTwo']['name']);
                } else {
                    $productImgTwo = NULL;
                }
                if ($this->upload->do_upload('myfileThree')) {
                    $data = array('upload_data' => $this->upload->data('myfileThree'));
                    $productImgThree = $data['upload_data']['file_name'];

                    include_once 'imagemanipulator.php';

                    $manipulator = new ImageManipulator($_FILES['myfileThree']['tmp_name']);
                    $width = $manipulator->getWidth();
                    $height = $manipulator->getHeight();

                    $centreX = round($width / 2);

                    $centreY = round($height / 2);

                    // our dimensions will be 200x130
                    $x1 = $centreX - 300; // 200 / 2
                    $y1 = $centreY - 400; // 130 / 2

                    $x2 = $centreX + 300; // 200 / 2
                    $y2 = $centreY + 400; // 130 / 2
                    // center cropping to 200x130
                    $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
                    // saving file to uploads folder
                    $manipulator->save('./content/uploads/images/' . $_FILES['myfileThree']['name']);
                } else {
                    $productImgThree = NULL;
                }

                // $proID = $this->dbmodel->get_proID();
                // foreach ($proID as $pID) {
                //     $id = $pID->id;
                // }
                //  $id = $id + 1;
                $qty = $this->input->post('qty');
                $productName = $this->input->post('pName');
                $productPrice = $this->input->post('pPrice');
                $productCategory = $this->input->post('pCategory');

                $description = quotes_to_entities($this->input->post('pDescription'));
                $summary = substr("$description", 0, 100);
                $shippingCost = $this->input->post('checkMe');
                $featured = $this->input->post('featured');
                if ($featured == 1) {
                    $featured = "1";
                } else {
                    $featured = "0";
                }
                if ($shippingCost == 1) {
                    $shipping = "enabled";
                } else {
                    $shipping = "disabled";
                }
                $like = $this->input->post('enableLike');
                if ($like == 1) {
                    $allowLike = "enabled";
                } else {
                    $allowLike = "disabled";
                }
                $share = $this->input->post('enableShare');
                if ($share == 1) {
                    $allowShare = "enabled";
                } else {
                    $allowShare = "disabled";
                }
                $this->dbmodel->add_new_product($productCategory, $description, $summary, $qty, $productName, $productPrice, $productImg, $productImgTwo, $productImgThree, $shipping, $allowLike, $allowShare, $featured);
                // $this->dbmodel->add_images($id,$productImg);
                $this->session->set_flashdata('message', 'One Product added sucessfully');
                // $this->productList();
                redirect('bnw/productList');
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function quckly_addproduct() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['category'] = $this->dbmodel->get_category();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('pName', 'Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('pPrice', 'Price', 'required|xss_clean|max_length[200]');

            if (($this->form_validation->run() == FALSE)) {
                $data['error'] = $this->upload->display_errors();

                $this->load->view('product/addProduct', $data);
            } else {

                //if valid
                if ($this->upload->do_upload('myfile')) {
                    $data = array('upload_data' => $this->upload->data('myfile'));
                    $productImg = $data['upload_data']['file_name'];

                    //if valid
                    $data = array('upload_data' => $this->upload->data('file'));
                    $slidename = $this->input->post('slide_name');
                    $slideimage = $data['upload_data']['file_name'];
                    $slidecontent = $this->input->post('slide_content');

                    //for cropper
                    //require_once(APPPATH.'Imagemanipulator.php');
                    include_once 'imagemanipulator.php';

                    $manipulator = new ImageManipulator($_FILES['myfile']['tmp_name']);
                    $width = $manipulator->getWidth();
                    $height = $manipulator->getHeight();

                    $centreX = round($width / 2);

                    $centreY = round($height / 2);

                    // our dimensions will be 200x130
                    $x1 = $centreX - 300; // 200 / 2
                    $y1 = $centreY - 400; // 130 / 2

                    $x2 = $centreX + 300; // 200 / 2
                    $y2 = $centreY + 400; // 130 / 2
                    // center cropping to 200x130
                    $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
                    // saving file to uploads folder
                    $manipulator->save('./content/uploads/images/' . $_FILES['myfile']['name']);
                    //cropper closed               
                } else {
                    $productImg = NULL;
                }


                // $proID = $this->dbmodel->get_proID();
                // foreach ($proID as $pID) {
                //     $id = $pID->id;
                // }
                //  $id = $id + 1;
                // $qty = $this->input->post('qty');
                $productName = $this->input->post('pName');
                $productPrice = $this->input->post('pPrice');
                $productCategory = $this->input->post('pCategory');
                $description = quotes_to_entities($this->input->post('pDescription'));
                $summary = substr("$description", 0, 100);
                $shippingCost = $this->input->post('checkMe');
                if ($shippingCost == 1) {
                    $shipping = "enabled";
                } else {
                    $shipping = "disabled";
                }
                $this->dbmodel->quick_add_new_product($productCategory, $description, $summary, $productName, $productPrice, $productImg, $shipping);
                // $this->dbmodel->add_images($id,$productImg);
                $this->session->set_flashdata('message', 'One Product added sucessfully');
                redirect('bnw/index');
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

// ============================= End Add Product ====================================================//
    //============================ Product Listing =================================================//
    function productList() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['username'] = Array($this->session->userdata('admin_logged_in'));
            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/productList";
            $config["total_rows"] = $this->dbmodel->record_count_product();
            // var_dump($config["total_rows"]);
            $config["per_page"] = 6;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data["query"] = $this->dbmodel->get_all_product($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbmodel->get_meta_data();

            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('product/listProduct');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //================================ Product Editing ===================================================//
    function editproduct($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbmodel->findproduct($id);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['category'] = $this->dbmodel->get_category();
            //$data['miscSetting'] = $this->dbmodel->get_misc_setting();
            $data['id'] = $id;
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('product/editProduct', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function updateproduct() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['miscSetting'] = $this->dbmodel->get_misc_setting();
            $username = $this->session->userdata('username');
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));

            //set validation rules
            $this->form_validation->set_rules('pName', 'Product Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('pdescription', 'Description', 'required|xss_clean');
            $this->form_validation->set_rules('price', 'Price', 'required|xss_clean');



            if (($this->form_validation->run() == TRUE)) {

                $id = $this->input->post('id');
                $name = $this->input->post('pName');
                $description = $this->input->post('pdescription');
                //die($description);
                $summary = substr("$description", 0, 100);
                $price = $this->input->post('price');
                $category = $this->input->post('pCategory');
                $featured = $this->input->post('featured');
                if ($featured == 1) {
                    $featured = "1";
                } else {
                    $featured = "0";
                }
                //if valid
                if ($this->upload->do_upload('myfile')) {
                    $data = array('upload_data' => $this->upload->data('myfile'));
                    $productImg = $data['upload_data']['file_name'];
                    //die("selected file");
                } else {


                    $productImg = $this->input->post('firstImg');
                }
                if ($this->upload->do_upload('myfileTwo')) {
                    $data = array('upload_data' => $this->upload->data('myfileTwo'));
                    $productImgTwo = $data['upload_data']['file_name'];
                } else {

                    $productImgTwo = $this->input->post('secondImg');
                }
                if ($this->upload->do_upload('myfileThree')) {
                    $data = array('upload_data' => $this->upload->data('myfileThree'));
                    $productImgThree = $data['upload_data']['file_name'];
                } else {

                    $productImgThree = $this->input->post('thirdImg');
                }
                $shippingCost = $this->input->post('checkMe');
                if ($shippingCost == 1) {
                    $shipping = "enabled";
                } else {
                    $shipping = "disabled";
                }
                $like = $this->input->post('enableLike');
                if ($like == 1) {
                    $allowLike = "enabled";
                } else {
                    $allowLike = "disabled";
                }
                $share = $this->input->post('enableShare');
                if ($share == 1) {
                    $allowShare = "enabled";
                } else {
                    $allowShare = "disabled";
                }


                $this->dbmodel->update_product($id, $category, $name, $description, $summary, $price, $productImg, $productImgTwo, $productImgThree, $shipping, $allowLike, $allowShare, $featured);
                $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                redirect('bnw/productList');
            } else {
                $id = $this->input->post('id');
                $data['query'] = $this->dbmodel->findproduct($id);
                $this->load->view('bnw/product/editProduct', $data);
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function productImgdelete() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $image = $_GET['image'];
            $id = $_GET['id'];
            // die($image);
            if (isset($image)) {
                unlink('./content/uploads/images/' . $image);
            } else {
                $image = NULL;
            }

            $this->dbmodel->delete_product_photo($id, $image);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/editproduct/' . $id);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function delProduct($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

//            $delimages = $this->dbmodel->findproduct($id);
//            foreach ($delimages as $images)
//            {
//                $imgOne = $images->image1;
//                $imgTwo = $images->image2;
//                $imgThree = $images->image3;
//            }
//            
//            if(isset($imgOne)==!NULL)
//            {
//                unlink('./content/uploads/images/' . $imgOne);
//            }
//          //  else{}
//            if(isset($imgTwo)==!NULL)
//            {
//                unlink('./content/uploads/images/' . $imgTwo);
//           }
//          //  else{}
//            if(isset($imgThree)==!NULL)
//           {
//                unlink('./content/uploads/images/' . $imgThree);
//           }
//          //  else{}
//            
//            
//            $result =$this->dbmodel->delProduct($id);
//             if($result == true)
//            {
//                $this->session->set_flashdata('message', 'Data Delete Sucessfully');
//                 redirect('bnw/productList');
//                
//            }
//           else {
//                 $this->session->set_flashdata('message', 'Cannot delete or update a parent row');
//                 redirect('bnw/productList');
//                  }
//            
            $result = $this->dbmodel->delProduct($id);
            if ($result == true) {
                $this->session->set_flashdata('message', 'Data Delete Sucessfully');
                redirect('bnw/productList');
            } else {
                $this->session->set_flashdata('message', 'Cannot delete product');
                redirect('bnw/productList');
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function disproduct() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['username'] = Array($this->session->userdata('admin_logged_in'));
            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/disproduct";
            $config["total_rows"] = count($this->dbmodel->get_record_all_product_orderDis());

            $config["per_page"] = 6;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data["query"] = $this->dbmodel->get_all_productTrn($config["per_page"], $page);

            $data["links"] = $this->pagination->create_links();

            // $data['query'] = $this->dbmodel->get_all_product_orderDis();
            $data['meta'] = $this->dbmodel->get_meta_data();

            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('product/test', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function productOrderList() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['username'] = Array($this->session->userdata('admin_logged_in'));
            //$config = array();
            // $config["base_url"] = base_url() . "index.php/bnw/productOrderList";
            //$config["total_rows"] = $this->dbmodel->record_count_product_order();
            // $config["per_page"] = 6;
            // $this->pagination->initialize($config);
            // $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            //$data["query"] = $this->dbmodel->get_all_product($config["per_page"], $page);
            //$data["links"] = $this->pagination->create_links();
            $data['query'] = $this->dbmodel->get_all_product_order();
            $data['meta'] = $this->dbmodel->get_meta_data();

            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('product/listProductOrder');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function catproduct() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['username'] = Array($this->session->userdata('admin_logged_in'));
            $categoryValue = $this->input->post('categoryProduct');
            if ($categoryValue == !0) {
                $config = array();
                $config["base_url"] = base_url() . "index.php/bnw/catproduct";
                $config["total_rows"] = count($this->dbmodel->record_count_catproduct($categoryValue));

                $config["per_page"] = 6;
                $this->pagination->initialize($config);
                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

                $data["query"] = $this->dbmodel->get_all_cateproduct($config["per_page"], $page, $categoryValue);
                $data["links"] = $this->pagination->create_links();
                $data['meta'] = $this->dbmodel->get_meta_data();

                $this->load->view('bnw/templates/header', $data);
                $this->load->view('bnw/templates/menu');
                $this->load->view('product/listProduct');
                $this->load->view('bnw/templates/footer', $data);
            } else {
                $this->productList();
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

//    function viewdetail()
//    {
//        $url = current_url();
//        if ($this->session->userdata('admin_logged_in')) {
//            //$data['query'] = $this->dbmodel->findproduct($id);
//            $data['meta'] = $this->dbmodel->get_meta_data();
//           // $data['category'] = $this->dbmodel->get_category();
//            //$data['miscSetting'] = $this->dbmodel->get_misc_setting();
//          //  $data['id'] = $id;
//            $tid = $_GET['id'];
//            $this->load->view("bnw/templates/header", $data);
//            $this->load->view("bnw/templates/menu");
//            $this->load->view('product/detailview', $data);
//
//           
//        } else {
//            redirect('login/index/?url='.$url, 'refresh');
//        }
//    }

    function updateTrn() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $id = $_POST['trnID'];

            $query = $this->dbmodel->TransDetail($id);
            //var_dump($query);
            foreach ($query as $item) {
                //$newqty = 'item_qnt_' . $item['id'];
                // $newrow = 'item_row_' . $item['id'];
                $pid = $item->p_id;
                $dbstatus = $item->status;
                //  die($pid);
                $newpro = $_POST['product_' . $item->p_id];
                $newstatus = $_POST['status_' . $item->p_id];
                $productid = $newstatus;
                if (isset($newstatus)) {
                    if ($dbstatus != $productid) {


                        $newstatus;

                        $this->dbmodel->updateDetails($newstatus, $pid, $id);
                        // $this->cart->update(array(
                        //    'status' => $newQnt
                        // ));
                    }
                }
            }
            redirect('bnw/disproduct');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function productShipping() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['username'] = Array($this->session->userdata('admin_logged_in'));
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['getship'] = $this->productmodel->getship();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('product/shipping', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function shippingupdate() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['getship'] = $this->productmodel->getship();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('shipping_charge', 'Shipping Charge', 'required|xss_clean|max_length[200]');


            if ($this->form_validation->run() == FALSE) {
                // $data['error'] = $this->upload->display_errors();

                $this->load->view('product/shipping', $data);
            } else {

                //if valid


                $charge = $this->input->post('shipping_charge');



                $this->productmodel->update_shipping_cost($charge);
                $this->session->set_flashdata('message', 'Shipping updated sucessfully');
                redirect('bnw/shippingupdate');
            }
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //=================================== end Cart System  ========================================================//


    public function menu_id_from_ajax() {
        $this->load->helper('myhelper_helper');
        $menu_id_next = ($_POST['menu_id_next']);
        fetch_menu(query(0));
    }

    //=====================================================================================================
    //====================================Category==========================================================
    //======================================================================================================
//========================================to add category===================================================
    //==================================To edit category=======================================================
    //========================================To delete category=============================================



   

    //==========================================================================================================//

    //============================================================================//
   

    //=========================================================================================================
    //====================================MEDIA================================================================
    //=========================================================================================================

    

    //=========================notice==============================//

    /* public function notice() {

      if ($this->session->userdata('admin_logged_in')) {

      $config = array();
      $config["base_url"] = base_url() . "index.php/bnw/notice";
      $config["total_rows"] = $this->dbmodel->record_count_notice();
      $config["per_page"] = 6;
      //$config["uri_segment"] = 3;

      $this->pagination->initialize($config);

      $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

      $data["query"] = $this->dbmodel->get_all_notices($config["per_page"], $page);
      $data["links"] = $this->pagination->create_links();
      //$data['query'] = $this->dbmodel->get_all_notices();
      $data['meta'] = $this->dbmodel->get_meta_data();
      $header = "bnw/templates/";

      $this->load->view($header . 'header', $data);
      $this->load->view($header . 'menu');
      $this->load->view('bnw/notice/index', $data);
      $this->load->view('bnw/templates/footer', $data);
      } else {
      redirect('login', 'refresh');
      }
      }

      public function addnotice() {
      if ($this->session->userdata('admin_logged_in')) {
      $data['meta'] = $this->dbmodel->get_meta_data();
      $header = "bnw/templates/header";
      $this->load->view($header, $data);
      $this->load->view('bnw/templates/menu');
      $this->load->helper('form');
      $this->load->library(array('form_validation', 'session'));
      //set validation rules
      $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
      $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

      if ($this->form_validation->run() == FALSE) {
      //if not valid
      $this->load->view('bnw/notice/addnew');
      } else {
      //if valid
      $type = $this->input->post('type');
      $name = $this->input->post('title');
      $body = $this->input->post('body');
      $status = $this->input->post('status');
      $this->dbmodel->add_new_notices($name, $body, $status, $type);
      $this->session->set_flashdata('message', 'One notice added sucessfully');
      redirect('bnw/notice');
      }

      $this->load->view('bnw/templates/footer', $data);
      } else {
      redirect('login', 'refresh');
      }
      }

      public function editnotice($nid) {
      if ($this->session->userdata('admin_logged_in')) {
      $data['query'] = $this->dbmodel->findnotice($nid);
      $data['meta'] = $this->dbmodel->get_meta_data();
      //$data['id'] = $pid;
      $header = "bnw/templates/";
      $this->load->view($header . 'header', $data);
      $this->load->view($header . 'menu');
      $this->load->view('bnw/notice/edit', $data);
      $this->load->view('bnw/templates/footer', $data);
      } else {
      redirect('login', 'refresh');
      }
      }

      public function updatenotice() {
      if ($this->session->userdata('admin_logged_in')) {
      $data['meta'] = $this->dbmodel->get_meta_data();
      $header = "bnw/templates/header";
      $this->load->view($header, $data);
      $this->load->view('bnw/templates/menu');
      $this->load->helper('form');
      $this->load->library(array('form_validation', 'session'));
      //set validation rules
      $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
      $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

      if ($this->form_validation->run() == FALSE) {
      //if not valid
      $this->load->view('bnw/notice/edit');
      } else {
      //if valid
      $id = $this->input->post('id');
      $title = $this->input->post('title');
      $body = $this->input->post('body');
      $status = $this->input->post('status');
      $this->dbmodel->update_notice($id, $title, $body, $status);
      $this->session->set_flashdata('message', 'Data Modified Sucessfully');
      redirect('bnw/notice');
      }
      $this->load->view('bnw/templates/footer', $data);
      } else {
      redirect('login', 'refresh');
      }
      }

      public function deletenotice($nid) {
      if ($this->session->userdata('admin_logged_in')) {
      $this->dbmodel->delete_notice($nid);
      redirect('bnw/notice');
      } else {
     * 
     * 
     * 
      redirect('login', 'refresh');
      }
      }

      //=======================Activities controler=========================//
      public function activities() {

      if ($this->session->userdata('admin_logged_in')) {
      $config = array();
      $config["base_url"] = base_url() . "index.php/bnw/activities";
      $config["total_rows"] = $this->dbmodel->record_count_activities();
      $config["per_page"] = 6;
      //$config["uri_segment"] = 3;

      $this->pagination->initialize($config);

      $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      $data["query"] = $this->dbmodel->get_all_activities($config["per_page"], $page);
      $data["links"] = $this->pagination->create_links();

      //$data['query'] = $this->dbmodel->get_all_activities();
      $data['meta'] = $this->dbmodel->get_meta_data();
      $header = "bnw/templates/";

      $this->load->view($header . 'header', $data);
      $this->load->view($header . 'menu');
      $this->load->view('bnw/activities/index', $data);
      $this->load->view('bnw/templates/footer', $data);
      } else {
      redirect('login', 'refresh');
      }
      }

      public function addactivity() {
      if ($this->session->userdata('admin_logged_in')) {

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = '500';
      $config['max_width'] = '1024';
      $config['max_height'] = '768';
      $this->load->library('upload', $config);
      $data['meta'] = $this->dbmodel->get_meta_data();
      $this->load->view('bnw/templates/header', $data);
      $this->load->view('bnw/templates/menu');
      $this->load->helper('form');
      $this->load->library(array('form_validation', 'session'));
      $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
      $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

      if (($this->form_validation->run() == TRUE)) {
      if ($_FILES && $_FILES['file']['name'] !== "") {
      if (!$this->upload->do_upload('file')) {
      $error = array('error' => $this->upload->display_errors('file'));
      $this->load->view('bnw/activities/addnew', $error);
      } else {
      $data = array('upload_data' => $this->upload->data());
      $image = $data['upload_data']['file_name'];
      //$imagedata = Array($this->upload->data());
      $name = $this->input->post('title');
      $body = $this->input->post('body');
      $type = $this->input->post('type');
      //$image = $imagedata['file_name'];
      $status = $this->input->post('status');
      $this->dbmodel->add_new_activities($name, $body, $image, $status, $type);
      $this->session->set_flashdata('message', 'One Activities added sucessfully');
      redirect('bnw/activities');
      }
      } else {
      $image = "";
      $name = $this->input->post('title');
      $body = $this->input->post('body');
      //$image = $imagedata['file_name'];
      $status = $this->input->post('status');
      $type = $this->input->post('type');
      $this->dbmodel->add_new_activities($name, $body, $image, $status, $type);
      $this->session->set_flashdata('message', 'One Activities added sucessfully');
      redirect('bnw/activities');
      }
      } else {

      $this->load->view('bnw/activities/addnew');
      }
      $this->load->view('bnw/templates/footer', $data);
      } else {

      redirect('login', 'refresh');
      }
      }

      function editactivities($id) {
      if ($this->session->userdata('admin_logged_in')) {
      $data['query'] = $this->dbmodel->findactivities($id);
      $data['meta'] = $this->dbmodel->get_meta_data();
      //$data['id'] = $pid;
      $header = "bnw/templates/";
      $this->load->view($header . 'header', $data);
      $this->load->view($header . 'menu');
      $this->load->view('bnw/activities/edit', $data);
      $this->load->view('bnw/templates/footer', $data);
      } else {

      redirect('login', 'refresh');
      }
      }

      public function updateactivities() {
      if ($this->session->userdata('admin_logged_in')) {

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = '500';
      $config['max_width'] = '1024';
      $config['max_height'] = '768';
      $this->load->library('upload', $config);
      $data['meta'] = $this->dbmodel->get_meta_data();
      $header = "bnw/templates/header";
      $this->load->view($header, $data);
      $this->load->view('bnw/templates/menu');
      $id = $this->input->post('id');
      $this->load->helper('form');
      $this->load->library(array('form_validation', 'session'));
      //set validation rules
      $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
      $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');
      if (($this->form_validation->run() == TRUE)) {
      if ($_FILES && $_FILES['file']['name'] !== "") {
      if (!$this->upload->do_upload('file')) {
      $error = array('error' => $this->upload->display_errors('file'));
      $this->load->view('bnw/activities/edit', $error);
      } else {
      //if valid


      $data = array('upload_data' => $this->upload->data());
      $image = $data['upload_data']['file_name'];
      $id = $this->input->post('id');
      $title = $this->input->post('title');
      $body = $this->input->post('body');
      $status = $this->input->post('status');
      $this->dbmodel->update_activities($id, $title, $body, $image, $status);
      $this->session->set_flashdata('message', 'Data Modified Sucessfully');
      redirect('bnw/activities');
      }
      } else {
      $image = "";
      $id = $this->input->post('id');
      $title = $this->input->post('title');
      $body = $this->input->post('body');
      $status = $this->input->post('status');
      $this->dbmodel->update_activities($id, $title, $body, $image, $status);
      $this->session->set_flashdata('message', 'Data Modified Sucessfully');
      redirect('bnw/activities');
      }
      } else {
      $id = $this->input->post('id');
      $data['query'] = $this->dbmodel->findactivities($id);
      $this->load->view('bnw/activities/edit', $data);
      }
      $this->load->view('bnw/templates/footer', $data);
      } else {
      redirect('login', 'refresh');
      }
      }

      function deleteactivities($aid) {
      if ($this->session->userdata('admin_logged_in')) {

      $this->dbmodel->deleteactivities($aid);
      $this->session->set_flashdata('message', 'One Acticity deleted sucessfully');
      redirect('bnw/activities');
      } else {

      redirect('login', 'refresh');
      }
      }

      //==========================Result management controler


      public function upload() {
      if ($this->session->userdata('admin_logged_in')) {

      $config['upload_path'] = './downloads/';
      $config['allowed_types'] = 'gif|jpg|png|pdf';
      $config['max_size'] = '500';
      //$config['max_width'] = '1024';
      //$config['max_height'] = '768';
      $this->load->library('upload', $config);
      $data['meta'] = $this->dbmodel->get_meta_data();
      $this->load->view('bnw/templates/header', $data);
      $this->load->view('bnw/templates/menu');
      $this->load->helper('form');
      $this->load->library(array('form_validation', 'session'));
      $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
      // $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

      if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload())) {

      //if not valid

      $error = array('error' => $this->upload->display_errors());
      $this->load->view('bnw/download/upload_form', $error);
      } else {

      //if valid
      $data = array('upload_data' => $this->upload->data());
      $image = $data['upload_data']['file_name'];
      //$imagedata = Array($this->upload->data());
      $name = $this->input->post('title');
      //$body = $this->input->post('body');
      //$image = $imagedata['file_name'];
      $status = $this->input->post('status');
      $this->dbmodel->upload_documents($name, $image, $status);
      $this->session->set_flashdata('message', 'One Document added sucessfully');
      redirect('bnw/download');
      }
      $this->load->view('bnw/templates/footer', $data);
      } else {

      redirect('login', 'refresh');
      }
      }

      public function deletedocument($id) {
      if ($this->session->userdata('admin_logged_in')) {
      $this->dbmodel->delete_document($id);
      $this->session->set_flashdata('message', 'One Document deleted sucessfully');
      redirect('bnw/download');
      } else {

      redirect('login', 'refresh');
      }
      }




      public function blog() {
      if ($this->session->userdata('admin_logged_in')) {
      $data['username'] = Array($this->session->userdata('admin_logged_in'));
      $data['query'] = $this->dbmodel->get_blog();
      $data['meta'] = $this->dbmodel->get_meta_data();
      $this->load->view("bnw/templates/header", $data);
      $this->load->view("bnw/templates/menu");
      $this->load->view('bnw/blogs/index', $data);
      $this->load->view('bnw/templates/footer', $data);
      } else {
      redirect('login', 'refresh');
      }
      }

      public function uploads() {
      if ($this->session->userdata('admin_logged_in')) {

      $config['upload_path'] = './downloads/';
      $config['allowed_types'] = 'gif|jpg|png|pdf';
      $config['max_size'] = '500';
      //$config['max_width'] = '1024';
      //$config['max_height'] = '768';
      $this->load->library('upload', $config);
      $data['meta'] = $this->dbmodel->get_meta_data();
      $this->load->view('bnw/templates/header', $data);
      $this->load->view('bnw/templates/menu');
      $this->load->helper('form');
      $this->load->library(array('form_validation', 'session'));
      $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');
      // $this->form_validation->set_rules('body', 'Body', 'required|xss_clean');

      if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload())) {

      //if not valid

      $error = array('error' => $this->upload->display_errors());
      $this->load->view('bnw/blogs/upload_form', $error);
      } else {

      //if valid
      $data = array('upload_data' => $this->upload->data());
      $image = $data['upload_data']['file_name'];
      //$imagedata = Array($this->upload->data());
      $name = $this->input->post('title');
      //$body = $this->input->post('body');
      //$image = $imagedata['file_name'];
      $status = $this->input->post('status');
      $this->dbmodel->upload_blog($name, $image, $status);
      $this->session->set_flashdata('message', 'One Document added sucessfully');
      redirect('bnw/blog');
      }
      $this->load->view('bnw/templates/footer', $data);
      } else {

      redirect('login', 'refresh');
      }
      }

      public function deleteblog($id) {
      if ($this->session->userdata('admin_logged_in')) {
      $this->dbmodel->deleteblog($id);
      $this->session->set_flashdata('message', 'Data Delete Sucessfully');
      redirect('bnw/blog');
      } else {
      redirect('login', 'refresh');
      }
      }

     */

    public function aanbiedingenadd() { //functie om ze toe te voegen aan de database
        $files = $_FILES;
        echo '<pre>';
        print_r($files);
        $cpt = count($_FILES['userfile']['name']);
        for ($i = 0; $i < $cpt; $i++) {

            $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload();
            $image_data = $this->upload->data();
        }
        print_r($image_data);
        print_r($this->upload->display_errors());
        $this->dbmodel->addaanbieding($image_data);
        // redirect("bnw/aanbiedingen");
    }

}