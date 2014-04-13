<?php
class database_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
        
             
        function addText($name,$type,$display)
        {
            $data = array(
                'name'=>$name,
                'type'=>$type,
                'display'=>$display,
                'setting'=>'1'
            );
        $this->db->insert('gadgets',$data);
            
        }
        
        function get_gaget()
        {   
            $gaget = $this->db->get('gadgets');
            return $gaget->result();
        }
        
        function get_gaget_display($display)
        {
            $gadget = $this->db->get_where('gadgets', array('display' => $display));
            return $gadget->result();
        }
        
        function updateText($gadget_name, $gadget_type, $updateDisplay)
        {
             $data = array(
                'name'=>$gadget_name,
                'type'=>$gadget_type,
                'display'=>$updateDisplay,
                'setting'=>'1'
            );
                   // var_dump($data);
            $this->db->insert('gadgets',$data);
        }

        function hide($gadget_hide, $name_hide)
        {
             $data = array(
                'name'=>$name_hide,
                'setting'=>$gadget_hide
            );
                   // var_dump($data);
            $this->db->where('name',$name_hide);
            $this->db->update('gadgets',$data);
        }
        
        function delete($gadget_delete, $name_hide)
        {
        $this->db->where('name', $name_hide)->delete('gadgets');
        //return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
        }






        //$query = $this->db->get_where('news', array('slug' => $slug));
	//return $query->row_array();
}
