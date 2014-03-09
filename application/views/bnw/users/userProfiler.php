<div class="rightSide">
    
<div id="body">
    <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
    <p>Your profile details are listed below.</p>
    <?php
    
    
        if($query){
            foreach ($query as $data){
            ?>
          
          User Name is: <?php echo $data->user_name ?>
          <br/>
          
          User First Name is: <?php echo $data->user_fname ?>
           <br/> 
          
          User Last Name is: <?php echo $data->user_lname ?>
          <br/> 
          
          User E-mail is: <?php echo $data->user_email ?>
           <br/>   
         

            Usre Status: <?php if($data->user_status=="Active")
            {
                echo "Draft";
            }
                else
            {
                    echo "Published";
                    
            }
            ?>
           <br/>
           
            User Type: <?php if($data->user_type=="User")
            {
                echo "User";
            }
                else
            {
                    echo "Administrator";
                    
            }
            ?>
           <br/>
           
        
            <?php    
            }
        }
    ?>
    
   
</div>
</div>
<div class="clear"></div>
</div>

