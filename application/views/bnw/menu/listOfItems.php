<div class="rightSide">
    <div class="forLeft">
    <div class="left">
       
       <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    
    <p>List of all pages</p>
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
           
            
            
   
    <div class="left">
        <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    <p>List of all category</p>
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
    </div>
        
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