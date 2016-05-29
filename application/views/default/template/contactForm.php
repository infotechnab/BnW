<div id="pattern-3">
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
        <?php $captcha_info = $this->session->userdata('captcha_info');
        $captchass = $captcha_info['code'];
        ?>
        <div class="container">

            <!-- Contact with Map - START -->
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="well well-sm">

    <?php if ($form == "showForm") { ?>
                            
     <script>   
          $(document).ready(function() {
                                        $('.error').hide();
                                    });
    $('.error').hide(); 
function validateEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function name()
{
              var name = $("#name").val();
        var f = name.length;
       if( f < 1) 
       {
           $("label#name_error").show();
           $("input#name").focus();
           return false;
       } else {
           $("label#name_error").hide();
           $("input#name").css("border","1px solid green");
           return true;
       }
}


function email()
{
     var email = $("#email").val();
     var e = email.length;
       if( validateEmail(email) == false) 
       {
           $("label#email_error").show();
           $("input#email").focus();
           return false;
       } else {
           $("label#email_error").hide();
           $("input#email").css("border","1px solid green");
           return true;
       }
}


function phone()
{
      var phone = $("#phone").val();
     var p = phone.length;
       if( p < 5 ) 
       {
           $("label#phone_error").show();
           $("input#phone").focus();
           return false;
       } else {
           $("label#phone_error").hide();
           $("input#phone").css("border","1px solid green");
           return true;
       }
}
function message()
{
      var message = $("#message").val();
     var m = message.length;
       if( m < 5 ) 
       {
           $("label#message_error").show();
           $("input#message").focus();
           return false;
       } else {
           $("label#message_error").hide();
           $("input#message").css("border","1px solid green");
           return true;
       }
}

function captcha()
{
    var captcha = $("#captcha").val();
     var sess = "<?php echo $captchass; ?>";
    
       if( captcha != sess ) 
       {
           $("label#captcha_mistake").show();
           $("input#captcha").focus();
           return false;
       } else {
           $("label#captcha_error").hide();
           $("input#captcha").css("border","1px solid green");
           return true;
       }
}

$(function(){
    
    $(document).on("blur", "#name", function(){
        name();
    });
        
    $(document).on("blur", "#email", function(){
        email();
    });
    
    
    $(document).on("blur", "#phone", function(){
        phone();
    });
    
    $(document).on("blur", "#message", function(){
        message();
    });
 $(document).on("blur", "#captcha", function(){
        captcha();
    });


    $("#submit").click(function() {
        if(name() == false)
        {
            $("input#name").focus();
        }
        else if(email() == false)
        {
            $("#email").focus();
        }
        else if(phone() == false)
        {
            $("#phone").focus();
        }
        else if(message() == false)
        {
            $("#message").focus();
        }
        else if(captcha() == false)
        {
            $("#captcha").focus();
        }
        else if(name() == true && email() == true && phone() == true && message() == true && captcha() == true)
                {
                     var aname = $("#name").val();
                                            var aemail = $("#email").val();
                                            var aphone = $("#phone").val();
                                            var amessage = $("#message").val();
                                            var acaptcha = $("#captcha").val();
                    $.ajax({
                                                    type: "POST",
                                                    url: "<?php echo base_url() . 'index.php/subscribers/addFeedback'; ?>",
                                                    data: {'name': aname, 'email': aemail, 'phone': aphone, 'message': amessage, 'captcha': acaptcha},
                                                    cache: false,
                                                    success: function(msgs) {

                                                        $('.well').html(msgs);




                                                    }
                                                });
                }
          
            else
            {
                $("label#captcha_mistake").show();
                $("input#captcha").focus();
            }
        
    });
    });
</script>                       
                            
                            
                            
                               <!-- <script>

                                    $(document).ready(function() {
                                        $('.error').hide();
                                        $("#submit").click(function() {
                                            $('.error').hide();
                                            var name = $("#name").val();
                                            var email = $("#email").val();
                                            var phone = $("#phone").val();
                                            var message = $("#message").val();
                                            var captcha = $("#captcha").val();
                                            var sess = "<?php echo $captchass; ?>";
                                            
                                            if (name == "") {
                                                $("label#name_error").show();
                                                $("input#name").focus();
                                                return false;
                                            }
                                            if (email == "") {
                                                $("label#email_error").show();
                                                $("input#email").focus();
                                                return false;
                                            }
                                            if (phone == "") {
                                                $("label#phone_error").show();
                                                $("input#phone").focus();
                                                return false;
                                            }
                                            if (message == "") {
                                                $("label#message_error").show();
                                                $("input#message").focus();
                                                return false;
                                            }
                                            if (captcha == "") {
                                                $("label#captcha_error").show();
                                                $("input#captcha").focus();
                                                return false;
                                            }
                                            if (captcha !== sess)
                                            {
                                                $("label#captcha_mistake").show();
                                                $("input#captcha").focus();
                                                return false;
                                            }
                                            if (name != '' || email != '' || phone != '' || message != '')
                                            {
                                                // AJAX Code To Submit Form.
                                                $.ajax({
                                                    type: "POST",
                                                    url: "<?php //echo base_url() . 'index.php/subscribers/addFeedback'; ?>",
                                                    data: {'name': name, 'email': email, 'phone': phone, 'message': message},
                                                    cache: false,
                                                    success: function(msgs) {

                                                        $('.well').html(msgs);




                                                    }
                                                });
                                            }
                                            return false;
                                        });
                                    });

                                </script>-->
                                <form class="form-horizontal">

                                    <fieldset>
                                        <legend class="text-center header">Contact us</legend>
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-1">
                                                <input name="name" id="name" type="text" placeholder="Full Name" required class="form-control">
                                                <label class="error" for="name" id="name_error">This field is required.</label>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-1">
                                                <input id="email" name="email" type="email" placeholder="Email Address" required class="form-control">
                                                <label class="error" for="name" id="email_error">This field is required.</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-1">
                                                <input id="phone" name="phone" type="text" placeholder="Phone" required class="form-control">
                                                <label class="error" for="name" id="phone_error">This field is required.</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-1">
                                                <textarea class="form-control" id="message" name="message" required placeholder="Enter your massage for us here. We will get back to you within 2 business days." rows="4"></textarea>
                                                <label class="error" for="name" id="message_error">This field is required.</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-1">
                                                <img src="<?php echo $captcha['image_src']; ?>" alt="CAPTCHA security code" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-1">
                                                <input name="captcha" id="captcha" type="text" placeholder="Type in above text" required class="form-control">
                                                <label class="error" for="captcha" id="captcha_error">This field is required.</label>
                                                <label class="error" for="captcha" id="captcha_mistake">Captcha did not match.</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12 text-center">
                                                <button class="btn btn-primary btn-lg" id="submit" type="button" value="Submit">Submit</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
    <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <div class="panel panel-default">
                                <div class="text-center header">Our Office</div>
                                <div class="panel-body text-center">
                                    <h4><?php echo $name; ?></h4>

                                    <div>
                                        <i class="fa fa-map-marker"></i> <?php echo $address; ?><br/>
                                        <?php if (!empty($contact1)) { ?> <i class="fa fa-phone"></i> <?php echo $contact1; ?><br/> <?php } ?>
    <?php if (!empty($contact2)) { ?> <i class="fa fa-skype"></i> <?php echo $contact2; ?><br/> <?php } ?>
                                        <i class="fa fa-envelope"></i> <?php echo $email; ?>
                                    </div>
    <?php if ($map == "showMap") { ?>
                                        <hr />
                                        <div id="map1" class="map">
                                        </div>
    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <script src="http://maps.google.com/maps/api/js?sensor=false"></script>

            <script type="text/javascript">
                                jQuery(function($) {
                                    function init_map1() {
                                        var myLocation = new google.maps.LatLng(27.691062, 84.426885);
                                        var mapOptions = {
                                            center: myLocation,
                                            zoom: 15
                                        };
                                        var marker = new google.maps.Marker({
                                            position: myLocation,
                                            title: "Property Location"
                                        });
                                        var map = new google.maps.Map(document.getElementById("map1"),
                                                mapOptions);
                                        marker.setMap(map);
                                    }
                                    init_map1();
                                });
            </script>

            <style>
                .map {
                    min-width: 300px;
                    min-height: 300px;
                    width: 100%;
                    height: 100%;
                }

                .header {
                    background-color: #F5F5F5;
                    color: #36A0FF;
                    height: 70px;
                    font-size: 27px;
                    padding: 10px;
                }
            </style>

            <!-- Contact with Map - END -->

        </div>

        <?php
    } else {
        $this->load->view('default/template/errorPage');
    }
    ?>
</div>

