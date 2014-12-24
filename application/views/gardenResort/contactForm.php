 <link rel="stylesheet" href="<?php echo base_url().'content/uploads/styles/form.css'; ?>">
 <script src="<?php echo base_url().'content/uploads/scripts/forms.js'; ?>"></script>
 <style>
     .alert-success {
    background-color: #dff0d8;
    border-color: #d6e9c6;
    color: #3c763d;
}
.alert {
    border: 1px solid transparent;
    border-radius: 4px;
    margin-bottom: 20px;
    padding: 15px;
    display: none;
}
     
 </style>
 <div id="pattern-3">
 <?php if(!empty($contact)){
     foreach($contact as $cinfo){
         $name = $cinfo->name;
         $address = $cinfo->address;
         $contact1 = $cinfo->contact_no1;
         $contact2 = $cinfo->contact_no2;
         $email = $cinfo->email;
         $form = $cinfo->show_form;
         $map = $cinfo->show_map;
     } 
     ?>
 
 <div class="container" style="padding-top:50px;min-height: 820px;">
  <div class="row">

      <?php if($map =="showMap"){ ?>
      <section class="about mt100">
      <div class="col-md-6">
        <h2 class="lined-headingcf bounceInRight appear" data-start="800"><span>Location Map</span></h2>
        <style>
      #map_canvas {
        width: 94%;
        height: 500px;
        margin: 0% 3% 0% 3%;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
      function initialize() {
        var map_canvas = document.getElementById('map_canvas');
         var myLatlng = new google.maps.LatLng(27.687278, 84.427995);
        var map_options = {
          center: myLatlng,
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(map_canvas, map_options);
        
        var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h3 id="firstHeading" class="firstHeading" style="color:#000;"> BGR Chitwan</h3>'+
      '<div id="bodyContent">'+
      '<p>Bharatpur Height, Bharatpur, Chitwan'+
      '</p>'+
      '</div>'+
      '</div>';

 var infowindow = new google.maps.InfoWindow({
      content: contentString
  });

    var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'BGR, Bharatpur)'
  });
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script> 
        <div id="map_canvas"></div>
      </div>
      </section>
      <?php } ?>
      
      
      
      
      <section class="about mt100">
      <div class="col-md-6">
        <h2 class="lined-headingcf bounceInRight appear" data-start="800"><span>Contact Info</span></h2>
        <dl>
                                <dt><p><?php echo $name; ?><br>
                                    <?php echo $address; ?><br>
                                </dt>
                                <dd><span>Phone: </span><?php echo $contact1; ?>, <?php echo $contact2; ?></dd>
                                <dd><span>Email: </span><?php echo $email; ?></dd>
                            </dl>
        <?php if($form =="showForm"){ ?>
        <h2 class="lined-headingcf bounceInRight appear" data-start="800"><span>Contact Form</span></h2>
         <div class="alert alert-success">

        <a href="#" class="close" data-dismiss="alert">&times;</a>  

    </div>
        
        <?php $attributes = array('id' => 'form'); echo form_open_multipart('subscribers/addFeedback', $attributes); ?>

       <div class="success_wrapper">
       <div class="success">Contact form submitted!<br>
       <strong>We will be in touch soon.</strong> </div></div>
       <fieldset>
       <label class="name">
       <input type="text" name="name" value="Name">
       <br class="clearfix">
       <span class="error error-empty">*This is not a valid name.</span><span class="empty error-empty">*This field is required.</span> </label>
       <label class="email">
       <input type="text" name="email" value="E-mail">
       <br class="clearfix">
       <span class="error error-empty">*This is not a valid email address.</span><span class="empty error-empty">*This field is required.</span> </label>
       <label class="phone">
       <input type="tel" name="phone" value="Phone">
       <br class="clearfix">
       <span class="error error-empty">*This is not a valid phone number.</span><span class="empty error-empty">*This field is required.</span> </label>
       <label class="message">
           <textarea name="message" placeholder="Message" style="color:ccc;"></textarea>
       <br class="clearfix">
       <span class="error">*The message is too short.</span> <span class="empty">*This field is required.</span> </label>
       <div class="clearfix"></div>
       <a data-type="reset" class="btn">Clear</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a data-type="submit" class="btn">Send</a>
       <div class="clearfix"></div>
       </fieldset><?php echo form_close(); ?>
        
        
        <?php } ?>
      </div>
      </section>
 
  </div>
 </div>
 <?php }else {
         $this->load->view('gardenResort/errorPage');
    } ?>
 </div>     