<!DOCTYPE html>
<html>
  <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Bharatpur Garden Resort Pvt. Ltd is the prefect destination, where you can feel the true nature of hospitality. As the name suggest Garden Resort, resort has a wide garden near by swimming pool which make ones feel like being in garden.Bharatpur garden resort is the supreme entry for leisure and relaxation. It also feature a outdoor swimming pool with free Wi- Fi access to every room.">
    <meta name="keywords" content="Bharatpur Garden Resort, Resort, Resort in chitwan, BGR, bgr, bgr bharatpur, Hotel, hotel, hotel in chitwan, chitwan hotel, lodge to stay, star hotel in chitwan, hotel to stay, best hotel in chitwan, best hotel, hotel in nepal, nepal hotel, hotels list, hotels list in chitwan, three star hotel in chitwan">

    <?php if(isset($meta))
{
     foreach ($meta as $data)
     {
         $title[] = $data->value;
     }
}
?>  
    <link rel="shortcut icon" href="<?php echo base_url().'content/uploads/images/'.$title[4]; ?>">
	<title><?php echo $title[1]; ?></title>
<meta property="og:title" content="Bharatpur Garden Resort Pvt. Ltd."/>
<meta property="og:type" content="article"/>
<meta property="og:url" content="http://www.bharatpurgardenresort.com"/>
<meta property="og:image" content="http://www.bharatpurgardenresort.com/content/uploads/images/bgr100ox.png"/>
<meta property="og:site_name" content="Bharatpur Garden Resort Pvt. Ltd."/>
<meta property="fb:app_id" content="798589833503780"/>
<meta property="og:description" content="Bharatpur Garden Resort Pvt. Ltd is the prefect destination, where you can feel the true nature of hospitality. As the name suggest Garden Resort, resort has a wide garden near by swimming pool which make ones feel like being in garden.Bharatpur garden resort is the supreme entry for leisure and relaxation. It also feature a outdoor swimming pool with free Wi- Fi access to every room."/>
   
<link rel="stylesheet" href="<?php echo base_url().'content/uploads/styles/custom.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'content/uploads/bootstrap/css/bootstrap.css'; ?>">
<link href="http://fonts.googleapis.com/css?family=Leckerli+One|Coustard:900" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="<?php echo base_url().'content/font-awesome/css/font-awesome.min.css'; ?>"> 
     <script src="<?php echo base_url().'content/uploads/scripts/jquery.js'; ?>"></script>
      <script src="<?php echo base_url().'content/uploads/bootstrap/js/bootstrap.min.js'; ?>"></script> 
      <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-19759610-4', 'auto');
  ga('send', 'pageview');

</script>
    </head>
            
     
    <body>
        
 <div id="top-head-small">
         <?php if (!empty($contact)){
     foreach ($contact as $con){
          $contact1 = $con->contact_no1;
          $contact2 = $con->contact_no2;
          $email = $con->email;
     }

         }    ?>
              <div id="top-head-small-left">
              <a href="tel:<?php echo $contact1; ?>" style="cursor:pointer; color: #eee;"><i class="icon-phone"></i> <?php echo $contact1; ?></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             
                    <a href="mailto:bgardenresort@gmail.com" target="_blank" data-rel="external" style="cursor:pointer;color: #eee;"><i class="icon-envelope"></i> <?php echo $email; ?></a>
                    </div>  
            
          <div id="top-head-small-right">
              <a href="https://www.facebook.com/pages/Bharatpur-Garden-Resort/605984239492108" target="_blank" style="cursor:pointer; color: #fff;"><i class="icon-facebook"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="#" style="cursor:pointer;color: #fff;" ><i class="icon-twitter"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" style="cursor:pointer;color: #fff;"><i class="icon-youtube"></i></a>
                    </div>    
        </div>