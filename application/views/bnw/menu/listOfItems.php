<div class="rightSide">
    <div class="forLeft">
    <div class="left">
        <div id="navigationLeftUp"> 
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    
    <p>List of all pages</p>
        </div>
    
    <div id="navigationLeftMiddle">
    <ul>
        <?php echo form_open_multipart('bnw/addPageForNavigation');?>
      <?php    
        if(isset($listOfPage)){
            foreach ($listOfPage as $pagedata){
                
            ?>
     
     
        <li><input type="checkbox" name="<?php echo $str = preg_replace('/\s+/', '', $pagedata->page_name); ?>" value="<?php echo $pagedata->page_name; ?>"/><?php echo $pagedata->page_name; ?></li>
      
          <?php    
            }
        }
    ?>
    </ul> 
    </div>
    
    <div id="navigationLeftDown">
    
    
            <select name="selectMenu">
                <?php
                foreach ($listOfMenu as $data)
                {
                    ?>
                <option value="<?php echo $data->menu_name; ?>">
                    <?php echo $data->menu_name; ?>
                </option>
                    <?php
                }
                ?>
          
            </select>
    
    <select name="selectNavigation">
        <option value=" ">
                    Make Parent
                </option>
                <?php
                foreach ($listOfNavigation as $data)
                {
                    ?>
                <option value="<?php echo $data->id; ?>">
                    <?php echo $data->navigation_name; ?>
                </option>
                    <?php
                }
                ?>
          
            </select>
            <input type="submit" value="Add">
        <?php echo form_close();?>
    </div>
    </div>
           
      <!-- Top left div for choosing page, menu and parent is closed -->       
            
   
    <div class="left">
        <div id="navigationLeftUp">    
        
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    <p>List of all category</p>
        </div>
        
        <div id="navigationLeftMiddle">
    
    <ul>
        <?php echo form_open_multipart('bnw/addCategoryForNavigation');?>
      <?php    
        if(isset($listOfCategory)){
            foreach ($listOfCategory as $categorydata){
                
            ?>
     
     
        <li><input type="checkbox" name="<?php echo $str = preg_replace('/\s+/', '', $categorydata->category_name); ?>" value="<?php echo $str = preg_replace('/\s+/', '', $categorydata->category_name); ?>"/><?php echo $categorydata->category_name; ?></li>
      
          <?php    
            }
        }
    ?>
    </ul> 
        </div>
        
        <div id="navigationLeftDown">
            <select name="selectMenuCategory">
                <?php
                foreach ($listOfMenu as $data)
                {
                    ?>
                <option value="<?php echo $data->menu_name; ?>">
                    <?php echo $data->menu_name; ?>
                </option>
                    <?php
                }
                ?>
          
            </select>
    
    <select name="selectNavigation">
        <option value=" ">
                    Make Parent
                </option>
                <?php
                foreach ($listOfNavigation as $data)
                {
                    ?>
                <option value="<?php echo $data->id; ?>">
                    <?php echo $data->navigation_name; ?>
                </option>
                    <?php
                }
                ?>
          
            </select>
            <input type="submit" value="Add">
        <?php echo form_close();?>
    </div></div>
      
      <!-- Middle left div for choosing category, menu and parent is closed -->      
      
      <div class="left">
        <div id="customLinkLeftUp">
            <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
            <p>Create Custom Menu Link</p>
            
        </div>
        
          <div id="customLinkLeftMiddle">
        <?php echo form_open_multipart('bnw/addCustomLink');?>
            
           <p>Navigation Title :
            <input type="text" name="navigation_name" placeholder="Type Navigation name" required/>
            </p>
            
            <p>Custom Menu Link :
            <input type="text" name="navigation_link" placeholder="Type Custom Menu Link" required/>
            </p>
              
            <select name="selectMenu">
                <?php
                foreach ($listOfMenu as $data)
                {
                    ?>
                <option value="<?php echo $data->menu_name; ?>">
                    <?php echo $data->menu_name; ?>
                </option>
                    <?php
                }
                ?>
          
            </select>
            
              
             
            <input type="submit" value="Add">
        <?php echo form_close();?>
    </div></div>   

      
     <!-- Bottom left div for creating custom link is closed -->       
      
      
        
    </div> 
    <div class="right">
        <p>List Of all Navigation</p>
        
        <div id='cssmenu'>
		<ul>
                    
<?php

//$this->load->helper('myHelper');

//fetch_menu (query(0));

?>

		</ul>
	</div>
        <div>
            <ul>
            <?php foreach($listOfMenu as $data){
                
                $menu_id= $data->id;
                $name = $data->menu_name; ?>
               <h4> <?php echo $name; ?> </h4> <?php
                $this->load->helper('myHelper');
                fetch_menu (main_menu_query($menu_id));
            } ?>
               </ul>
        </div>
        
    </div>
    
    <div class="clear"></div> 
</div>
<div class="clear"></div>
</div>