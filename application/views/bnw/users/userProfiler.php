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
          
          User Name : <?php echo $data->user_name ?>
          <br/>
          
          User full Name: <?php echo $data->user_fname." ".$data->user_lname; ?>
           <br/> 
          
          User E-mail : <?php echo $data->user_email ?>
           <br/>   
         

            User Status: <?php if($data->user_status=="0")
            {
                echo "Draft";
            }
                else
            {
                    echo "Active";
                    
            }
            ?>
           <br/>
           
            User Type: <?php if($data->user_type=="1")
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

