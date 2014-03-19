<?php foreach ($selectedpagequery as $page) {
                    ?>
                    <div class="container">
                        <div class="containerHeader">
                            <h3> <?php echo $page->page_name ; ?> </h3>
                            
                        </div>
                        <div class="content">

                            <p class="paragraph"><?php echo $page->page_content; ?></p>        
                        </div>
                    </div> 

                <?php } ?>
            </div>

            <div class="clear"></div>
            <!class full is closed here>