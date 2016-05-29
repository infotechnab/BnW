<div class="product">
   
    <h4>Latest Product</h4>
     <hr />
        <?php 
     $category = $this->dbmodel->get_category();
        
         if(!empty($pList)){
             ?>
        <table border="1" cellpadding="10" width="95%">
        <tr>
            <th>Category</th>
            <th>Product Name</th>
           
            <th>Price</th>
            <th>First Image</th>
           
        </tr>
        <?php
            foreach ($pList as $data){
            ?>
          <tr>
              <td><?php $cid = $data->category;
              $cateID = $this->dbmodel->get_category_id($cid);
              foreach ($cateID as $cName)
              {
                  $categoryName = $cName->category_name;
              }
              echo $categoryName;
              ?></td>
            <td><?php echo $data->name ?></td>
           
            <td><?php echo $data->price ?></td>
            <td><img src="<?php echo base_url()."content/uploads/images/".$data->image1; ?>" width="50" height="50" alt="Image not set!" /></td>
           
        </tr>
            <?php    
            }
        }
        else{
            echo '<h3>Sorry product are not available</h3>';
        }
            
    ?>
    </table>
</div>
</div>

</div>
 </div>
<div class="clear"></div>
        
    
        
        
        
    </div>