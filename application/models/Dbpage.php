<?php

class Dbpage extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    //pages -----------------------------------------------
    
     public function delete_navigation_related_to_page($id) {

        $this->db->delete('navigation', array('navigation_link' => 'page/' . $id));
    }
    public function update_navigation_on_page_update($pageid, $navigationName, $navigationLink, $navigationSlug) {
        $this->load->database();
        $data = array(
            'navigation_name' => $navigationName,
            'navigation_link' => $navigationLink,
            'navigation_slug' => $navigationSlug);
        $this->db->where('page_id', $pageid);
        $this->db->update('navigation', $data);
    }
    public function get_page_author_id($username) {
        $this->db->select('id');
        $this->db->where('user_name', $username);
        $query = $this->db->get('user');
        return $query->result();
    }
    public function record_count_page() {
        return $this->db->count_all("page");
    }

    public function get_all_pages($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('page');
        return $query->result();
    }

    public function get_list_of_pages() {
        $query = $this->db->get('page');
        return $query->result();
    }

    public function get_pages() {


        $query = $this->db->get('page');
        return $query->result();
    }

    public function add_new_page($pageName, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare, $image, $template, $seoTitle){
        $dt = new DateTime();
        $insert_date = $dt->format('Y-m-d H:i:s');
        $data = array(
            'page_name' => $pageName,
            'page_content' => $body,
            'page_author_id' => $page_author_id,
            'page_summary' => $summary,
            'page_status' => $status,
            'page_order' => $order,
            'page_type' => $type,
            'page_tags' => $tags,
            'allow_comment' => $allowComment,
            'allow_like' => $allowLike,
            'allow_share' => $allowShare,
            'page_modifed_date' => $insert_date,
            'images' => $image,
            'seo_title' => $seoTitle
                );
        $this->db->insert('page', $data);
    }

    public function findpage($id) {
        $this->db->select();
        $this->db->from('page');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function find_page_id($name) {

        $this->db->select('id');
        $this->db->where('page_name', $name);
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');
        $page = $this->db->get('page');
        return $page->result();
    }

     public function update_page($id, $pageName, $body, $page_author_id, $summary, $status, $order, $type, $tags, $allowComment, $allowLike, $allowShare, $image, $template, $seoTitle){
         $dt = new DateTime();
        $insert_date = $dt->format('Y-m-d H:i:s');
        $data = array
            (
            'page_name' => $pageName,
            'page_content' => $body,
            'page_author_id' => $page_author_id,
            'page_summary' => $summary,
            'page_status' => $status,
            'page_order' => $order,
            'page_type' => $type,
            'page_tags' => $tags,
            'allow_comment' => $allowComment,
            'allow_like' => $allowLike,
            'allow_share' => $allowShare,
            'page_modifed_date' => $insert_date,
            'images' => $image,
            'seo_title' => $seoTitle);
        $this->db->where('id', $id);
        $this->db->update('page', $data);
    }

    public function delete_page($id) {
        $query = $this->db->get_where('page', array('id' => $id));
        if ($query->num_rows() > 0) {
            $this->db->delete('page', array('id' => $id));
            return TRUE;
        } else {
            return FALSE;
        }

        //$this->db->delete('page', array('id' => $id));
    }

    public function delete_page_image($id) {
       $image = NULL;
        $data = array(
            'images' => $image
        );
        $this->db->where('id', $id);
        $this->db->update('page', $data);
    }
     
}
