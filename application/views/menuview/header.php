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
                                <li class="par-list"> <?php echo $data->title; } ?>
                                    
                        <?php         
                            $list = $this->viewmodel->get_sublist_title($title);
                                foreach ($list as $data)
                            {
                                $id= $data->p_id;
                            }?>
                                    
                                <ul class="sub-list"><?php
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
            </div>
            <div class="fullRight"></div>
            
        </div>
    </body>
</html>