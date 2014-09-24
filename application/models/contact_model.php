<?php

class contact_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function add_new_contact($name, $email, $type)
    {
        $data = Array(
            'full_name' => $name,
            'email' => $email,
            'type' => $type);
        $this->db->insert('contact_list', $data);
    }
    
    public function get_newsletter_subscribers()
    {
        $this->db->where('type', 'newsletter subs');
        $query = $this->db->get('contact_list');
        return $query->result();
    }
    
    
    
    
    
    
}