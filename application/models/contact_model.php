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
    
    public function add_new_contact_feedback($email, $remark, $type)
    {
        $data = Array(
            'email' => $email,
            'remarks' => $remark,
            'type' => $type);
        $this->db->insert('contact_list', $data);
    }

        public function get_newsletter_subscribers()
    {
        $this->db->where('type', 'newsletter subs');
        $query = $this->db->get('contact_list');
        return $query->result();
    }
    
    public function get_feedback()
    {
         $this->db->where('type', 'feedback');
        $query = $this->db->get('contact_list');
        return $query->result();
    }

        public function delete_subscription($id)
    {
         $this->db->where('id', $id);
        $this->db->delete('contact_list');
    }
    
    
    
    
}