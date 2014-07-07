<?php

class Dbsetting extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    //=====================================HEADER========================================================//
    public function get_design_setup() {
        $this->db->from('design_setup');
        $query = $this->db->get();
        return $query->result();
    }

    function update_design_header_setup($headerTitle, $headerLogo, $headerDescription, $headerBgColor) {
        $data = Array(array('description' => $headerTitle), array('description' => $headerLogo), array('description' => $headerDescription), array('description' => $headerBgColor));
        $i = 0;

        foreach ($data as $value) {

            $this->db->where('id', $i);
            $this->db->update('design_setup', $value);
            $i++;
        }
    }

    function update_design_sidebar_setup($sideBarTitle, $sideBarDescription, $sideBarBgColor) {
        $data = Array(array('description' => $sideBarTitle), array('description' => $sideBarDescription), array('description' => $sideBarBgColor));
        $i = 4;

        foreach ($data as $value) {

            $this->db->where('id', $i);
            $this->db->update('design_setup', $value);
            $i++;
        }
    }

    public function update_misc_setting($allowComment, $allowLike, $allowShare, $maximunPost, $maximumPage, $slideHeight, $slideWidth) {
        $data = Array(array('description' => $allowComment), array('description' => $allowLike), array('description' => $allowShare), array('description' => $maximunPost), array('description' => $maximumPage), array('description' => $slideHeight), array('description' => $slideWidth));
        $i = 0;

        foreach ($data as $value) {

            $this->db->where('id', $i);
            $this->db->update('misc_setting', $value);
            $i++;
        }
    }

    public function get_misc_setting() {
        $this->db->from('misc_setting');
        $query = $this->db->get();
        return $query->result();
    }

    function delete_favicone($id) {

        $this->db->where('value', $id);
        $this->db->update('meta_data', array('value' => " "));
    }

    function get_meta_data() {
        $this->db->from('meta_data');
        $query = $this->db->get();
        return $query->result();
    }

    function update_meta_data($url, $title, $keyword, $description, $favicone) {
        if ($favicone !== '' || $favicone !== NULL) {
            $data = Array(array('value' => $url), array('value' => $title), array('value' => $keyword), array('value' => $description), array('value' => $favicone));
            $i = 1;

            foreach ($data as $value) {

                $this->db->where('id', $i);
                $this->db->update('meta_data', $value);
                $i++;
            }
        } else {
            $data = Array(array('value' => $url), array('value' => $title), array('value' => $keyword), array('value' => $description));
            $i = 1;

            foreach ($data as $value) {

                $this->db->where('id', $i);
                $this->db->update('meta_data', $value);
                $i++;
            }
        }
    }
}