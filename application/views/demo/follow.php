<script>
         function validate() {  
             var name= $('#fullName').val();
             var email = $('#email').val(); 
             
             var msg = "Please fill your name and email field correctly!";
                     if ((name == null) || (name == "") || (!name.match(/^[a-z,0-9,A-Z_ ]{5,35}$/)) && (email == null) || (email == "") || (!email.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/))) {          
        $("#msg").html(msg);
        }
        else {
              $.ajax({
 type: "POST",
 url: "<?php echo base_url().'index.php/subscribers/addSubscriber' ;?>",
 data: {
     'fullName' : name,
     'email' : email},
  success: function(msgs) 
        {
            alert(msgs);
            $("#replaceMe").html(msgs);
        }
 });
         }
         }      
</script>    
<div id="sub-full-subscription">
    <h1 class="titlebarHeading">Connect With Us</h1>
    <div class="subscription-two-sub-divs">
 
        <div style="margin: 0 auto;width: 70%;">
              <h1 class="subscriptionhead">SUBSCRIBE OUR NEWSLETTER</h1>
            <span id="msg"></span>
            <input type="text" name="fullName" id="fullName" placeholder="Name" style="width: 100%; height: 50px;"><br/><br/>
            <input type="text" name="email" id="email" placeholder="E-mail Address" style="width: 100%; height: 50px;"><br/><br/>
            <input type="button" class="subscribe" onclick="validate()" value="Subscribe"></div>
            
        </div>
    
    <div class="subscription-two-sub-divs">
       <div style="margin: 0 auto;width: 70%;">
              <h1 class="subscriptionhead">Feedback Us</h1>
            
            <input type="text" placeholder="Email Address" style="width: 100%; height: 50px;"><br/><br/>
            <textarea placeholder="Remarks" style="width: 100%; height: 100px; resize:none"></textarea><br/><br/>
            <input type="button" class="subscribe" value="Send"></div>
        </div>
   
</div>