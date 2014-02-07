
<div class="rightSide">
    <h2><a href="#">Add New Category</a></h2>

     <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>
<p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
</p>
  <?php echo form_open_multipart('bnw/addcategory');?>
  
  <p>Name:<br />
  <input type="text" name="category_name" value="<?php echo set_value('category_name'); ?>" />
  </p>
  
   <input type="submit" value="Submit" />
  <?php echo form_close();?>

<div id="body">
    <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    <p>List of all Categories</p>
    <table border="1" cellpadding="10">
        <tr>
            <th>S.N.</th>
            <th>Name of Category</th> 
            <th>Action</th>
        </tr>
    
    <?php    
        if(isset($query)){
            foreach ($query as $data){
            ?>
          <tr>
            <td><?php echo $data->id; ?></td>
            <td><?php echo $data->category_name ?></td>
            <td><?php echo anchor('bnw/editcategory/'.$data->id,'Edit'); ?> / 
            <?php echo anchor('bnw/deletecategory/'.$data->id,'Delete'); ?></td>
        </tr>
            <?php    
            }
        }
    ?>
       
    </table>
    <?php echo $links; ?>
</div>
</div>
<div class="clear"></div>
</div>