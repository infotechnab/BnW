<div class="rightSide">
    <div class="left">
       <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    <p>List of all pages</p>
    <table border="1" cellpadding="10">
        <tr>
            <th>S.N.</th>
            <th>Title</th> 
        </tr>   
      <?php    
        if(isset($query)){
            foreach ($query as $pagedata){
                
            ?>
          <tr>
              <td><?php echo $pagedata->id; ?></td>  
            <td><input type="checkbox" value=""/><?php echo $pagedata->page_name; ?></td> 
          </tr>
          <?php    
            }
        }
    ?>
    </table>
    </div>
           
            
            
   
    <div class="left">
        <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    <p>List of all category</p>
    <table border="1" cellpadding="10">
        <tr>
            <th>S.N.</th>
            <th>Title</th> 
        </tr>   
      <?php    
        if(isset($query)){
            foreach ($query as $categorydata){
               
            ?>
          <tr>
              <td><?php echo $categorydata->id; ?></td>  
            <td><input type="checkbox" value=""/><?php echo $categorydata->category_name; ?></td> 
          </tr>
          <?php    
            }
        }
    ?>
    </table>
    </div>
    
    
    <div class="right">
        <ul>
            <li><?php  ?></li>
        </ul>
    </div>
    
    
</div>
<div class="clear"></div>