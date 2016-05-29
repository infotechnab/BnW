<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">
    <h2>Dashboard >>> &nbsp; &nbsp; &nbsp; &nbsp; Add New Category</h2>
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
<div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
  <?php echo form_open_multipart('dashboard/addcategory');?>
  <div class="form-group">
  <label class="control-label">Name :</label>
  <input type="text" class="form-control" name="category_name" value="<?php echo set_value('category_name'); ?>" />
  </div>
  
   <input type="submit" class="btn btn-default btn-lg btn-block" value="Submit" />
  <?php echo form_close();?>
</div>

<div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
    <h2>All Categories</h2>
    <hr style="border:2px solid #222;margin-top:-8px;">
    <?php    
        if(!empty($query)){
            ?>
            <div class="table-responsive">
    <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>S.N.</th>
            <th>Name of Category</th> 
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $i=1;
            foreach ($query as $data)
            {
            
              // $catData =  $this->dbmodel->get_file($data->id);
                                
                ?>
                
        <tr class="action">


            <td><?php echo  $i++?></td>
            <td><?php echo $data->category_name ?></td>

            <td>
 <a  href='<?php echo base_url().'dashboard/editcategory/'.$data->id; ?>'  title=" Edit " data-placement="top" style='font-size:16px;text-decoration:none;'> <span id='$menu_id' class='editNavs    glyphicon glyphicon-edit'></span> | </a> 
            <?php
            if(empty($catData))
            { ?>
 <a href="#" style='font-size:16px;text-decoration:none;'  title=" Delete "> <span  id="<?php echo $data->id; ?>" class='del_category glyphicon glyphicon-trash'></span></a>
                <!--echo anchor('dashboard/deletecategory/'.$data->id,'<i class="fa fa-trash-o"></i>');-->
                
            <?php }
            else 
                { ?>
                <a href="" class="del_category"><i class="fa fa-trash-o"></i></a>
                <!--echo anchor('dashboard/delete_category/'.$data->id,'');-->
              <?php   }            ?>
            
           
            
            </td>
        </tr>
    
            <?php    
            }
            ?>
</tbody>
            <?php 
        }
        else{
            echo '<h3>Sorry Categories are not available</h3>';
        }
    ?>
       
    </table>
    </div>
    <?php echo $links; ?>
</div>
</div>
<span id="confirm"> </span>

<script>
    $(document).ready(function(){
       $(document).on("click", ".del_category", function(){
           var id = $(this).attr("id");
            var url = '<?php echo base_url().'index.php/dashboard/deletecategory' ?>';
            var hideid = $(this);
            senddata({id:id,url:url,thiss:hideid});
            
       });
    });
</script>