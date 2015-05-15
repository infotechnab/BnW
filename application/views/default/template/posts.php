<div id="pattern-3">
    <?php if (!empty($selectedpostquery)){
foreach ($selectedpostquery as $post){ ?>
<div class="container">   
                
                    
                        
                        <div class="col-md-12">
                     <?php if(strlen($post->image>'0')){ ?><img class='news-event-page-image' src="<?php echo base_url().'content/uploads/images/'.$post->image; ?>" alt=""/> <?php } ?>  
                            <div class="lib-row lib-desc">
                                <p><?php echo $post->post_content; ?></p>
                            </div>
                        </div>
                    
                
            
        
</div>
    <?php }} else {
         $this->load->view('default/template/errorPage');
    } ?>
</div>
