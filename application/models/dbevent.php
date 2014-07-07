<?php

class Dbevent extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    function get_event() {
        // $this->db->order_by('id','DESE');
        return $this->db->count_all('events');
    }
    
    function get_event_data($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by('date', 'DESC');
        $query = $this->db->get("events");
        return $query->result();
    }
    
    function get_event_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('events');
        return $query->result();
    }
    
     function update_event($id, $title, $content, $summary, $location, $image, $dateTime) {
        // die($id);
        $data = array(
            'title' => $title,
            'details' => $content,
            'location' => $location,
            'image' => $image,
            'date' => $dateTime);
        $this->db->where('id', $id);
        $this->db->update('events', $data);
    }
    
    function add_event($name, $detail, $location, $dateTime, $image) {
        $data = array(
            'title' => $name,
            'details' => $detail,
            'location' => $location,
            'date' => $dateTime,
            'image' => $image
        );
        $this->db->insert('events', $data);
    }
    
     function Imgdelete($id = 0) {
        $image = NULL;
        $data = array(
            'image' => $image
        );

        $this->db->where('id', $id);
        $this->db->update('events', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('events');
    }
}