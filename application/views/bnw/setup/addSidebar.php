<div class="rightSide">  
<h2>Change Header Content</h2>
  <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>
<p>Choose Sidebar Colour:<br/>
    <input type="color" class="color" />
</p>


<input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>