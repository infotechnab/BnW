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
    
    public function add_new_contact_feedback($name, $email, $remark, $type)
    {
        $data = Array(
            'full_name' => $name,
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
    
    public function add_contact_form($name, $street, $city, $district, $country, $contact1, $contact2, $email, $showForm, $showMap)
    {
        $data = Array(
            'name' => $name,
            'address' => $street.','.$city.','.$district.','.$country,
            'contact_no1' => $contact1,
            'contact_no2' => $contact2,
            'email' => $email,
            'show_form' => $showForm,
            'show_map' => $showMap);
        $this->db->where('id', '1');
        $this->db->update('contact_address', $data);
    }
    
    public function get_contact_form()
    {
        $query = $this->db->get('contact_address');
        return $query->result();
    }
}