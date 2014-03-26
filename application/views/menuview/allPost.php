<?php foreach ($selectedpostquery as $post) {
                    ?>
                    <div class="container">
                        <div class="containerHeader">
                            <h3> <?php echo $post->post_title ; ?> </h3>
                            
                        </div>
                        <div class="content">

                            <p class="paragraph"><?php echo $post->post_content; ?></p>        
                        </div>
                        
                        
   <?php if($post->allow_comment == 1)
     {
    echo 'comment allowed';
     }
 else {
    echo 'comment not allowed';    
    }

    ?>
                        
                        
                    </div> 

                <?php } ?>



            </div>

            <div class="clear"></div>
            <!class full is closed here>