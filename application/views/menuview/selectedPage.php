<?php foreach ($selectedpagequery as $page) {
                    ?>
                    <div class="container">
                        <div class="containerHeader">
                            <h3> <?php echo $page->page_name ; ?> </h3>
                            
                        </div>
                        <div class="content">

                            <p class="paragraph"><?php echo $page->page_content; ?></p>        
                        </div>
                        
       <div class="comment">                    
   <?php foreach ($commentallowquery as $data) {
                    ?>
                       
    <?php if($data->description==1)
    {
     echo 'allowed for all';                   
    }
        else {
            if($page->allow_comment==1)
            {
         echo 'allowed for this post';
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