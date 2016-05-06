<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>content/bnw/styles/stylesForLogin.css" type="text/css" /> 
    <script src="<?php echo base_url(); ?>content/bnw/scripts/jquery-1.9.1.min.js" > </script>
	<meta charset="utf-8">
<?php if(isset($meta))
{
     foreach ($meta as $data)
     {
         $title[] = $data->value;
     }
}
?>        
	<title>.:Dashboard <?php echo $title[1]; ?></title>
 
</head>
<body>
    
    <div class="container">
        <div class="left">
             
            <div id="loginform">
                <?php 
                 echo 'Sorry ! Your token has been expired.';
              ?>      
            </div>
         </div>
        
        <!--left side is closed here -->
        
        <div class="right">
            <div>
                <!--<iframe class="frame" src="http://salyani.org/sources/iframeContent/bnwIframe.php" frameborder="0" scrolling="no"></iframe>-->  
            </div>
            
        </div>
        <div class="clear"></div>
        
    </div>