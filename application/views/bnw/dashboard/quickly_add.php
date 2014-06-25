<div class="quick">
<h4>Quickly Add new Product</h4>
 <hr />

  <?php echo validation_errors(); ?>
<p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open_multipart('bnw/quckly_addproduct');?>
      
    <input type="hidden" name="qty" value="1" />
 <p>Name:<br />
      <input type="text" name="pName" size="66" value="<?php echo set_value('pName'); ?>" /> </p>
 <p> Description : <br/>
<textarea name="pDescription" id="area1" cols="50" rows="5" ><?php echo set_value('pDescription'); ?></textarea> </p>
 <p>Price:<br />
      <input type="number" name="pPrice" min="1" /> </p>

 <div class="imageUploadside">
 <p> Select Category : <br/>
     
     <select name="pCategory">
         <?php foreach ($category as $catName)
         {?>
         <option value="<?php echo $catName->id; ?>"><?php echo $catName->category_name; ?></option>
         <?php } ?>
     </select>
     
 </p></div>
  <div class="imageUploadside">
      <p> Image 1 : <br/> <input type="file" name="myfile" id="file" /> </p></div>
 <div class="clear"></div>
<p>
     <input type="checkbox" value="1" name="checkMe"  /> Enable shipping charge </p>
 <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
