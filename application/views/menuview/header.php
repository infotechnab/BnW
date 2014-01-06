<!DOCTYPE HTML>
<html>
<head>
<?php foreach ($query as $data)
 {
     $pageTitle = $data->title;
 }
?>
<title>
    <?php if(isset($pageTitle))
{echo $pageTitle.' ' .'-'.' '.'B&W' ;}
else
{echo $pageTitle = 'B&W';}
?>
</title>
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
        <!--<div class="search">
<script>
  (function() {
    var cx = '003019572812212623629:ogxeyfn2ziy';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search> </gcse:search>
</div>-->
                <div class="menuItem">
                    <ul class="list">
                
                        <?php 
                            foreach ($query as $data)
                                {
     
                                    $listing = $data->listing;
                                    $title = $data->title;
                                    //$id= $data->id;
                                if($listing==0|| $listing=="" )
                            { ?>
                                <li class="parList"> <?php echo $data->title; } ?>
                                    
                        <?php         
                            $list = $this->viewmodel->get_sublist_title($title);
                                foreach ($list as $data)
                            {
                                $id= $data->p_id;
                            }?>
                                    
                                <ul class="subList"><?php
                                    $menu = $this->viewmodel->get_sublist($id);
                                    foreach ($menu as $data)
                                    {
                                    ?>                    
                                <li> <?php echo $data->title; ?> </li>
                                    <?php } ?>   
                                </ul> 
                            </li>
                        <?php } ?>              
                    </ul>
                    
                 </div>
        <div class="clear"></div>
        <div class="event">
            <div class="eventHeader">
                <h3>News and Events</h3>
            </div>
            <?php foreach ($event as $data)
            {
                $id = $data->id;
                $evtitle = $data->title;

                //$image = $data->image;
            ?>
            <div class="newNews"><?php echo $data->title; ?> </div>
            <p class="paragraph">    <?php
          $wordsreturned = 150;
          $string = $data->body;
          $retval =$string;
          if(strlen($string)<=$wordsreturned)
          {
              $retval = $string;
              echo strip_tags($retval);
          }
          else 
          {
              $retval = Substr($string,0,$wordsreturned);
              $retval = $retval.".. "."";
              ?>
          <?php echo strip_tags($retval); 
          
          } ?></p>
            <p class="paragraph" > <?php echo anchor('view/index/'.$id,'more','style="color:green;"'); ?> </p> <hr/> <?php } ?>
            </div>
        <div class="clear"></div>
        <div class="download">
            <div class="downloadHeader"><h3> Downloads </h3></div>
            <div>
                <?php foreach ($download as $data)
            { ?>
                <div class="paragraph">
                    <b> Download Files </b> <br/> <a href="<?php echo base_url(); ?>downloads/<?php echo $data->image; ?>" > <?php echo $data->title;?> </a>  </p>
            <?php
            } ?>
                </div>
            </div>
        </div>
        </div>
            <div class="clear"></div>
                  
            <div class="fullRight">
                <div class="slider">
                    <!-- Start WOWSlider.com BODY section -->
                    <div id="wowSlider">
                    <div class="ws_images"><ul>
                        <?php foreach ($slider as $data)
                            { ?>           
                    <li> <img src="<?php echo base_url(); ?>slider/DSC03734.jpg" alt="<?php echo $data->title; ?>" title="<?php echo $data->title; ?>" class="wows1_0"/> </li> <?php } ?>
                        </ul>
                    </div>
	<div class="ws_shadow"></div>
	</div>
	<script type="text/javascript" src="<?php echo base_url(); ?>content/engine1/wowslider.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>content/engine1/script.js"></script>
	<!-- End WOWSlider.com BODY section --> 

                </div>
                <div class="container">
                    <div class="containerHeader">
                        <h3> Page <?php// echo $tital; ?> </h3>
                    </div>
                    <div class="content">
                    <?php //if((isset($image)) && (trim($image) !=='') && ($image !==0))
                    //{ ?>
                <!-- <img src="<?php// echo base_url();?>uploads/<?php// echo $image; ?>" alt="<?php// echo $tital; ?>" /> -->
                    <?php// } ?>    
                        <p class="paragraph"> This is Content Display View<?php// echo $body; ?></p>        
                    </div>
                </div> 
            </div>
            
        </div>
        <!class full is closed here>
        <div id="footer">
                 <div  id="copyright">  Copyright &copy;  2013. B&W </div> 
            
                <div class="credit"> Designed By: 
                    <img src="<?php echo base_url(); ?>content/images/salyaniTech.png" alt="salyani logo"  /> 
                </div>
            <div class="clear" > </div>
        </div>
    </body>
</html>