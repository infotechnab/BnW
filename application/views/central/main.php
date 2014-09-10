      
    
    
 
<div class="main">
  
 
    <div id="myCarousel" class="carousel slide" style="margin-top: 10px;">
            

          <div class="carousel-inner">  
        
         <div class="active item">
             <img src="<?php echo base_url().'content1/images/2.jpg'; ?>">
             <div class="carousel-caption">
                 <h3>Caption1</h3>
                 <p>This is just description</p>
             </div>
         </div>
         <div class="item">
             <img src="<?php echo base_url().'content1/images/3.jpg'; ?>">
              <div class="carousel-caption">
                 <h3>Caption2</h3>
                 <p>This is just description.This is just description</p>
             </div>
         </div>
         <div class="item">
             <img src="<?php echo base_url().'content1/images/4.jpg'; ?>">
          <div class="carousel-caption">
                 <h3>Caption3</h3>
                 <p>This is just description.This is just description.This is just description</p>
             </div>
         </div>
  </div>    
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>  
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>  
</div>  


    
    <script src="<?php echo base_url().'content1/carousel.js'; ?>"></script>
    
  
    
    
    
    
    
    
    
    
    
    
    
    
    
    <div class="arrow1"></div> 
 
   <div class="content">
      
   <?php for($i=0;$i<3;$i++) {?>
        <div class="part">
            <div class="circle"></div>
            <div class="summary">Check the address for typing errors such as ww.example.com instead of www.example.com
If you are unable to load any pages, check your computer's network connection.
If your computer or network is protected by a firewall or proxy, make sure that Firefox is permitted to access the Web.</div>
            <div class="details"><span><b>View More </b>&rsaquo;&rsaquo;</span></div>
        </div>  
       
   <?php } ?>
    </div>
    <div class="clear"></div>
   
</div>
    
    <div class="arrow"></div>



