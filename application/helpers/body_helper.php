<?php
  
    function get_gadget_body() {
 
    //the database functions can not be called from within the helper
    //so we have to explicitly load the functions we need in to an object
    //that I will call ci. then we use that to access the regular stuff.
    $ci=& get_instance();
    $ci->load->database();
 
    //select the required fields from the database
    //$ci->db->select('name, type, setting');
 
    //tell the db class the criteria
    $ci->db->where('display', 'Body');
 
    //supply the table name and get the data
    $query = $ci->db->get('gadgets');
 
    foreach($query->result() as $row)
    {
 
      $type[] = array('name' => $row->name, 'type' => $row->type);
    }
return $type;    

}