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
 <?php 
       $res = $this->dbmodel->get_album();
?>
<?php
foreach ($res as $r)
{	$aid = $r->aid;	
        $result = $this->dbmodel->get_gallery_image($aid); 
        if($result)
        {  
        ?>       
<div class="abcimg" style="width:150px; height:130px; background-color:#CCC; float:left; margin-top: 70px; margin-right: 20px; ">
<a href="<?php echo base_url();?>index.php/admin/delete_album/<?php echo $aid; ?> " id="<?php echo $aid; ?>" class="delbutton">
<img src="<?php echo base_url();?>content/images/close.png" width="20" height="20" style="z-index:100;  position:relative; top:0px; left:125px;" /></a>
<?php
foreach( $result as $abc)
{
    ?>
    <img src="<?php echo base_url(); ?>gallery/<?php echo $abc->image;?>" width="150px" height="120px"  />
<div class="alb" style="background-color:#096; width:150px; text-align:center; float:left; z-index:1000;  ">
<?php echo anchor('admin/photos/'.$r->aid,$r->a_name); ?></div></div> 
<?php }}
else 
 {    
 ?>      
<div class="abcimg" style="width:150px; height:130px; background-color:#CCC; float:left; margin-top: 70px; margin-right: 20px; ">
<a href="<?php echo base_url();?>index.php/admin/delete_album/<?php echo $aid; ?> " id="<?php echo $aid; ?>" class="delbutton">
<img src="<?php echo base_url();?>content/images/close.png" width="20" height="20" style="z-index:100;  position:relative; top:0px; left:125px;" /></a>
 <img src="<?php echo base_url(); ?>gallery/default.jpg" width="150px" height="120px"  />
<div class="alb" style="background-color:#096; width:150px; text-align:center; float:left; z-index:1000;  ">
<?php echo anchor('admin/photos/'.$r->aid,$r->a_name); ?></div></div>
 <?php     
 }?> 
 <?php  } 
   if ($this->session->userdata('logged_in')) ?>
<a class="ad" href="#" style="position: relative; top: 50px; left: 0px;" > Create new album </a>
<div class="add" style="width:150px; height:90px; position: absolute; top: 170px; left: 350px; display:none; z-index:105; " >
 <img id="close" src="<?php echo base_url();?>content/images/close.png" width="15px" height="15px" style="float:right;" />
<?php echo form_open('admin/add_album'); ?>
<input type="text" name="addtext" placeholder="album name"  />
<input type="submit" name="submit" value="create album"   />
<?php echo form_close(); ?>
</div> 
<div style="clear:left;" />