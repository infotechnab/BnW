<div class="rightSide">
    
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
       <h3>Basic Details</h3>
       <table border="1" cellpadding="10">  
         <tr><td width="100"> User Name </td><td width="200"><?php echo $data->user_name ?></td>
         </tr>
         <tr><td> First Name </td><td><?php echo $data->user_fname ?></td>
         </tr>
         <tr><td> Last Name </td><td><?php echo $data->user_lname ?></td>
         </tr>
         <tr><td> Full Name </td><td><?php echo $data->user_fname." ".$data->user_lname; ?></td>
         </tr>
        </table> 
       <br/>
       <h3>Contact Details</h3>
        <table border="1" cellpadding="10">  
         <tr><td width="100"> Email </td><td width="200"><?php echo $data->user_email ?></td>
         </tr>
         <tr><td> Phone </td><td></td>
         </tr>
         <tr><td> Mobile </td><td></td>
         </tr>
         
        </table>   
    
           
        
            <?php    
            }
        }
    ?>
    
   
</div>
</div>
<div class="clear"></div>
</div>

