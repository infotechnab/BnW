<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">
<h2>Update Contact Details</h2>
<hr class="hr-gradient"/>

<div id="sucessmsg">
  <?php if($this->session->flashdata('message'))
            {
            echo "<div class='alert alert-default fade in '>".$this->session->flashdata('message')."</div>"; 

            }?>
    <?php $validation_errors= validation_errors();
    if(isset($validation_errors)){
     echo "<div class='error'>".$validation_errors."</div>"; 

    }
  if(isset($error))
  {
         echo "<div class='error'>".$error."</div>"; 
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

<div class="setleftmargin">
  <?php echo form_open_multipart('contact/addContact',array('class'=>'form-horizontal'));?>
  <div id="forLeftPage">  
  <div class="form-group">
  <label>Name of Organization:</label>
  <input type="text" class="textInput form-control" name="title" value="<?php echo $name; ?>" />
  </div>
<div class="form-group">
  <label>Address 1(Street):</label>
  <input type="text" class="textInput form-control" name="street" value="<?php echo $street; ?>" />
  </div>
  <div class="form-group">
  
  <label>Address 2(City):</label>
  <input type="text" class="textInput form-control" name="city" value="<?php echo $city; ?>" />
  </div>
  <div class="form-group">
  
  <label>District:</label>
  <input type="text" class="textInput form-control" name="district" value="<?php echo $district; ?>" />
  </div>
  <div class="form-group">

  <label>Country:</label>
  <input type="text" class="textInput form-control" name="country" value="<?php echo $country; ?>" />
  </div>
<div class="form-group">
  <label>Contact No.(Primary)</label>
  <input type="text" class="textInput form-control" name="contact1" value="<?php echo $contact1; ?>" />
 </div>
 <div class="form-group">
  <label>Contact No.(Secondary)</label>
  <input type="text" class="textInput form-control" name="contact2" value="<?php echo $contact2; ?>" />
 </div>
 <div class="form-group">
  <label> Email </label>
  <input type="email" class="textInput form-control" name="email" value="<?php echo $email; ?>" />
 </div>
<div class="form-group">
<div class="checkbox">
  <label><input type="checkbox" name="showForm" value="showForm" <?php if($showForm=='showForm') echo 'checked' ;?>>Show Contact Form.</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" name="showMap" value="showMap" <?php if($showMap=='showMap') echo 'checked' ;?>>Show Location Map</label>
</div>
</div>
<div class="form-group">
  <input type="submit" class="btn btn-default btn-lg btn-block " value="Submit" />
</div>
  <?php echo form_close();?>
<?php } ?>
</div>
</div>
</div>
</div>