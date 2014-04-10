<div class="rightSide">
 <h2>Add new Menu</h2>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open_multipart('bnw/addmenu');?>
      
 <p>Menu Name:<br />
      <input type="text" name="menu_name" value="<?php echo set_value('menu_name'); ?>"  /> </p> 
 
 <input type="submit" value="Submit" />
  <?php echo form_close();?>



<div id="body">
    <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    <p>List of all menu</p>
    <table border="1" cellpadding="10">
        <tr>
            <th>S.N.</th>
            <th>Title</th>
            <th>Action</th>
        </tr>
    
    <?php    
        if(isset($query)){
            foreach ($query as $data){
                
            ?>
          <tr>
            <td><?php echo $data->id; ?></td>
            <td><?php echo $data->menu_name; ?></td>
            <td><?php echo anchor('bnw/editmenu/'.$data->id,'Edit'); ?> / 
            <?php echo anchor('bnw/deletemenu/'.$data->id,'Delete'); ?></td>
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