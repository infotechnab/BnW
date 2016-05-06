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
    <?php
if (isset($_GET['resetPassword'])) {
            $token =  $_GET['resetPassword'];
        }elseif(isset ($tokene) && (!empty ($tokene))){ $token = $tokene; }else{$token =NULL;}
if(!empty($query)){
foreach ($query as $data){
                   $useremail= $data->user_email;
                   $userKey = $data->user_auth_key;
}}else{
    $useremail = "aaaaaaaaaaaaaaaaa";
    $userKey = "as";
}
?>
   <script language="javascript" type="text/javascript">
       $(document).ready(function(){
             document.getElementById("username").focus();
       });
       
        </script>
    <div class="container">
        <div class="left">
             
            <div id="loginform">
                <?php if($token == $userKey){ ?>
                <table>
                    <?php echo form_open('login/setpassword'); ?>
                    <tbody>
                        <tr>
                        <td colspan="3">
                            <img id="name" src="<?php echo base_url()."content/bnw/images/bnw.png"; ?>"/>
                                <p id="sucessmsg">
                                    <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}
                                echo validation_errors(); ?></p>
                        </td>
                        </tr>
                        <input type="hidden" name="email" value="<?php echo $useremail; ?>">
                        <input type="hidden" name="resetPassword" value="<?php echo $userKey; ?>">
                        <tr>
                            <td colspan="2" style="text-align: left;">New Password:</td>   
                        </tr>
                        <tr>
                        <td colspan="2">
                            <input type="password" name="user_pass" id="newPassword" required size="35"/>
                        </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: left;">Confirm Password:</td>
                        </tr>
                        <tr>
                        <td colspan="2">
                            <input type="password" name="user_confirm_pass" id="confirmPassword" required size="35"/>
                        </td>
                        </tr>
                        <tr>
                        <td colspan="2">
                            <input type="submit" id="submitMe" value="Submit">
                        </td>
                        </tr>
                        <tr>
                        
                        
                        </tr>
                    </tbody>
                    </form>
                </table>
              <?php }else{
                 echo 'Sorry ! Your token has been expired.';
             } ?>      
            </div>
         </div>
        
        <!--left side is closed here -->
        
        <div class="right">
            <div>
                <iframe class="frame" src="http://salyani.org/sources/iframeContent/bnwIframe.php" frameborder="0" scrolling="no"></iframe>  
            </div>
            
        </div>
        <div class="clear"></div>
        
    </div>