<div class="rightSide">
<?php
if(isset($category))
{
    foreach ($category as $data)
    {
        $id = $data->id;
        $name = $data->category_name;
    }
}
?>
    <h2>Are You Sure To Delete <?php echo $name; ?> </h2> <br/> <h3> It will also delete all product associated with this category </h3>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open_multipart('bnw/delete_Product_cat/');?>
  
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      
      
  </p>
    <input type="submit" value="Yes" />
    <?php echo anchor('bnw/category', 'No');  ?>
  
 <?php 
    echo form_close(); ?>

<div>
    <h4>Related Product</h4>
    <div>
        <?php $related = $this->dbmodel->get_related_product($id); ?>
        <table>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Price</th>
            </tr>
            <?php foreach ($related as $product){ ?>
            <tr>
                <td><?php echo $product->name; ?></td>
                <td><?php if(isset($product->image1)){?><img src="<?php echo base_url()."content/uploads/images/".$product->image1; ?>" width="60px" height="40px" /> <?php } else { echo "Image not found" ;} ?></td>
                <td><?php echo $product->price; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
    
    <div>
        <h4> Change to another category </h4>
        
         <?php 
     $category = $this->dbmodel->get_categorys($id);
    echo form_open('bnw/change_category'); ?>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
     <select name="categoryProduct" id="categoryList">
     <?php          foreach ($category as $cName)
              { ?>
         <option value="<?php echo $cName->id; ?>">
                <?php echo $cName->category_name; ?>
         </option> <?php   } ?>
     </select>
     
     <input type="submit" value="Change category" />
    <?php 
    echo form_close(); ?>
        
        
        
        
    </div>
</div>
<div class="clear"></div>
</div>

