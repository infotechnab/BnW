<?php
class model1 extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
        
             
        function addText($name,$textBox,$type,$display)
        {
            $data = array(
                'name'=>$name,
                'textBox'=>$textBox,
                'type'=>$type,
                'display'=>$display,
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
            var_dump($gadget);
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
        
        function delete($id)
        {
            $sql = "DELETE FROM gadgets WHERE gadget_id = '$id'";
            $this->db->query($sql);
        }
            
        
        function defaultGadget($name_title,$recentPost,$display_recentPost,$arr)
        {
             $dat = array(
                'name'=>$name_title,
                'defaultGadget'=>$recentPost,
                'display'=>$display_recentPost,
                'setting'=>$arr
            );
        $this->db->insert('gadgets',$dat);
        }

         function get_gaget_recentPost()
        {
            $gadget = $this->db->get_where('gadgets', array('defaultGadget' => 'recent post'));
            return $gadget->result();
            var_dump($gadget);
        }


        public function get_post($limit)
        {
        $this->db->from('post'); 
        $this->db->limit($a);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();  
        }
    
         function defaultGadgetUpdate($name_title,$recentPost,$arr,$gadget_update)
        {
             $data = array(
                'name'=>$name_title,
                'setting'=>$arr
            );

            $this->db->where(array('defaultGadget' => 'recent post','display' => $gadget_update));
            $this->db->update('gadgets', $data);

        }
        
        
        function textBoxUpdate($id,$name_title,$type,$gadget_update)
        {
             $data = array(
                'name'=>$name_title,
                'type'=>$type
            );

            $this->db->where('gadget_id',$id);
            $this->db->update('gadgets', $data);

        }
}
