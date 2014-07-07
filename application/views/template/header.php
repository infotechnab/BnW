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
                <div class="header">
                    <h1> B&W </h1>
                </div>

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
                        <?php
                        $event[] = array(array('id'=>1, 'title'=>"news and events"),array('id'=>2, 'title'=>"news and events"),
                            array('id'=>3, 'title'=>"news and events"), array('id'=>4, 'title'=>"news and events"));
                        foreach ($event as $data) {
                             foreach($data as $singleArray){
                            ?>
                            <div class="newNews"><?php $singleArray['id']; ?> </div>
                            <p class="paragraph">
                                <?php echo $singleArray['title']; ?>
                            </p>
                            <p class="paragraph" > <?php echo anchor('view/index/', 'more'); ?> </p>
                            <hr/> <?php }} ?>
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
                                <?php foreach ($slider as $data) {
                                    ?>           
                                    <li> <img src="<?php echo base_url(); ?>slider/DSC03734.jpg" alt="<?php echo $data->title; ?>" title="<?php echo $data->title; ?>" class="wows1_0"/> </li> <?php } ?>
                            </ul>
                        </div>
                        <div class="ws_shadow"></div>
                    </div>
                    <script type="text/javascript" src="<?php echo base_url(); ?>content/engine1/wowslider.js"></script>
                    <script type="text/javascript" src="<?php echo base_url(); ?>content/engine1/script.js"></script>
                    <!-- End WOWSlider.com BODY section --> 

                </div>
                <?php foreach ($query as $data) {
                    ?>
                    <div class="container">
                        <div class="containerHeader">
                            <h3> <?php echo $data->page_name . "-" . $data->id; ?> </h3>
                        </div>
                        <div class="content">

                            <p class="paragraph"><?php echo $data->page_content; ?></p>        
                        </div>
                    </div> 

                <?php } ?>
            </div>

            <div class="clear"></div>
            <!class full is closed here>
            <div id="footer">
                <div  id="copyright">  Copyright &copy;  2013. B&W </div> 

                <div class="credit"> Designed By: 
                    <img src="<?php echo base_url(); ?>content/uploads/images/salyaniTech.png" alt="salyani logo"  /> 
                </div>
                <div class="clear" > </div>
            </div>
        </div>
    </body>
</html>