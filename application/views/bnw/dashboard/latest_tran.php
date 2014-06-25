<div class="sale_product">
    <div class="sale">

    
    <h4>Latest sales product </h4>
     <hr >
    
    
    <?php
    
    
         if(!empty($query)){
             ?>
        <table cellpadding="10">
        <tr  >
            <th>Transection ID</th>
            <th>Product Detail</th>
            
        </tr>
        <?php
            foreach ($query as $data){
            ?>
          <tr>
         
            <td id="userDetail" style="font-size: 14px; vertical-align: top;"> <?php $tid = $data->trans_id ; ?> <a href="<?php echo base_url().'index.php/bnw/viewdetail/?id='.$tid; ?>" Style="color:black; text-decoration: none; " > <div>
                <?php 
               echo "<b>".$tid."</b>";  
             ?>
                    </div>   </a>
          </td>
            <?php $getTransData = $this->dbmodel->TransDetail($tid); ?>
            <td> <div>
                 <?php foreach ($getTransData as $trandetail)
                     { 
                 $pid = $trandetail->p_id;
                 $oid = $trandetail->o_id;
                 $qty = $trandetail->qty;
                 
                 $product_Detail = $this->dbmodel->get_product_id($pid); ?>
                    <table>
                        <?php foreach ($product_Detail as $pdetail) { ?>
                        <tr>
                            <td rowspan="2"> <img src="<?php echo base_url()."content/uploads/images/".$pdetail->image1; ?>" width="60px" height="40px" /></td>
                            <td id="userDetail" style="font-size: 14px; vertical-align: top;">
                            <?php echo "<b>".$pdetail->name."</b>";  ?>
                            </td>
                        </tr>
                        <tr>
<!--                            <td> <?php //echo $pdetail->summary; ?></td>-->
                            <td id="userDetail" style="font-size: 14px; vertical-align: top;"><?php echo "Qnt :".$qty." ($".$pdetail->price.") = $".$qty * $pdetail->price; ?></td>
                        </tr>
                        <?php  } ?>
                    </table> <hr/>
                <?php  } ?>
                </div>
            </td>
          
            <!--<td></td>-->
           
           
            
            
           
        </tr>
            <?php    
            }
        }
        else{
            echo '<h3>Sorry transaction are not available</h3>';
        }
            
    ?>
    </table>
   
</div>

   