   <div class="titlebar">
       <h1 class="titlebarHeading">Introduction</h1> 
       </div>


<div style="padding: 2% 5% 2% 5%;">
      <?php foreach($pagequery as $sucess) { ?>  
      
        <div style="width: 100%;">
         
            <div class="panel-heading">
                <h4 style="font-size: 24px;"><?php echo $sucess->page_content; ?></h4>
            </div>
            
        </div>
  <?php } ?>
      </div>