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
        <link rel="shortcut icon" href="<?php echo base_url().'content/uploads/images/'. $meta_data[4]; ?>" type="image/x-icon">
       
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="<?php echo base_url(); ?>content/engine1/jquery.js"></script>
<!--        <link rel="icon" type="image/jpg" href="<?php echo base_url(); ?>content/images/bnw.jpg">-->
    </head>
    <body>
        
        <div class="full">
            
            <div  class="fullLeft">
    <?php foreach ($headerColor as $bgcolor) {
                    ?>        
                <div style="background-color: <?php echo $bgcolor->description ; ?>" >
    <?php foreach ($headertitle as $header) {
                    ?>
                
                <div class="header">
                    <h1> <?php echo $header->description ; ?> </h1>
                </div>
                <?php } ?>
                
                <?php foreach ($headerlogo as $header) {
                    ?>
    
                <div class="header">
                    <img src="<?php echo base_url().'content/uploads/images/'.$header->description ; ?>" width="150" height="150" />
                </div>
                <?php } ?>
                
                <?php foreach ($headerdescription as $header) {
                    ?>
    
                <div class="header">
                    <p> <?php echo $header->description ; ?> </p>
            </div>
                    
                  <?php } ?>  
                                
                <!-- For diplaying gadgets -->
            <?php
            $this->load->helper('header_helper'); 
             $type = get_gadget_header();
             //var_dump($type);
            ?>
 <!--for default gadget start -->


    <?php
    foreach ($recentPost as $data)
    {
    if($data->display == 'Footer')
    {
        ?>
             <div class="subgadget">
        <div id='title'><?php echo $data->name; ?></div>
          <div id='description'>
        <?php
          foreach($noOfRecentPost as $recent_post)
         {
             // var_dump($recent_post);
        $post_id = $recent_post->id;
        
        echo anchor('view/post/'.$post_id , $recent_post->post_title)."<br>"; 
         }
         ?>
          </div>  
             </div>
         <?php
            }
           }
        
    ?>
    <!--for default gadget close -->
    
    
    <div >
     <?php
        if(empty($type))  //checking whether $type is null or not that is coming from database and header_helper.php and if its null then handling error.
                {
                    echo " ";
                }
                else {
                    
                
        foreach ($type as $dat){ 
            if($dat['defaultGadget'] != 'recent post') {
     ?>
        <div >
        <div id='title'><?php echo $dat['name']; ?></div>
        <div id='description'><?php echo $dat['type']; ?> </div>
         </div>
    <?php        
            }
    }
                }
                
    ?>
    </div>
    
            <!-- For diplaying gadgets -->
    
                
                
       </div>         
                <?php } ?>

                <div class="clear"></div>
                

            
            