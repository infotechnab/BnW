<?php
    $this->load->helper('footer_helper'); 
     $type = get_gadget_footer();
?>


    <div id="footer">
        
     <div style="alignment-adjust: central">
    
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
        <div class="clear"></div>   
        
        
        
        
                <div  id="copyright">  Copyright &copy;  2013. B&W </div> 

                <div class="credit"> Designed By: 
                    <img src="<?php echo base_url(); ?>content/images/salyaniTech.png" alt="salyani logo"  /> 
                </div>
                <div class="clear" > </div>
            </div>
        </div>
    </body>
</html>