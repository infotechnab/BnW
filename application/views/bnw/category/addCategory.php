
<div class="rightSide">
    <h2>Dashboard >> Add New Category</a></h2>
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
  <?php echo form_open_multipart('dashboard/addcategory');?>
  
  <p class="dashuppe-text-all">Name<br />
  <input type="text" class="textInput" name="category_name" value="<?php echo set_value('category_name'); ?>" />
  </p>
  
   <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
  <?php echo form_close();?>

<div id="body">
    <h4 style="margin: 15px 0px 5px 5px;">All Categories</h4>
   <hr style="width: 30%; float: left;" />
   <div class="clear"></div>
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
            
              // $catData =  $this->dbmodel->get_file($data->id);
                                
                ?>
        <tr class="action">
            <td><?php echo $data->id; ?></td>
            <td><?php echo $data->category_name ?></td>
            <td><?php echo anchor('dashboard/editcategory/'.$data->id,'<i class="fa fa-pencil-square-o"></i>'); ?> / 
            <?php
            if(empty($catData))
            { ?>
                <span class="del_category" id="<?php echo $data->id; ?>"><i class="fa fa-trash-o"></i></span>
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

<span id="confirm">sadf</span>

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