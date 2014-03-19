<?php 


class Viewmodel extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }
    
    public function get_page()
    {
        
        $this->db->from('page');
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
    
    public function get_desired_page($id)
    {
        
        $this->db->from('page');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
        
    }

}