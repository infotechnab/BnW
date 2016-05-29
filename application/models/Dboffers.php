<?php

class Dboffers extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
     public function record_count_post() {
        return $this->db->count_all("post");
    }
     public function record_count_post_category_id($post_category_id) {
        $this->db->where('post_category',$post_category_id);
        $this->db->from('post');
        return $this->db->count_all_results();
    }
    
    public function get_list_of_post() {
        $query = $this->db->get('post');
        return $query->result();
    }
    
    public function get_post_category() {
        
        $query = $this->db->query("SELECT DISTINCT post.post_category FROM post");
        return $query->result();
    }
    
     public function get_posts() {
        $query = $this->db->get('post');
        return $query->result();
    }

    public function get_post_category_info($categoryName) {
        $this->db->select('id');
        $this->db->where('category_name', $categoryName);
        $query = $this->db->get('category');
        return $query->result();
    }

    public function get_post_author_id($username) {
        $this->db->select('id');
        $this->db->where('user_name', $username);
        $query = $this->db->get('user');
        return $query->result();
    }

    public function get_all_posts($limit, $start) {
        $this->db->select('*,post.id as pid');
        $this->db->from('post');
        $this->db->limit($limit, $start);
        $this->db->order_by('post.id', 'DESC');
        $this->db->join('category', 'category.id = post.post_category', 'left');
        $query = $this->db->get(); 
        return $query->result();
    }

    public function get_all_posts_category_id($post_category_id) {
        $this->db->select('*,post.id as pid');
        $this->db->from('post');
        $this->db->where("post_category", $post_category_id);
        $this->db->order_by('post.id', 'DESC');
        $query = $this->db->get(); 
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

        $query = $this->db->get_where('post', array('id' => $id));
        if ($query->num_rows() > 0) {
            $this->db->delete('post', array('id' => $id));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function add_new_post($post_title, $post_content, $post_summary, $post_status, $image, $selectCategory, $seoTitle) {
       
        $data = array(
            'post_title' => $post_title,
            'post_content' => $post_content,
            'post_summary' => $post_summary,
            'post_status' => $post_status,
            'image' => $image,
            'post_category' => $selectCategory,
            'seo_title' => $seoTitle);
        $this->db->insert('post', $data);
    }

//    public function add_new_post($post_title, $post_content, $post_author_id, $post_summary, $post_status, $post_comment_status, $post_tags, $post_category_id, $allow_comment, $allow_like, $allow_share)
//        {
//        $this->load->database();        
//        $data = array(
//            
//            'post_title' => $post_title,
//            'post_content'=> $post_content,
//            'post_author_id'=> $post_author_id,
//            'post_summary'=> $post_summary,
//            'post_status'=> $post_status,
//            'comment_status'=> $post_comment_status,
//            'post_tags'=>$post_tags,
//            'post_category'=>$post_category_id,
//            'allow_comment'=>$allow_comment,
//            'allow_like'=>$allow_like,
//            'allow_share'=>$allow_share);
//         $this->db->insert('post', $data);
//    }

    public function update_post($id, $post_title, $post_content, $post_summary, $image, $selectCategory, $seoTitle) {
        $this->load->database();
        $data = array
            (
            'post_title' => $post_title,
            'post_content' => $post_content,
            'post_summary' => $post_summary,
            'image' => $image,
            'post_category' => $selectCategory,
            'seo_title' => $seoTitle);
        $this->db->where('id', $id);
        $this->db->update('post', $data);
    }
    
    public function update_navigation_on_post_update($post_id, $navigationName, $navigationLink, $navigationSlug) {
        $this->load->database();
        $data = array(
            'navigation_name' => $navigationName,
            'navigation_link' => $navigationLink,
            'navigation_slug' => $navigationSlug);
        $this->db->where('post_id', $post_id);
        $this->db->update('navigation', $data);
    }
    
     function offerImgdelete($id = 0) {
        $image = NULL;
        $data = array(
            'image' => $image
        );
        $this->db->where('id', $id);
        $this->db->update('post', $data);
    }
}