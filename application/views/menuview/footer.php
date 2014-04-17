<?php
    $this->load->helper('footer_helper'); 
     $type = get_gadget_footer();
?>



<div id="footer">
    <div class="gadget_collection">
    
        
     <?php
        foreach ($type as $dat){ 
     ?>
        <div class="subgadget">
        <div id='title'><?php echo $dat['name']; ?></div>
        <div id='description'><?php echo $dat['type']; ?> </div>
         </div>
    <?php        
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