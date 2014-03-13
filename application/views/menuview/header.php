<!DOCTYPE HTML>
<html>
    <head>
        <title>BnW</title>

        <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>content/styles/stylesForView.css" type="text/css" />
        <link rel="shortcut icon" href="<?php echo base_url(); ?>content/images/favicon.ico" type="image/x-icon">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="<?php echo base_url(); ?>content/engine1/jquery.js"></script>
    </head>
    <body>
        <div class="full">
            <div class="fullLeft">
                <?php foreach ($headertitle as $header) {
                    ?>
    
                <div class="header">
                    <h1> <?php echo $header->description ; ?> </h1>
                </div>
                <?php } ?>
                
                <?php foreach ($headerlogo as $header) {
                    ?>
    
                <div class="header">
                    <h4> <?php echo $header->description ; ?> </h4>
                </div>
                <?php } ?>
                
                <?php foreach ($headerdescription as $header) {
                    ?>
    
                <div class="header">
                    <p> <?php echo $header->description ; ?> </p>
                </div>
                <?php } ?>

                <div class="menuItem">
                    <ul class="list">
                                            
        <?php

            $this->load->helper('myHelper');

            fetch_menu (query(0));

        ?>
                    </ul>

                </div>
                <div class="clear"></div>
                <div class="eventAndDownload">
                    
                    
                    <div class="event">
                        <div class="eventHeader">
                            <h3>News and Events</h3>
                        </div>
                        <?php foreach($pagequery as $summary){
                    ?>
                            <div class="newNews"></div>
                            <p class="paragraph">
                                <?php echo $summary->page_summary ?>
                            </p>
                            <p class="paragraph" > <?php echo anchor('view/index/', 'more'); ?> </p>
                            <hr/> 
                            <?php } ?>
                    </div>
                    
                    <div class="download">
                        <div class="downloadHeader"><h3> Downloads </h3></div>
                        <div>

                            <div class="paragraph">
                                <p><b> Download Files </b> <br/> <a href="downloads/" > Downlaod</a>  </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>      


            <div class="fullRight">
                <div class="slider">
                    <!-- Start WOWSlider.com BODY section -->
                    <div id="wowSlider">
                        <div class="ws_images"><ul>
                                <?php foreach ($slidequery as $data) {
                                    ?>           
                                    <li> <img src="<?php echo base_url(); ?>content/images/<?php echo $data->slide_image; ?>" /> </li> <?php } ?>
                            </ul>
                        </div>
                        
                    </div>
                    <script type="text/javascript" src="<?php echo base_url(); ?>content/engine1/wowslider.js"></script>
                    <script type="text/javascript" src="<?php echo base_url(); ?>content/engine1/script.js"></script>
                    <!-- End WOWSlider.com BODY section --> 

                </div>
                <?php foreach ($pagequery as $page) {
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
            <div id="footer">
                <div  id="copyright">  Copyright &copy;  2013. B&W </div> 

                <div class="credit"> Designed By: 
                    <img src="<?php echo base_url(); ?>content/images/salyaniTech.png" alt="salyani logo"  /> 
                </div>
                <div class="clear" > </div>
            </div>
        </div>
    </body>
</html>