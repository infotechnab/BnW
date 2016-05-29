        
<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">
  <h2 id="titleinfo">Dashboard >> Home</h2> 
  <hr class="hr-gradient"/>
  <h1 id="secondtitle">Welcome to Dashboard</h1>
  <div class="row">

   
    <a class="col-lg-3 col-md-3 col-sm-3 col-xs-3" href="<?php echo base_url('page/pages'); ?>">
      <div class="well"><?php echo $page; ?>
        <br>
        Page
      </div>
    </a>
    
    <a class="col-lg-3 col-md-3 col-sm-3 col-xs-3"  href="<?php echo base_url('offers/posts'); ?>"> 
      <div class="well">
        <?php echo $post; ?>
        <br>
        POST
      </div></a>

      <a class="col-lg-3 col-md-3 col-sm-3 col-xs-3" href="<?php echo base_url('events/allevents'); ?>"> 
       <div class="well">
         <?php echo $events; ?>
         <br>
         EVENTS
       </div>
     </a>

     <a class="col-lg-3 col-md-3 col-sm-3 col-xs-3" href="<?php echo base_url('events/allevents'); ?>">
       <div class="well">
         <?php echo $news; ?>
         <br>

         NEWS
       </div>
     </a>
     
   </div>
   <div>
    

   </div>
 </div>
 