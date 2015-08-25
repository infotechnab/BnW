<div class="rightSide">
<h2>Contact</h2>
<hr class="hr-gradient"/>
<div id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>
</div>
<?php if(!empty($contact)){
    foreach ($contact as $datas){
        $name = $datas->name;
        $address= $datas->address;
      $myArray = explode(',', $address);
          $street = $myArray['0'];
          $city = $myArray['1'];
          $district = $myArray['2'];
          $country = $myArray['3'];
        $contact1 = $datas->contact_no1;
        $contact2 = $datas->contact_no2;
        $email = $datas->email;
        $showForm = $datas->show_form;
        $showMap = $datas->show_map;
    }
?>
  <?php echo form_open_multipart('contact/addContact');?>
  <div id="forLeftPage">  
  <p class="dashuppe-text-all">Name of Organization *<br />
  <input type="text" class="textInput" name="title" value="<?php echo $name; ?>" />
  </p>
  <p class="dashuppe-text-all">Address 1(Street) *<br />
  <input type="text" class="textInput" name="street" value="<?php echo $street; ?>" />
  </p>
  <p class="dashuppe-text-all">Address 2(City) *<br />
  <input type="text" class="textInput" name="city" value="<?php echo $city; ?>" />
  </p>
  <p class="dashuppe-text-all">District *<br />
  <input type="text" class="textInput" name="district" value="<?php echo $district; ?>" />
  </p>
  <p class="dashuppe-text-all">Country *<br />
  <input type="text" class="textInput" name="country" value="<?php echo $country; ?>" />
  </p>
  </div>
<div id="forRightPage"> 
  <p class="dashuppe-text-all">Contact No.(Primary) *<br />
  <input type="text" class="textInput" name="contact1" value="<?php echo $contact1; ?>" />
  </p>
  <p class="dashuppe-text-all">Contact No.(Secondary)<br />
  <input type="text" class="textInput" name="contact2" value="<?php echo $contact2; ?>" />
  </p>
  <p class="dashuppe-text-all">Email *<br />
  <input type="email" class="textInput" name="email" value="<?php echo $email; ?>" />
  </p>
  <input type="checkbox" name="showForm" value="showForm" <?php if($showForm=='showForm') echo 'checked' ;?>>Show Contact Form.<br/><br/>
  <input type="checkbox" name="showMap" value="showMap" <?php if($showMap=='showMap') echo 'checked' ;?>>Show Location Map.<br/><br/>
  <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
</div>
  <?php echo form_close();?>
<?php } ?>
</div>
<div class="clear"></div>
</div>