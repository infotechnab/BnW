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
        var initOptions = "<option value='Make Parent'>Make Parent</option>";
        var options ='';
        for(var i=0;i<data.length;i++)
        {
          options +="<option value='"+ data[i].id +"'>"+ data[i].navigation_name +"</option>";
        }
        thiss.html(initOptions + options);
      }


    });
   });
 });
</script>
<style>
  .modal-header,.close {
    background-color: #222;
    color:white !important;
    text-align: center;
    font-size: 19px;
  }
  .modal-footer {
    background-color: #f9f9f9;
  }
  .modal-dialog {
    margin:0px;
    width:90%;
    max-height:250px;
    margin-bottom:99px;
  
}
.modal-body{

   max-height: 200px;
    overflow:auto;
}
ul.blocks {
  list-style-type: none;
}
ul.blocks li {

  padding:5px;
  font-size:17px;
  list-style-type: none;
}
.list-group-item{

  margin-bottom: 15px;
}
</style>
<!-- NAvigation items list shown here  -->
<div class=" col-md-10 col-sm-10 col-lg-10 col-xs-10 rightside">

     <div class="titleArea">
       <h2>Dashboard >> Navigation</h2>
       <hr class="hr-gradient"/>   
     </div>
    <div id="sucessmsg">
  <?php if($this->session->flashdata('message'))
  {
    echo "<div class='alert alert-default fade in '>".$this->session->flashdata('message')."</div>"; 

  }?>
  <?php $validation_errors= validation_errors();
  if(isset($validation_errors)){
   echo "<div class='error'>".$validation_errors."</div>"; 

 }
 if(isset($token_error))
 {
   echo "<div class='error'>".$token_error."</div>"; 
 }
 ?>
</div>
  <div class="error"><h4><span id="msges"></span></h4></div>
<br>
    



    <div class="row">
      <div class="col-md-5 col-lg-5 col-sm-5>" >

       <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"></button>
           <h4>list of all pages</h4>
          </div>
          <div class="modal-body">
           <?php echo form_open_multipart('dashboard/addPageForNavigation', array('id' => 'search', 'name'=>'search'));?> 
           <ul class="blocks">

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
        <div class="modal-footer">
          <select name="departments" id="departments">
         <option value ="0">Select Menu</option>
         <?php foreach($listOfMenu as $menu) { ?>
          <option value ="<?php echo $menu->id; ?>"><?php echo $menu->menu_name; ?></option>
         <?php } ?>
         </select>
           
     <select  name="jobs" id="jobs" class="jobs">
        <option>Make Parent</option>
    </select>      
      <input type="submit" value="Add">
      
        <?php echo form_close();?>
        </div>
      </div>
    </div>




       <div class="modal-dialog" style="margin-bottom:10px;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"></button>

           <h4>list of all posts</h4>
          </div>
          <div class="modal-body">
           <?php echo form_open_multipart('dashboard/addPostForNavigation', array('id' => 'search', 'name'=>'search'));?>
    <ul class="blocks">
        
      <?php    
        if(isset($listOfPost)){
            foreach ($listOfPost as $postdata){
            ?>

        <li><input type="checkbox" name="<?php echo $str = htmlentities(preg_replace('/\s+/', '', $postdata->post_title)); ?>" value="<?php echo htmlentities($postdata->post_title); ?>"/><?php echo $postdata->post_title; ?></li>
          <?php    
            }
        }
    ?>
    </ul> 
  
  
        </div>
        <div class="modal-footer">
          <select  name="departments" id="departments">
         <option value ="0">Select Menu</option>
         <?php foreach($listOfMenu as $menu) { ?>
        <option value ="<?php echo $menu->id; ?>"><?php echo $menu->menu_name; ?></option>
         <?php } ?>
    </select>
           
        <select  name="jobs" id="jobs" class="jobs">
        <option>Make Parent</option>
       </select>      
            <input type="submit" value="Add">
            <?php echo form_close();?>
        
    </div>
    
      </div>

    </div>



     <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"></button>
           <h4>list of all category</h4>
          </div>
          <div class="modal-body">
            <?php echo form_open_multipart('dashboard/addCategoryForNavigation',array('id' => 'search', 'name'=>'search'));?>    
  
    
    <ul>
        
      <?php
        if(isset($listOfCategory)){
            foreach ($listOfCategory as $categorydata){
               
            ?>
       <li><input type="checkbox" name="<?php echo $str = htmlentities(preg_replace('/\s+/', '', $categorydata->category_name)); ?>" value="<?php echo htmlentities($categorydata->category_name); ?>"/><?php echo $categorydata->category_name; ?></li>
          <?php    
            }
        }
    ?>
    </ul> 
        </div>
        <div class="modal-footer">
              <select  name="departments" id="departments">
        <option value ="0">Select Menu</option>
         <?php foreach($listOfMenu as $menu) { ?>
        <option value ="<?php echo $menu->id; ?>"><?php echo $menu->menu_name; ?></option>
         <?php } ?>
    </select>
           
    <select  name="jobs" id="jobs" class="jobs">
        <option>Make Parent</option>
    </select>
            <input type="submit" value="Add">
  
        
    </div>
    
      </div>
      </div>




     <div class="modal-dialog" style="margin-top:-69px;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"></button>
           <h4>Create Custom Menu Link</h4>
          </div>
          <div class="modal-body">
           <p>Navigation Title :
            <input type="text" name="navigation_name" placeholder="Type Navigation name" required/>
            </p>
            
            <p>Custom Menu Link :
            <input type="text" name="navigation_link" placeholder="Type Custom Menu Link" required/>
            </p>
              
        
  
        </div>
        <div class="modal-footer">

        <select  name="departments" id="departments">
        <option value ="0">Select Menu</option>
         <?php foreach($listOfMenu as $menu) { ?>
        <option value ="<?php echo $menu->id; ?>"><?php echo $menu->menu_name; ?></option>
         <?php } ?>
    </select>  
            
            <select  name="jobs" id="jobs" class="jobs">
        <option>Make Parent</option>
    </select> 
            
            <input type="submit" value="Add">
        <?php echo form_close();?>
  
        
    </div>
    
      </div>
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





  </div>
  <div class="col-md-7 col-lg-7 col-sm-7" style="margin-top:-40px;">

   <div class="jumbotron" style="max-height:900px;">
        <div class="modal-content">
          <div class="modal-header" style="padding:35px 50px;">
            <button type="button" class="close" data-dismiss="modal"></button>
           <h4  class='text-left'>Available Navigations</h4>

     <div class="form-group">
  <select class="form-control" style='height:42px;' name="selectMenu" id="selectBox" onchange="changeFunc();">
 <option value="0" selected="selected"> Select Menu</option>
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
</div>
           <!--  <select name="selectMenu" id="selectBox" onchange="changeFunc();">
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
          
            </select> -->
          </div>
          <div>
        
            <div id='cssmenu'>

  
            </div>

  
        </div>
        <div class="modal-footer">
      
    </div>
    
      </div>
      </div>



        
  </div>
</div>

</div>
</div>
</div>



