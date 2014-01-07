<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>content/styles/stylesForLogin.css" type="text/css" /> 
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
   
    <div class="container">
        <div class="left">
            <div id="loginform">
                <form>
                <table>
                    <tbody>
                        <tr>
                        <td>
                            
                        </td>
                        </tr>
                    </tbody>
                </table>
                <div id="companyLogo">
                    <img id="name" src="<?php echo base_url()."/content/images/bnw.png"; ?>"/>
                </div>
                <div id="form">
                    <p id="sucessmsg">
                    <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}
                        echo validation_errors(); ?> </p>
                        <?php echo form_open('login/validate_credentials'); ?>
                  
                    
                        <input type="text" size="30" id="username" name="username" placeholder="User Name" required/>
                   
                    
                    <input type="password" size="30" id="passowrd" name="password" placeholder="Password" required/>
                  
                    <input type="submit" id="submitMe" value="Login">
                    
                    
                    <input type="checkbox" value=""/>Stay Logged In &nbsp&nbsp&nbsp&nbsp<a href="#">ForGot Password</a>
                    </form>
                </div>
            </div>
        </div>
        
        <!left side is closed here>
        
        <div class="right">
            <div id="rightTop">
                <iframe width="470px" height="290px" src="http://salyani.org/sources/iframeContent/bnwIframe.php" frameborder="0" scrolling="no"></iframe>
            </div>
            
        </div>
        <div class="clear"></div>
        
    </div>
    
        <div id="footer">
            B&W 1.5 Copyright &copy 2014. All rights reserved to <a href="#">B&W</a>
        </div>
    
    
    
</body>
</html>