<h2>Slider </h2>
<a href="addslider">Add New Slider</a>
<div id="body">
    <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    <p>List of all pages</p>
    <table border="1" cellpadding="10">
        <tr>
            <th>S.N.</th>
            <th>Title</th> 
            <th>Image</th>
            <th>Action</th>
        </tr>
    
    <?php
    
    
        if(isset($query)){
            foreach ($query as $data){
            ?>
          <tr>
            <td><?php echo $data->sid ?></td>
            <td><?php echo $data->title ?></td>
            <td><img src="<?php echo base_url()."slider/". $data->image; ?>" width="50px" height="50px" />  </td>
            <td><?php echo anchor('bnw/editslider/'.$data->sid,'Edit'); ?> / 
            <?php echo anchor('bnw/deleteslider/'.$data->sid,'Delete'); ?></td>
        </tr>
            <?php    
            }
        }
    ?>
       
    </table>
    <?php echo $links; ?>
</div>