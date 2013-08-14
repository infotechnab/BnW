<?php

class Dbmodel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // This model is to user verified 
    function validate() {
        $this->db->where('login', $this->input->post('username'));
        $this->db->where('passwd', md5($this->input->post('password')));
        $query = $this->db->get('members');

        if ($query->num_rows == 1) {
            return true;
        } else {
            return FALSE;
        }
    }

    // this is another method to get user verified 
    function login($username, $password) {
        $this->db->select('member_id, login, passwd');
        $this->db->from('members');
        $this->db->where('login = ' . "'" . $username . "'");
        $this->db->where('passwd = ' . "'" . MD5($password) . "'");
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
    public function get_all_pages() {
        $query = $this->db->get('pages');
        return $query->result();
    }

    public function add_new_page($title, $body, $image, $status) {
        $data = Array(
            'title' => $title,
            'body' => $body,
            'image' => $image,
            'status' => $status);
        $this->db->insert('pages', $data);
    }

    public function findpage($pid) {
        $this->db->select('pid, title, body, image, status');
        $this->db->from('pages');
        $this->db->where('pid = ' . "'" . $pid . "'");
        $query = $this->db->get();
        return $query->result();
    }

    public function update_page($pid, $title, $body, $image, $status) {
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
            'image'=> $image,
            'status' => $status);
        }
        
        $this->db->where('pid', $pid);
        $this->db->update('pages', $data);
    }

    public function delete_page($pid) {

        $this->db->delete('pages', array('pid' => $pid));
    }
    
    public function delete_page_image($pid)
    {
            $data = Array(
            'image' => ""
           );
        
            $this->db->where('pid', $pid);
            
            $this->db->update('pages',$data);
    }

    
// Activities ----------------------------------------------------------
    public function get_all_activities() {
        $query = $this->db->get('activities');
        return $query->result();
    }

    public function add_new_activities($title, $body, $image, $status) {
        $data = Array(
            'title' => $title,
            'body' => $body,
            'image' => $image,
            'status' => $status);
        $this->db->insert('activities', $data);
    }

    public function findactivities($aid) {
        $this->db->select('aid, title, body, status, image');
        $this->db->from('activities');
        $this->db->where('aid = ' . "'" . $aid . "'");
        $query = $this->db->get('');
        return $query->result();
    }

    public function deleteactivities($aid) {
        $this->db->delete('activities', array('aid' => $aid));
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

        $this->db->where('aid', $id);
        $this->db->update('activities', $data);
    }

    //gadgets --------------------------------------------------------------------------------
    function get_gadgets() {
        $this->db->select('gid, title, body, status');
        $this->db->from('gadget');
        $query = $this->db->get();
        return $query->result();
    }

    function add_new_gadget($title, $body, $status) {
        $data = Array(
            'title' => $title,
            'body' => $body,
            'status' => $status);
        $this->db->insert('gadget', $data);
    }

    function findgadget($gid) {
        $this->db->select('gid, title, body, status');
        $this->db->from('gadget');
        $this->db->where('gid = ' . "'" . $gid . "'");
        $query = $this->db->get();
        return $query->result();
    }

    function update_gadget($id, $title, $body, $status) {
        $this->load->database();
        $data = array(
            'title' => $title,
            'body' => $body,
            'status' => $status);
        $this->db->where('gid', $id);
        $this->db->update('gadget', $data);
    }

    function delete_gadget($gid) {
        $this->db->delete('gadget', array('gid' => $gid));
    }
    
    //metadata  --------------------------------------------------------------------------------

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
    



    //others 
    function get_documents() {
        $this->db->select('did, title, image, status, date');
        $this->db->from('downloads');
        //$this -> db -> where('did = ' . "'" . $gid . "'");
        $query = $this->db->get();
        return $query->result();
    }

    function upload_documents($name, $image, $status) {
        $data = Array(
            'title' => $name,
            'image' => $image,
            'status' => $status);
        $this->db->insert('downloads', $data);
    }

    function delete_document($did) {
        $this->db->delete('downloads', array('did' => $did));
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

    public function record_count() {
        return $this->db->count_all("alumni");
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
    
    public function get_slider()
    {
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
    
    

}