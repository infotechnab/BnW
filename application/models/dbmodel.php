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
    
    
    
    
   
        
        function get_media_image($aid)
        {
            $this->db->select();            
            $this->db->where('media_association_id',$aid);
            //$this->db->order_by('eid','DESC');
            $this->db->limit(1);
                    $query = $this->db->get('media');
           if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
        }
        
        //=========================================================================================================
        //=======================================NAVIGATION-=======================================================
        //==========================================================================================================
        
        public function record_count_navigation() {
        return $this->db->count_all("navigation");
    }
        
    public function get_navigation($limit,$start)
    {
        $this->db->limit($limit,$start);
        $query = $this->db->get('navigation');
        return $query->result();
    }
    
    function findnavigation($id) {
        $this->db->select();
        $this->db->where('id', $id);
        $query = $this->db->get('navigation');
        return $query->result();
    }    
    
     public function update_navigation($id, $navigationname, $navigationlink, $pid, $navigationtype, $navigationslug, $mid) {
        $this->load->database();
        $data = array(
            'navigation_name' => $navigationname,
            'navigation_link'=> $navigationlink,
            'parent_id'=> $pid,
            'navigation_type'=> $navigationtype,
            'navigation_slug'=> $navigationslug,
            'menu_id'=> $mid);
        $this->db->where('id', $id);
        $this->db->update('navigation', $data);
    }    
    public function add_new_navigation($navigationname, $navigationlink, $pid, $navigationtype, $navigationslug, $mid)
    {   $this->load->database();        
        $data = array(
            
            'navigation_name' => $navigationname,
            'navigation_link'=> $navigationlink,
            'parent_id'=> $pid,
            'navigation_type'=> $navigationtype,
            'navigation_slug'=> $navigationslug,
            'menu_id'=> $mid);
         $this->db->insert('navigation', $data);        
    }
    public function add_for_navigation($name){
            $this->load->database();
    $data = array(
        'page_name'=> $name);
    $this->db->insert('navigation', $data);
}

        
      // =========================== menu =================//
    
     public function record_count_menu() {
        return $this->db->count_all("menu");
    }
        
    public function get_menu($limit,$start)
    {
        $this->db->limit($limit,$start);
        $query = $this->db->get('menu');
        return $query->result();
    }
    
     public function get_list_of_menu()
    {
        $query = $this->db->get('menu');
        return $query->result();
        
    }
    
     public function get_page_author_id($username)
    {
         $this->db->select('id');
        $this->db->where('user_name', $username);
        $query = $this->db->get('user');
          return $query->result();
    }

    function findmenu($mid) {
        $this->db->select();
        $this->db->where('id', $mid);
        $query = $this->db->get('menu');
        return $query->result();
    }    
    
     public function update_menu($mid, $menuname) {
        $this->load->database();
        $data = array(
            'id'=>$mid,
            'menu_name' => $menuname);
        $this->db->where('id', $mid);
        $this->db->update('menu', $data);
    }    
    public function add_new_menu($mid, $menuname )
    {   $this->load->database();        
        $data = array(
            'id'=>$mid,
            'menu_name'=> $menuname);
         $this->db->insert('menu', $data);        
    }
  public function delete_menu($mid) {

        $this->db->delete('menu', array('id' => $mid));
    }
    
    
    //============================================CAtegory==========================================================
        public function record_count_category() {
        return $this->db->count_all("category");
    }
    
    public function get_all_category($limit, $start) {
           $this->db->limit($limit, $start); 
       // $this->db->where('type','page');
        $query = $this->db->get('category');
        return $query->result();
    }
    public function get_category() {
            
        //$this->db->where('type','page');
        $query = $this->db->get('category');
        return $query->result();
    } 
     public function get_list_of_category()
    {
        $query = $this->db->get('category');
        return $query->result();
        
    }
    public function get_category_parent_id($data)
    {
         $this->db->select('id');
        $this->db->where('category_name', $data);
        $query = $this->db->get('category');
          return $query->result();
    }
    
    public function add_new_category($categoryname) {
        $data = Array(
            'category_name' => $categoryname);
           
        $this->db->insert('category', $data);
    }
    
    public function add_new_navigation_item($navigation_name, $navigation_link, $parent_id, $navigation_type, $naviation_slug, $menu_id)
    {
        $navigationData = Array('navigation_name'=>$navigation_name,
                                'navigation_link'=>$navigation_link,
                                'parent_id'=>$parent_id,
                                'navigation_type'=>$navigation_type,
                                'navigation_slug'=>$naviation_slug,
                                'menu_id'=>$menu_id
            );
         $this->db->insert('navigation', $navigationData);
    }
    
    public function get_page_parent_id($data)
    {
         $this->db->select('id');
       
        $this->db->where('page_name', $data);
        $query = $this->db->get('page');
          return $query->result();
    }
    
    public function get_menu_info($menuSelected)
    {
        $this->db->select('id');
       
        $this->db->where('menu_name', $menuSelected);
        $query = $this->db->get('menu');
          return $query->result();
        
    }

        public function findcategory($id) {
        $this->db->select();
        $this->db->from('category');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function find_category_id($categoryname)
    {   
        
        $this->db->select('id');
        $this->db->where('category_name',$categoryname);
        $this->db->limit(1);
        $this->db->order_by('id','DESC');
        $page = $this->db->get('category');
        return $page->result();
    }
    public function update_category($id, $categoryname){
          
           $data = array
                (
                'category_name' => $categoryname);  
        
        $this->db->where('id', $id);
        $this->db->update('category', $data);
    }

    public function delete_category($id) {

        $this->db->delete('category', array('id' => $id));
    }
    
   /* public function delete_page_image($id)
    {
            $data = Array(
            'image' => ""
           );
        
            $this->db->where('id', $id);
            
            $this->db->update('page',$data);
    }*/
       
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
    public function get_list_of_pages()
    {
         $query = $this->db->get('page');
        return $query->result();
    }
    
   public function get_pages() {
            
        //$this->db->where('type','page');
        $query = $this->db->get('page');
        return $query->result();
    }

    public function add_new_page($name, $body,$page_author_id, $summary, $status, $order, $type, $tags) {
        $pagedata = Array(
            'page_name' => $name,
            'page_content' => $body,
            'page_author_id'=>$page_author_id,
            'page_summary' => $summary,
            'page_status' => $status,
            'page_order'=> $order,
            'page_type'=>$type,
          'page_tags'=>$tags);
        $this->db->insert('page', $pagedata);
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
    public function update_page($id, $name,$page_author_id, $body, $summary, $status, $order, $type, $tags){
          
           $pagedata = array
                (
                'page_name' => $name,
                'page_content' => $body,
               'page_author_id'=>$page_author_id,
                'page_summary' => $summary,
                'page_status' => $status,
                'page_order' => $order,
                'page_type' => $type,
                'page_tags' => $tags);  
        
        $this->db->where('id', $id);
        $this->db->update('page', $pagedata);
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
    //========================================USER============================================================
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
    
    
    //=========================================================================================================
    //====================================MEDIA================================================================
    //=========================================================================================================
   public function record_count_media() {
        return $this->db->count_all("media");
    }
     public function get_all_media() {
           //$this->db->limit($limit, $start); 
        $query = $this->db->get('media');
        return $query->result();
    }
       
     public function get_media()
    {  
        $query = $this->db->get('media');
        return $query->result();  
       
       if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
        
    }
    
    
    function findmedia($id) {
        $this->db->select();

       $this -> db -> from('media');
        $this->db->where('id', $id );
        $query = $this->db->get();
        return $query->result();
    }    
    
     public function update_media($id, $medianame, $mediatype, $aid, $medialink) {
       
        $data = array(
            'media_name'=>$medianame,
            'media_type'=> $mediatype,
            'media_association_id'=> $aid,
            'media_link'=> $medialink);
        $this->db->where('id', $id);
        $this->db->update('media', $data);
    }    
    public function add_new_media( $medianame, $mediatype, $aid, $medialink)
    {   
                
        $data = array(
            'media_name'=>$medianame,
            'media_type'=> $mediatype,
            'media_association_id'=> $aid,
            'media_link'=> $medialink);
         $this->db->insert('media', $data);        
    }
    
      public function delete_media($id) {

        $this->db->delete('media', array('id' => $id));
    }
    
    //==============================================================================================================
    //======================================ALBUM===================================================================
    //==============================================================================================================
   
    
     public function get_album()
    {
        $query = $this->db->get('album');
        return $query->result();
    }
    
    public function add_album($name)
    {
        $data = Array(
            
            'album_name' => $name);
        $this->db->insert('album', $data);
           
    }
        
    public function add_new_album($name){
            $data = array (
           'album_name'=> $name);
    $this ->db->insert('album', $data);
    }
    

     function delete_album($aid) {
        $this->db->delete('album', array('id' => $aid));
    } 
    
    function edit_album($aid) {
        $this->db->delete('album', array('id' => $aid));
    } 
    
    function get_all_photos($id) {
        $this->db->select();
        $this->db->from('media');
       $this -> db -> where('id', $aid);
        $query = $this->db->get();
        return $query->result();
    }

    function add_new_photo($medianame, $mediatype, $aid, $medialink) {
        $data = Array(
            'media_name' => $medianame,
            'media_type' => $mediatype,
            'media_association_id'=> $aid,
            'media_link'=> $medialink);
        
        $this->db->insert('media', $data);
    }
    
    function get_aid($id)
    {
         $this->db->select();
        $this->db->where('id',$id);
        $this->db->from('media');
        $aid = $this->db->get();
         return $aid->result();
    }

    function delete_photo($id) {
       
        $this->db->delete('media', array('id' => $id));
        
    }

// ==========================================Activities ----------------------------------------------------------
   
    public function record_count_activities() {
        return $this->db->count_all("page");
    }
    
    public function get_all_activities($limit,$start) {
        $this->db->limit($limit, $start);
        $this->db->where('type','event');
        $query = $this->db->get('page');
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
    //======================================SLIDER===========================================================
    //=======================================================================================================
     public function record_count_slider() {
        return $this->db->count_all("slide");
    }
    
    public function get_slider($limit,$start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get('slide');
        return $query->result();
    }
    
    public function add_new_slider($slidename,$slideimage,$slidecontent)
                    {
       // $this->load->database();
        $data = array(
            'slide_name' => $slidename,
            'slide_image' => $slideimage,
            'slide_content' => $slidecontent);
        $this->db->insert('slide', $data);
    }
    
    function findslider($id) {
        $this->db->select();
         $this->db->from('slide');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }
        
     public function update_slider($id, $slidename,$slideimage,$slidecontent) {
        $this->load->database();
        $data = array(
            'slide_name' => $slidename,
            'slide_image' => $slideimage,
            'slide_content' => $slidecontent);
        $this->db->where('id', $id);
        $this->db->update('slide', $data);
    }
    
    function delete_slider($id) {
        $this->db->delete('slide', array('id' => $id));
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
    
    //navigation
    public function get_list_by_parent_id($parent_id)
    {
         $this->db->where('id', $parent_id);
        $query = $this->db->get('navigation');
        return $query->result();
    }
    
    
    }