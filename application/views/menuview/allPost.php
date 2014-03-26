<?php foreach ($selectedpostquery as $post) {
                    ?>
                    <div class="container">
                        <div class="containerHeader">
                            <h3> <?php echo $post->post_title ; ?> </h3>
                            
                        </div>
                        <div class="content">

                            <p class="paragraph"><?php echo $post->post_content; ?></p>        
                        </div>
                        
                        <div class="comment">                    
   <?php foreach ($commentallowquery as $data) {
                    ?>
                       
    <?php if($data->description==1)
    {
     echo 'allowed for all';                   
    }
 else {
     if($post->allow_comment==1)
     {
         echo 'allowed for this post';
     }
 else {
         echo 'for this not allowed ';    
     }
     
       
    }
                        
                        
       ?>                  
                
                <?php } ?>                   
                        
   
                        </div>         
                        
                    </div> 

                <?php } ?>



            </div>

            <div class="clear"></div>
            <!class full is closed here>