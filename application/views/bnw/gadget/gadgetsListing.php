<?php
$data['template'] = $this->load->view('menuview/template_meta_data');
$gadgetDisplay = template_function();
//var_dump($gadgetDisplay);


    $this->load->helper('tamplate_helper'); 
    $recentPostGadget = recent_post();
    ?>

<div class="rightSide"> <!-- rightside open -->
    <div id="forLeftPage"><h2>Gadgets</h2></div>
    <div id="main"> <!-- main open -->
       
        <div id="nav_location"> <!-- nav_location open -->
            <ul>
                <li class="list-item">Header</li>
                    <ul class='header_gadgets'  id='option_gadget'>
                       
                        <?php
                      
                            foreach ($gaget as $datas)
                                { 
                                
                                if($datas->display == "Header")
                                {
                                    $setting = $datas->setting;
                                    parse_str($setting);
                                   // echo $post;
                                    //echo $titleBold;
                                    //echo $titleUnderline;
                                    //echo $titleColor;
                                ?>
                                <li>
                                    <div id='single_gadget_edit'>
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
                                
                                <div>
                                    <div id="edit_recentPost_toggle">
                                        
                                        <?php if($datas->defaultGadget == 'recent post') { ?>
                                        <div id="recentPostEdit">
                                         <div id="description_for_gadget">
                    <?php echo form_open('gadgets/defaultGadgetUpdate'); ?>
                    <input type="text" id="inputtype" placeholder="Title" name="name_gadget" value="<?php echo $datas->name; ?>" required>
                <input type="hidden" value="recent post" name="recentPost_gadget">
                <input type='hidden' value='header' name='display'>
                <table id="table" border="0">
                    
             <?php
                                              //   var_dump($a);
             foreach($recentPostGadget as $element)
             {
                 ?>
                    <tr><td>No. of Post:</td><td><input type="<?php echo $element['noOfPost']; ?>" name='noOfPost' class='onlyNumerics' size='5' value='<?php if(!empty($post)){ echo $post; } ?>' required><div style='font-size:12px; float:right;'> Enter Only numbers.</div></td></tr>
              <tr><td>Title Bold:</td><td><input type="<?php echo $element['titleBold']; ?>" name='titleBold' value='b' <?php if(!empty($titleBold)){ echo 'checked'; } ?>></td></tr>
              <tr><td>Title Underline:</td><td><input type="<?php echo $element['titleUnderline']; ?>" name='titleUnderline' value='u' <?php if(!empty($titleUnderline)){ echo 'checked'; } ?>></td></tr>
              <tr><td>Title Color:</td><td><input type="<?php echo $element['titleColor']; ?>" name='titleColor' value='<?php if(!empty($titleColor)){ echo $titleColor; } ?>'></td></tr>
            <?php  
             }
             ?>
                </table>    
            </div>
                                            <div>
           
                   
                    <input type="submit" value="Update Gadget" id="btn" name="submit">
                    <?php echo form_close(); ?>
            </div>
                                            
                                    </div> <!-- recentPostEdit div close -->
                                    </div>
                                </div>
                                        <?php }
                                        else if($datas->defaultGadget !== 'recent post')
                                        {
                                            ?>
                                        
                                             <div id="textEdit">
                                     <?php echo form_open('gadgets/textBoxUpdate'); ?>
                                                 <input type="text" value="<?php echo $datas->name; ?>" id='inputtype' name="name_gadget">
                                                 <textarea id='txtarea' name="type"><?php echo $datas->type; ?></textarea>
                                      <input type='hidden' value='header' name='display'>
                                    <div>
           
                    
                   
                    <input type="submit" value="Update Gadget" id="btn" name="submit">
                    <?php echo form_close(); ?>
            </div>
                                             </div>
                                
                                       <?php }
                                       ?> 
                                         
                                    <div>
                                        
                                    </div>
                                </div>
                                 </li>
                                <?php
                                }
                            }
                        
                        
                      ?>
                    </ul>
                
                <li class="list-item">Sidebar<div class="arrow"></div></li>
                    <ul  id='option_gadget' class='sidebar_gadgets'>
                        
                        <?php
                      
                            foreach ($gaget as $datas)
                                { 
                                
                                if($datas->display == "Sidebar")
                                {
                                    $setting = $datas->setting;
                                    parse_str($setting);
                                   // echo $post;
                                    //echo $titleBold;
                                    //echo $titleUnderline;
                                    //echo $titleColor;
                                ?>
                                <li>
                                    <div id='single_gadget_edit'>
                                <div class='whole'>
                                <div class='name'>
                                <?php echo $datas->name; ?> 
                                </div>              <!-- close name div-->
                                <div id='option'>
                                <div id='edit'>Edit</div> <!--close edit div-->
                                <div id='delete_option'>
                                <?php echo form_open('gadgets/delete'); ?> 
                                <input type='hidden' value='<?php echo $datas->name; ?>' name='name_hide'>
                                <input type='hidden' value='sidebar' name='display'>
                                <input type='submit' value='' name='delete' id='delete'>
                                <?php echo form_close(); ?>
                                </div> <!--delete_option div close-->
                                </div> <!--option div close-->
                                </div> <!--close whole div-->
                                
                                <div>
                                    <div id="edit_recentPost_toggle">
                                        
                                        <?php if($datas->defaultGadget == 'recent post') { ?>
                                        <div id="recentPostEdit">
                                         <div id="description_for_gadget">
                    <?php echo form_open('gadgets/defaultGadgetUpdate'); ?>
                    <input type="text" id="inputtype" placeholder="Title" name="name_gadget" value="<?php echo $datas->name; ?>" required>
                <input type="hidden" value="recent post" name="recentPost_gadget">
                <input type='hidden' value='sidebar' name='display'>
                <table id="table" border="0">
                    
             <?php
                                              //   var_dump($a);
             foreach($recentPostGadget as $element)
             {
                 ?>
                    <tr><td>No. of Post:</td><td><input type="<?php echo $element['noOfPost']; ?>" name='noOfPost' class='onlyNumerics' size='5' value='<?php if(!empty($post)){ echo $post; } ?>' required><div style='font-size:12px; float:right;'> Enter Only numbers.</div></td></tr>
              <tr><td>Title Bold:</td><td><input type="<?php echo $element['titleBold']; ?>" name='titleBold' value='b' <?php if(!empty($titleBold)){ echo 'checked'; } ?>></td></tr>
              <tr><td>Title Underline:</td><td><input type="<?php echo $element['titleUnderline']; ?>" name='titleUnderline' value='u' <?php if(!empty($titleUnderline)){ echo 'checked'; } ?>></td></tr>
              <tr><td>Title Color:</td><td><input type="<?php echo $element['titleColor']; ?>" name='titleColor' value='<?php if(!empty($titleColor)){ echo $titleColor; } ?>'></td></tr>
            <?php  
             }
             ?>
                </table>    
            </div>
                                            <div>
          
                    
                   
                    <input type="submit" value="Update Gadget" id="btn" name="submit">
                    <?php echo form_close(); ?>
            </div>
                                            
                                    </div> <!-- recentPostEdit div close -->
                                    </div>
                                </div>
                                        <?php }
                                        else if($datas->defaultGadget !== 'recent post')
                                        {
                                            ?>
                                        
                                             <div id="textEdit">
                                     <?php echo form_open('gadgets/textBoxUpdate'); ?>
                                                 <input type="text" value="<?php echo $datas->name; ?>" id='inputtype' name="name_gadget">
                                                 <textarea id='txtarea' name="type"><?php echo $datas->type; ?></textarea>
                                       <input type='hidden' value='sidebar' name='display'>
                                    <div>
         
                    
                   
                    <input type="submit" value="Update Gadget" id="btn" name="submit">
                    <?php echo form_close(); ?>
            </div>
                                             </div>
                                
                                       <?php }
                                       ?> 
                                         
                                    <div>
                                        
                                    </div>
                                </div>
                                 </li>
                                <?php
                                }
                            }
                        
                        
                      ?>
                    </ul>
                
                <li class="list-item">Body<div class="arrow"></div></li>
                    <ul  id='option_gadget' class='body_gadgets'>
                        
                        <?php
                      
                            foreach ($gaget as $datas)
                                { 
                                
                                if($datas->display == "Body")
                                {
                                    $setting = $datas->setting;
                                    parse_str($setting);
                                   // echo $post;
                                    //echo $titleBold;
                                    //echo $titleUnderline;
                                    //echo $titleColor;
                                ?>
                                <li>
                                    <div id='single_gadget_edit'>
                                <div class='whole'>
                                <div class='name'>
                                <?php echo $datas->name; ?> 
                                </div>              <!-- close name div-->
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
                                
                                <div>
                                    <div id="edit_recentPost_toggle">
                                        
                                        <?php if($datas->defaultGadget == 'recent post') { ?>
                                        <div id="recentPostEdit">
                                         <div id="description_for_gadget">
                    <?php echo form_open('gadgets/defaultGadgetUpdate'); ?>
                    <input type="text" id="inputtype" placeholder="Title" name="name_gadget" value="<?php echo $datas->name; ?>" required>
                <input type="hidden" value="recent post" name="recentPost_gadget">
              <input type='hidden' value='body' name='display'>
                <table id="table" border="0">
                    
             <?php
                                              //   var_dump($a);
             foreach($recentPostGadget as $element)
             {
                 ?>
                    <tr><td>No. of Post:</td><td><input type="<?php echo $element['noOfPost']; ?>" name='noOfPost' class='onlyNumerics' size='5' value='<?php if(!empty($post)){ echo $post; } ?>' required><div style='font-size:12px; float:right;'> Enter Only numbers.</div></td></tr>
              <tr><td>Title Bold:</td><td><input type="<?php echo $element['titleBold']; ?>" name='titleBold' value='b' <?php if(!empty($titleBold)){ echo 'checked'; } ?>></td></tr>
              <tr><td>Title Underline:</td><td><input type="<?php echo $element['titleUnderline']; ?>" name='titleUnderline' value='u' <?php if(!empty($titleUnderline)){ echo 'checked'; } ?>></td></tr>
              <tr><td>Title Color:</td><td><input type="<?php echo $element['titleColor']; ?>" name='titleColor' value='<?php if(!empty($titleColor)){ echo $titleColor; } ?>'></td></tr>
            <?php  
             }
             ?>
                </table>    
            </div>
                                            <div>
           
                    
                   
                    <input type="submit" value="Update Gadget" id="btn" name="submit">
                    <?php echo form_close(); ?>
            </div>
                                            
                                    </div> <!-- recentPostEdit div close -->
                                    </div>
                                </div>
                                        <?php }
                                        else if($datas->defaultGadget !== 'recent post')
                                        {
                                            ?>
                                        
                                             <div id="textEdit">
                                     <?php echo form_open('gadgets/textBoxUpdate'); ?>
                                                 <input type="text" value="<?php echo $datas->name; ?>" id='inputtype' name="name_gadget">
                                                 <textarea id='txtarea' name="type"><?php echo $datas->type; ?></textarea>
                                                 <input type='hidden' value='body' name='display'>
                                    <div>
            
                   
                    <input type="submit" value="Update Gadget" id="btn" name="submit">
                    <?php echo form_close(); ?>
            </div>
                                             </div>
                                
                                       <?php }
                                       ?> 
                                         
                                    <div>
                                        
                                    </div>
                                </div>
                                 </li>
                                <?php
                                }
                            }
                        
                        
                      ?>
                    </ul>
                
                <li class="list-item">Footer<div class="arrow"></div></li>
                    <ul  id='option_gadget' class='footer_gadgets'>
                           
                        <?php
                      
                            foreach ($gaget as $datas)
                                { 
                                
                                if($datas->display == "Footer")
                                {
                                    $setting = $datas->setting;
                                    parse_str($setting);
                                   // echo $post;
                                    //echo $titleBold;
                                    //echo $titleUnderline;
                                    //echo $titleColor;
                                ?>
                                <li>
                                    <div id='single_gadget_edit'>
                                <div class='whole'>
                                <div class='name'>
                                <?php echo $datas->name; ?> 
                                </div>              <!-- close name div-->
                                <div id='option'>
                                <div id='edit'>Edit</div> <!--close edit div-->
                                <div id='delete_option'>
                                <?php echo form_open('gadgets/delete'); ?> 
                                <input type='hidden' value='<?php echo $datas->name; ?>' name='name_hide'>
                                <input type='hidden' value='footer' name='display'>
                                <input type='submit' value='' name='delete' id='delete'>
                                <?php echo form_close(); ?>
                                </div> <!--delete_option div close-->
                                </div> <!--option div close-->
                                </div> <!--close whole div-->
                                
                                <div>
                                    <div id="edit_recentPost_toggle">
                                        
                                        <?php if($datas->defaultGadget == 'recent post') { ?>
                                        <div id="recentPostEdit">
                                         <div id="description_for_gadget">
                    <?php echo form_open('gadgets/defaultGadgetUpdate'); ?>
                    <input type="text" id="inputtype" placeholder="Title" name="name_gadget" value="<?php echo $datas->name; ?>" required>
                <input type="hidden" value="recent post" name="recentPost_gadget">
               <input type='hidden' value='footer' name='display'>
                <table id="table" border="0">
                    
             <?php
                                              //   var_dump($a);
             foreach($recentPostGadget as $element)
             {
                 ?>
                    <tr><td>No. of Post:</td><td><input type="<?php echo $element['noOfPost']; ?>" name='noOfPost' class='onlyNumerics' size='5' value='<?php if(!empty($post)){ echo $post; } ?>' required><div style='font-size:12px; float:right;'> Enter Only numbers.</div></td></tr>
              <tr><td>Title Bold:</td><td><input type="<?php echo $element['titleBold']; ?>" name='titleBold' value='b' <?php if(!empty($titleBold)){ echo 'checked'; } ?>></td></tr>
              <tr><td>Title Underline:</td><td><input type="<?php echo $element['titleUnderline']; ?>" name='titleUnderline' value='u' <?php if(!empty($titleUnderline)){ echo 'checked'; } ?>></td></tr>
              <tr><td>Title Color:</td><td><input type="<?php echo $element['titleColor']; ?>" name='titleColor' value='<?php if(!empty($titleColor)){ echo $titleColor; } ?>'></td></tr>
            <?php  
             }
             ?>
                </table>    
            </div>
                                            <div>
          
                    
                   
                    <input type="submit" value="Update Gadget" id="btn" name="submit">
                    <?php echo form_close(); ?>
            </div>
                                            
                                    </div> <!-- recentPostEdit div close -->
                                    </div>
                                </div>
                                        <?php }
                                        else if($datas->defaultGadget !== 'recent post')
                                        {
                                            ?>
                                        
                                             <div id="textEdit">
                                                  <?php echo form_open('gadgets/textBoxUpdate'); ?>
                                                 
                                                 <input type="hidden" value="<?php echo $datas->gadget_id; ?>" name="gadget_id" />
                                                 <input type="text" value="<?php echo $datas->name; ?>" id='inputtype' name="name_gadget">
                                                 <textarea id='txtarea' name="type"><?php echo $datas->type; ?></textarea>
                                                   <input type='hidden' value='footer' name='display'>
                                    <div>
          
                   
                    <input type="submit" value="Update Gadget" id="btn" name="submit">
                    <?php echo form_close(); ?>
            </div>
                                             </div>
                                
                                       <?php }
                                       ?> 
                                         
                                    <div>
                                        
                                    </div>
                                </div>
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
   // $gadgetDisplay = tamplate_function(); 
    ?>
        
        <div id="gadget_collection"> <!-- gadget_collections open -->
            
            
            <div id="sub_gadget"> <!-- sub_gadget open -->
       
        <?php 
        //if($this->session->flashdata('mess'))
          //  {
          //  echo $this->session->flashdata('mess');
            
          //  }
        ?>
        
            <div id="title">Click to add new text box 
                <div id="arrow"></div>
            </div>
                
                <div id="description">
                    <?php echo form_open('gadgets/addText'); ?>
                    <input type="text" id="inputtype" placeholder="Title" name="name_gadget" required="required">
                    <input type="hidden" name="textBox" value="textBox">
                <textarea id="txtarea" placeholder="Description" name="type_gadget" ></textarea>
            
                    <div id='gadget_action'>
            Choose Template:<br>
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
                </div>
              
            </div>
     
      
            <!-- Default gadget -->
              <div id="sub_gadget"> <!-- sub_gadget open -->
                <div id="title1">Recent Post
                    <div id="arrow1"></div>
                </div>
                <div id="description_for_gadget1">
                    <?php echo form_open('gadgets/defaultGadget'); ?>
                    <input type="text" id="inputtype" placeholder="Title" name="name_gadget" required>
                <input type="hidden" value="recent post" name="recentPost_gadget">
             <?php
             foreach($recentPostGadget as $element)
             {
              echo "No. of Post:"."<input type=".$element['noOfPost']." name='noOfPost' class='onlyNumerics' size='5' required>"."<div style='font-size:12px; float:right;'> Enter Only numbers.</div>"."<br>";
              echo "Title Bold:"."<input type=".$element['titleBold']." name='titleBold' value='b'><br>";
              echo "Title Underline:"."<input type=".$element['titleUnderline']." name='titleUnderline' value='u'><br>";
              echo "Title Color:"."<input type=".$element['titleColor']." name='titleColor' value=''>";
             }
             ?>
                
            
                <div id='gadget_action'>
            Choose Template:<br>
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
                </div>
            
            <!-- Default gadget - upto here-->
            
            
            
              </div>  
            
        </div>
        
    </div>
        <div class="clear"></div>
</div>
<div class="clear"></div>
</div>
