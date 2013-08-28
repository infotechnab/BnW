
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>content/styles/bnw.css" type="text/css" /> 
    <script src="<?php echo base_url(); ?>content/jquery-1.9.1.min.js" > </script>
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
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
   
<div id="container">
    <div id="header">
        <h1 id="hd_title" > Welcome to <?php echo $title[1]; ?> Dashboard </h1>
        <?php  if ($this->session->userdata('logged_in')){ ?>
        <div id="userinfo">
        <p>
            <?php echo $this->session->userdata('username'); ?>
            <?php echo anchor('bnw/logout','Log Out') ?>
        </p>
        
        </div>
       
        <?php } ?>
         <div class="clear"/>
    </div>
