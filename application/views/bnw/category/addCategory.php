
<div class="rightSide">
    <h2>Add New Category</a></h2>
<hr class="hr-gradient"/>
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
    <p>List of all Categories</p>
    <?php    
        if(!empty($query)){
            ?>
    <table border="1" cellpadding="10">
        <tr>
            <th>S.N.</th>
            <th>Name of Category</th> 
            <th>Action</th>
        </tr>
    
    <?php
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
        else{
            echo '<h3>Sorry Categories are not available</h3>';
        }
    ?>
       
    </table>
    <?php echo $links; ?>
</div>
</div>
<div class="clear"></div>
</div>