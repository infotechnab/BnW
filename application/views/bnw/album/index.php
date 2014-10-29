
<script>
    $(document).ready(function(){
  $(".ad").click(function(){
   $(".frm").show();
   $(".ad").hide();
     }); 
});

$(document).ready(function(){
  $("#albumCancel").click(function(){
   $(".frm").hide();
  
   $("#error").hide();
    $(".ad").show();
     }); 
});
</script>
<div class="rightSide">
    <h2> Add Album</h2>
    <hr class="hr-gradient"/>
    <div id="sucessmsg">
  <?php echo $this->session->flashdata('message');
  echo validation_errors();
if(isset($error))
{
    echo $error;
}    
?>
    </div>



<div id="newAlbum">
<a class="ad" href="#" style="position: relative; top: 50px; left: 0px;" >Create new album </a>
<div id="error">
    
</div>
<div class="frm" style="width:150px; height:90px; float: left; display:none; z-index:105; " >
    <?php echo form_open('album/addalbum'); ?>
    <input type="text" class="input-text-small" name="album_name" placeholder="Album Name" required />
    <input type="submit" class="submit-button-small" name="submit" value="create" />        
    <input type="button" class="submit-button-small" id="albumCancel" name="close" value="cancel"/>
    <?php echo form_close(); ?>
</div>
</div>

<?php
if($query){
foreach ($query as $data)
{
	$aid = $data->id;	
        
                  
	$result = $this->dbalbum->get_media_image($aid); 
        if($result)
        {
foreach( $result as $abc)
{
   ?> 
    

<div id="photodiv">
   
    

    <img src="<?php echo base_url(); ?>content/uploads/images/<?php echo $abc->media_type; ?>" id="galleryimage" />
        <div id="imagetitle">
            <?php echo anchor('album/photos/'.$data->id,$data->album_name); ?> 
        </div>
            <a href="<?php echo base_url();?>index.php/album/delalbum/<?php echo $aid; ?> " id="<?php echo $aid; ?>" class="delbutton">
        <img src="<?php echo base_url();?>content/bnw/images/delete.png" id="close"/></a>
        
    
</div> 


<?php }}
else 
 {  
    
 ?>     
<div id="photodiv"> 
    
    <h4 style="text-align: center" >Please add photo to album <?php echo $data->album_name; ?></h4>
        <div id="imagetitle">
            <?php echo anchor('album/photos/'.$data->id,$data->album_name); ?> 
        </div>
            <a href="<?php echo base_url();?>index.php/album/delete_album/<?php echo $aid; ?> " id="<?php echo $aid; ?>" class="delbutton">
        <img src="<?php echo base_url();?>content/bnw/images/delete.png" id="close"/></a>
        
    
</div> 



 <?php    
 }}?> 
 


 <?php  }
 
   if ($this->session->userdata('logged_in')) ?>


</div>
<div class="clear"></div>
</div>
