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
        <div class="menu-item">
            <div class="menu-title">
                <div class="title-name">
                    
                </div>
            </div>
            <ul class="list">
                
                 <?php 
 foreach ($query as $data)
 {
     
     $listing = $data->listing;
     $title = $data->title;
     //$id= $data->id;
      if($listing==0|| $listing=="" )
     { ?>
                 <li class="par-list"> <?php echo $data->title; } ?>
        <?php         
                $list = $this->viewmodel->get_sublist_title($title);
                    foreach ($list as $data)
                 {         $id= $data->p_id;
                 }?>
                <ul class="sub-list"><?php
                         $menu = $this->viewmodel->get_sublist($id);
                         foreach ($menu as $data)
                         {
                           ?>                    
           <li> <?php echo $data->title; ?> </li> <?php } ?>   </ul> 
            </li>
                <?php } ?>              
            </ul>
        </div>
        <!--<div class="menu-item">
        <div class="title-name"> <h3> Quick Contact </h3> </div>
        <div class="quick-contact">
            <?php // foreach ($gadget as $data)
            { ?>
            <p class="n-body"> <b> <?php //echo $data->title;?> </b> : <?php //echo $data->body; ?></p>
            <?php
            } ?>
        </div>
        </div> -->
        <div class="menu-item">
            <div class="menu-title">
                <div class="title-name">
                    <h3> News and Events </h3>
                </div>
            </div>
            <?php foreach ($event as $data)
{
    $id = $data->id;
    $evtitle = $data->title;

    //$image = $data->image;
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
         <p class="n-body"> <?php echo anchor('view/index/'.$id,'more','style="color:green;"'); ?> </p> <hr/> <?php } ?>
        </div>
         <div class="menu-item">
        <div class="title-name"> <h3> Downloads </h3> </div>
        <div class="quick-contact">
            <?php foreach ($download as $data)
            { ?>
            <p class="n-body"> <b> Download Files </b> <br/> <a href="<?php echo base_url(); ?>downloads/<?php echo $data->image; ?>" > <?php echo $data->title;?> </a>  </p>
            <?php
            } ?>
        </div>
        </div>       
    </div>