<?php

class Dbmodel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // This model is to user verified 
    function validate() {
        $this->db->where('user_name', $this->input->post('username'));
        $this->db->where('user_pass', md5($this->input->post('password')));
        $this->db->where('user_type', 0);
        $query = $this->db->get('user');

        if ($query->num_rows == 1) {
            return true;
        } else {
            return FALSE;
        }
    }

    //Get the selected category ID
    public function get_id_of_selected_category($navigation_link) {

        $this->db->where('navigation_link', $navigation_link);
        $this->db->limit(1);
        $query = $this->db->get('navigation');
        return $query->result();
    }

    public function get_product_order($userID) {

        $this->db->where('u_id', $userID);
        $query = $this->db->get('product_oder');
        return $query->result();
    }

    public function get_product_order_detail($product, $limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->where('o_id', $product);
        $query = $this->db->get('product_oder_detail');
        return $query->result();
    }

    public function get_product_detail($pid) {

        $this->db->where('id', $pid);
        $query = $this->db->get('product');
        return $query->result();
    }

    function validate_user($email, $pass) {
        $password = md5($pass);
        $this->db->where('user_email', $email);
        $this->db->where('user_pass', $password);
        $this->db->where('user_type', 1);
        $query = $this->db->get('user');
        return $query->result();
    }

    public function get_logged_in_user($userName) {
        $this->db->where('user_name', $userName);
        //$this->db->where('user_type',1);
        $query = $this->db->get('user');
        return $query->result();
    }

    public function get_admin_email($userName) {
        $this->db->where('user_name', $userName);
        $this->db->where('user_type', 0);
        $query = $this->db->get('user');
        return $query->result();
    }

    public function get_logged_in_user_by_name($userName) {
        $this->db->where('user_name', $userName);
        $this->db->where('user_type', 0);
        $query = $this->db->get('user');
        return $query->result();
    }

    // this is another method to get user verified 
    function login($name, $pass) {
        $this->db->select('id, user_name, user_pass');
        $this->db->from('user');
        $this->db->where('user_name= ' . "'" . $name . "'");
        $this->db->where('user_pass = ' . "'" . MD5($pass) . "'");
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function add_new_comment($comment, $comment_association_id, $user_name) {
        $data = array(
            'comment' => $comment,
            'comment_association_id' => $comment_association_id,
            'comment_user_name' => $user_name);

        $this->db->insert('comment_store', $data);
    }

    public function check_user_name($name) {
        $this->db->where('user_name', $name);
        $query = $this->db->get('user');

        return $query->result();
    }

    public function check_user_email($email) {
        $this->db->where('user_email', $email);
        $query = $this->db->get('user');

        return $query->result();
    }

    function get_file($id) {
        $this->db->where('category', $id);
        $query = $this->db->get('product');
        return $query->result();
    }

    // ========================== Navigation ==================================//
    ////==============================//////
//============================    For Cart System         ========================================//
    function getdate($key) {
        $this->db->select('exp_date');
        $this->db->where('key', $key);
        $query = $this->db->get('coupon');
        return $query->result();
    }

    function checkkey($id, $today) {
        $this->db->where('key', $id);
        // $this->db->where('exp_date <=',$today);
        $query = $this->db->get('coupon');
        return $query->result();
    }

    function add_coupon($key, $rate, $date) {
        // die($date);
        //  $starus value 0 if coupone is new or not used 
        $status = 0;
        $data = array(
            'key' => $key,
            'rate' => $rate,
            'exp_date' => $date,
            'status' => $status
        );

        $this->db->insert('coupon', $data);
    }

    function order_user($name, $address, $city, $state, $country, $zip, $email, $contact) {
        $uid = 11;
        $data = array(
            'u_id' => $uid,
            'user_name' => $name,
            'deliver_address' => $address,
            'city' => $city,
            'state' => $state,
            'zip' => $zip,
            'country' => $country,
            'email' => $email,
            'contact' => $contact
        );
        $this->db->insert('product_oder', $data);
    }

    function add_new_product($cat, $des, $sum, $qty, $name, $price, $img1, $img2, $img3, $shipping, $allowLike, $allowShare, $featured) {
        $status = 0;
        $data = array(
            'featured' => $featured,
            'category' => $cat,
            'description' => $des,
            'summary' => $sum,
            'qty' => $qty,
            'price' => $price,
            'name' => $name,
            'image1' => $img1,
            'image2' => $img2,
            'image3' => $img3,
            'shiping' => $shipping,
            'like' => $allowLike,
            'share' => $allowShare,
            'status' => $status);

        $this->db->insert('product', $data);
    }

    function quick_add_new_product($productCategory, $description, $summary, $productName, $productPrice, $productImg, $shipping) {
        $status = 0;
        $data = array(
            'category' => $productCategory,
            'description' => $description,
            'summary' => $summary,
            'price' => $productPrice,
            'name' => $productName,
            'image1' => $productImg,
            'shiping' => $shipping,
            'status' => $status
        );

        $this->db->insert('product', $data);
    }

    function get_proID() {
        $this->db->select('id');

        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        $proID = $this->db->get('product');
        return $proID->result();
    }

    function record_count_product() {
        $this->db->where('status', '0');
        $this->db->from("product");
        return $this->db->count_all_results();
    }

    function record_count_products($id) {
        $this->db->where('category', $id);
        $this->db->where('status', '0');
        $this->db->from("product");
        return $this->db->count_all_results();
    }

    function record_count_transaction($product) {
        $this->db->where('o_id', $product);
        $this->db->from('product_oder_detail');
        return $this->db->count_all_results();
    }

    function record_count_coupon() {

        return $this->db->count_all("coupon");
    }

    function record_count_cat($id) {

        $this->db->where('category', $id);
        $this->db->where('status = 0');
        return $this->db->count_all("product");
    }

    function record_count_product_order() {
        return $this->db->count_all("product_oder_detail");
    }

    function get_all_product_order() {
        $this->db->order_by('o_id', 'DESC');
        $query = $this->db->get('product_oder_detail');
        return $query->result();
    }

    function get_all_product_orderDis() {
        $this->db->order_by('o_id', 'DESC');
        $this->db->distinct();
        $this->db->select("trans_id");
        $this->db->order_by('trans_id', 'DESC');
        $query = $this->db->get('product_oder_detail', 3);
        return $query->result();
    }

    function get_record_all_product_orderDis() {
        $this->db->distinct();
        $this->db->select("trans_id");
        $query = $this->db->get('product_oder_detail');
        return $query->result();
    }

    function TransDetail($id) {

        $this->db->where('trans_id', $id);
        $query = $this->db->get('product_oder_detail');
        return $query->result();
    }

    function get_product_id($id) {
        $this->db->where('id', $id);
        // $this->db->where('status = 0');
        $query = $this->db->get('product');
        return $query->result();
    }

    function get_all_productTrn($limit, $start) {

        $this->db->distinct();

        $this->db->limit($limit, $start);
        $this->db->order_by('trans_id', 'DESC');
        $query = $this->db->get('product_oder_detail');
        return $query->result();
    }

    function get_all_product($limit, $start) {

        $this->db->limit($limit, $start);
        $this->db->where('status = 0');
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get('product');
        return $query->result();
    }

    function get_all_product_for_facebook() {
        $this->db->where('status = 0');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('product');
        return $query->result();
    }

    function get_related_product($id) {//die($id);
        // $this->db->order_by('id','DESC');
        $this->db->where('category', $id);
        $this->db->where('status = 0');
        $this->db->where('status = 0');
        $query = $this->db->get('product');
        return $query->result();
    }

    function change_category($id, $catid) {
        $data = array(
            'category' => $catid
        );
        $this->db->where('category', $id);

        $this->db->update('product', $data);
    }

    function get_product() {
        $this->db->order_by('id', 'DESC');
        $this->db->where('status = 0');
        $query = $this->db->get('product', 3);
        return $query->result();
    }

    function findproduct($id) {
        // $this->db->select();
        $this->db->from('product');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function get_all_product_order_oid($id) {
        $this->db->where('o_id', $id);
        $query = $this->db->get('product_oder');
        return $query->result();
    }

    function delete_product_photo($id, $image) {
        //die($image);
        // $this->db->delete('product', array('media_type' => $a)); 
        if ($image == "image1") {
            $data = array(
                'image1' => " "
            );
        }
        if ($image == "image2") {
            $data = array(
                'image2' => " "
            );
        }
        if ($image == "image3") {
            $data = array(
                'image3' => " "
            );
        }
        $this->db->where('id', $id);

        $this->db->update('product', $data);
    }

    function update_product($id, $cate, $name, $description, $summary, $price, $productImg, $productImgTwo, $productImgThree, $shipping, $allowLike, $allowShare, $featured) {
        $data = array(
            'featured' => $featured,
            'category' => $cate,
            'name' => $name,
            'description' => $description,
            'summary' => $summary,
            'price' => $price,
            'image1' => $productImg,
            'image2' => $productImgTwo,
            'image3' => $productImgThree,
            'shiping' => $shipping,
            'like' => $allowLike,
            'share' => $allowShare);

        $this->db->where('id', $id);
        $this->db->update('product', $data);
    }

    public function update_user_data($fname, $lname, $street, $town, $district, $zip, $country, $contact, $email) {
        $data = array(
            'user_fname' => $fname,
            'user_lname' => $lname,
            'address' => $street,
            'city' => $town,
            'state' => $district,
            'zip' => $zip,
            'country' => $country,
            'contact' => $contact);
        $this->db->where('user_email', $email);
        $this->db->update('user', $data);
    }

    function updateDetails($status, $pid, $trn) {
        //die($status.$pid.$trn);
        // die($pid);
        //die($trn);
        $data = array(
            'status' => $status
        );
        // $this->db->where('trans_id',$id);
        $this->db->where(array('trans_id' => $trn, 'p_id' => $pid));
        $this->db->update('product_oder_detail', $data);
    }

    function delProduct($id) {
        $query = $this->db->get_where('product', array('id' => $id));
        if ($query->num_rows() > 0) {
            $status = 1;
            $data = array(
                'status' => $status
            );
            $this->db->where('id', $id);
            $result = $this->db->update('product', $data);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function record_count_catproduct($name) {

        $this->db->where('category', $name);
        return $this->db->count_all("product");
    }

    function get_all_product_orderID($id) {
        $this->db->where('o_id', $id);
        $this->db->order_by('o_id', 'DESC');
        $query = $this->db->get('product_oder_detail');
        return $query->result();
    }

    function get_all_cateproduct($limit, $start, $cid) {
        $this->db->limit($limit, $start);
        $this->db->where('category', $cid);
        $this->db->order_by('id', 'DESC');
        $this->db->where('status = 0');
        $query = $this->db->get('product');
        return $query->result();
    }

    function get_all_products() {
        //$this->db->limit($limit, $start);
        $this->db->order_by('id', 'DESC');
        $this->db->where('status = 0');
        $query = $this->db->get('product');
        return $query->result();
    }

    function get_tran_id($id) {
        
    }

    //==========================   End Cart System               ====================================//

   
    public function get_identity($id) {
        // die($id);
        $this->db->where('menu_id', $id);
        $identity = $this->db->get('navigation');
        return $identity->result();
    }

    public function get_navigation_parent($menu_id_next) {
        $this->db->select('parent_id');
        $this->db->where('menu_id', $menu_id_next);
        $query = $this->db->get('navigation');
        return $query->result();
    }

    public function update_navigation($id, $navigationname, $navigationlink, $pid, $navigationtype, $navigationslug, $mid) {
        $this->load->database();
        $data = array(
            'navigation_name' => $navigationname,
            'navigation_link' => $navigationlink,
            'parent_id' => $pid,
            'navigation_type' => $navigationtype,
            'navigation_slug' => $navigationslug,
            'menu_id' => $mid);
        $this->db->where('id', $id);
        $this->db->update('navigation', $data);
    }

    public function add_new_navigation($navigationname, $navigationlink, $pid, $navigationtype, $navigationslug, $mid) {
        $this->load->database();
        $data = array(
            'navigation_name' => $navigationname,
            'navigation_link' => $navigationlink,
            'parent_id' => $pid,
            'navigation_type' => $navigationtype,
            'navigation_slug' => $navigationslug,
            'menu_id' => $mid);
        $this->db->insert('navigation', $data);
    }

    public function add_for_navigation($name) {
        $this->load->database();
        $data = array(
            'page_name' => $name);
        $this->db->insert('navigation', $data);
    }

    // =========================== menu =================//

   

    //============================================CAtegory==========================================================

   

    //======================================================================================================
    //========================================USER============================================================
    //===========================================================================================================
    //=========================================================================================================
    //====================================MEDIA================================================================
    //=========================================================================================================
   

    //==============================================================================================================
    //======================================ALBUM===================================================================
    //==============================================================================================================
   

// ==========================================Activities ----------------------------------------------------------

    public function record_count_activities() {
        return $this->db->count_all("page");
    }

    public function get_all_activities($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->where('type', 'event');
        $query = $this->db->get('page');
        return $query->result();
    }

    public function add_new_activities($title, $body, $image, $status, $type) {
        $data = Array(
            'title' => $title,
            'body' => $body,
            'image' => $image,
            'status' => $status,
            'type' => $type);
        $this->db->insert('page_event', $data);
    }

    public function findactivities($id) {
        $this->db->select('id, title, body, status, image');
        $this->db->from('page_event');
        $this->db->where('id = ' . "'" . $id . "'");
        $query = $this->db->get('');
        return $query->result();
    }

    public function deleteactivities($id) {
        $this->db->delete('page_event', array('id' => $id));
    }

    public function update_activities($id, $title, $body, $image, $status) {
        $this->load->database();

        if (!isset($image)) {
            $data = array(
                'title' => $title,
                'body' => $body,
                'status' => $status);
        } else {
            $data = array(
                'title' => $title,
                'body' => $body,
                'image' => $image,
                'status' => $status);
        }

        $this->db->where('id', $id);
        $this->db->update('page_event', $data);
    }

    //gadgets --------------------------------------------------------------------------------

    public function record_count_gadget() {
        return $this->db->count_all("media");
    }

    function get_gadgets() {
        //$this->db->limit($limit, $start);
        // $this->db->select('id, title, body, status');
        //$this->db->where('type','gadgets');
        $this->db->from('media');
        $query = $this->db->get();
        return $query->result();
    }

    function add_new_gadget($title, $body, $status, $type) {
        $data = Array(
            'type' => $type,
            'title' => $title,
            'body' => $body,
            'status' => $status);
        $this->db->insert('notice_gadget', $data);
    }

    function findgadget($id) {
        $this->db->select();
        $this->db->from('media');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function update_gadget($id, $title, $body, $status, $type) {
        $this->load->database();
        $data = array(
            'type' => $type,
            'title' => $title,
            'body' => $body,
            'status' => $status);
        $this->db->where('id', $id);
        $this->db->update('notice_gadget', $data);
    }

    function delete_gadget($id) {
        $this->db->delete('notice_gadget', array('id' => $id));
    }

    //===============================notice====================================//
    public function record_count_notice() {
        return $this->db->count_all("notice_gadget");
    }

    function get_all_notices($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->select('id, title, body, status');
        $this->db->where('type', 'notice');
        $this->db->from('notice_gadget');
        $query = $this->db->get();
        return $query->result();
    }

    function add_new_notices($title, $body, $status, $type) {
        $data = Array(
            'type' => $type,
            'title' => $title,
            'body' => $body,
            'status' => $status);
        $this->db->insert('notice_gadget', $data);
    }

    function findnotice($id) {
        $this->db->select('id, title, body, status');
        $this->db->from('notice_gadget');
        $this->db->where('id = ' . "'" . $id . "'");
        $query = $this->db->get();
        return $query->result();
    }

    //======================others 
    function get_documents() {
        $this->db->select();
        $this->db->from('download');
        //$this -> db -> where('did = ' . "'" . $gid . "'");
        $query = $this->db->get();
        return $query->result();
    }

    function upload_documents($name, $image, $status) {
        $data = Array(
            'title' => $name,
            'image' => $image,
            'status' => $status);
        $this->db->insert('download', $data);
    }

    function delete_document($id) {
        $this->db->delete('download', array('id' => $id));
    }

    function get_alumni() {
        // $this -> db -> select('eid, title, image');
        //$this -> db -> from('gallery');
        //$this -> db -> where('did = ' . "'" . $gid . "'");
        $query = $this->db->get('alumni');
        return $query->result();
    }

    function add_alumni($name, $batch, $p_address, $c_address, $qualification, $organization, $email, $phone, $status) {
        $this->load->database();
        $data = array(
            'name' => $name,
            'batch' => $batch,
            'p_address' => $p_address,
            'c_address' => $c_address,
            'qualification' => $qualification,
            'organization' => $organization,
            'email' => $email,
            'phone' => $phone,
            'status' => $status);
        $this->db->insert('alumni', $data);
    }

    function find_alumni($sid) {
        $this->db->select('sid, name, batch, p_address, c_address, qualification, organization, email,phone, status');

        //$this -> db -> from('gallery');
        $this->db->where('sid = ' . "'" . $sid . "'");
        $query = $this->db->get('alumni');
        return $query->result();
    }

    function update_alumni($sid, $name, $batch, $p_address, $c_address, $qualification, $organization, $email, $phone, $status) {
        $this->load->database();
        $data = array(
            'name' => $name,
            'batch' => $batch,
            'p_address' => $p_address,
            'c_address' => $c_address,
            'qualification' => $qualification,
            'organization' => $organization,
            'email' => $email,
            'phone' => $phone,
            'status' => $status);
        $this->db->where('sid', $sid);
        $this->db->update('alumni', $data);
    }

    function delete_alumni($sid) {
        $this->db->delete('alumni', array('sid' => $sid));
    }

    public function fetch_alumni($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("alumni");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    //========================================================================================================
   
    /* function get_blog() {
      $this->db->select('id, title, image, status, date');
      $this->db->from('blog');
      //$this -> db -> where('did = ' . "'" . $gid . "'");
      $query = $this->db->get();
      return $query->result();
      }

      function upload_blog($name, $image, $status) {
      $data = Array(
      'title' => $name,
      'image' => $image,
      'status' => $status);
      $this->db->insert('blog', $data);
      }
      function deleteblog($id) {
      $this->db->delete('blog', array('id' => $id));
      }

      navigation
     */

    public function get_list_by_parent_id($parent_id) {
        $this->db->where('id', $parent_id);
        $query = $this->db->get('navigation');
        return $query->result();
    }

    // for listing in navigation 
    public function get_subList($id) {
        $this->db->where('menu_id', $id);
        $query = $this->db->get('navigation');
        return $query->result();
    }

    function get_userKey($id) {
        $this->db->select('user_email');
        $this->db->where('user_auth_key', $id);
        $keys = $this->db->get('user');
        return $keys->result();
    }

    function user_key($email) {
        $file = " ";
        $data = array(
            'user_auth_key' => $file);
        $this->db->where('user_email', $email);
        $this->db->update('user', $data);
    }

    function addaanbieding() {
        $insert_data = array(
            'fotonaam' => $image_data['file_name']
        );
        print_r($insert_data);
        die;
        $input = $this->input->post('userfile');
        if (isset($input)) {
            $this->db->insert('fotoaanbiedingen', $insert_data);
        } else {
            return FALSE;
        }
    }

    public function add_ajax_user($name, $email, $pass) {
        $user_type = 1;
        $pass = md5($pass);
        $data = array(
            'user_name' => $name,
            'user_email' => $email,
            'user_pass' => $pass,
            'user_type' => $user_type);
        $this->db->insert('user', $data);
    }

    public function add_new_user_for($name, $email, $pass) {
        $user_type = 1;
        $user_pass = md5($pass);
        $data = array(
            'user_name' => $name,
            'user_email' => $email,
            'user_pass' => $user_pass,
            'user_type' => $user_type);
        $this->db->insert('user', $data);
    }

}