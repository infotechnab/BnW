<?php
class database_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
        
        public function get_news()
        {
            $query = $this->db->get('news');
            return $query->result_array();
	}
        
        function addText($title,$description){
            $data = array(
                'title'=>$title,
                'description'=>$description
            );
            
            $this->db->insert('gadget_collection',$data);
            
        }
        
        function get_gaget(){
            
            $gaget = $this->db->get('gadgets');
            return $gaget->result();
        }





        //$query = $this->db->get_where('news', array('slug' => $slug));
	//return $query->row_array();
}
