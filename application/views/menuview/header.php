<!DOCTYPE HTML>
<html>
    <head>
        <?php foreach ($headertitle as $header) {
                    ?>
        <title><?php echo $header->description ; ?></title>
<?php } ?>
        <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>content/styles/stylesForView.css" type="text/css" />
        <?php if ($meta)
{
    $i=0;
    foreach ($meta as $data)
    {        
       $meta_data[$i] = $data->value;
       $i++;      
    }
 }
                    ?>
      
        <link rel="shortcut icon" href="<?php echo base_url().'content/images/'. $meta_data[4]; ?>" type="image/x-icon">
       
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="<?php echo base_url(); ?>content/engine1/jquery.js"></script>
        <link rel="icon" type="image/jpg" href="<?php echo base_url(); ?>content/images/bnw.jpg">
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
                    <img src="<?php echo base_url().'content/images/'.$header->description ; ?>" />
                </div>
                <?php } ?>
                
                <?php foreach ($headerdescription as $header) {
                    ?>
    
                <div class="header">
                    <p> <?php echo $header->description ; ?> </p>
                </div>
                <?php } ?>

                
                <div class="clear"></div>
                

            
            