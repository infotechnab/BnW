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
     function check_user($id)
    {
           // die('dsfgsdfg'.$id);
        $this->db->select('user_name');
        $this->db->where('id', $id);
        $userKey = $this->db->get('user');
        return $userKey->result();
    }
    public function add_new_comment($comment, $comment_association_id, $user_name)
    {
        $data = array(
            'comment' => $comment,
            'comment_association_id'=> $comment_association_id,
            'comment_user_name'=>$user_name);
            
         $this->db->insert('comment_store', $data);
    }








    function get_media_image($aid)
        {
            $this->db->select();            
            $this->db->where('media_association_id',$aid);
            
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
    
   
        public function get_identity($id)
    {
       // die($id);
        $this->db->where('menu_id',$id);
        $identity = $this->db->get('navigation');
        return $identity->result();
    }
    
    public function get_list_of_selected_menu_navigation($id){
        $this->db->where('menu_id',$id);
        $query = $this->db->get('navigation');
        return $query->result();
    }

    

    public function get_list_of_navigation()
    {
        
        $query = $this->db->get('navigation');
        return $query->result();
    }
     public function get_list_of_navigationID()
    {
        $id = 1;
        $this->db->where('menu_id',$id);
        $query = $this->db->get('navigation');
        return $query->result();
    }
    
    public function get_navigation_parent($menu_id_next){
        $this->db->select('parent_id');
        $this->db->where('menu_id', $menu_id_next);
        $query = $this->db->get('navigation');
        return $query->result();
    }

    

    public function add_new_custom_link($navigationName, $navigationLink, $parentID, $navigationType, $navigation_slug, $menu_id)
    {      
        $data = array(
            'navigation_name' => $navigationName,
            'navigation_link'=> $navigationLink,
            'parent_id'=> $parentID,
            'navigation_type'=> $navigationType,
            'navigation_slug'=> $navigation_slug,
            'menu_id'=> $menu_id);
        
         $this->db->insert('navigation', $data);
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
    public function update_edited_navigation($id, $navigationname) {
        $this->load->database();
        $data = array(
        'navigation_name' => $navigationname);   
        $this->db->where('id', $id);
        $this->db->update('navigation', $data);
    } 
    
    public function update_navigation_on_page_update($pageid,$navigationName,$navigationLink,$navigationSlug){
        $this->load->database();
        $data = array(
            'navigation_name' => $navigationName,
            'navigation_link'=> $navigationLink,            
            'navigation_slug'=> $navigationSlug);
        $this->db->where('navigation_link', 'page/'.$pageid);
        $this->db->update('navigation', $data);
    }
    public function delete_navigation_related_to_page($id)
    {

        $this->db->delete('navigation', array('navigation_link' => 'page/'.$id));
    }

    function delnavigation($id){
        $this->db->delete('navigation', array('id' => $id));
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

public function get_navigation_info($navigationName)
    {
         $this->db->select('id');
        $this->db->where('navigation_name', $navigationName);
        $query = $this->db->get('navigation');
          return $query->result();
    }
//=============================POST===============================================================================//
    public function record_count_post() {
        return $this->db->count_all("post");
    }
    public function get_posts() {
        $query = $this->db->get('post');
        return $query->result();
    }

      public function get_post_category_info($categoryName)
    {
         $this->db->select('id');
        $this->db->where('category_name', $categoryName);
        $query = $this->db->get('category');
          return $query->result();
    }
    
     public function get_post_author_id($username)
    {
         $this->db->select('id');
        $this->db->where('user_name', $username);
        $query = $this->db->get('user');
          return $query->result();
    }
    
     public function get_all_posts($limit, $start) {
           $this->db->limit($limit, $start);
            $this->db->order_by('id','DESC');
        $query = $this->db->get('post');
        return $query->result();
    }
    
    public function findpost($id) {
        $this->db->select();
        $this->db->from('post');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    
     public function deletepost($id) {

        $this->db->delete('post', array('id' => $id));
    }
    
    public function add_new_post($post_title, $post_content, $post_author_id, $post_summary, $post_status, $post_comment_status, $post_tags, $post_category_id, $allow_comment, $allow_like, $allow_share)
        {
        $this->load->database();        
        $data = array(
            
            'post_title' => $post_title,
            'post_content'=> $post_content,
            'post_author_id'=> $post_author_id,
            'post_summary'=> $post_summary,
            'post_status'=> $post_status,
            'comment_status'=> $post_comment_status,
            'post_tags'=>$post_tags,
            'post_category'=>$post_category_id,
            'allow_comment'=>$allow_comment,
            'allow_like'=>$allow_like,
            'allow_share'=>$allow_share);
         $this->db->insert('post', $data);
    }
   
    public function update_post($id, $post_title, $post_content, $post_author_id, $post_summary, $post_status, $post_comment_status, $post_tags, $post_category_id, $allow_comment, $allow_like, $allow_share)
    {
        $this->load->database(); 
        $data = array
                (
            'post_title' => $post_title,
            'post_content'=> $post_content,
            'post_author_id'=> $post_author_id,
            'post_summary'=> $post_summary,
            'post_status'=> $post_status,
            'comment_status'=> $post_comment_status,
            'post_tags'=>$post_tags,
            'post_category'=>$post_category_id,
            'allow_comment'=>$allow_comment,
            'allow_like'=>$allow_like,
            'allow_share'=>$allow_share);
        $this->db->where('id', $id);
        $this->db->update('post', $data);
    }

    // =========================== menu =================//
    
     public function record_count_menu() {
        return $this->db->count_all("menu");
    }
        
    public function get_menu()
    {
        
        $query = $this->db->get('menu');
        return $query->result();
    }
    
    public function get_menulist(){
        
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

    function findmenu($id) {
        $this->db->select();
        $this->db->where('id', $id);
        $query = $this->db->get('menu');
        return $query->result();
    }    
    
     public function update_menu($id, $menuname) {
        $this->load->database();
        $data = array(            
            'menu_name' => $menuname);
        $this->db->where('id', $id);
        $this->db->update('menu', $data);
    }    
    public function add_new_menu($menuname )
    {   $this->load->database();        
        $data = array(
            
            'menu_name'=> $menuname);
         $this->db->insert('menu', $data);        
    }
  public function delete_menu($id) {

        $this->db->delete('menu', array('id' => $id));
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
    
    public function add_new_navigation_item($navigation_name, $navigation_link, $parent_id, $navigation_type, $navigation_slug, $menu_id)
    {
        $data = Array('navigation_name'=>$navigation_name,
                                'navigation_link'=>$navigation_link,
                                'parent_id'=>$parent_id,
                                'navigation_type'=>$navigation_type,
                                'navigation_slug'=>$navigation_slug,
                                'menu_id'=>$menu_id
            );
         $this->db->insert('navigation', $data);
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
        //die($menuSelected);
       
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
    
       
//pages -----------------------------------------------
    public function record_count_page() {
        return $this->db->count_all("page");
    }
    
    public function get_all_pages($limit, $start) {
           $this->db->limit($limit, $start); 
        $this->db->order_by('id','DESC');
        $query = $this->db->get('page');
        return $query->result();
    }
    public function get_list_of_pages()
    {
         $query = $this->db->get('page');
        return $query->result();
    }

    
   public function get_pages() {
            
        
        $query = $this->db->get('page');
        return $query->result();
    }

    public function add_new_page($name, $body,$page_author_id, $summary, $status, $order, $type, $tags, $allow_comment, $allow_like, $allow_share) {
        $data = Array(
            'page_name' => $name,
            'page_content' => $body,
            'page_author_id'=>$page_author_id,
            'page_summary' => $summary,
            'page_status' => $status,
            'page_order'=> $order,
            'page_type'=>$type,
          'page_tags'=>$tags,
            'allow_comment'=>$allow_comment,
            'allow_like'=>$allow_like,
            'allow_share'=>$allow_share);
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
    public function update_page($id, $name, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allow_comment, $allow_like, $allow_share){
          
           $data = array
                (               
                'page_name' => $name,
                'page_content' => $body,
               'page_author_id'=>$page_author_id,
                'page_summary' => $summary,
                'page_status' => $status,
                'page_order' => $order,
                'page_type' => $type,
                'page_tags' => $tags, 
                'allow_comment'=>$allow_comment,
                'allow_like'=>$allow_like,
                'allow_share'=>$allow_share);
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
    
    public function get_selected_user($useremail){
       $this->db->where('user_email', $useremail );
        $query = $this->db->get('user');
        return $query->result();
    }
    public function update_emailed_user($to, $token){
        $data = array(
            'user_auth_key'=>$token);
        $this->db->where('user_email', $to);
        $this->db->update('user', $data);
    }
    public function update_user_password($token, $userPassword){
        $data = array(
            'user_pass'=> md5($userPassword));
        $this->db->where('user_auth_key', $token);
        $this->db->update('user', $data);
    }

    public function get_user() {
        $query = $this->db->get('user');
        return $query->result();
    }
    public function get_user_info($username){
        $this->db->select();

       $this -> db -> from('user');
       $this->db->where('user_name', $username );
        $query = $this->db->get();
        return $query->result();
    }

    function finduser($id) {
        $this->db->select();

       $this -> db -> from('user');
        $this->db->where('id', $id );
        $query = $this->db->get();
        return $query->result();
    }  
    
    function find_user_auth_key($token) {       
        $this->db->where('user_auth_key', $token );
        $query = $this->db->get('user');
        return $query->result();
    }  
    
    function find_user($email) {
        $this->db->select();

       $this -> db -> from('user');
        $this->db->where('user_email', $email );
        $query = $this->db->get();
        return $query->result();
    }  
    
     public function update_user($id,$name, $fname, $lname, $email, $pass, $status, $user_type) {
       
        $data = array(
            'user_name'=>$name,
            'user_fname'=> $fname,
            'user_lname'=> $lname,
            'user_email'=> $email,
            'user_pass'=> $pass,
            'user_status'=> $status,
            'user_type'=> $user_type);
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }    
    public function add_new_user($name, $fname, $lname, $email, $pass, $status, $user_type)
    {   
                
        $data = array(
            'user_name'=>$name,
            'user_fname'=> $fname,
            'user_lname'=> $lname,
            'user_email'=> $email,
            'user_pass'=> $pass,
            'user_status'=> $status,
            'user_type'=> $user_type );
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
          $this->db->order_by('id','DESC');
        $query = $this->db->get('media');
        return $query->result();
    }
    
   
     public function get_media($id)
    {  
       $this->db-> from('media');
       $this->db->where('media_association_id',$id);
       $query = $this->db->get();
       
        return $query->result();  
    }
    public function get_photo_media_id($photoid)
    {  
       
       $this -> db -> from('media');
       $this->db->where('id',$photoid);
       $query = $this->db->get();
       
        return $query->result();  
    }
    
    
    function findmedia($id) {
        $this->db->select();

       $this -> db -> from('media');
        $this->db->where('id', $id );
        $query = $this->db->get();
        return $query->result();
    }    
    
     public function update_media($id, $medianame, $mediatype, $media_association_id, $medialink) {
       
        $data = array(
            'media_name'=>$medianame,
            'media_type'=> $mediatype,
            'media_association_id'=> $media_association_id,
            'media_link'=> $medialink);
        $this->db->where('id', $id);
        $this->db->update('media', $data);
    }    
    public function add_new_media( $medianame, $mediatype, $media_association_id, $medialink)
    {   
                
        $data = array(
            'media_name'=>$medianame,
            'media_type'=> $mediatype,
            'media_association_id'=> $media_association_id,
            'media_link'=> $medialink);
         $this->db->insert('media', $data);        
    }
    
      public function delete_media($id) {

        $this->db->delete('media', array('media_type' => $id));
    }
    
     public function get_media_association_info($mediaName)
    {
        $this->db->select('id');
        $this->db->where('album_name', $mediaName);
        $query = $this->db->get('album');
          return $query->result();
    }
    
     public function get_list_of_album()
    {
        $query = $this->db->get('album');
        return $query->result();
    }
    
    //==============================================================================================================
    //======================================ALBUM===================================================================
    //==============================================================================================================
    public function record_count_album() {
        return $this->db->count_all("album");
    }
    
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
    

     function delete_album($id) { 
        $this->db->delete('media', array('media_association_id' => $id));
        $this->db->delete('album', array('id' => $id));
    } 
    
    function edit_album($aid) {
        $this->db->delete('album', array('id' => $aid));
    } 
    
    function get_all_photos($id) {
        $this->db->select('media_type');
        $this->db->from('media');
       $this -> db -> where('media_association_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_selected_album($id){
        $this->db->from('album');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function add_new_photo($medianame, $mediatype, $albumid, $medialink) {
        $data = Array(
            
            'media_name' => $medianame,
            'media_type' => $mediatype,
            'media_association_id'=> $albumid,
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

    function delete_photo($a) {
       
        $this->db->delete('media', array('media_type' => $a));  
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

    function add_new_gadget($title, $body, $status,$type) {
        $data = Array(
            'type'=>$type,
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
    
   //=====================================design_setup========================================================//
    public function get_design_setup()
    {
                $this->db->from('design_setup');
                $query = $this->db->get();
                return $query->result();
    }
    
    function update_design_header_setup($headerTitle, $headerLogo, $headerDescription, $headerBgColor)
    {
        $data = Array( array('description'=>$headerTitle), array('description'=>$headerLogo), array('description'=>$headerDescription), array('description'=>$headerBgColor));
        $i= 0;
              
        foreach ($data as $value)
        {
          
            $this->db->where('id', $i);
            $this->db->update('design_setup', $value);        
            $i++;
        }
    }

    function update_design_sidebar_setup($sideBarTitle, $sideBarDescription, $sideBarBgColor)
    {
        $data = Array( array('description'=>$sideBarTitle), array('description'=>$sideBarDescription), array('description'=>$sideBarBgColor));
        $i= 4;
              
        foreach ($data as $value)
        {
          
            $this->db->where('id', $i);
            $this->db->update('design_setup', $value);        
            $i++;
        }
    }
    
    //======================================misc_setting=====================================================//
    public function update_misc_setting($allowComment, $allowLike, $allowShare,$maximunPost,$maximumPage, $slideHeight, $slideWidth )
    {
        $data = Array( array('description'=>$allowComment), array('description'=>$allowLike), array('description'=>$allowShare),array('description'=>$maximunPost),array('description'=>$maximumPage),array('description'=>$slideHeight),array('description'=>$slideWidth));
        $i= 0;
              
        foreach ($data as $value)
        {
          
            $this->db->where('id', $i);
            $this->db->update('misc_setting', $value);        
            $i++;
        }
    }
    
    public function get_misc_setting()
    {
                $this->db->from('misc_setting');
                $query = $this->db->get();
                return $query->result();
    }

        
    

    //=============================metadata  --------------------------------------------------------------------------------
function delete_favicone($id) {
       
       $this->db->where('value',$id);
        $this->db->update('meta_data', array('value' => " "));
        
    }
    function get_meta_data()
    {
                $this->db->from('meta_data');
                $query = $this->db->get();
                return $query->result();
    }
    
    function update_meta_data($url, $title, $keyword, $description,$favicone)
    {
        if($favicone !=='' || $favicone !==NULL){
        $data = Array( array('value'=>$url), array('value'=>$title), array('value'=>$keyword), array('value'=>$description), array('value'=>$favicone));
        $i= 1;
              
        foreach ($data as $value)
        {
          
            $this->db->where('id',$i);
            $this->db->update('meta_data', $value);        
            $i++;
        }}
        else{
            $data = Array( array('value'=>$url), array('value'=>$title), array('value'=>$keyword), array('value'=>$description));
        $i= 1;
              
        foreach ($data as $value)
        {
          
            $this->db->where('id',$i);
            $this->db->update('meta_data', $value);        
            $i++;
        }
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
         $this->db->order_by('id','DESC');
        $query = $this->db->get('slide');
        return $query->result();
    }
    public function get_selected_slider($id)
    {
        $this->db->select('slide_name');
        $this->db->where('id', $id);
        $this->db->from('slide');
        $query = $this->db->get();
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
    public function get_slide_width()
    {
        $this->db->select('description');
        $this->db->from('misc_setting');
        $this->db->where('name', 'slide_width');
        $query = $this->db->get();
        return $query->result();
        
    }
    
    public function get_slide_height()
    {
        $this->db->select('description');
        $this->db->from('misc_setting');
        $this->db->where('name', 'slide_height');
        $query = $this->db->get();
        return $query->result();
        
    }
    
    
    public function findslider($id) {
         $this->db->from('slide');
        $this->db->where('id', $id);
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
    
    function delete_slider($a) {
        $this->db->delete('slide', array('slide_image' => $a));
    }
    
    
      
    /*function get_blog() {
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
    
    public function get_list_by_parent_id($parent_id)
    {
         $this->db->where('id', $parent_id);
        $query = $this->db->get('navigation');
        return $query->result();
    }
 
    
    // for listing in navigation 
    public function get_subList($id)
    {
        $this->db->where('menu_id', $id);
        $query = $this->db->get('navigation');
        return $query->result();
        
    }
    
    function get_userKey($id)
    {
        $this->db->select('user_email');
        $this->db->where('user_auth_key', $id);
        $keys = $this->db->get('user');
        return $keys->result();
    }
    
    function user_key($email)
    {
        $file = " ";
        $data = array(
          
            'user_auth_key' => $file);
        $this->db->where('user_email', $email);
        $this->db->update('user', $data);
    }
    
       }