<div class="fullRight">
                <div class="slider">
                    <!-- Start WOWSlider.com BODY section -->
                    <div id="wowSlider">
                        <div id="wowslider-container1">
                        <div class="ws_images"><ul>
                                <?php foreach ($slidequery as $data) {
                                    ?>           
                                <li> <img src="<?php echo base_url(); ?>content/images/<?php echo $data->slide_image; ?>" /> <?PHP echo $data->slide_name."<br/>".$data->slide_content; ?><li></li> <?php } ?>
                            </ul>
                        </div>
                        </div> 
                    </div>
                    <script type="text/javascript" src="<?php echo base_url(); ?>content/engine1/wowslider.js"></script>
                    <script type="text/javascript" src="<?php echo base_url(); ?>content/engine1/script.js"></script>
                    <!-- End WOWSlider.com BODY section --> 

                </div>
                