<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2>Notices </h2>
<a href="addnotice">Add New Notices</a>
<div id="body">
    <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    <p>List of pages</p>
    <table border="1" cellpadding="10">
        <tr>
            
            <td>S.N.</td>
            <td>Notice</td>
            <td>Status</td>
            <td>Action</td>
        </tr>
    <?php
        if($query){
            foreach ($query as $data){
            ?>
          <tr>
            <td><?php echo $data->id ?></td>
            <td><?php echo $data->title ?></td>
            <td><?php if($data->status==0)
            {
                echo "Draft";
            }
                else
            {
                    echo "Published";                    
            }
            ?></td>
            <td><?php echo anchor('bnw/editnotice/'.$data->id,'Edit') ?> / <?php echo anchor('sresadmin/deletenotice/'.$data->id,'Delete') ?></td>
        </tr>
            <?php    
            }
        }
          ?>
    </table>
    <?php echo $links; ?>
</div>