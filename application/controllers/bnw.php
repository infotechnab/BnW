<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class bnw extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dbmodel');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
    }

    public function index() {
        $url = base_url() . 'index.php/bnw';
        if ($this->session->userdata('admin_logged_in')) {
            $data['username'] = Array($this->session->userdata('admin_logged_in'));
            $data['meta'] = $this->dbmodel->get_meta_data();
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
            $this->form_validation->set_rules('key', 'Coupon Key', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('rate', 'Discount Rate', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('expdate', 'Expire Date', 'required|xss_clean|max_length[200]');

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

    function logout() {
        $this->session->sess_destroy();
        $this->index();
        // redirect('login', 'refresh');
    }

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



    function change_category() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $id = $_POST['id'];
            $cat_id = $_POST['categoryProduct'];
            // die($cat_id);
            $this->dbmodel->change_category($id, $cat_id);
            $this->deletecategory($id);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function delete_Product_cat() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $id = $_POST['id'];
            $this->dbmodel->delRelPro($id);
            $this->dbmodel->delete_category($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/category');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //==========================================================================================================//
    //====================================POST==================================================================//
    //===========================================================================================================//

    public function posts() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/posts";
            $config["total_rows"] = $this->dbmodel->record_count_post();
            $config["per_page"] = 6;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data["query"] = $this->dbmodel->get_all_posts($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbmodel->get_meta_data();

            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/posts/postListing', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //============================To Add New Post=======================================//

    public function addpost() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $username = $this->session->userdata('username');
            $data['username'] = ($this->session->userdata('admin_logged_in'));
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            // $config['max_size'] = '500';
            // $config['max_width'] = '1024';
            // $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['query'] = $this->dbmodel->get_posts();
            $data['query'] = $this->dbmodel->get_misc_setting();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->helper('date');
            $this->load->library(array('form_validation', 'session'));
            $listOfCategory = $this->dbmodel->get_list_of_category();
            $data["listOfCategory"] = $this->dbmodel->get_list_of_category();

//            if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
//                $categoryName = $_POST['selectCategory'];
//                $post_category_info = $this->dbmodel->get_post_category_info($categoryName);
//                foreach ($post_category_info as $pid) {
//                    $post_category_id = $pid->id;
//                }
//            }
            //set validation rules
            $this->form_validation->set_rules('post_title', 'Page Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('post_content', 'Body', 'required|xss_clean');



            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['offreImage']['name'] !== "") {
                    if (!$this->upload->do_upload('offreImage')) {
                        $error = array('error' => $this->upload->display_errors('offreImage'));
                        $this->load->view('bnw/posts/addNewPost', $error);
                    } else {
                        // die('img');
                        $data = array('upload_data' => $this->upload->data('offreImage'));
                        $image = $data['upload_data']['file_name'];
                        $post_title = $this->input->post('post_title');
                        $post_content = $this->input->post('post_content');
                        $string = $this->input->post('post_content');
                        $post_summary = substr("$string", 0, 100);
                        $post_status = $this->input->post('post_status');

                        $this->dbmodel->add_new_post($post_title, $post_content, $post_summary, $post_status, $image);
                        $this->session->set_flashdata('message', 'One offer added sucessfully');
                        redirect('bnw/posts/postListing');
                    }
                } else {
                    //die('not');
                    $image = NULL;
                    $post_title = $this->input->post('post_title');
                    $post_content = $this->input->post('post_content');
                    $post_author_info = $this->dbmodel->get_post_author_id($username);
                    foreach ($post_author_info as $pid) {
                        $post_author_id = $pid->id;
                    }
                    $string = $this->input->post('post_content');
                    $post_summary = substr("$string", 0, 100);
                    $post_status = $this->input->post('post_status');
                    $post_comment_status = $this->input->post('comment_status');
                    $post_tags = $this->input->post('post_tags');
                    // $post_category_info = $this->dbmodel->get_post_category_info($categoryName);
                    $allowComment = $this->input->post('allow_comment');
                    $allowLike = $this->input->post('allow_like');
                    $allowShare = $this->input->post('allow_share');
                    $this->dbmodel->add_new_post($post_title, $post_content, $post_summary, $post_status, $image);
                    // $this->dbmodel->add_new_post($post_title, $post_content, $post_author_id, $post_summary, $post_status, $post_comment_status, $post_tags, $post_category_id, $allowComment, $allowLike, $allowShare);
                    $this->session->set_flashdata('message', 'One Offer added sucessfully');
                    redirect('bnw/posts');
                }
            } else {

                $this->load->view('bnw/posts/addNewPost', $data);
            }

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //======================================To Edit Post===========================================================//

    function editpost($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbmodel->findpost($id);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['miscSetting'] = $this->dbmodel->get_misc_setting();
            $data['id'] = $id;
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/posts/editPost', $data);

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //=========================================To Delete Post======================================================//
    public function deletepost($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $this->dbmodel->deletepost($id);
            $this->session->set_flashdata('message', 'Data Deleted Sucessfully');
            redirect('bnw/posts');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //===================================To Update Edited Post======================================================//
    public function updatepost() {
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
            $data['query'] = $this->dbmodel->get_posts();
            $username = $this->session->userdata('username');
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $listOfCategory = $this->dbmodel->get_list_of_category();

            $data["listOfCategory"] = $this->dbmodel->get_list_of_category();
            $id = $this->input->post('id');
            $data['query'] = $this->dbmodel->findpost($id);

//            if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
//                $categoryName = $_POST['selectCategory'];
//                $post_category_info = $this->dbmodel->get_post_category_info($categoryName);
//                foreach ($post_category_info as $pid) {
//                    $post_category_id = $pid->id;
//                }
//            }
            //set validation rules
            $this->form_validation->set_rules('post_title', 'Page Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('post_content', 'Body', 'required|xss_clean');


            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('file')) {
                        // die('i am here');
                        $data['error'] = $this->upload->display_errors('file');
                        $id = $this->input->post('id');
                        $data['query'] = $this->dbmodel->findpost($id);
                        $this->load->view('bnw/posts/editPost', $data);
                    } else {

                        $id = $this->input->post('id');
                        $post_title = $this->input->post('post_title');
                        $post_content = $this->input->post('post_content');
                        $data = array('upload_data' => $this->upload->data('file'));
                        $image = $data['upload_data']['file_name'];
//                        $post_author_info = $this->dbmodel->get_post_author_id($username);
//                        foreach ($post_author_info as $pid) {
//                            $post_author_id = $pid->id;
//                        }
                        $string = $this->input->post('post_content');
                        $post_summary = substr("$string", 0, 100);
//                        $post_status = $this->input->post('page_status');
//                        $post_comment_status = $this->input->post('comment_status');
//                        $post_tags = $this->input->post('post_tags');
//                        $allowComment = $this->input->post('allow_comment');
//                        $allowLike = $this->input->post('allow_like');
//                        $allowShare = $this->input->post('allow_share');
                        $this->dbmodel->update_post($id, $post_title, $post_content, $post_summary, $image);
                        $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                        redirect('bnw/posts/postListing');
                    }
                } else {
                    $id = $this->input->post('id');
                    $post_title = $this->input->post('post_title');
                    $post_content = $this->input->post('post_content');
//                    $post_author_info = $this->dbmodel->get_post_author_id($username);
//                    foreach ($post_author_info as $pid) {
//                        $post_author_id = $pid->id;
//                    }
                    $string = $this->input->post('post_content');
                    $post_summary = substr("$string", 0, 100);
                    $post_image = $this->input->post('hidden_image');
//                    $post_status = $this->input->post('page_status');
//                    $post_comment_status = $this->input->post('comment_status');
//                    $post_tags = $this->input->post('post_tags');
//                    $allowComment = $this->input->post('allow_comment');
//                    $allowLike = $this->input->post('allow_like');
//                    $allowShare = $this->input->post('allow_share');
                    $this->dbmodel->update_post($id, $post_title, $post_content, $post_summary, $post_image);
                    $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                    redirect('bnw/posts/postListing');
                }
            } else {
                $id = $this->input->post('id');
                $data['query'] = $this->dbmodel->findpost($id);
                $this->load->view('bnw/posts/editPost', $data);
            }

            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //==================================== Page ============================//

    public function pages() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/pages";
            $config["total_rows"] = $this->dbmodel->record_count_page();
            $config["per_page"] = 6;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $pagedata["query"] = $this->dbmodel->get_all_pages($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbmodel->get_meta_data();


            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/pages/pageListing', $pagedata);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //============== ADD PAGE ==============//
    public function addpage() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $username = $this->session->userdata('username');
            $data['username'] = ($this->session->userdata('admin_logged_in'));
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $pagedata['query'] = $this->dbmodel->get_pages();
            $data['query'] = $this->dbmodel->get_misc_setting();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->helper('form');
            $this->load->helper('date');
            $this->load->library(array('form_validation', 'session'));
            //set validation rules
            $name = $this->input->post('page_name');
            $body = $this->input->post('page_content');
            $page_author_info = $this->dbmodel->get_page_author_id($username);
            foreach ($page_author_info as $id) {
                $page_author_id = $id->id;
            }
            $string = $this->input->post('page_content');
            $summary = substr("$string", 0, 100);
            $status = $this->input->post('page_status');
            $order = $this->input->post('page_order');
            $type = $this->input->post('page_type');
            $tags = $this->input->post('page_tags');
            $allowComment = $this->input->post('allow_comment');
            $allowLike = $this->input->post('allow_like');
            $allowShare = $this->input->post('allow_share');
            $this->form_validation->set_rules('page_name', 'Page Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('page_content', 'Body', 'required|xss_clean');



            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('file')) {
                        $error = array('error' => $this->upload->display_errors('file'));
                        $this->load->view('bnw/pages/addnew', $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data('file'));
                        $image = $data['upload_data']['file_name'];
                        $this->dbmodel->add_new_page($name, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare);
                        $this->session->set_flashdata('message', 'One pages added sucessfully');
                        redirect('bnw/pages/pageListing');
                    }
                } else {

                    $name = $this->input->post('page_name');
                    $body = $this->input->post('page_content');
                    $page_author_info = $this->dbmodel->get_page_author_id($username);
                    foreach ($page_author_info as $id) {
                        $page_author_id = $id->id;
                    }

                    $string = $this->input->post('page_content');
                    $summary = substr("$string", 0, 100);

                    $status = $this->input->post('page_status');
                    $order = $this->input->post('page_order');

                    $type = $this->input->post('page_type');
                    $tags = $this->input->post('page_tags');
                    $allowComment = $this->input->post('allow_comment');
                    $allowLike = $this->input->post('allow_like');
                    $allowShare = $this->input->post('allow_share');
                    $this->dbmodel->add_new_page($name, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare);

                    $page = $this->dbmodel->find_page_id($name);
                    $this->session->set_flashdata('message', 'One pages added sucessfully');
                    redirect('bnw/pages/pageListing');
                }
            } else {

                $this->load->view('bnw/pages/addnew', $data);
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //======================EDIT PAGE===============================//

    function editpage($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbmodel->findpage($id);

            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['miscSetting'] = $this->dbmodel->get_misc_setting();
            $data['id'] = $id;

            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/pages/edit', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //======================UPDATE EDITED PAGE===============================//


    public function updatepage() {
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
            $this->form_validation->set_rules('page_name', 'Page Name', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('page_content', 'Body', 'required|xss_clean');




            if (($this->form_validation->run() == TRUE)) {
                if ($_FILES && $_FILES['file']['name'] !== "") {
                    if (!$this->upload->do_upload('slide_image')) {
                        $data['error'] = $this->upload->display_errors('file');
                        $id = $this->input->post('id');
                        $data['query'] = $this->dbmodel->findpage($id);
                        $this->load->view('bnw/pages/edit', $data);
                    } else {


                        $id = $this->input->post('id');
                        $name = $this->input->post('page_name');
                        $body = $this->input->post('page_content');
                        $page_author_info = $this->dbmodel->get_page_author_id($username);
                        foreach ($page_author_info as $pid) {
                            $page_author_id = $pid->id;
                        }
                        $string = $this->input->post('page_content');
                        $summary = substr("$string", 0, 100);
                        $status = $this->input->post('page_status');
                        $order = $this->input->post('page_order');
                        $type = $this->input->post('page_type');
                        $tags = $this->input->post('page_tags');
                        $allowComment = $this->input->post('allow_comment');
                        $allowLike = $this->input->post('allow_like');
                        $allowShare = $this->input->post('allow_share');
                        $navigationName = $name;
                        $navigationLink = 'page/' . $id;
                        $navigationSlug = preg_replace('/\s+/', '', $name);
                        $pageid = $id;
                        $this->dbmodel->update_page($id, $name, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare);
                        $this->dbmodel->update_navigation_on_page_update($pageid, $navigationName, $navigationLink, $navigationSlug);
                        $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                        redirect('bnw/pages/pageListing');
                    }
                } else {

                    $id = $this->input->post('id');
                    $name = $this->input->post('page_name');
                    $body = $this->input->post('page_content');
                    $page_author_info = $this->dbmodel->get_page_author_id($username);
                    foreach ($page_author_info as $pid) {
                        $page_author_id = $pid->id;
                    }
                    $string = $this->input->post('page_content');
                    $summary = substr("$string", 0, 100);
                    $status = $this->input->post('page_status');
                    $order = $this->input->post('page_order');
                    $type = $this->input->post('page_type');
                    $tags = $this->input->post('page_tags');
                    $allowComment = $this->input->post('allow_comment');
                    $allowLike = $this->input->post('allow_like');
                    $allowShare = $this->input->post('allow_share');
                    $navigationName = $name;
                    $navigationLink = 'page/' . $id;
                    $navigationSlug = preg_replace('/\s+/', '', $name);
                    $pageid = $id;
                    $this->dbmodel->update_page($id, $name, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare);
                    $this->dbmodel->update_navigation_on_page_update($pageid, $navigationName, $navigationLink, $navigationSlug);
                    $this->session->set_flashdata('message', 'Data Modified Sucessfully');
                    redirect('bnw/pages/pageListing');
                }
            } else {
                $id = $this->input->post('id');
                $data['query'] = $this->dbmodel->findpage($id);
                $this->load->view('bnw/pages/edit', $data);
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function deletepage($id) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $this->dbmodel->delete_page($id);
            $this->dbmodel->delete_navigation_related_to_page($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/pages');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //============================================================================//
    //=============================USER===========================================//
    //============================================================================//
    public function users() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/users";
            $config["total_rows"] = $this->dbmodel->record_count_user();
            $config["per_user"] = 6;


            $this->pagination->initialize($config);

            $user = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbmodel->get_all_user($config["per_user"], $user);
            $data["links"] = $this->pagination->create_links();
            $data['query'] = $this->dbmodel->get_user();
            $data['meta'] = $this->dbmodel->get_meta_data();

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

            $data['meta'] = $this->dbmodel->get_meta_data();
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
                $this->dbmodel->add_new_user($name, $fname, $lname, $email, $pass, $status, $user_type, $contact, $address);
                $this->session->set_flashdata('message', 'One user added sucessfully');
                redirect('bnw/users/userListing');
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
            $data['query'] = $this->dbmodel->finduser($id);
            $data['meta'] = $this->dbmodel->get_meta_data();

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

            $data['meta'] = $this->dbmodel->get_meta_data();
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
                $data['query'] = $this->dbmodel->finduser($id);
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

                $this->dbmodel->update_user($id, $name, $fname, $lname, $email, $pass, $status, $user_type);
                $this->session->set_flashdata('message', 'User data Modified Sucessfully');

                redirect('bnw/users/userListing');
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
            $userKey = $this->dbmodel->check_user($id);
            // print_r($userKey);
            foreach ($userKey as $user) {
                $userid = $user->user_name;
            }
            if ($uNAme !== $userid) {
                // die($uNAme);
                $this->dbmodel->delete_user($id);
                $this->session->set_flashdata('message', 'Data Delete Sucessfully');
                redirect('bnw/users');
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
            $config["total_rows"] = $this->dbmodel->record_count_user();
            $config["per_user"] = 6;


            $this->pagination->initialize($config);

            $user = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbmodel->get_all_user($config["per_user"], $user);
            $data["links"] = $this->pagination->create_links();
            $username = $this->session->userdata('username');
            $data['query'] = $this->dbmodel->get_user_info($username);
            $data['meta'] = $this->dbmodel->get_meta_data();

            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/users/userProfiler', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //=========================================================================================================
    //====================================MEDIA================================================================
    //=========================================================================================================

    public function media() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/media";
            $config["total_rows"] = $this->dbmodel->record_count_user();
            $config["per_media"] = 6;
            $this->pagination->initialize($config);
            $media = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbmodel->get_all_user($config["per_media"], $media);
            $data["links"] = $this->pagination->create_links();
            $data['query'] = $this->dbmodel->get_all_media();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/media/mediaListing', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //===============================to add media=================================================
    public function addmedia() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|ppt|odt|pptx|docx|xls|xlsx|key';
            $config['max_size'] = '2000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);
            $listOfAlbum = $this->dbmodel->get_list_of_album();
            $data["listOfAlbum"] = $this->dbmodel->get_list_of_album();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));

            if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
                $mediaName = $_POST['selectAlbum'];
                $media_association_info = $this->dbmodel->get_media_association_info($mediaName);
                foreach ($media_association_info as $id) {
                    $media_association_id = $id->id;
                }
            }
            $this->form_validation->set_rules('media_name', 'media Name', 'required|xss_clean|max_length[200]');



            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file_name'))) {
                $data['error'] = $this->upload->display_errors();

                $this->load->view('bnw/media/addNew', $data);
            } else {

                //if valid
                $data = array('upload_data' => $this->upload->data('file'));
                $medianame = $this->input->post('media_name');
                $mediatype = $data['upload_data']['file_name'];
                $medialink = base_url() . 'content/images/' . $mediatype;
                $this->dbmodel->add_new_media($medianame, $mediatype, $media_association_id, $medialink);
                $this->session->set_flashdata('message', 'One media added sucessfully');
                redirect('bnw/media/mediaListing');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //==================================To edit media==================================================

    public function editmedia($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbmodel->findmedia($id);
            $data['meta'] = $this->dbmodel->get_meta_data();

            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/media/editMedia', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //======================================To update edited media=========================================

    function updatemedia() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|ppt|odt|pptx|docx|xls|xlsx|key.';
            $config['max_size'] = '2000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);
            $listOfAlbum = $this->dbmodel->get_list_of_album();
            $data["listOfAlbum"] = $this->dbmodel->get_list_of_album();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));

            if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
                $mediaName = $_POST['selectAlbum'];
                $media_association_info = $this->dbmodel->get_media_association_info($mediaName);
                foreach ($media_association_info as $id) {
                    $media_association_id = $id->id;
                }
            }
            $this->form_validation->set_rules('media_name', 'media Name', 'required|xss_clean|max_length[200]');


            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file_name'))) {
                $data['error'] = $this->upload->display_errors();



                //if not valid
                $data['query'] = $this->dbmodel->findmedia($id);
                $this->load->view('bnw/media/mediaListing', $data);
            } else {
                //if valid
                $id = $this->input->post('id');
                $data = array('upload_data' => $this->upload->data('file'));
                $medianame = $this->input->post('media_name');
                $mediatype = $data['upload_data']['file_name'];
                $medialink = $this->input->post('media_link');
                $this->dbmodel->update_media($id, $medianame, $mediatype, $media_association_id, $medialink);
                $this->session->set_flashdata('message', 'Media data Modified Sucessfully');

                redirect('bnw/media/mediaListing');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function delmedia($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbmodel->findmedia($id);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/media/deleteMedia', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function deletemedia($id) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $id = $_GET['image'];
            unlink('./content/uploads/images/' . $id);

            $this->dbmodel->delete_media($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/media');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //==========================================================================================================//
    //===================================ALBUM==================================================================//
    //==========================================================================================================//

    public function album() {
        //$url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/album";
            $config["total_rows"] = $this->dbmodel->record_count_album();
            $config["per_user"] = 6;
            $this->pagination->initialize($config);

            $user = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbmodel->get_all_user($config["per_user"], $user);
            $data["links"] = $this->pagination->create_links();
            $data['query'] = $this->dbmodel->get_album();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->view('bnw/album/index');
            $this->load->view('bnw/templates/footer', $data);
        }
    }

    public function addalbum() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['query'] = $this->dbmodel->get_album();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('album_name', 'Album Name', 'required|xss_clean|max_length[200]');

            if (($this->form_validation->run() == FALSE)) {

                //if not valid
                $error = "Enter Album Name";


                $this->load->view('bnw/album/index', $error);
            } else {

                //if valid

                $name = $this->input->post('album_name');

                $this->dbmodel->add_new_album($name);
                $this->session->set_flashdata('message', 'One Album added sucessfully');
                redirect('bnw/album/index');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //===============================To Add Photo================================================================//
    public function addphoto() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean|max_length[200]');

            $albumid = $this->input->post('id');
            $data['query'] = $this->dbmodel->get_album();


            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload())) {
                $data['error'] = $this->upload->display_errors();

                $this->load->view('bnw/album/index', $data);
            } else {

                //if valid
                $data = array('upload_data' => $this->upload->data());

                $mediatype = $data['upload_data']['file_name'];
                $medianame = $this->input->post('title');
                $albumid = $this->input->post('id');
                $medialink = $this->input->post('media_link');
                $this->dbmodel->add_new_photo($medianame, $mediatype, $albumid, $medialink);
                $this->session->set_flashdata('message', 'One photo added sucessfully');
                redirect('bnw/addalbum');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function delphoto($photoid = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbmodel->get_photo_media_id($photoid);

            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/album/deletePhoto', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function deletephoto($a = 0) {
        $url = current_url();

        if ($this->session->userdata('admin_logged_in')) {
            $a = $_GET['image'];

            unlink('./content/uploads/images/' . $a);
            $this->dbmodel->delete_photo($a);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/addalbum');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //============================================================================================================//
    //====================================SLIDER==================================================================//
    //============================================================================================================/

    public function slider() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/slider";
            $config["total_rows"] = $this->dbmodel->record_count_slider();
            $config["per_page"] = 6;
            //$config["uri_segment"] = 3;

            $this->pagination->initialize($config);

            $slide = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["query"] = $this->dbmodel->get_slider($config["per_page"], $slide);
            $data["links"] = $this->pagination->create_links();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/slider/slideListing', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function addslider() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config);

            $data['meta'] = $this->dbmodel->get_meta_data();

            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('slide_name', 'Title', 'required|xss_clean|max_length[200]');
            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file_name'))) {
                $data['error'] = $this->upload->display_errors();

                $this->load->view('bnw/slider/addnew', $data);
            } else {

                //if valid
                $data = array('upload_data' => $this->upload->data('file'));
                $slidename = $this->input->post('slide_name');
                $slideimage = $data['upload_data']['file_name'];
                $slidecontent = $this->input->post('slide_content');

                //for cropper
                //require_once(APPPATH.'Imagemanipulator.php');
                include_once 'Imagemanipulator.php';

                $manipulator = new ImageManipulator($_FILES['file_name']['tmp_name']);
                $width = $manipulator->getWidth();
                $height = $manipulator->getHeight();


                $slideWidth = $this->dbmodel->get_slide_width();
                foreach ($slideWidth as $a) {
                    $fullWidth = $a->description;
                }
                $slideHeight = $this->dbmodel->get_slide_height();
                foreach ($slideHeight as $b) {
                    $fullHeight = $b->description;
                }
                $halfWidth = round($fullWidth / 2);
                $halfHeight = round($fullHeight / 2);

                $centreX = round($width / 2);

                $centreY = round($height / 2);

                // our dimensions will be 200x130
                $x1 = $centreX - $halfWidth; // 200 / 2
                $y1 = $centreY - $halfHeight; // 130 / 2

                $x2 = $centreX + $halfWidth; // 200 / 2
                $y2 = $centreY + $halfHeight; // 130 / 2
                // center cropping to 200x130
                $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
                // saving file to uploads folder
                $manipulator->save('./content/uploads/images/' . $_FILES['file_name']['name']);
                //cropper closed               
                $this->dbmodel->add_new_slider($slidename, $slideimage, $slidecontent);
                $this->session->set_flashdata('message', 'One slide added sucessfully');
                redirect('bnw/slider');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function editslider($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbmodel->findslider($id);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/slider/edit', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function delslider($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbmodel->findslider($id);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/slider/delete', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function updateslider() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config);

            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('slide_name', 'Title', 'required|xss_clean|max_length[200]');



            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file_name'))) {
                $data['error'] = $this->upload->display_errors();
                $id = $this->input->post('id');
                $data['query'] = $this->dbmodel->findslider($id);
                $this->load->view('bnw/slider/edit', $data);
            } else {

                //if valid
                $id = $this->input->post('id');
                $data = array('upload_data' => $this->upload->data('file'));
                $slidename = $this->input->post('slide_name');
                $slideimage = $data['upload_data']['file_name'];
                $slidecontent = $this->input->post('slide_content');

                $this->dbmodel->update_slider($id, $slidename, $slideimage, $slidecontent);
                $this->session->set_flashdata('message', 'One slide modified sucessfully');
                redirect('bnw/slider');
            }
            $this->load->view('bnw/templates/footer', $data);
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function deleteslider($a = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $a = $_GET['image'];

            unlink('./content/uploads/images/' . $a);


            $this->dbmodel->delete_slider($a);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/slider');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //============================================================================================================//
    //================================Settings/ Setup ============================================================//
    //============================================================================================================//

    public function setup() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $header = "bnw/templates/";
            $this->load->view($header . 'header', $data);
            $this->load->view($header . 'menu');
            $this->load->view('bnw/setup/index', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function deletefavicone($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $this->dbmodel->delete_favicone($id);
            $this->session->set_flashdata('message', 'Data Delete Sucessfully');
            redirect('bnw/setup');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function setupupdate() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png|ico';
            $config['max_size'] = '500';
            $config['max_width'] = '70';
            $config['max_height'] = '70';
            $this->load->library('upload', $config);

            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('url', 'Url', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
            $this->form_validation->set_rules('keyword', 'Keyword', 'required|xss_clean');
            $this->form_validation->set_rules('description', 'Description', 'required|xss_clean');
            if (($this->form_validation->run() == FALSE)) {
                $data['error'] = $this->upload->display_errors();
                $data['meta'] = $this->dbmodel->get_meta_data();
                $header = "bnw/templates/";
                $this->load->view($header . 'header', $data);
                $this->load->view($header . 'menu');
                $this->load->view('bnw/setup/index', $data);
            } else {
                if (!$this->upload->do_upload('file_name')) {


                    $favicone = $this->input->post('faviconeName');
                    //die($favicone);
                    $url = $this->input->post('url');
                    $title = $this->input->post('title');
                    $keyword = $this->input->post('keyword');
                    $description = $this->input->post('description');
                    $this->dbmodel->update_meta_data($url, $title, $keyword, $description, $favicone);
                } else {
                    $data = array('upload_data' => $this->upload->data('file'));

                    $favicone = $data['upload_data']['file_name'];

                    $url = $this->input->post('url');
                    $title = $this->input->post('title');
                    $keyword = $this->input->post('keyword');
                    $description = $this->input->post('description');
                    $this->dbmodel->update_meta_data($url, $title, $keyword, $description, $favicone);
                }
                redirect('bnw/setup');
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function header() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $set['query'] = $this->dbmodel->get_design_setup();
            // var_dump($set);
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/setup/addHeader', $set);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function headerupdate() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '786';

            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['query'] = $this->dbmodel->get_design_setup();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('header_title', 'Title', 'required|xss_clean|max_length[200]');


            if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file_name'))) {
                //die('not image');
                $data['error'] = $this->upload->display_errors();

                $this->load->view('bnw/setup/addHeader', $data);
            } else {

                //if valid
                $data = array('upload_data' => $this->upload->data('file'));

                $headerTitle = $this->input->post('header_title');
                $headerLogo = $data['upload_data']['file_name'];

                $headerDescription = $this->input->post('header_description');
                $headerBgColor = $this->input->post('header_bgcolor');
                $this->dbmodel->update_design_header_setup($headerTitle, $headerLogo, $headerDescription, $headerBgColor);
                $this->session->set_flashdata('message', 'Header setting done sucessfully');
                redirect('bnw');
            }
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function sidebar() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $set['query'] = $this->dbmodel->get_design_setup();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/setup/addSidebar', $set);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function sidebarupdate() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('sidebar_title', 'Title', 'required|xss_clean|max_length[200]');
            $this->form_validation->set_rules('sidebar_description', 'Description', 'required|xss_clean');
            $this->form_validation->set_rules('sidebar_bgcolor', 'Background Color', 'required|xss_clean');
            // $this->form_validation->set_rules('header_bgcolor', 'Description', 'required|xss_clean');
            if (($this->form_validation->run() == FALSE)) {

                $data['meta'] = $this->dbmodel->get_meta_data();
                $this->load->view("bnw/templates/header", $data);
                $this->load->view("bnw/templates/menu");
                $this->load->view('bnw/setup/addSidebar');
            } else {
                $sideBarTitle = $this->input->post('sidebar_title');
                $sideBarDescription = $this->input->post('sidebar_description');
                $sideBarBgColor = $this->input->post('sidebar_bgcolor');

                $this->dbmodel->update_design_sidebar_setup($sideBarTitle, $sideBarDescription, $sideBarBgColor);
                redirect('bnw');
            }
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //=====================================Miscellaneous Setting===============================================/
    public function miscsetting() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['query'] = $this->dbmodel->get_misc_setting();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/setup/miscSetting');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function miscsettingupdate() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $this->load->library('session');
            $data['query'] = $this->dbmodel->get_misc_setting();

            $allowComment = $this->input->post('allow_comment');
            $allowLike = $this->input->post('allow_like');
            $allowShare = $this->input->post('allow_share');
            $maximunPost = $this->input->post('max_post_to_show');
            $maximumPage = $this->input->post('max_page_to_show');
            $slideHeight = $this->input->post('slide_height');
            $slideWidth = $this->input->post('slide_width');


            $this->dbmodel->update_misc_setting($allowComment, $allowLike, $allowShare, $maximunPost, $maximumPage, $slideHeight, $slideWidth);
            redirect('bnw');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    //============album=====



    public function add_new_album() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $config['upload_path'] = './content/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '500';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $data['query'] = $this->dbmodel->get_album();
            $this->load->view('bnw/templates/header', $data);
            $this->load->view('bnw/templates/menu');
            $this->load->helper('form');
            $this->load->library(array('form_validation', 'session'));
            $this->form_validation->set_rules('album_name', 'Album Name', 'required|xss_clean|max_length[200]');

            if (($this->form_validation->run() == FALSE)) {

                //if not valid
                $error = "Enter Album Name";


                $this->load->view('bnw/album/index', $error);
            } else {

                //if valid
                $name = $this->input->post('album_name');

                $this->dbmodel->add_new_album($name);
                $this->session->set_flashdata('message', 'One Album added sucessfully');
                redirect('bnw/album/index');
            }
        } else {

            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function delalbum($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['photoquery'] = $this->dbmodel->get_all_photos($id);
            $data['albumquery'] = $this->dbmodel->get_selected_album($id);
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/album/deleteAlbum', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function delete_album($id) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $data['photoquery'] = $this->dbmodel->get_all_photos($id);
            foreach ($data['photoquery'] as $photo) {
                $image = $photo->media_type;
                unlink('./content/uploads/images/' . $image);
            }

            $this->dbmodel->delete_photo($id);
            $this->dbmodel->delete_album($id);
            $this->session->set_flashdata('message', 'One album Deleted Sucessfully');
            redirect('bnw/album');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function editalbum($aid = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $this->dbmodel->edit_album($aid);
            redirect('bnw/album');
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    public function photos($id = 0) {

        $data['query'] = $this->dbmodel->get_media($id);
        $data['meta'] = $this->dbmodel->get_meta_data();
        $data['id'] = $id;
        $this->load->view('bnw/templates/header', $data);
        $this->load->view('bnw/templates/menu');
        $this->load->view('bnw/album/gallery', $data);
        $this->load->view('bnw/templates/footer', $data);
    }

    //--------------------------------gallery---------------

    public function gallery() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $data['query'] = $this->dbmodel->get_all_photos();
            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/gallery/index', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    // ==================  MENU  ============================ //

    public function menu() {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "index.php/bnw/menu";
            $config["total_rows"] = $this->dbmodel->record_count_menu();
            $config["per_page"] = 6;
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $this->pagination->initialize($config);


            $data["query"] = $this->dbmodel->get_menu($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();

            $data['meta'] = $this->dbmodel->get_meta_data();
            $this->load->view("bnw/templates/header", $data);
            $this->load->view("bnw/templates/menu");
            $this->load->view('bnw/menu/addnew', $data);
            $this->load->view('bnw/templates/footer', $data);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

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

    function offerImgdelete($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $id = $_GET['id'];
            $data['query'] = $this->dbmodel->findpost($id);
            foreach ($data['query'] as $a) {
                $img = $a->image;
            }
            // die($img);
            if ($img == !NULL) {
                unlink('./content/uploads/images/' . $img);
            }
            $this->dbmodel->offerImgdelete($id);

            $this->editpost($id);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    function Imgdelete($id = 0) {
        $url = current_url();
        if ($this->session->userdata('admin_logged_in')) {

            $id = $_GET['id'];
            $data['event'] = $this->dbmodel->get_event_id($id);
            foreach ($data['event'] as $a) {
                $img = $a->image;
            }
            // die($img);
            if ($img == !NULL) {
                unlink('./content/uploads/images/' . $img);
            }
            $this->dbmodel->Imgdelete($id);

            $this->editevent($id);
        } else {
            redirect('login/index/?url=' . $url, 'refresh');
        }
    }

    

}