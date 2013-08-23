<?php 
class Viewmodel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
     public function get_menu()
    {
         $this->db->order_by('order','ASC');
        $query = $this->db->get('menu');
        return $query->result();
    }
    
    public function listing($id)
    {      $this->db->where('listing',$id); 
           $menu = $this->db->get('menu');
           return $menu->result();
}

function get_sublist_title($title)
{
    $this->db->select('p_id');
    $this->db->where('title',$title);
    $list = $this->db->get('menu');
    return $list->result();
}

function get_sublist($id)
{   
    die($id);
            $this->db->order_by('order','ASC');
            $this->db->where('listing',$id); 
           $menu = $this->db->get('menu');
           return $menu->result();
    
}
function get_sub_sublist($id)
{
            $this->db->where('listing',$id); 
           $menu = $this->db->get('menu');
           return $menu->result();
    
}

}