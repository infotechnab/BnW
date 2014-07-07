<?php

class Dboffers extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
     public function record_count_post() {
        return $this->db->count_all("post");
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
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'DESC');
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

        $query = $this->db->get_where('post', array('id' => $id));
        if ($query->num_rows() > 0) {
            $this->db->delete('post', array('id' => $id));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function add_new_post($post_title, $post_content, $post_summary, $post_status, $image) {
       
        $data = array(
            'post_title' => $post_title,
            'post_content' => $post_content,
            'post_summary' => $post_summary,
            'post_status' => $post_status,
            'image' => $image
        );
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

    public function update_post($id, $post_title, $post_content, $post_summary, $image) {
        $this->load->database();
        $data = array
            (
            'post_title' => $post_title,
            'post_content' => $post_content,
            'post_summary' => $post_summary,
            'image' => $image);
        $this->db->where('id', $id);
        $this->db->update('post', $data);
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