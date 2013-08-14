<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>
    $(document).ready(function(){
  $(".ad").click(function(){
   $(".add").show();
     }); 
});

$(document).ready(function(){
  $("#close").click(function(){
   $(".add").hide();
     }); 
});
</script>

<h2>Album </h2>
 <?php 
       $res = $this->dbmodel->get_album();
?>
<?php
foreach ($res as $r)
{
	$aid = $r->aid;	
        
                   
	$result = $this->dbmodel->get_gallery_image($aid); 
        if($result)
        {
foreach( $result as $abc)
{
   ?>   
<div id="photodiv">
        <img src="<?php echo base_url(); ?>gallery/<?php echo $abc->image;?>" id="galleryimage" />
        <div id="imagetitle">
            <?php echo anchor('admin/photos/'.$r->aid,$r->a_name); ?> 
             </div>
            <a href="<?php echo base_url();?>index.php/admin/delete_album/<?php echo $aid; ?> " id="<?php echo $aid; ?>" class="delbutton">
        <img src="<?php echo base_url();?>content/images/delete.png" id="close"/></a>
 </div> 


<?php }}
else 
 {
 
    
    
 ?>
  

      
<div id="photodiv">
   
    

        <img src="<?php echo base_url(); ?>gallery/default.jpg" id="galleryimage" />
        <div id="imagetitle">
            <?php echo anchor('admin/photos/'.$r->aid,$r->a_name); ?> 
        </div>
            <a href="<?php echo base_url();?>index.php/admin/delete_album/<?php echo $aid; ?> " id="<?php echo $aid; ?>" class="delbutton">
        <img src="<?php echo base_url();?>content/images/delete.png" id="close"/></a>
        
    
</div> 



 <?php     
 }?> 
 


 <?php  }
 
   if ($this->session->userdata('logged_in')) ?>
<a class="ad" href="#" style="position: relative; top: 50px; left: 0px;" > Create new album </a>
<div class="add" style="width:150px; height:90px; position: absolute; top: 170px; left: 350px; display:none; z-index:105; " >
 <img id="close" src="<?php echo base_url();?>content/images/delete.jpg "/>
<?php echo form_open('admin/add_album'); ?>
      <input type="text" name="addtext" />
<input type="submit" name="submit" value="create album"   />
<?php echo form_close(); ?>
</div> 
<div style="clear:left;" />
