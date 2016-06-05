<div class=" col-md-10 col-sm-10 col-lg-10 col-xs-10 rightSide">
    
<div id="body">
    <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
    
    <?php
    
    
        if($query){
            foreach ($query as $data){
            ?>
       <h2>Dear <?php echo $data->user_name ?>, Your profile details are listed below.</h2> 
       <hr class="hr-gradient"/>
       <h3 style="text-decoration:underline;">Basic Details</h3>
       <br>
       <div clas="row">
    <div class="col-md-5 col-lg-5 col-sm-5">
       <table class="table table-bordered " style="width:400px;margin-top:-12px;"> 
         <tr><th style="width:150px;"> User Name </th><td><?php echo $data->user_name ?></td>
         </tr>
         <tr><th> First Name </th><td><?php echo $data->user_fname ?></td>
         </tr>
         <tr><th> Last Name </th><td><?php echo $data->user_lname ?></td>
         </tr>
         <tr><th> Full Name </th><td><?php echo $data->user_fname." ".$data->user_lname; ?></td>
         </tr>
        </table> 
     
       <h3 style="text-decoration:underline;">Contact Details</h3>
         <br>
        <table class="table table-bordered" style="width:400px;;margin-top:-12px;">  
         <tr><th  style="width:150px;"> Email </th><td width="200"><?php echo $data->user_email ?></td>
         </tr>
        </table> 
        </div>
    <div class="col-md-5 col-lg-5 col-sm-5">
        <img class="img-responsive img-rounded" style="margin-left:15px;border:1px solid #ccc;" height="400" width="500" alt="currently image is not aivlalabe">
      </div> 
      </div>
    
           
        
            <?php    
            }
        }
    ?>
    
   
</div>
</div>
</div>
