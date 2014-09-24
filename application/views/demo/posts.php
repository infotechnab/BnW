
<div class="content" style="display: inline-block; padding: 5%;">
     <h1 class="titlebarHeading">Features</h1>  
       
       
    <style>
.price {
  font-size: 4em;
}

.price-cents {
  vertical-align: super;
  font-size: 50%;
}

.price-month {
  font-size: 35%;
  font-style: italic;
}
.panel {
-webkit-transition-property : scale; 
-webkit-transition-duration : 0.2s; 
-webkit-transition-timing-function : ease-in-out; 
-moz-transition : all 0.2s ease-in-out;  
}

.panel:hover {
box-shadow: 0 0 10px rgba(0,0,0,.5);
-moz-box-shadow: 0 0 10px rgba(0,0,0,.5);
-webkit-box-shadow: 0 0 10px rgba(0,0,0,.5);
-webkit-transform: scale(1.05);
-moz-transform: scale(1.05);
}
</style> 

    <div class="row">
      <?php foreach($postquery as $sucess) { ?>  
        
      
       
     
     
      
       
        <div class="col-sm-3">
          <div class="panel panel-default text-center">
              <div class="panel-body">
              <h3><?php echo $sucess->post_title; ?></h3>
            </div>
            <div class="panel-heading">
              <div class="circle"><img src="<?php echo base_url().'content/uploads/images/'.$sucess->image; ?>" height="150" width="150"></div>
            </div>
            
            <ul class="list-group">
              <li class="list-group-item"><?php echo $sucess->post_summary; ?></li>
              <li class="list-group-item"><?php echo 'view more'; ?></li>
            </ul>
          </div>          
        </div>
  <?php } ?>
      </div>   
       
  
    </div>
<div class="clear"></div>