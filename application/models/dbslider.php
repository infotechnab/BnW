<?php

class Dbslider extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
     public function record_count_slider() {
        return $this->db->count_all("slide");
    }

    public function get_slider($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('slide');
        return $query->result();
    }

    public function get_selected_slider($id) {
        $this->db->select('slide_name');
        $this->db->where('id', $id);
        $this->db->from('slide');
        $query = $this->db->get();
        return $query->result();
    }

    public function add_new_slider($slidename, $slideimage, $slidecontent) {
        // $this->load->database();
        $data = array(
            'slide_name' => $slidename,
            'slide_image' => $slideimage,
            'slide_content' => $slidecontent);
        $this->db->insert('slide', $data);
    }

    public function get_slide_width() {
        $this->db->select('description');
        $this->db->from('misc_setting');
        $this->db->where('name', 'slide_width');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_slide_height() {
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

    public function update_slider($id, $slidename, $slideimage, $slidecontent) {
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
}