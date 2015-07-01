<script>
    $(document).ready(function(){
       $(document).on("change", "#departments", function(){
           var menu_id = $(this).val();
           var options;
           var thiss = $(this).next();
           $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url() . 'index.php/dashboard/fetchMenu'; ?>",
                                    data: {
                                        id : menu_id
                                    },
                                    success: function (dat)
                                    {
                                        thiss.html(" ");
                                        var data = JSON.parse(dat);
                                        var initOptions = "<option>Make Parent</option>";
                                        for(var i=0;i<data.length;i++)
                                        {
                                            options +="<option value='"+ data[i].navigation_name +"'>"+ data[i].navigation_name +"</option>";
                                        }
                                        thiss.html(initOptions + options);
                                    }


                                });
       });
    });
</script>
<!-- NAvigation items list shown here  -->
 <div class="rightSide">
     <div class="titleArea">
     <h2>Dashboard >> Navigation</h2>
<hr class="hr-gradient"/>   
    </div>
      <p style="color: red;">
            <?php if(isset($token_error)){ echo $token_error;} ?>
            <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
        </p>
    <div class="forLeft">
    <div class="left">
       
        <div id="navigationLeftUp"> 
    
    <h3>List of all pages</h3>
        </div>
    <?php echo form_open_multipart('dashboard/addPageForNavigation', array('id' => 'search', 'name'=>'search'));?> 
    <div id="navigationLeftMiddle">
    <ul>
        
      <?php    
        if(isset($listOfPage)){
            foreach ($listOfPage as $pagedata){
            ?>

        <li><input type="checkbox" name="<?php echo $str = htmlentities(preg_replace('/\s+/', '', $pagedata->page_name)); ?>" value="<?php echo htmlentities($pagedata->page_name); ?>"/><?php echo $pagedata->page_name; ?></li>
          <?php    
            }
        }
    ?>
    </ul> 
    </div>
    
    <div id="navigationLeftDown">
     <select style="width: 110px" name="departments" id="departments">
         <option value ="0">Select Menu</option>
         <?php foreach($listOfMenu as $menu) { ?>
        <option value ="<?php echo $menu->id; ?>"><?php echo $menu->menu_name; ?></option>
         <?php } ?>
    </select>
           
        <select style="width: 150px" name="jobs" id="jobs" class="jobs">
        <option>Make Parent</option>
    </select>      
            <input type="submit" value="Add">
        
    </div>
        <?php echo form_close();?>
    </div>
           
      <!-- Top left div for choosing page, menu and parent is closed -->       
            
   
    <div class="left">
        <div id="navigationLeftUp">    
    
    <h3>List of all category</h3>
        </div>
    <?php echo form_open_multipart('dashboard/addCategoryForNavigation',array('id' => 'search', 'name'=>'search'));?>    
        <div id="navigationLeftMiddle">
    
    <ul>
        
      <?php    
        if(isset($listOfCategory)){
            foreach ($listOfCategory as $categorydata){
                
            ?>
       <li><input type="checkbox" name="<?php echo $str = htmlentities(preg_replace('/\s+/', '', $categorydata->category_name)); ?>" value="<?php echo htmlentities($categorydata->category_name); ?>"/><?php echo $pagedata->page_name; ?></li>
          <?php    
            }
        }
    ?>
    </ul> 
        </div>
        
        <div id="navigationLeftDown">
            <select style="width: 110px" name="departments" id="departments">
        <option value ="0">Select Menu</option>
         <?php foreach($listOfMenu as $menu) { ?>
        <option value ="<?php echo $menu->id; ?>"><?php echo $menu->menu_name; ?></option>
         <?php } ?>
    </select>
           
    <select style="width: 150px" name="jobs" id="jobs" class="jobs">
        <option>Make Parent</option>
    </select>
            <input type="submit" value="Add">
       
    </div>
     <?php echo form_close();?>
    </div>
      
      <!-- Middle left div for choosing category, menu and parent is closed -->      
      
      <div class="left">
        <div id="customLinkLeftUp">
          
            <h3>Create Custom Menu Link</h3>
            
        </div>
        
          <div id="customLinkLeftMiddle">
        <?php echo form_open_multipart('dashboard/addCustomLink');?>
            
           <p>Navigation Title :
            <input type="text" name="navigation_name" placeholder="Type Navigation name" required/>
            </p>
            
            <p>Custom Menu Link :
            <input type="text" name="navigation_link" placeholder="Type Custom Menu Link" required/>
            </p>
              
            <select style="width: 110px" name="departments" id="departments">
        <option value ="0">Select Menu</option>
         <?php foreach($listOfMenu as $menu) { ?>
        <option value ="<?php echo $menu->id; ?>"><?php echo $menu->menu_name; ?></option>
         <?php } ?>
    </select>  
            
            <select style="width: 150px" name="jobs" id="jobs" class="jobs">
        <option>Make Parent</option>
    </select> 
            
            <input type="submit" value="Add">
        <?php echo form_close();?>
    </div></div>   

      
     <!-- Bottom left div for creating custom link is closed -->       
      
      
        
    </div> 
    <div class="right">
        <div id="navigationLeftMiddle">
           <h3>Available Navigations</h3> 
        </div>
        
        
       <script type="text/javascript">
           function changeFunc()
           {
                var selectBox = document.getElementById("selectBox");
                var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                var dataString = 'menu_id_next=' + selectedValue;
                if(selectedValue != "0") {
                 $.ajax({
                        type: "POST",
                        url: "<?php echo base_url().'index.php/dashboard/manageNavigation' ;?>",
                        data: dataString,
                         success: function(msg) 
                               {
                                   $("#cssmenu").html(msg);
                               }


                        });
                } else {
                    $("#cssmenu").html("Please Select Menu.");
                }
               
           }

  </script>
  <div id="navigation">
        <select name="selectMenu" style="width: 125px"  id="selectBox" onchange="changeFunc();">
             <option value="0" selected="selected"> Select Menu                    
             </option>
               <?php
                foreach ($listOfMenu as $data)
                {
                    ?>
                <option value="<?php echo $data->id; ?>">
                    <?php echo $data->menu_name; ?>
                </option>
                    <?php
                }
                ?>
          
            </select>
  <p style="color: green;"><span id="msges"></span></p>
        <div id='cssmenu'>
	
	</div>
  </div> 
  
    </div>
       
    <div class="clear"></div> 
</div>
<div class="clear"></div>
</div>


<style>
    ul li, li.has-sub {list-style: none;padding: 1%;}
    #fullNav i:hover{cursor: pointer;}
    .left{margin:0 0 5% 0;}
</style>


<!-- upto here -->
