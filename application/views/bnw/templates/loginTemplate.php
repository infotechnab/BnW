<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>content/styles/stylesForLogin.css" type="text/css" /> 
    <script src="<?php echo base_url(); ?>content/jquery-1.9.1.min.js" > </script>
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js">
    </script> <script type="text/javascript">
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
   <script language="javascript" type="text/javascript">
         document.getElementById("username").focus();
        </script>
    <div class="container">
        <div class="left">
            <div id="loginform">
               
                <table>
                    <?php echo form_open('login/validate_credentials'); ?>
                    <input type="hidden" name="requersUrl" value="<?php echo $link; ?>"/>
                    <tbody>
                        <tr>
                        <td colspan="2">
                            <img id="name" src="<?php echo base_url()."content/bnw/images/bnw.png"; ?>"/>
                                <p id="sucessmsg">
                                    <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}
                                echo validation_errors(); ?> </p>
                        </td>
                        </tr>
                        <tr>
                        <td colspan="2">
                            <input type="text" size="35" id="username" name="username" placeholder="User Name" required/>
                        </td>
                        </tr>
                        <tr>
                        <td colspan="2">
                            <input type="password" size="35" id="password" name="password" placeholder="Password" required/>
                        </td>
                        </tr>
                        <tr>
                        <td colspan="2">
                            <input type="submit" id="submitMe" value="Login">
                        </td>
                        </tr>
                        <tr>
                        <td>
                            <input type="checkbox" value="1" name="checkMe"/>Stay Logged In
                           
                        </td>
                        <td>
                            <a href="login/forgotPassword">Forgot Password</a>
                        </td>
                        </tr>
                    </tbody>
                    </form>
                </table>
                    
            </div>
         </div>
        
        <!--left side is closed here -->
        
        <div class="right">
            <div>
             <!--   <iframe class="frame" src="http://salyani.org/sources/iframeContent/bnwIframe.php" frameborder="0" scrolling="no"></iframe>  -->
            </div>
            
        </div>
        <div class="clear"></div>
        
    </div>