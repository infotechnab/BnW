   <div id="myCarousel" class="carousel slide" style="margin-top: 10px;">
            

          <div class="carousel-inner">  
        <?php foreach($slidequery as $sliderimg) { ?>
           <div class="item">
             <img src="<?php echo base_url().'content/uploads/sliderImages/'.$sliderimg->slide_image; ?>" width="100%" height="100%">
          <div class="carousel-caption">
                 <h3><?php echo $sliderimg->slide_name; ?></h3>
                 <p><?php echo $sliderimg->slide_content ?></p>
             </div>
         </div>
        <?php } ?>
  </div>    
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>  
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>  
</div>  


    
    <script src="<?php echo base_url().'content/uploads/scripts/carousel.js'; ?>"></script>
    
  
    
    
    
    
    
    
    
    
    
    
    
    
    
    <div class="arrow1"></div> 
 
   <div class="content">
      
   <?php for($i=0;$i<3;$i++) {?>
        <div class="part">
            <div class="title">Title</div>
            <img src="<?php echo base_url().'content/uploads/images/facilityImg/2.png' ?>" class="img-circle">
            <div class="summary">Check the address for typing errors such as ww.example.com instead of www.example.com
If you are unable to load any pages, check your computer's network connection.
If your computer or network is protected by a firewall or proxy, make sure that Firefox is permitted to access the Web.</div>
            <div class="details"><span><b>View More </b>&rsaquo;&rsaquo;</span></div>
        </div>  
       
   <?php } ?>
    </div>
    <div class="clear"></div>
   
   
    
    
    
    <!--sucess story-->
    <div class="sucess-story">
    <div class="sucess-story-title">Sucessful Story</div>
      <?php foreach($postquery as $sucess) { ?>
    <div class="sucess-story-content">
      
        <div><img src="<?php echo base_url().'content/uploads/images/'.$sucess->image; ?>" height="200" width="150"></div>
        <div style="font-size: 12px;font-weight: bolder;color:#000;text-align: center; "><?php echo $sucess->post_title; ?></div>
        <div style="font-size: 12px;color:#990000;text-align: center;"><?php echo $sucess->post_content; ?></div>
    </div>
        <?php } ?>
    <div class="clear"></div>
    <div style="font-size: 16px;color: #fff;text-align: center;color:#fff;">
        <!--<a href="<?php echo base_url().'index.php/view/sucess_story';?>" style="color: #fff;">-->
            <b>Sell All &rsaquo;&rsaquo;</b>
    <!--</a>-->
    </div>
       

    </div>
<div class="arrow"></div>


