
<div class="rightSide">
    <h2>Menu list </h2>
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
                $mid = $data->id;
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