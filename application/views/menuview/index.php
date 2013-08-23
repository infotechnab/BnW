<!DOCTYPE HTML>
<html>
    <head>
        <title> menu listing</title>
        
    </head>
    <body>
 <div class="menu-div">     
            <ul>
                <?php 
 foreach ($query as $data)
 {
     
     $listing = $data->listing;
     $title = $data->title;
     //$id= $data->id;
      if($listing==0|| $listing=="" )
     { ?>
                <li> <?php echo $data->title; } ?>
        <?php         
                $list = $this->viewmodel->get_sublist_title($title);
                    foreach ($list as $data)
                 {         $id= $data->p_id;
                 }?>
                 <ul><?php
                         $menu = $this->viewmodel->get_sublist($id);
                         foreach ($menu as $data)
                         {
                           ?>                    
           <li> <?php echo $data->title; ?> </li> <?php } ?>   </ul> 
            </li>
                <?php } ?>
            </ul>           
        </div>
    </body>
</html>