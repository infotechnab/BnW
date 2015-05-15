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

<div class="container">

<!-- Contact with Map - START -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="well well-sm">
                <div class="alert alert-success" style="display: none;"></div>
                  <?php if($form =="showForm"){ ?>
                 <?php $attributes = array('class' => 'form-horizontal'); echo form_open_multipart('subscribers/addFeedback', $attributes); ?>
                    <fieldset>
                        <legend class="text-center header">Contact us</legend>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="fname" name="name" type="text" placeholder="Full Name" required class="form-control">
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="email" name="email" type="text" placeholder="Email Address" required class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="phone" name="phone" type="text" placeholder="Phone" required class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <textarea class="form-control" id="message" name="message" required placeholder="Enter your massage for us here. We will get back to you within 2 business days." rows="7"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
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
                      <?php if(!empty($contact1)){ ?> <i class="fa fa-phone"></i> <?php echo $contact1; ?><br/> <?php } ?>
                        <?php if(!empty($contact2)){ ?> <i class="fa fa-skype"></i> <?php echo $contact2; ?><br/> <?php } ?>
                        <i class="fa fa-envelope"></i> <?php echo $email; ?>
                        </div>
                         <?php if($map =="showMap"){ ?>
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
    jQuery(function ($) {
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

<?php }else {
         $this->load->view('default/template/errorPage');
    } ?>
</div>

