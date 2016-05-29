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

<!-- start for Gadgets  -->
<div>
 <?php
    $this->load->helper('body_helper'); 
     $type = get_gadget_body();
?>

<div id="footer">
    <!--for default gadget start -->
    <?php
    foreach ($recentPost as $data)
    {
    if($data->display == 'Body')
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
    
    
    <div class="gadget_collection">
     <?php
        if(empty($type))  //checking whether $type is null or not that is coming from database and header_helper.php and if its null then handling error.
                {
                    echo " ";
                }
                else {
                    
                
        foreach ($type as $dat){ 
            if($dat['defaultGadget'] != 'recent post') {
     ?>
        <div class="subgadget">
        <div id='title'><?php echo $dat['name']; ?></div>
        <div id='description'><?php echo $dat['type']; ?> </div>
         </div>
    <?php        
            }
    }
                }
                
    ?>
    </div>
   
    
</div>
    <!-- end for Gadgets  -->


            <div class="clear"></div>
            <!class full is closed here>