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
{echo $pageTitle.' ' .'-'.' '.'Universal Office Suppliers' ;}
else
{echo $pageTitle = 'Universal Office Suppliers';}
?>
</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>content/styles/me.css" type="text/css" />
    <link rel="shortcut icon" href="<?php echo base_url(); ?>content/images/favicon.ico" type="image/x-icon">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>content/engine1/style.css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>content/engine1/jquery.js"></script>
</head>
    <body>
<div class="full">
    <div class="full_left" >
        <div class="header">
            <!--<img src="<?php echo base_url();?>content/images/logo2.jpg" alt="universal logo" />-->
            <h1> Universal Office <br/>
                Suppliers </h1>
        </div>
        <div class="search">
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
</div>
        <div class="menu-item">
            <div class="menu-title">
                <div class="title-name">
                    
                </div>
            </div>
            <ul class="list">
                <li class="par-list"><?php echo anchor('view/page/1','Home'); ?></li>
                <li class="par-list">  <?php echo anchor('view/page/2','About Us'); ?>
                    <ul class="sub-list">
                        <li> <?php echo anchor('view/page/3','Mission/Vision'); ?></li>
                        <li> <?php echo anchor('view/page/4','Objective'); ?></li>
                    </ul>
                </li>
                <li class="par-list"> <a href="#">Products</a>
               <ul class="sub-list">
                    <li> <?php echo anchor('view/page/5','CCTV Surveillance System'); ?>  </li>
                    <li> <?php echo anchor('view/page/6','Note Counting'); ?></li>
                    <li> <?php echo anchor('view/page/7','Metal Detector'); ?></li>
                    <li> <?php echo anchor('view/page/8','Fake Note Detector'); ?></li>
                    <li> <?php echo anchor('view/page/9','Electronics Time Attendance'); ?></li>
                    <li> <?php echo anchor('view/page/10','ATM Paper Roll'); ?></li>
                    <li> <?php echo anchor('view/page/11','Fire Extinguisher'); ?></li>
                    <li> <?php echo anchor('view/page/12','Cheque Writer'); ?></li>
                    <li> <?php echo anchor('view/page/13','Queue Liner Poles'); ?></li>
                    <li> <?php echo anchor('view/page/14','EPABX'); ?></li>
                    <li> <?php echo anchor('view/page/15','Door Access System Lock'); ?></li>
                    <li> <?php echo anchor('view/page/16','Note Binding Machine'); ?></li>
                    <li> <?php echo anchor('view/page/17','Door Alarm'); ?></li>
                    <li> <?php echo anchor('view/page/18','Display Stand'); ?></li>
                </ul>
                     </li>
                <li class="par-list"> <?php echo anchor('view/page/19','Services'); ?>  </li>
                <li class="par-list"> <?php echo anchor('view/page/20','Contact Us'); ?>  </li>
            </ul>
        </div>
        <div class="menu-item">
        <div class="title-name"> <h3> Quick Contact </h3> </div>
        <div class="quick-contact">
            <?php foreach ($gadget as $data)
            { ?>
            <p class="n-body"> <b> <?php echo $data->title;?> </b> : <?php echo $data->body; ?></p>
            <?php
            } ?>
        </div>
        </div>
        <div class="menu-item">
            <div class="menu-title">
                <div class="title-name">
                    <h3> News and Events </h3>
                </div>
            </div>
            <?php foreach ($event as $data)
{
    $aid = $data->aid;
    $evtitle = $data->title;

    $image = $data->image;
?>
            <div class="sub-title-name"> <?php echo $data->title; ?> </div>
         <p class="n-body"> <?php
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
          
          } ?> </p>
         <p class="n-body"> <?php echo anchor('view/events/'.$aid,'more','style="color:green;"'); ?> </p> <hr/> <?php } ?>
        </div>
    
        
            
        
    </div>