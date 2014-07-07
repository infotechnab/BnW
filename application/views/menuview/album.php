<?php
if($albumquery){
foreach ($albumquery as $data)
{
	$aid = $data->id;	
        
                  
	$result = $this->viewmodel->get_media_image($aid); 
        if($result)
        {
foreach( $result as $abc)
{
   ?> 
    

<div id="photodiv">
   
    

    <img src="<?php echo base_url(); ?>content/uploads/images/<?php echo $abc->media_type; ?>" id="galleryimage" />
        <div id="imagetitle">
            <?php echo anchor('view/photo/'.$data->id,$data->album_name); ?> 
        </div>
            <a href="<?php echo base_url();?>index.php/album/delete_album/<?php echo $aid; ?> " id="<?php echo $aid; ?>" class="delbutton">
        <img src="<?php echo base_url();?>content/bmw/images/delete.png" id="close"/></a>
        
    
</div> 


<?php }}
else 
 {  
    
 ?>     
<div id="photodiv"> 
    
   
        <div id="imagetitle">
            <?php echo anchor('view/photo/'.$data->id,$data->album_name); ?> 
        </div>
            <a href="<?php echo base_url();?>index.php/album/delete_album/<?php echo $aid; ?> " id="<?php echo $aid; ?>" class="delbutton">
        <img src="<?php echo base_url();?>content/bnw/images/delete.png" id="close"/></a>
        
    
</div> 



 <?php    
 }}?> 
 <?php  } ?>
            </div>

            <div class="clear"></div>
            <!class full is closed here>