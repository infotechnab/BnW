<?php
    $this->load->helper('footer_helper'); 
     $type = get_gadget_footer();
?>

<div id="footer">
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
        
         echo "<a href='#'>".$recent_post->post_title."</a>"."<br>"; 
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
    ?>
    </div>
    
    
    
                <div  id="copyright">  Copyright &copy;  2013. B&W </div> 

                <div class="credit"> Designed By: 
                    <img src="<?php echo base_url(); ?>content/images/salyaniTech.png" alt="salyani logo"  /> 
                </div>
                <div class="clear" > </div>
            </div>
        </div>
    </body>
</html>