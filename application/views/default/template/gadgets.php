






<?php if(!empty($gadget)){ ?>
<footer id="footer">
            <div class="container">

                <div class="row">
 <?php   foreach($gadget as $info) { 
        if ($info->display == "Footer") {?>
    <div class="col-md-3 col-sm-6 margin30">
        <div class="footer-col"><h3><?php echo $info->name; ?></h3>
            <ul class="list-unstyled contact">
                
                <li><p class='bold'> <?php echo $info->type; ?> </p></li>
                
                
            </ul>
        
        
        </div>
        
    </div>
    <?php } } ?>
 </div>
                
            </div>
        </footer>

 <?php } ?>
