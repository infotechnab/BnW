<?php 


class Viewmodel extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }
    
    public function get_page()
    {
        //$this->db->select('member_id, login, passwd');
        $this->db->from('page');
        //$this->db->where('login = ' . "'" . $username . "'");
        //$this->db->where('passwd = ' . "'" . MD5($password) . "'");
        //$this->db->limit(1);
        $query = $this->db->get();
        
            return $query->result();
        
    }
    public function get_slider()
    {
        $this->db->from('slide');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_design_setup()
    {
        $this->db->from('design_setup');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_header_title()
    {
        $this->db->select('description');
        $this->db->from('design_setup');
        $this->db->where('name', 'header_title');
        $query = $this->db->get();
        return $query->result();
        
    }
    public function get_header_logo()
    {
        $this->db->select('description');
        $this->db->from('design_setup');
        $this->db->where('name', 'header_logo');
        $query = $this->db->get();
        return $query->result();
        
    }
    public function get_header_description()
    {
        $this->db->select('description');
        $this->db->from('design_setup');
        $this->db->where('name', 'header_description');
        $query = $this->db->get();
        return $query->result();
        
    }
    
    

}