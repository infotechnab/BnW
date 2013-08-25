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

function  get_event()
{
     $this->db->where('type','event');
    $this->db->order_by('id','DESC');
    $event = $this->db->get('page_event',2);
    return $event->result();
}

function  get_slider()
{
     
    $slider = $this->db->get('page_event',5);
    return $slider->result();
}

function  get_download()
{
     
    $download = $this->db->get('download');
    return $download->result();
}

}