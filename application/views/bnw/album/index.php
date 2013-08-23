<script>
    $(document).ready(function(){
  $(".ad").click(function(){
   $(".frm").show();
     }); 
});

$(document).ready(function(){
  $("#close").click(function(){
   $(".frm").hide();
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
            <?php echo anchor('bnw/photos/'.$r->aid,$r->a_name); ?> 
             </div>
            <a href="<?php echo base_url();?>index.php/bnw/delete_album/<?php echo $aid; ?> " id="<?php echo $aid; ?>" class="delbutton">
        <img src="<?php echo base_url();?>content/images/delete.png" id="close"/></a>
 </div> 


<?php }}
else 
 {   
 ?>     
<div id="photodiv">
   
    

        <img src="<?php echo base_url(); ?>gallery/default.jpg" id="galleryimage" />
        <div id="imagetitle">
            <?php echo anchor('bnw/photos/'.$r->aid,$r->a_name); ?> 
        </div>
            <a href="<?php echo base_url();?>index.php/bnw/delete_album/<?php echo $aid; ?> " id="<?php echo $aid; ?>" class="delbutton">
        <img src="<?php echo base_url();?>content/images/delete.png" id="close"/></a>
        
    
</div> 



 <?php     
 }?> 
 


 <?php  }
 
   if ($this->session->userdata('logged_in')) ?>
<a class="ad" href="#" style="position: relative; top: 50px; left: 0px;" > Create new album </a>
<div class="frm" style="width:150px; height:90px; position: absolute; top: 170px; left: 350px; display:none; z-index:105; " >
 <img id="close" src="<?php echo base_url();?>content/images/delete.png "/>
<?php echo form_open('bnw/add_album'); ?>
      <input type="text" name="addtext" />
<input type="submit" name="submit" value="create album"   />
<?php echo form_close(); ?>
</div> 
<div style="clear:left;" />
