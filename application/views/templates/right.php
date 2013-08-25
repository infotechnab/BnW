<?php foreach ($query as $data)
{
    $pid = $data->pid;
    $tital = $data->title;
    $body = $data->body;
    $image = $data->image;
}?>         
<div class="full-right">
<div class="slider" id="div">
   <!-- Start WOWSlider.com BODY section -->
	<div id="wowslider-container1">
	<div class="ws_images"><ul>
   <?php foreach ($slider as $data)
   { ?>           
<li><img src="<?php echo base_url(); ?>slider/<?php echo $data->image; ?>" alt="<?php echo $data->title; ?>" title="<?php echo $data->title; ?>" class="wows1_0"/></li> <?php } ?>
</ul>
        </div>
	<div class="ws_shadow"></div>
	</div>
	<script type="text/javascript" src="<?php echo base_url(); ?>content/engine1/wowslider.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>content/engine1/script.js"></script>
	<!-- End WOWSlider.com BODY section --> 
</div>
<div class="content">
  <div class="title-name">
  <h3> <?php echo $tital; ?> </h3>
  </div>
    <div class="page-pragraph">
<?php if((isset($image)) && (trim($image) !=='') && ($image !==0))
{ ?>
    <img src="<?php echo base_url();?>uploads/<?php echo $image; ?>" alt="<?php echo $tital; ?>" />
<?php } ?>    
    <p class="para"><?php echo $body; ?></p>        
</div>
</div> 
</div>    
<!--//======full div close=========//-->
</div>
<div class="clear" > </div>
<div id="footer">
                 <div  id="copyright">  Copyright &copy;  2013. Universal Office Suppliers  </div> 
            
        <div class="credit"> Designed By: 
            <img src="<?php echo base_url(); ?>content/images/salyaniTech.png" alt="salyani logo"  /> 
        </div>
            <div class="clear" > </div>
</div>
</body>
</html>