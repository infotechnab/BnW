<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">

 <h2>Dashboard >> &nbsp;&nbsp;&nbsp;&nbsp;Add New Menu</h2>
 <hr class="hr-gradient"/>

 <div id="sucessmsg">
  <?php if($this->session->flashdata('message'))
  {
    echo "<div class='alert alert-default fade in '>".$this->session->flashdata('message')."</div>"; 

  }?>
  <?php $validation_errors= validation_errors();
  if(isset($validation_errors)){
   echo "<div class='error'>".$validation_errors."</div>"; 

 }
 if(isset($error))
 {
   echo "<div class='error'>".$error."</div>"; 
 }
 ?>
</div>
<script>
    $(document).ready(function(){
        $("#myBtn").click(function(){
            // $("#myModal").css("display","block");
            $(".modal").css("display", "block"); 



        });
         $("#closeme").click(function(){
            // $("#myModal").css("display","block");
            $(".modal").css("display", "none"); 
        });
    });
</script>

<!-- Modal -->
<button type="button" class="btn btn-default btn-lg btn-block" id="myBtn" data-toggle="modal" data-target="#myModal">Add new Menu</button>
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <?php echo form_open_multipart('dashboard/addmenu');?>
       <div class="form-group">
       <h3>Enter Menu Name :</h3>
         <input type="text" class="form-control" name="menu_name" value="<?php echo set_value('menu_name'); ?>"  />
       </div>
       <div class="form-group">

        <input type="submit" class="btn btn-default btn-lg btn-block" value="Submit" />
      </div>
      <?php echo form_close();?>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default  pull-right"  id="closeme">Close</button>
    </div>
  </div>

</div>
</div>
<h2 class="text-left">All Menus</h2>
<hr style="border:2px solid #222;margin-top:-8px;">
<?php    
if(!empty($query)){
  ?>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <th>S.N.</th>
        <th>Title</th>
        <th>Action</th>
      </thead>

      <?php
      $i=1;
      foreach ($query as $data){

        ?>
        <tr class="action">
          <td><?php echo $i++; ?></td>
          <td><?php echo $data->menu_name; ?></td>
          <td>
          <a  href='<?php echo base_url().'dashboard/editmenu/'.$data->id; ?>'  title=" Edit " data-placement="top" style='font-size:16px;text-decoration:none;'> <span id='$menu_id' class='editNavs    glyphicon glyphicon-edit'></span> | </a> 
            <a href="#" style='font-size:16px;text-decoration:none;'  title=" Delete "> <span  id="<?php echo $data->id; ?>" class='del_category glyphicon glyphicon-trash'></span></a>

            
          </td>
        </tr>
        <?php    
      }
    }
    else{
      echo "<div class='alert' style='background-color:#ddd;'>
      <h3 class='text-left'>Sorry menu are not available</h3>
      </div>";
    }
    ?>

  </table>
</div>
<?php echo $links; ?>
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
