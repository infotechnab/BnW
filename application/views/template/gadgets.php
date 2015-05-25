<section id="about">
<footer id="footer">
    <div class="container">

        <div class="row">
            <div class="col-md-3 col-sm-6 margin30">
                <div class="footer-col">
                    <h3>About BnW</h3>
                    <p>BnW is a MVC CMS developed from Chitwan. The motto of this is to make content management and web production easy, fast, reliable and convenient.</p>


                    <ul class="list-inline social-1">
                        <li><a class="facebook" href="#"><i class="fa fa-facebook square-2 rounded-1"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fa fa-twitter square-2 rounded-1"></i></a></li>
                        <li><a class="google-plus" href="#"><i class="fa fa-google-plus square-2 rounded-1"></i></a></li>
                    </ul>
                </div>                        
            </div><!--footer col-->
            <div class="col-md-3 col-sm-6 margin30">
                <div class="footer-col">
                    <?php
                    if (!empty($contact)) {
                        foreach ($contact as $cinfo) {
                            $name = $cinfo->name;
                            $address = $cinfo->address;
                            $contact1 = $cinfo->contact_no1;
                            $contact2 = $cinfo->contact_no2;
                            $email = $cinfo->email;
                            $form = $cinfo->show_form;
                            $map = $cinfo->show_map;
                        }
                        ?>
                        <h3>Contact</h3>

                        <ul class="list-unstyled contact">
                            <li><p><strong><i class="fa fa-map-marker"></i> Address:</strong> <?php echo $address; ?></p></li> 
                            <li><p><strong><i class="fa fa-envelope"></i> Mail Us:</strong> <a href="#"><?php echo $email; ?></a></p></li>
                            <li> <p><strong><i class="fa fa-phone"></i> Phone:</strong> <?php echo $contact1; ?></p></li>
                            <li> <p><strong><i class="fa fa-skype"></i> Skype</strong> <?php echo $contact2; ?></p></li>

                        </ul>
                    <?php } ?>
                </div>                        
            </div><!--footer col-->
            <div class="col-md-3 col-sm-6 margin30">
                <div class="footer-col">
                    <h3>Location Map</h3>

                </div>                        
            </div><!--footer col-->
            <div class="col-md-3 col-sm-6 margin30">
                <div class="footer-col">
                    <h3>Newsletter</h3>
                    <p class='bold'>
                        Don't Forget to subscribe our newsletter.
                    </p>
                    <form class="subscribe-form" role="form">
                        <div class="input-group">
                            <input type="email" id="subscribe_email" placeholder="Enter Email Id" class="form-control">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-color" id="subscribe_btn">Subscribe</button>
                            </span>
                        </div>
                    </form>
                </div>  
                <div class="alert alert-success" id="subs_success" style="display: none;padding: 1%;margin: 1%;"></div>
                <div class="alert alert-warning" id="subs_error" style="display: none;padding: 1%;margin: 1%;"></div>
            </div><!--footer col-->

        </div>

    </div>
</footer>
<script>
    function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
    $(document).ready(function(){
       $(document).on("click", "#subscribe_btn", function(){
           $("#subs_error").hide();
           $("#subs_success").hide();
       var email = $("#subscribe_email").val();
       if(IsEmail(email) == true) {
       $.ajax({
           'type': "POST",
          'url':'<?php echo base_url().'index.php/subscribers/addSubscriber';?>',
           data:{email:email},
           success:function(data){
               $("#subs_success").show();
               $("#subs_success").html(data);
           }
       });
       } else {
       $("#subs_error").show();
        $("#subs_error").html("Enter valid Email ID.");
       }
       });
    });
</script>
</section>

