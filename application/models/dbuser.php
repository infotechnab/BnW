<?php

class Dbuser extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
public function record_count_user() {
        return $this->db->count_all("user");
    }

    public function get_all_user($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('user');
        return $query->result();
    }

    public function get_selected_user($useremail) {
        $this->db->where('user_email', $useremail);
        $query = $this->db->get('user');

        return $query->result();
    }

    public function update_emailed_user($to, $token) {
        $data = array(
            'user_auth_key' => $token);
        $this->db->where('user_email', $to);
        $this->db->update('user', $data);
    }

    public function update_user_password($token, $userPassword) {
        $data = array(
            'user_auth_key' => "",
            'user_pass' => md5($userPassword));

        $this->db->where('user_auth_key', $token);
        $this->db->update('user', $data);
    }

    public function get_user() {
        $query = $this->db->get('user');
        return $query->result();
    }

    public function get_user_info($username) {
        $this->db->select();

        $this->db->from('user');
        $this->db->where('user_name', $username);
        $query = $this->db->get();
        return $query->result();
    }

    function finduser($id) {
        $this->db->select();

        $this->db->from('user');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function find_user_auth_key($token) {
        $this->db->where('user_auth_key', $token);
        $query = $this->db->get('user');
        return $query->result();
    }

    function find_user($email) {

        $this->db->from('user');
        $this->db->where('user_email', $email);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_user($id, $name, $fname, $lname, $email, $pass, $status, $user_type) {

        $data = array(
            'user_name' => $name,
            'user_fname' => $fname,
            'user_lname' => $lname,
            'user_email' => $email,
            'user_status' => $status,
            'user_type' => $user_type);
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }

    public function add_new_user($name, $fname, $lname, $email, $pass, $status, $user_type, $contact, $address) {

        $data = array(
            'user_name' => $name,
            'user_fname' => $fname,
            'user_lname' => $lname,
            'user_email' => $email,
            'user_pass' => $pass,
            'address' => $address,
            'contact' => $contact,
            'user_status' => $status,
            'user_type' => $user_type);
        // var_dump($data);
        $this->db->insert('user', $data);
    }

    function check_data($user) {
        $this->db->where('user_email', $user);
        $query = $this->db->get('user');
        return $query->num_rows();
    }

    public function delete_user($id) {
        $query = $this->db->get_where('user', array('id' => $id));
        if ($query->num_rows() > 0) {
            $this->db->delete('user', array('id' => $id));
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
     function check_user($id) {
        $this->db->select('user_name');
        $this->db->where('id', $id);
        $userKey = $this->db->get('user');
        return $userKey->result();
    }
}
