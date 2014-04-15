
                 
                    <div class="container">
                        <div class="containerHeader">
                            <h3> Available Download Files </h3>
                            
                        </div>
                        <?php foreach ($mediaquery as $page) {   
                        $filename = $page->media_type; ?>
                         


                       
                        <a href="<?php echo base_url().'index.php/view/download/?download='.$filename; ?>" ><?php echo $filename;  ?></a><br/>

                     <?php   } ?>
                    </div> 

                
            </div>

            <div class="clear"></div>
            <!class full is closed here>