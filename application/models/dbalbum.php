<?php

class Dbalbum extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
     public function record_count_album() {
        return $this->db->count_all("album");
    }

    public function get_album() {
        $query = $this->db->get('album');
        return $query->result();
    }

    public function add_album($name) {
        $data = Array(
            'album_name' => $name);
        $this->db->insert('album', $data);
    }

    public function add_new_album($name) {
        $data = array(
            'album_name' => $name);
        $this->db->insert('album', $data);
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
        $this->db->where('media_association_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_selected_album($id) {
        $this->db->from('album');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function add_new_photo($medianame, $mediatype, $albumid, $medialink) {
        $data = Array(
            'media_name' => $medianame,
            'media_type' => $mediatype,
            'media_association_id' => $albumid,
            'media_link' => $medialink);

        $this->db->insert('media', $data);
    }

    function get_aid($id) {
        $this->db->select();
        $this->db->where('id', $id);
        $this->db->from('media');
        $aid = $this->db->get();
        return $aid->result();
    }

    function delete_photo($a) {

        $this->db->delete('media', array('media_type' => $a));
    }
    
     function get_media_image($aid) {
        $this->db->select();
        $this->db->where('media_association_id', $aid);

        $this->db->limit(1);
        $query = $this->db->get('media');
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
     public function record_count_media() {
        return $this->db->count_all("media");
    }

    public function get_all_media() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('media');
        return $query->result();
    }

    public function get_media($id) {
        $this->db->from('media');
        $this->db->where('media_association_id', $id);
        $query = $this->db->get();

        return $query->result();
    }

    public function get_photo_media_id($photoid) {

        $this->db->from('media');
        $this->db->where('id', $photoid);
        $query = $this->db->get();

        return $query->result();
    }

    function findmedia($id) {
        $this->db->select();

        $this->db->from('media');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_media($id, $medianame, $mediatype, $media_association_id, $medialink) {

        $data = array(
            'media_name' => $medianame,
            'media_type' => $mediatype,
            'media_association_id' => $media_association_id,
            'media_link' => $medialink);
        $this->db->where('id', $id);
        $this->db->update('media', $data);
    }

    public function add_new_media($medianame, $mediatype, $media_association_id, $medialink) {

        $data = array(
            'media_name' => $medianame,
            'media_type' => $mediatype,
            'media_association_id' => $media_association_id,
            'media_link' => $medialink);
        $this->db->insert('media', $data);
    }

    public function delete_media($id) {

        $this->db->delete('media', array('media_type' => $id));
    }

    public function get_media_association_info($mediaName) {
        $this->db->select('id');
        $this->db->where('album_name', $mediaName);
        $query = $this->db->get('album');
        return $query->result();
    }

    public function get_list_of_album() {
        $query = $this->db->get('album');
        return $query->result();
    }
}