<div class="fullRight">
    <div class="slider">
               <div id="wowSlider">
                        <div class="ws_images"><ul>
                                <?php foreach ($slidequery as $data) {
                                    ?>           
                                <li> <img src="<?php echo base_url(); ?>content/images/<?php echo $data->slide_image; ?>" /> <?PHP echo $data->slide_name."<br/>".$data->slide_content; ?><li></li> <?php } ?>
                            </ul>
                        </div>
                        
                    </div>
    
    </div>
    
    
    