<div id="mapDivFull"><section class="about mt100">
    <div class="col-md-12">
        <h2 class="lined-heading bounceInRight appear" data-start="800"><span style="background-color: #fff;">Location Map</span></h2><style>
      #map_canvas {
        width: 94%;
        height: 400px;
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
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
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
    </div>
<style>
    #mapDivFull
    {
       
        width: 100%;
        padding-bottom: 20px;
        min-height: 500px;
    }
    
</style>