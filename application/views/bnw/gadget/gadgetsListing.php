<div class="rightSide"> <!-- rightside open -->
    <div id="forLeftPage"><h2>Gadgets Warehouse</h2></div>
    <div id="main"> <!-- main open -->
       
        <div id="nav_location"> <!-- nav_location open -->
            <ul>
                <li class="list-item" id="header_display">Header</li>
                    <ul>
                        <?php
                            foreach ($gaget as $datas)
                            { 
                                if($datas->display == "Header")
                                {
                                echo "<li id='option_gadget' class='header_gadgets'>";
                                echo $datas->name;
                                echo "<br>";
                                echo form_open('gadgets/hide'); 
                                echo "<select name='hide'><option value='1'>Show</option><option value='0'>Hide</option></select>";
                                echo "<input type='submit' value='submit'>";
                                echo "<input type='hidden' value='$datas->name' name='name_hide'>";
                                echo form_close();
                                echo form_open('gadgets/delete'); 
                                echo "<input type='hidden' value='$datas->name' name='name_hide'>";
                                echo "<input type='submit' value='Delete' name='delete'>";
                                echo form_close();
                                echo "</li>";
                                }
                            }
                            ?>
                    </ul>
                
                <li class="list-item" id="sidebar_display">Sidebar</li>
                    <ul>
                        <?php
                            foreach ($gaget as $datas)
                            {
                                if($datas->display == "Sidebar")
                                {
                                echo "<li id='option_gadget' class='sidebar_gadgets'>";
                                echo $datas->name;
                                echo "<br>";
                                echo form_open('gadgets/hide');
                                echo "<select name='hide'><option value='1'>Show</option><option value='0'>Hide</option></select>";
                                echo "<input type='submit' value='submit'>";
                                echo "<input type='hidden' value='$datas->name' name='name_hide'>";
                                echo form_close();
                                echo form_open('gadgets/delete'); 
                                echo "<input type='hidden' value='$datas->name' name='name_hide'>";
                                echo "<input type='submit' value='Delete' name='delete'>";
                                echo form_close();
                                echo "</li>";
                                }
                            }
                            ?> 
                    </ul>
                
                <li class="list-item" id="body_display">body</li>
                    <ul>
                        <?php
                            foreach ($gaget as $datas)
                            { 
                            
                                if($datas->display == "Body")
                                {    
                                echo "<li id='option_gadget' class='body_gadgets'>";
                                echo $datas->name;
                                echo "<br>";
                                echo form_open('gadgets/hide');
                                echo "<select name='hide'><option value='1'>Show</option><option value='0'>Hide</option></select>";
                                echo "<input type='submit' value='submit'>";
                                echo "<input type='hidden' value='$datas->name' name='name_hide'>";
                                echo form_close();
                                echo form_open('gadgets/delete'); 
                                echo "<input type='hidden' value='$datas->name' name='name_hide'>";
                                echo "<input type='submit' value='Delete' name='delete'>";
                                echo form_close();
                                echo "</li>";
                                }
                            }
                            ?>
                    </ul>
                
                <li class="list-item" id="footer_display">Footer</li>
                    <ul>
                           <?php
                            foreach ($gaget as $datas)
                            { 
                                if($datas->display == "Footer")
                                {
                                echo "<li id='option_gadget' class='footer_gadgets'>";
                                echo $datas->name;
                                echo "<br>";
                                echo form_open('gadgets/hide');
                                echo "<select name='hide'><option value='1'>Show</option><option value='0'>Hide</option></select>";
                                echo "<input type='submit' value='submit'>";
                                echo "<input type='hidden' value='$datas->name' name='name_hide'>";
                                echo form_close();
                                echo form_open('gadgets/delete'); 
                                echo "<input type='hidden' value='$datas->name' name='name_hide'>";
                                echo "<input type='submit' value='Delete' name='delete'>";
                                echo form_close();
                                echo "</li>";
                                }
                            }
                            ?>
                    </ul>
                
            </ul>
        </div> <!-- nav_location close -->
       
    <?php
    $this->load->helper('tamplate_helper'); 
    $var = tamplate_function();
    ?>
        
        <div id="gadget_collection"> <!-- gadget_collections open -->
            
            
            <div id="add_gadget"> <!-- add_gadget open -->
       <!--<div style="font-size: 12px; border: thin solid #cccccc;">
        <?php 
        //if($this->session->flashdata('mess'))
          //  {
          //  echo $this->session->flashdata('mess');
            
          //  }
        ?>
        </div>-->
            <div id="title">Click to Add Widgets</div>
            <div id="description">
                
                    <?php echo form_open('gadgets/addText'); ?>
                <input type="text" id="inputtype" placeholder="Title" name="name_gadget" required="required">
                <textarea id="txtarea" placeholder="Description" name="type_gadget" required="required"></textarea>
         
                Where to display:
                <select name="wheretodisplay">
                    <?php 
                    foreach($var as $temp)
                    {
                        echo "<option value=".$temp.">".$temp."</option>";

                    }
                        ?>
                    </select>
                    <input type="submit" value="Add Gadget" id="btn" name="submit">
                    <?php echo form_close(); ?>
            </div>
        </div>
      
                             <?php
                    //die($gaget);
                    //$gaget = array($data->name,$data->type,$data->display,$data->setting);    
                     foreach ($gaget as $data){ 
                         //echo $data;
                         ?>
   
             <div id='sub_gadget'>                     
                          <div id='title'><?php echo $data->name; ?></div>
                          <div id='description_in_collection'><?php echo $data->type; ?> </div>                
                Where to display:
                <?php echo form_open('gadgets/updateText'); ?>
                    <select name="display">
                    <?php 

                    foreach($var as $temp)
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
