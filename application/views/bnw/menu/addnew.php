<div class="rightSide">
 <h2>Dashboard >> Add New Menu</h2>
 <hr class="hr-gradient"/>


 
 
  <p id="sucessmsg">
        <?php echo validation_errors(); ?>
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open_multipart('dashboard/addmenu');?>
      
 <p class="dashuppe-text-all">Menu Name<br />
      <input type="text" class="textInput" name="menu_name" value="<?php echo set_value('menu_name'); ?>"  /> </p> 
 
 <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
  <?php echo form_close();?>



<div id="body">
<!--    <p id="sucessmsg">
  <?php //if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>-->
    <h4 style="margin: 15px 0px 5px 5px;" class="dashuppe-text-all">All Menu</h4>
   <hr style="width: 30%; float: left;" />
   <div class="clear"></div>
     <?php    
        if(!empty($query)){
            ?>
    <table border="1" cellpadding="10">
        <tr>
            <th>S.N.</th>
            <th>Title</th>
            <th>Action</th>
        </tr>
    
   <?php
            foreach ($query as $data){
                
            ?>
        <tr class="action">
            <td><?php echo $data->id; ?></td>
            <td><?php echo $data->menu_name; ?></td>
            <td><?php echo anchor('dashboard/editmenu/'.$data->id,'<i class="fa fa-pencil-square-o"></i>'); ?> / 
                <span class="del_category" id="<?php echo $data->id; ?>"><i class="fa fa-trash-o"></i></span>
            </td>
        </tr>
            <?php    
            }
        }
        else{
            echo '<h3>Sorry menu are not available</h3>';
        }
    ?>
       
    </table>
    <?php echo $links; ?>
</div>
 </div>
<div class="clear"></div>
</div>

<script>
    $(document).ready(function(){
       $(document).on("click", ".del_category", function(){
           var id = $(this).attr("id");
            var url = '<?php echo base_url().'index.php/dashboard/deletemenu' ?>';
            var hideid = $(this);
            senddata({id:id,url:url,thiss:hideid});
            
       });
    });
</script>
