<?php
    $this->load->helper('tamplate_helper'); 
    $gadgetDisplay = tamplate_function(); 
    $recentPostGadget = recent_post();
    ?>

<div class="rightSide"> <!-- rightside open -->
    <div id="forLeftPage"><h2>Gadgets Warehouse</h2></div>
    <div id="main"> <!-- main open -->
       
        <div id="nav_location"> <!-- nav_location open -->
            <ul>
                <li class="list-item" id="header_display">Header</li>
                    <ul class='header_gadgets'  id='option_gadget'>
                        <?php
                            foreach ($gaget as $datas)
                            { 
                                if($datas->display == "Header")
                                {
                                ?>
                                <li>
                                <div class='whole'>
                                <div class='name'>
                                <?php echo $datas->name; ?> 
                                </div>              <!-- close name div-->
                                <div id='option'>
                                <div id='edit'>Edit</div> <!--close edit div-->
                                <div id='delete_option'>
                                <?php echo form_open('gadgets/delete'); ?> 
                                <input type='hidden' value='<?php echo $datas->name; ?>' name='name_hide'>
                                <input type='hidden' value='header' name='display'>
                                <input type='submit' value='' name='delete' id='delete'>
                                <?php echo form_close(); ?>
                                </div> <!--delete_option div close-->
                                </div> <!--option div close-->
                                </div> <!--close whole div-->
                                 </li>
                                <?php
                                }
                                
                            }
                            ?>
                    </ul>
                
                <li class="list-item" id="sidebar_display">Sidebar</li>
                    <ul  id='option_gadget' class='sidebar_gadgets'>
                        <?php
                            foreach ($gaget as $datas)
                            {
                                if($datas->display == "Sidebar")
                                {
                                    ?>
                                <li>
                                <div class='whole'>
                                <div class='name'>
                                <?php echo $datas->name;  ?>
                                </div>                       <!--close name div-->
                                <div id='option'>
                                    <div id='edit'>Edit</div> <!--close edit div-->
                                <div id='delete_option'>
                                <?php echo form_open('gadgets/delete');  ?>
                                <input type='hidden' value='<?php echo $datas->name; ?>' name='name_hide'>
                                <input type='hidden' value='sidebar' name='display'>
                                <input type='submit' value='' name='delete' id='delete'>
                                <?php echo form_close(); ?>
                                 </div> <!--delete_option div close-->
                                </div> <!--option div close-->
                                </div> <!--close whole div-->
                                </li>
                                <?php
                                }
                            }
                            ?> 
                    </ul>
                
                <li class="list-item" id="body_display">Body</li>
                    <ul  id='option_gadget' class='body_gadgets'>
                        <?php
                            foreach ($gaget as $datas)
                            { 
                                if($datas->display == "Body")
                                {    
                                    ?>
                                <li>
                                <div class='whole'>
                                <div class='name'>
                                <?php echo $datas->name;  ?>
                                </div>              <!--close name div-->
                                <div id='option'>
                                <div id='edit'>Edit</div> <!--close edit div-->
                                <div id='delete_option'>
                                <?php echo form_open('gadgets/delete'); ?>
                                <input type='hidden' value='<?php echo $datas->name; ?>' name='name_hide'>
                                <input type='hidden' value='body' name='display'>
                                <input type='submit' value='' name='delete' id='delete'>
                                <?php echo form_close(); ?>
                                </div> <!--delete_option div close-->
                                </div> <!--option div close-->
                                </div> <!--close whole div-->
                                </li>
                                <?php
                                }    
                            }
                            ?>
                    </ul>
                
                <li class="list-item" id="footer_display">Footer</li>
                    <ul  id='option_gadget' class='footer_gadgets'>
                           <?php
                            foreach ($gaget as $datas)
                            { 
                                if($datas->display == "Footer")
                                {
                                    ?>
                                <li>
                                <div class='whole'>
                                <div class='name'>
                                <?php echo $datas->name; ?>
                                </div>                      <!--close name div-->
                                <div id='option'>
                                <div id='edit'>Edit</div> <!--close edit div-->
                                <div id='delete_option'>
                                <?php echo form_open('gadgets/delete'); ?>
                                <input type='hidden' value='<?php echo $datas->name; ?>' name='name_hide'>
                                <input type='hidden' value='footer' name='display'>
                                <input type='submit' value='' name='delete'  id='delete'>
                                <?php echo form_close(); ?>
                                </div> <!--delete_option div close-->
                                </div> <!--option div close-->
                                </div> <!--close whole div-->
                                </li>
                                <?php
                                }
                            }
                            ?>
                    </ul>
                
            </ul>
        </div> <!-- nav_location close -->
       
    <?php
    $this->load->helper('tamplate_helper'); 
    $gadgetDisplay = tamplate_function(); 
    ?>
        
        <div id="gadget_collection"> <!-- gadget_collections open -->
            
            
            <div id="sub_gadget"> <!-- sub_gadget open -->
       
        <?php 
        //if($this->session->flashdata('mess'))
          //  {
          //  echo $this->session->flashdata('mess');
            
          //  }
        ?>
        
            <div id="title">Click to Add Widgets</div>
            
                <div id="description">
                    <?php echo form_open('gadgets/addText'); ?>
                <input type="text" id="inputtype" placeholder="Title" name="name_gadget">
             
                <textarea id="txtarea" placeholder="Description" name="type_gadget" required="required"></textarea>
            </div>
            Where to display:<br>
                <select name="wheretodisplay">
                    <?php 
                    foreach($gadgetDisplay as $temp)
                    {
                        echo "<option value=".$temp.">".$temp."</option>";

                    }
                        ?>
                    </select>
                    <input type="submit" value="Add Gadget" id="btn" name="submit">
                    <?php echo form_close(); ?>
            </div>
     
      
            <!-- Default gadget -->
              <div id="sub_gadget"> <!-- sub_gadget open -->
                <div id="title">Recent Post</div>
            
                <div id="description_for_gadget">
                    <?php echo form_open('gadgets/defaultGadget'); ?>
                <input type="text" id="inputtype" placeholder="Title" name="name_gadget">
                <input type="hidden" value="recent post" name="recentPost_gadget">
             <?php
             foreach($recentPostGadget as $element)
             {
              echo "No. of Post:"."<input type=".$element['noOfPost']." name='noOfPost'>"."<br>";
              echo "View More:"."<input type=".$element['viewMore']." name='viewMore' value='View More'>";
              
             }
             ?>
                
            </div>
            Where to display:<br>
                <select name="wheretodisplay">
                    <?php 
                    foreach($gadgetDisplay as $temp)
                    {
                        echo "<option value=".$temp.">".$temp."</option>";

                    }
                        ?>
                    </select>
                    <?php $concate =$element['noOfPost'].$element['viewMore']; ?>
                   
                    <input type="submit" value="Add Gadget" id="btn" name="submit">
                    <?php echo form_close(); ?>
            </div>
            <!-- Default gadget - upto here-->
            
            
            
                             <?php
                        foreach ($gaget as $data){ 
                   
                         ?>
   
             <div id='sub_gadget'>                     
                          <div id='title'><?php echo $data->name; ?></div>
                          <div id='description_for_gadget'><?php echo $data->type; ?> </div>                
                Where to display:
                <?php echo form_open('gadgets/updateText'); ?>
                    <select name="display">
                    <?php 

                    foreach($gadgetDisplay as $temp)
                    {
                        echo "<option value=".$temp.">".$temp."</option>";

                    }
                    ?>
                    </select>
                <input type="hidden" value="<?php echo $data->name; ?>" name="gadget_name">
                <input type="hidden" value="<?php echo $data->type; ?>" name="gadget_type">
                
                    <input type='submit' value='Add Gadget' id='btn' name='submit'>
                    <?php echo form_close(); ?>
            </div> 
                  <?php
                          }
                  
                    ?>
                     
            
        </div>
        
    </div>
        <div class="clear"></div>
</div>
<div class="clear"></div>
</div>
