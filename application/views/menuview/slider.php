<div class="fullRight">
    <div class="slider">
               <div id="wowSlider">
                        <div class="ws_images"><ul>
                                <?php foreach ($slidequery as $data) {
                                    ?>  
                                
                                <li><div class='ws-title' ><?PHP echo $data->slide_name."<br/>".$data->slide_content; ?></div> <img src="<?php echo base_url(); ?>content/uploads/images/<?php echo $data->slide_image; ?>" /> </li> <?php } ?>
                            </ul>
                        </div>
                        
                    </div>
    
    </div>
    
    
    