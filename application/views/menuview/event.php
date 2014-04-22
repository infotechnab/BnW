<?php                                       
    $this->load->helper('sidebar_helper');      //for gadget in event
     $type = get_gadget_sidebar();
?>



<div class="eventAndDownload">
         <?php foreach ($sidebarColor as $bgcolor) {
                    ?>           
                    <div style="background-color: <?php echo $bgcolor->description ; ?>" class="event">
                        <div class="eventHeader">
                            
 <?php
    foreach ($recentPost as $data)
    {
    if($data->display == 'Sidebar')
    {
        $setting = $data->setting;
         parse_str($setting);
         //echo $post;
         //echo $titleBold;
         //echo $titleUnderline;
         //die ($titleColor);
        ?>
                            <h3><?php echo $data->name; ?></h3>
                        </div>
                        
                        
                        
                            <div class="newNews">
                            <?php
          foreach($noOfRecentPost as $recent_post)
         {
              ?>
         
                            <p class="paragraph">
                                <?php 
                                $post_id = $recent_post->id;
                               ?>
                            <?php if(!empty($titleUnderline)) { echo "<".$titleUnderline.">"; } ?>
                            <?php if(!empty($titleBold)) { echo "<".$titleBold.">"; } ?>
                                
                            <?php if(!empty($titleColor)) { echo " "; } ?>    
                          
                                
                            <a href="<?php echo base_url().'index.php/view/post/'.$post_id ?>" style="color:<?php echo $titleColor ?> ;"> <?php echo $recent_post->post_title; ?></a>
                              </<?php echo $titleUnderline; ?>>
                              </<?php echo $titleBold; ?>>
                              
                             
                            
                              <br>
                                <font color="#cccccc"><?php echo $recent_post->post_summary; ?></font>
                                
                            </p>
                            
                            <p class="paragraph" >   <?php  
        echo anchor('view/post/'.$post_id , '<font size="1px"><i>View more</i></font>'); 
        echo "<hr/>  ";
        
         } 
    }
    ?>
                                
    
                           
    <?php    }  ?>
                            </p>
                            
                            
                            
                            
                        
                    </div>
                    
                    <div class="download">
                        <div class="downloadHeader"><h3> Downloads </h3></div>
                        <div>

                            <div class="paragraph">
                               
<p><b> Download Files </b> <br/> <a href="<?php echo base_url().'index.php/view/downloads'; ?>" >Click here for Downlaod</a>  </p>
                            </div>
                        </div>
                    </div>
    
                </div>
    <?php } ?>
</div>
                <div class="clear"></div>
            </div>      