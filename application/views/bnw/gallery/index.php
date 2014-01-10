<div class="rightSide">
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2>Manage Photo Gallery</h2>
<a href="addphoto">Add another photo</a>
<div id="body">
         <?php
        if($query){
            
            ?>
    <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    <p>Photo Listing</p>  
    <table border="1" cellpadding="10">
        <tr>
            <th>S.N.</th>
            <th>Photo Title</th>
            <th>Photo Preview</th>
            <th>Action</th>
    </tr>
    
    <?php
            foreach ($query as $data){
            ?>
          <tr>
            <td><?php echo $data->eid ?></td>
            <td><?php echo $data->title ?></td>
            <td><img src="<?php echo base_url()."/gallery/".$data->image; ?>" width="30" height="30"></td>
            
            <td><?php //echo anchor('sresbnw/editpage/'.$data->eid,'Edit') ?>
              <?php echo anchor('bnw/deletephoto/'.$data->eid,'Delete') 
            ?></td>
        </tr>
            <?php    
            }
        }
        
        else 
        {
            echo "<p>No Photo in gallery</p>";
        }
    ?>
    </table>
</div>
</div>
<div class="clear"></div>
</div>