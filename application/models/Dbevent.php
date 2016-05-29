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
        $this->db->order_by('insert_date', 'DESC');
        $query = $this->db->get("events");
        return $query->result();
    }
    
    function get_event_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('events');
        return $query->result();
    }
    
     
     function update_event($id, $title, $content, $location, $image, $start_dateTime, $end_dateTime, $type, $updatedOn, $seoTitle) {
        // die($id);
        $data = array(
            'title' => $title,
            'details' => $content,
            'location' => $location,
            'image' => $image,
            'start_date' => $start_dateTime,
            'end_date' => $end_dateTime,
            'last_modified_date' => $updatedOn,
            'type'=>$type,
            'seo_title' => $seoTitle);
        $this->db->where('id', $id);
        $this->db->update('events', $data);
    }
    
    function add_event($name, $detail, $location, $start_dateTime,$end_dateTime, $insert_date, $image, $type, $seoTitle){
        $data = array(
            'title' => $name,
            'details' => $detail,
            'location' => $location,
            'start_date' => $start_dateTime,
            'end_date' => $end_dateTime,
             'insert_date' => $insert_date,
            'image' => $image,
            'type' => $type,
            'seo_title' => $seoTitle);
        $this->db->insert('events', $data);
    }
    
    function add_news($name, $detail, $location, $insert_date, $image, $type, $seoTitle)
    {
        $data = array(
            'title' => $name,
            'details' => $detail,
            'location' => $location,
            'insert_date' => $insert_date,
            'image' => $image,
            'type' => $type,
            'seo_title' => $seoTitle);
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