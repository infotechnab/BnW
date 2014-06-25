
<?php     foreach ($listOfMenu as $data)
                {
                  $categories[] = array('id'=> $data->id,'menu_name'=>$data->menu_name); 
                } 
                if(!empty($listOfNavigation)){
                foreach ($listOfNavigation as $data){
                   $subcats[$data->menu_id][] = array('nid'=>$data->id,'menu_id'=>$data->menu_id,'nname'=>$data->navigation_name); 
                }
                
                }
 $jsonCats = json_encode($categories);
  $jsonSubCats = json_encode($subcats);
 
  
?>

<script type="text/javascript">

(function($) { 
$.fn.changeType = function(){
    <?php
        echo "var categories = $jsonCats; \n";
        echo "var subcats = $jsonSubCats; \n";
      ?>
              <?php
              
                $initial= '             

    
    var data = [';
                echo $initial;
                
                foreach ($listOfMenu as $data)
                {
                    echo'{"department":'.'"'.$data->menu_name.'",'.'"jobs":[';
                    $subCategory = $this->dbmodel->get_subList($data->id);
                    foreach ($subCategory as $nextData)
                    {
                        echo '{"title":"'.$nextData->navigation_name.'"},';
                    }
                    echo "]},";
                }
                echo ']';
              ?>


        var options_departments = '<option value="0">Select Menu<\/option>';
        $.each(data, function(i,d){
            options_departments += '<option value="' + d.department + '">' + d.department + '<\/option>';
        });
        $("select#departments", this).html(options_departments);
       
        $("select#departments", this).change(function(){
            var index = $(this).get(0).selectedIndex;
            var d = data[index-1];  // -1 because index 0 is for empty 'Select' option
            var options = '<option>Make Parent<\/option>';
            if (index > 0) {
                $.each(d.jobs, function(i,j){
                            options += '<option value="'+ j.title + '">' + j.title + '<\/option>';
                });
            } else {
                options += '<option>Make Parent<\/option>';
            }
            $("select#jobs").html(options);
        })
};
   
})(jQuery);


$(document).ready(function() {
    $("form#search").changeType();
});

$(document).ready(function() {
    $("form#search").changeType();
});
/* ]]> */
</script>

<!-- NAvigation items list shown here  -->
 <div class="rightSide">
     <div class="titleArea">
     <h2>Dashboard >> Navigation</h2>
<hr class="hr-gradient"/>   
    </div>
      <p style="color: red;">
            <?php if(isset($token_error)){ echo $token_error;} ?>
        </p>
    <div class="forLeft">
    <div class="left">
       
        <div id="navigationLeftUp"> 
         
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    
    <h3>List of all pages</h3>
        </div>
    <?php echo form_open_multipart('dashboard/addPageForNavigation', array('id' => 'search', 'name'=>'search'));?> 
    <div id="navigationLeftMiddle">
    <ul>
        
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
     <select style="width: 110px" name="departments" id="departments">
        <option value ="0">Select Menu</option>
    </select>
           
    <select style="width: 150px" name="jobs" id="jobs">
        <option>Make Parent</option>
    </select>      
            <input type="submit" value="Add">
        
    </div>
        <?php echo form_close();?>
    </div>
           
      <!-- Top left div for choosing page, menu and parent is closed -->       
            
   
    <div class="left">
        <div id="navigationLeftUp">    
        
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    <h3>List of all category</h3>
        </div>
    <?php echo form_open_multipart('dashboard/addCategoryForNavigation',array('id' => 'search', 'name'=>'search'));?>    
        <div id="navigationLeftMiddle">
    
    <ul>
        
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
            <select style="width: 110px" name="departments" id="departments">
        <option value="0" >Select Menu</option>
    </select>
           
    <select style="width: 150px" name="jobs" id="jobs">
        <option>Make Parent</option>
    </select>
            <input type="submit" value="Add">
       
    </div>
     <?php echo form_close();?>
    </div>
      
      <!-- Middle left div for choosing category, menu and parent is closed -->      
      
      <div class="left">
        <div id="customLinkLeftUp">
            <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
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
              
            <select name="selectMenu" style="width: 110px">
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
        <div id="navigationLeftMiddle">
           <h3>Available Navigations</h3> 
        </div>
        
        
       <script type="text/javascript">
   function changeFunc() {
    var selectBox = document.getElementById("selectBox");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    
    var dataString = 'menu_id_next=' + selectedValue;
    $a= dataString;
    var link = '<?php echo base_url();?>'+'index.php/dashboard/showNavigation/'+selectedValue;
    var editLink = '<a href='+link+'>'+'Edit Navigation'+'</a>';
    var mLink = '<?php echo base_url();?>'+'index.php/dashboard/manageNavigation/'+selectedValue;
    var manageLink = '<a href='+mLink+'>'+'Manage Navigation'+'</a>';
   var blank = '';
  $.ajax({
  type: "POST",
  url: "<?php echo base_url().'index.php/bnw/menu_id_from_ajax' ;?>",
  data: dataString,
   success: function(msg) 
         {
             $("#cssmenu").html(msg);
             if(selectedValue >0)
                 {
                  
             $("#editLink").html(editLink);
             $("#manLink").html(manageLink);
                 }
                 else{
                     $("#editLink").html(blank);
             $("#manLink").html(blank);
                 }
                 
         }
  
    
  });
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
  
        <div id='cssmenu'>
		
                    
<?php 
$this->load->helper('myhelper_helper');

fetch_menu (query(0));

?>

		
	</div>
  </div> 
  
  <p id="editLink"> </p>   <p id="manLink" > </p>
    </div>
    
    <div class="clear"></div> 
</div>
<div class="clear"></div>
</div>





<!-- upto here -->

 