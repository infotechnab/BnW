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
        $this->db->from('slider');
        $query = $this->db->get();
        return $query->result();
    }
    

}