<div id="pattern-3">
    <?php if (!empty($selectedpostquery)){
foreach ($selectedpostquery as $post){ ?>
<div class="container">
	<div class="row">
            <h3 id="page-heading-top"><?php echo $post->post_title; ?></h3>
	</div>
    <hr>
                
            
                
                    
                        
                        <div class="col-md-12">
                     <?php if(strlen($post->image>'0')){ ?><img id='news-event-page-image' src="<?php echo base_url().'content/uploads/images/'.$post->image; ?>" alt=""/> <?php } ?>  
                            <div class="lib-row lib-desc">
                                <p><?php echo $post->post_content; ?></p>
                            </div>
                        </div>
                    
                
            
        
</div>
    <?php }} else {
         $this->load->view('gardenResort/errorPage');
    } ?>
</div>
