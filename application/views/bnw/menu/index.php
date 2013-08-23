<h2>Menu list </h2>
<a href="addmenu">Add New Menu</a>
<div id="body">
    <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    <p>List of all pages</p>
    <table border="1" cellpadding="10">
        <tr>
            <th>S.N.</th>
            <th>Title</th> 
            <th>Parmalink</th>
            <th>Listing</th>
            <th>Order</th>
            <th>Link</th>
            <th>Page id </th>
            <th>Action</th>
        </tr>
    
    <?php    
        if(isset($query)){
            foreach ($query as $data){
                $pid = $data->p_id;
            ?>
          <tr>
            <td><?php echo $data->id; ?></td>
            <td><?php echo $data->title; ?></td>
            <td><?php echo $data->parmalink; ?>  </td>
            <td><?php echo $data->listing; ?>  </td>
            <td><?php echo $data->order; ?>  </td>
            <td><?php echo $data->link; ?>  </td>
            <td><?php echo $data->p_id; ?></td>
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