<!DOCTYPE html>
<html>
    <head>
        <title>Form Validation </title>
    </head>
    <body>
        <?php if (isset($errorMessage)) echo $errorMessage; ?>
        <?php echo form_open('formValidation/validation'); ?>
        <label for="username">User Name</label>
        <input type="text" name="username" value="<?php echo set_value('username'); ?>"/>        
        <label for="password">Password</label>
        <input type="text" name="password" value="<?php echo set_value('password') ?>"/> 
        <input type="submit" value="Submit">
        <?php echo form_close(); ?>
    </body>
</html>