<div id="pattern-3">
            <?php
if(!empty($albumquery)){ ?>
    <div class="container">
    <?php foreach ($albumquery as $data)
{
	$aid = $data->id;	
        
                  
	$result = $this->viewmodel->get_media_image($aid); 
        if($result)
        {
foreach( $result as $abc)
{
   ?> 
		 <a href="<?php echo base_url().'index.php/view/photo/'.$data->id ?>"><div class="col-md-3 col-sm-4 col-xs-6"><div class="thumbnail">
                             <img class="img-responsive" src="<?php echo base_url().'content/uploads/images/'.$abc->media_type; ?>" id="galleryimage" alt="..." />  
      <div class="caption">
        <h3> <?php echo $data->album_name; ?> </h3>
      </div>
    </div>
                     </div></a>
                    
<?php }}else 
 {  
    
 ?>   
         <a href="<?php echo base_url().'index.php/view/photo/'.$data->id ?>">
        <div class="col-sm-6 col-md-2">
    <div class="thumbnail">
       
        <div class="caption">
        <h3> <?php echo $data->album_name; ?>  </h3>
      </div>
    </div>
  </div>
         </a>
        
 <?php    
 }}

 ?> 
 <?php  }
   else{
     $this->load->view('gardenResort/errorPage');
 }?>               
                    
                    
                    
                    
        
    </div>
</div>
