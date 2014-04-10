
    
        <script>
  $(document).ready(function() {
        $('#title').click(function() {
                $('#description').slideToggle("fast");
        });
    });
</script>
    <div id="main">
        <div><h3>Gadgets Warehouse</h3></div>
        <div id="nav_location">
            <ul>
                <li class="list-item">Header</li>
                    <ul>
                        <li>
                          Header ko gadget  
                        </li>
                    </ul>
                
                <li class="list-item">Navigation</li>
                    <ul>
                        <li>
                          Nav ko gadget  
                        </li>
                    </ul>
                
                <li class="list-item">body</li>
                    <ul>
                        <li>
                          body ko gadget  
                        </li>
                    </ul>
                
                <li class="list-item">Footer</li>
                    <ul>
                        <li>
                          Footer ko gadget  
                        </li>
                    </ul>
                
            </ul>
        </div>
       
            
        <div id="gadget_collection">
            
            
            <div id="add_gadget">
                <div style="font-size: 12px; border: thin solid #cccccc;">
        <?php if($this->session->flashdata('mess')){ echo $this->session->flashdata('mess');} ?>
        </div>
            <div id="title">Gadget title</div>
            <div id="description">
                
                    <?php echo form_open('gadgets/addText'); ?>
                <input type="text" id="inputtype" placeholder="Title" name="name_gadget">
                <textarea id="txtarea" placeholder="Description" name="type_gadget"></textarea>
                
                <?php
                   $gadgets=array('Header','Navigation','Body','Footer');
                    echo "Where to display: ";
                    echo "<select>";
                    echo ' <option disabled selected>Select your option</option>';
                    foreach($gadgets as $gadget)
                    {
                    echo "<option>";
                    echo $gadget;
                    echo "</option>";
                     }
                    echo "</select>";
                    ?>
                    <input type="submit" value="Add Gadget" id="btn" name="submit">
                    <?php echo form_close(); ?>
            </div>
        </div>
      
            
             <div id='sub_gadget'>
              
                    <?php
                    //die($gaget);
                    //$gaget = array($data->name,$data->type,$data->display,$data->setting);    
                     foreach ($gaget as $data){ 
                         //echo $data;
                         ?>
                        
                          <div id='title_in_collection'><?php echo $data->name; ?></div>
                          <div id='description_in_collection'><?php echo $data->type; ?> </div>
                     
                  <?php
                          }
                  
                    ?>
                     
            
            <?php
                   
                    echo "<div style='padding:3px;'>";
                   $gadgets=array('Header','Navigation','Body','Footer');
                    echo "Where to display: ";
                    echo "<select>";
                    echo ' <option disabled selected>Select your option</option>';
                    foreach($gadgets as $gadget)
                    {
                    echo "<option>";
                    echo $gadget;
                    echo "</option>";
                     }
                    echo "</select>";
                    echo "<input type='submit' value='Add Gadget' id='btn' name='submit'>";
                    echo "</div>";
                    ?>
                    <?php
                    echo "</div>";
                    
                    ?>
            </div>
        </div>
    </div>
        
    