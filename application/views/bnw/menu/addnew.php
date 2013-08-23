<h2> Add New Menu </h2>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open_multipart('bnw/addmenu');?>
  
      
 <p>Title:<br />
      <input type="text" name="title"  /> </p> 
 <p>Pramalink : <br/>
       <input type="text" name="parmalink"  /> </p>
 <p> Listing : <br/>
      <input type="text" name="listing" /> </p>
 <p> Order : <br/>
       <input type="txt" name="order" /> </p>
 <p> Link : <br/>
      <input type="text" name="link" /> </p>
  
 
    <input type="submit" value="Submit" />
  <?php echo form_close();?>
