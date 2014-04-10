<?php
class database_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
        
             
        function addText($name,$type){
            $data = array(
                'name'=>$name,
                'type'=>$type
            );
            
            $this->db->insert('gadgets',$data);
            
        }
        
        function get_gaget(){
            
            $gaget = $this->db->get('gadgets');
            return $gaget->result();
        }





        //$query = $this->db->get_where('news', array('slug' => $slug));
	//return $query->row_array();
}
