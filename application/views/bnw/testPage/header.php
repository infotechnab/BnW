<!DOCTYPE HTML>
<html>
    <head>
        <title>Test Page</title>
        <link rel="icon" type="image/jpg" href="<?php echo base_url(); ?>content/images/bnw.jpg">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="<?php echo base_url(); ?>content/engine1/jquery.js"></script>
    </head>
    <body>
        <div class="header">
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
          
            
            
            
        </div>
        
   