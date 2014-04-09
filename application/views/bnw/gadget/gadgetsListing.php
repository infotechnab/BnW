
    
        <script>
  $(document).ready(function() {
        $('#title').click(function() {
                $('#description').slideToggle("fast");
        });
    });
</script>
    <div id="main">
        <div id="nav_location">
            <div id="header">HEADER</div>
            <div id="header_gadget" class="gadget">header ko gadget</div>
            
            
            <div id="nav">NAVIGATION</div>
            <div id="nav_gadget" class="gadget">Navigation ko gadget</div>
            
            
            <div id="body">BODY</div>
            <div id="body_gadget" class="gadget">Body ko gadget</div>
            
            
            <div id="footer">FOOTER</div>
            <div id="footer_gadget">footer ko gadget</div>
            
            
        </div>
       
            
        <div id="gadget_collection">
            <div id="its_title"> Gadgets Warehouse</div>
            
            <div id="add_gadget">
                <div style="font-size: 12px; border: thin solid #cccccc;">
        <?php if($this->session->flashdata('mess')){ echo $this->session->flashdata('mess');} ?>
        </div>
            <div id="title">Gadget title</div>
            <div id="description">
                
                    <?php echo form_open('welcome/addText'); ?>
                <input type="text" id="inputtype" placeholder="Title" name="title">
                <textarea id="txtarea" placeholder="Description" name="description"></textarea>
                
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
        
    