</div>  <!--close of main div-->
<div class="clear"></div>



<div class="footer">
    <?php 
    foreach($gadget as $info) { 
        if ($info->display == "Footer") {?>
    <div class="box footer_box"> 
        <div class="footer_heading"><?php echo $info->name; ?></div>
        <div class="footer_content">
            <?php echo $info->type; ?>
        </div>
    </div>
    <?php } } ?>
    <div class="clear"></div>
    
    <div class="copyright"> &COPY; 2002-2014 Central College Inc. All rights reserved.<br>
        Powered by <b>SALYANI</b>
</div>
    
</div> 

</div>

</body>
</html>