      
    
    
 
<div class="main">
  
 
   <div id="myCarousel" class="carousel slide">
            

          <div class="carousel-inner">  
        <?php foreach($slidequery as $sliderimg) {?>
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

 <script src="<?php echo base_url().'content2/carousel.js'; ?>"></script>

    
  </div>

    
    
    
    
    
    
    
    
    
    
    
    

 
   <div class="content" style="height: 600px;">
       <div style="margin: 0 auto 0 auto; width: 100%; text-align: center;padding: 15px 0px 0px 0px; height: 100px;">
       <h1 style="margin: 0 auto 0 auto; opacity: 0.7; color: #fff; font-weight: 100;">Are You Bored off Using Bulky PHP Codes?</h1> 
       <h2 style="margin: 0 auto 0 auto; opacity: 0.7; color: #fff; font-weight: 100;">Let's Use BnW for simplicity.</h2></div>
   <?php foreach($postquery as $sucess) { ?>
        <div class="part">
            <div class="circle"><img src="<?php echo base_url().'content/uploads/images/'.$sucess->image; ?>" height="150" width="150"></div>
            <div class="summary"><?php echo $sucess->post_summary; ?></div>
            <div class="details"><span><b>View More </b>&rsaquo;&rsaquo;</span></div>
        </div>  
       
   <?php } ?>
    </div>
<div class="clear"></div>
    
   
    



