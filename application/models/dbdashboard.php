<?php

class Dbdashboard extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    //================================= STATR MENU ==================================//
    
      public function get_menu_info($menuSelected) {
        //die($menuSelected);

        $this->db->where('menu_name', $menuSelected);
        $query = $this->db->get('menu');
        return $query->result();
    }
     public function record_count_menu() {
        return $this->db->count_all("menu");
    }

    public function get_list_of_menu() {
        $query = $this->db->get('menu');
        return $query->result();
    }
    public function get_menu() {

        $query = $this->db->get('menu');
        return $query->result();
    }

    public function add_new_menu($menuname) {
        $data = array(
            'menu_name' => $menuname);
        $this->db->insert('menu', $data);
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

    public function delete_menu($id) {

        $this->db->delete('menu', array('id' => $id));
    }

    //====================================== CLOSE MENU =====================================================//
    //======================================= START NAVIGATION ==============================================//

    public function get_navigation($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('navigation');
        return $query->result();
    }

    public function get_list_of_navigation() {

        $query = $this->db->get('navigation');
        return $query->result();
    }

    public function get_list_of_navigationID() {
        $id = 1;
        $this->db->where('menu_id', $id);
        $query = $this->db->get('navigation');
        return $query->result();
    }

    function findnavigation($id) {
        $this->db->select();
        $this->db->where('id', $id);
        $query = $this->db->get('navigation');
        return $query->result();
    }

    public function get_list_of_selected_menu_navigation($id) {
        $this->db->where('menu_id', $id);
        $query = $this->db->get('navigation');
        return $query->result();
    }

    function get_parent_id($id) {
        $this->db->select('parent_id');
        $this->db->where('id', $id);
        $result = $this->db->get('navigation');
        return $result->result();
    }

    function get_data($id) {
        $this->db->select('id');
        $this->db->where('parent_id', $id);
        $resut = $this->db->get('navigation');
        return $resut->result();
    }

    function update_navID($id, $tempID) {
        $data = array(
            'id' => $tempID
        );
        $this->db->where('id', $id);
        $this->db->update('navigation', $data);
    }

    function update_navParentID($id, $tempID) {
        $data = array(
            'parent_id' => $tempID
        );
        $this->db->where('parent_id', $id);
        $this->db->update('navigation', $data);
    }

    function update_previousID($id, $previousID) {
        $data = array(
            'id' => $id
        );
        $this->db->where('id', $previousID);
        $this->db->update('navigation', $data);
    }

    function update_Previous_ParentID($id, $previousID) {
        $data = array(
            'parent_id' => $id
        );

        $this->db->where('parent_id', $previousID);
        $this->db->update('navigation', $data);
    }

    function update_up($tempID, $previousID) {
        $data = array(
            'id' => $previousID
        );
        $this->db->where('id', $tempID);
        $this->db->update('navigation', $data);
    }

    function update_parentID_UP($tempID, $previousID) {
        $data = array(
            'parent_id' => $previousID
        );

        $this->db->where('parent_id', $tempID);
        $this->db->update('navigation', $data);
    }

    function get_parent_id_down($id) {
        $this->db->select('parent_id');
        $this->db->where('id', $id);
        $this->db->order_by('parent_id', 'DESC');
        $result = $this->db->get('navigation');
        return $result->result();
    }

    function get_data_down($id) {
        $this->db->select('id');
        $this->db->where('parent_id', $id);
        $this->db->order_by('id', 'DESC');
        $resut = $this->db->get('navigation');
        return $resut->result();
    }

    public function update_edited_navigation($id, $navigationname) {
        $this->load->database();
        $data = array(
            'navigation_name' => $navigationname);
        $this->db->where('id', $id);
        $this->db->update('navigation', $data);
    }

    function delnavigation($id) {
        $this->db->delete('navigation', array('id' => $id));
    }

    public function record_count_navigation() {
        return $this->db->count_all("navigation");
    }

    public function get_list_of_category() {
        $query = $this->db->get('category');
        return $query->result();
    }

    public function get_navigation_info($navigationName) {
        $this->db->select('id');
        $this->db->where('navigation_name', $navigationName);
        $query = $this->db->get('navigation');
        return $query->result();
    }

    public function add_new_navigation_item($navigation_name, $navigation_link, $parent_id, $navigation_type, $navigation_slug, $menu_id) {
        $data = Array('navigation_name' => $navigation_name,
            'navigation_link' => $navigation_link,
            'parent_id' => $parent_id,
            'navigation_type' => $navigation_type,
            'navigation_slug' => $navigation_slug,
            'menu_id' => $menu_id
        );
        $this->db->insert('navigation', $data);
    }

    public function add_new_custom_link($navigationName, $navigationLink, $parentID, $navigationType, $navigation_slug, $menu_id) {
        $data = array(
            'navigation_name' => $navigationName,
            'navigation_link' => $navigationLink,
            'parent_id' => $parentID,
            'navigation_type' => $navigationType,
            'navigation_slug' => $navigation_slug,
            'menu_id' => $menu_id);

        $this->db->insert('navigation', $data);
    }

    //======================================= CLOSE NAVIGATION ==============================================//
    //====================================== START CATEGORY ================================================//

    
     public function get_categorys($id) {
        //$id = "<>".$id;
        //  die($id);(array('pt_id !='=> $id))
        $this->db->where(array('id !=' => $id));
        $query = $this->db->get('category');
        //var_dump($query);
        return $query->result();
    }

    public function get_coupon($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('coupon');
        return $query->result();
    }

    public function get_category_parent_id($data) {
        $this->db->select('id');
        $this->db->where('category_name', $data);
        $query = $this->db->get('category');
        return $query->result();
    }

    public function get_page_parent_id($data) {
        $this->db->select('id');

        $this->db->where('page_name', $data);
        $query = $this->db->get('page');
        return $query->result();
    }

  

    public function delete_related_product($id) {
        $this->db->where('category', $id);
        $this->db->delete('product');
    }
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

    public function add_new_category($categoryname) {
        $data = Array(
            'category_name' => $categoryname);

        $this->db->insert('category', $data);
    }

    public function find_category_id($categoryname) {

        $this->db->select('id');
        $this->db->where('category_name', $categoryname);
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');
        $page = $this->db->get('category');
        return $page->result();
    }

    public function findcategory($id) {
        $this->db->select();
        $this->db->from('category');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_category($id, $categoryname) {

        $data = array
            (
            'category_name' => $categoryname);

        $this->db->where('id', $id);
        $this->db->update('category', $data);
    }

    public function delete_category($id) {
        $this->db->where('id', $id);
        $this->db->delete('category');
    }

    public function get_category_id($id) {
        $this->db->select("id, category_name");
        $this->db->where('id', $id);
        $query = $this->db->get('category');
        return $query->result();
    }

    // ===================================== CLOSE CATEGORY ================================================//
}
