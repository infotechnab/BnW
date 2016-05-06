<div id="pattern-3">
    <?php if(!empty($singleEvent)){ foreach($singleEvent as $even) {?>
<div class="container">
    
    <div class="col-md-12" style="text-align: center;"><h5>
                <span class="icon-calendar"></span>
                     <?php
                     $timestamp = strtotime($even->start_date);
                    echo date('Y-m-d', $timestamp);   ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="icon-alarm2"></span>
                     <?php
                    echo date('h:i a', $timestamp);   ?>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="icon-location"></span><?php echo $even->location; ?>
              </h5></div>
         <div class="row">
        <?php if(strlen($even->image>'0')){ ?><img class='news-event-page-image' src="<?php echo base_url().'content/uploads/images/'.$even->image; ?>" alt="" /><?php } ?>
        
       
               
                    <p><?php echo $even->details; ?></p>
        
        
        
    </div>
         
         
         
          
              <div class=" clearfix"></div> 
        </div>

  <?php    } }  else {
      $this->load->view('default/template/errorPage');
 }   ?>
</div>

