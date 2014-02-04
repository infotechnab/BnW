<?php

class Dbmodel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // This model is to user verified 
    function validate() {
        $this->db->where('user_name', $this->input->post('username'));
        $this->db->where('user_pass', md5($this->input->post('password')));
        $query = $this->db->get('user');

        if ($query->num_rows == 1) {
            return true;
        } else {
            return FALSE;
        }
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
    
    
     public function get_album()
    {
        $query = $this->db->get('album');
        return $query->result();
    }
    
    public function add_album($name)
    {
        $data = Array(
            'a_name' => $name);
        $this->db->insert('album', $data);
           
    }
    
     public function delete_album($aid) {

        
        $this->db->delete('album', array('aid' => $aid));
    }
    
    public function get_gallery($aid)
    {  
        $this->db->where('aid',$aid);
        $query = $this->db->get('gallery');
        return $query->result();  
       
       if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
        
    }
        
        function get_gallery_image($aid)
        {
            $this->db->select('image');            
            $this->db->where('aid',$aid);
            $this->db->order_by('eid','DESC');
            $this->db->limit(1);
                    $query = $this->db->get('gallery');
           if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
        }
         public function delete_gallery($eid) {

        
        $this->db->delete('gallery', array('eid' => $eid));
    }
    
    
       
//pages -----------------------------------------------
    public function record_count_page() {
        return $this->db->count_all("page");
    }
    
    public function get_all_pages($limit, $start) {
           $this->db->limit($limit, $start); 
       // $this->db->where('type','page');
        $query = $this->db->get('page');
        return $query->result();
    }
    public function get_pages() {
            
        //$this->db->where('type','page');
        $query = $this->db->get('page');
        return $query->result();
    }

    public function add_new_page($name, $body, $summary, $status, $order, $type, $tags) {
        $data = Array(
            'page_name' => $name,
            'page_content' => $body,
            'page_summary' => $summary,
            'page_status' => $status,
            'page_order'=> $order,
            'page_type'=>$type,
          'page_tags'=>$tags);
        $this->db->insert('page', $data);
    }

    public function findpage($id) {
        $this->db->select();
        $this->db->from('page');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function find_page_id($name)
    {   
        
        $this->db->select('id');
        $this->db->where('page_name',$name);
        $this->db->limit(1);
        $this->db->order_by('id','DESC');
        $page = $this->db->get('page');
        return $page->result();
    }
    public function update_page($id, $name, $body, $summary, $status, $order, $type, $tags){
          
           $data = array
                (
                'page_name' => $name,
                'page_content' => $body,
                'page_summary' => $summary,
                'page_status' => $status,
                'page_order' => $order,
                'page_type' => $type,
                'page_tags' => $tags);  
        
        $this->db->where('id', $id);
        $this->db->update('page', $data);
    }

    public function delete_page($id) {

        $this->db->delete('page', array('id' => $id));
    }
    
    public function delete_page_image($id)
    {
            $data = Array(
            'image' => ""
           );
        
            $this->db->where('id', $id);
            
            $this->db->update('page',$data);
    }

   //======================================================================================================
    //========================================user============================================================
    //===========================================================================================================
    
      public function record_count_user() {
        return $this->db->count_all("user");
    }
     public function get_all_user() {
           //$this->db->limit($limit, $start); 
        $query = $this->db->get('user');
        return $query->result();
    }
    public function get_user() {
        $query = $this->db->get('user');
        return $query->result();
    }
    
    
    
    
    function finduser($id) {
        $this->db->select();

       $this -> db -> from('user');
        $this->db->where('id', $id );
        $query = $this->db->get();
        return $query->result();
    }    
    
     public function update_user($id,$name, $fname, $lname, $email, $pass, $status) {
       
        $data = array(
            'user_name'=>$name,
            'user_fname'=> $fname,
            'user_lname'=> $lname,
            'user_email'=> $email,
            'user_pass'=> $pass,
            'user_status'=> $status);
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }    
    public function add_new_user($name, $fname, $lname, $email, $pass, $status)
    {   
                
        $data = array(
            'user_name'=>$name,
            'user_fname'=> $fname,
            'user_lname'=> $lname,
            'user_email'=> $email,
            'user_pass'=> $pass,
            'user_status'=> $status  );
         $this->db->insert('user', $data);        
    }
    
      public function delete_user($id) {

        $this->db->delete('user', array('id' => $id));
    }
    
// ==========================================Activities ----------------------------------------------------------
   
    public function record_count_activities() {
        return $this->db->count_all("page_event");
    }
    
    public function get_all_activities($limit,$start) {
        $this->db->limit($limit, $start);
        $this->db->where('type','event');
        $query = $this->db->get('page_event');
        return $query->result();
    }

    public function add_new_activities($title, $body, $image, $status,$type) {
        $data = Array(
            'title' => $title,
            'body' => $body,
            'image' => $image,
            'status' => $status,
            'type'=>$type);
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
        return $this->db->count_all("page_event");
    } 
    function get_gadgets($limit,$start) {
        $this->db->limit($limit, $start);
        $this->db->select('id, title, body, status');
        $this->db->where('type','gadgets');
        $this->db->from('notice_gadget');
        $query = $this->db->get();
        return $query->result();
    }

    function add_new_gadget($title, $body, $status,$type) {
        $data = Array(
            'type'=>$type,
            'title' => $title,
            'body' => $body,
            'status' => $status);
        $this->db->insert('notice_gadget', $data);
    }

    function findgadget($id) {
        $this->db->select('id, title, body, status');
        $this->db->from('notice_gadget');
        $this->db->where('id = ' . "'" . $id . "'");
        $query = $this->db->get();
        return $query->result();
    }

    function update_gadget($id, $title, $body, $status,$type) {
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
        $this->db->where('type','notice');
        $this->db->from('notice_gadget');
        $query = $this->db->get();
        return $query->result();
    }
    function add_new_notices($title, $body, $status,$type) {
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
    
    //=============================metadata  --------------------------------------------------------------------------------

    function get_meta_data()
    {
                $this->db->from('meta_data');
                $query = $this->db->get();
                return $query->result();
    }
    
    function update_meta_data($url, $title, $keyword, $description)
    {
        $data = Array( array('value'=>$url), array('value'=>$title), array('value'=>$keyword), array('value'=>$description));
        $i= 1;
              
        foreach ($data as $value)
        {
          
            $this->db->where('id',$i);
            $this->db->update('meta_data', $value);        
            $i++;
        }
    }
    



    //======================others 
    function get_documents() {
        $this->db->select('id, title, image, status, date');
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

    function get_all_photos() {
        $this->db->select('eid, title, image');
        $this->db->from('gallery');
        //$this -> db -> where('did = ' . "'" . $gid . "'");
        $query = $this->db->get();
        return $query->result();
    }

    function add_new_photo($name, $image,$aid) {
        $data = Array(
            'title' => $name,
            'image' => $image,
            'aid'=> $aid);
        
        $this->db->insert('gallery', $data);
    }
    
    function get_aid($id)
    {
         $this->db->select('aid');
        $this->db->where('eid',$id);
        $this->db->from('gallery');
        $aid = $this->db->get();
         return $aid->result();
    }

    function delete_photo($id) {
       
        $this->db->delete('gallery', array('eid' => $id));
        
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
    
     public function record_count_slider() {
        return $this->db->count_all("slider");
    }
    
    public function get_slider($limit,$start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get('slider');
        return $query->result();
    }
    
    public function add_new_slider($name,$image)
                    {
        $this->load->database();
        $data = array(
            'title' => $name,
            'image' => $image);
        $this->db->insert('slider', $data);
    }
    
    function findslider($sid) {
        $this->db->select('sid,image,title');

        //$this -> db -> from('gallery');
        $this->db->where('sid = ' . "'" . $sid . "'");
        $query = $this->db->get('slider');
        return $query->result();
    }
        
     public function update_slider($sid, $title,$image) {
        $this->load->database();
        $data = array(
            'title' => $title,
            'image'=> $image);
        $this->db->where('sid', $sid);
        $this->db->update('slider', $data);
    }
    
    function delete_slider($sid) {
        $this->db->delete('slider', array('sid' => $sid));
    }
    
    
    // =========================== menu =================//
    
     public function record_count_menu() {
        return $this->db->count_all("page");
    }
        
    public function get_menu($limit,$start)
    {
        $this->db->limit($limit,$start);
        $query = $this->db->get('menu');
        return $query->result();
    }
    
    
    
    
    function findmenu($id) {
        $this->db->select('id,title,parmalink,listing,order,link');

        //$this -> db -> from('menu');
        $this->db->where('id = ' . "'" . $id . "'");
        $query = $this->db->get('menu');
        return $query->result();
    }    
    
     public function update_menu($id,$title,$parmalink,$listing,$order,$link) {
        $this->load->database();
        $data = array(
            'title' => $title,
            'parmalink'=> $parmalink,
            'listing'=> $listing,
            'order'=> $order,
            'link'=> $link);
        $this->db->where('id', $id);
        $this->db->update('menu', $data);
    }    
    public function add_new_menu($tital,$listing, $order , $id )
    {   $this->load->database();        
        $data = array(
            'p_id'=>$id,
            'title'=> $tital,
            
            'listing' => $listing,
            'order'=> $order  );
         $this->db->insert('menu', $data);        
    }
    
    function get_blog() {
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
    }