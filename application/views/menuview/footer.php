<div id="footer">
    <div id="footer_gadget_collection">
    
        
     <?php
        foreach ($gadget as $dat){ 
     ?>
        
    <?php
    if($dat->display == 'Footer' && $dat->setting == '1')
    {
    ?>
        <div id="footer_subgadget">
        <div id='title'><?php echo $dat->name; ?></div>
        <div id='description'><?php echo $dat->type; ?> </div>
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