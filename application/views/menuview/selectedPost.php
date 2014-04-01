<?php foreach ($selectedpostquery as $post) {
                    ?>
                    <div class="container">
                        <div class="containerHeader">
                            <h3> <?php echo $post->post_title ; ?> </h3>
                            
                        </div>
                        <div class="content">

                            <p class="paragraph"><?php echo $post->post_content; ?></p>        
                        </div>
       <!--comment button and show comment-->                 
                        <div class="comment">                    
   <?php foreach ($commentallowquery as $data) {
                    ?>
                       
    <?php if($data->description==1)
    { 
        //================ IF ALL ALLOW COMMENT ================//
        ?>
                            
    
     
      
     
                
    <?php }
 else {
     if($post->allow_comment==1)
     {
         //============== IF ONE POST ALLOW ==========//
         ?>
         
    
    
   
  
     <?php }
       
    }
                        
                        
       ?>                  
                
                <?php } ?>                      
   
                        </div> 
     
      <!--comment button closed -->
     
         <!--like button-->                 
                        <div class="comment">                    
   <?php foreach ($likeallowquery as $data) {
                    ?>
                       
    <?php if($data->description==1)
    { 
        //================ IF ALL ALLOW COMMENT ================//
        ?>
                            
    
     
      
     
                
    <?php }
 else {
     if($post->allow_comment==1)
     {
         //============== IF ONE POST ALLOW ==========//
         ?>
         
    
    
   
  
     <?php }
       
    }
                        
                        
       ?>                  
                
                <?php } ?>                      
   
                        </div> 
     
      <!--like button closed -->
                    
       <!--share button -->                 
                        <div class="comment">                    
   <?php foreach ($shareallowquery as $data) {
                    ?>
                       
    <?php if($data->description==1)
    { 
        //================ IF ALL ALLOW COMMENT ================//
        ?>
                            
    
     
      
     
                
    <?php }
 else {
     if($post->allow_comment==1)
     {
         //============== IF ONE POST ALLOW ==========//
         ?>
         
    
    
   
  
     <?php }
       
    }
                        
                        
       ?>                  
                
                <?php } ?>                      
   
                        </div> 
     
      <!--share button closed -->
     
                    </div> 

                <?php } ?>



            </div>

            <div class="clear"></div>
            <!class full is closed here>