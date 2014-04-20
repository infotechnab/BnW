<?php                                       
    $this->load->helper('sidebar_helper');      //for gadget in event
     $type = get_gadget_sidebar();
?>



<div class="eventAndDownload">
                    
                    
                    <div class="event">
                        <div class="eventHeader">
                            
 <?php
    foreach ($recentPost as $data)
    {
    if($data->display == 'Sidebar')
    {
        $setting = $data->setting;
         parse_str($setting);
         echo $post;
         echo $titleBold;
         echo $titleUnderline;
         echo $titleColor;
        ?>
                            <h3><?php echo $data->name; ?></h3>
                        </div>
                        
                        
                        
                            <div class="newNews"></div>
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
                                
                            <?php if(!empty($titleColor)) { echo "<div style='color:$titleColor;'>"; } ?>    
                          
                                
                                <?php echo anchor('view/post/'.$post_id , $recent_post->post_title); ?>
                              </<?php echo $titleUnderline; ?>>
                              </<?php echo $titleBold; ?>>
                              
                              <?php if(!empty($titleColor)) { echo "</div>"; }?>
                            
                              <br>
                                <font color="#666"><?php echo $recent_post->post_summary; ?></font>
                                
                            </p>
                            
                            <p class="paragraph" >   <?php  
        echo anchor('view/post/'.$post_id , '<font size="1px"><i>View more</i></font>'); 
        echo "<hr/>  ";
        
         } 
    }
    }?></p>
                            
                            
                        
                            <div style="text-align: center">
                     <?php $return['rows'] = $this->db->query('SELECT FOUND_ROWS() count;')->row()->count; if($return>700) echo  anchor('view/posts', 'View All News') ;  ?>       
                    </div>
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
                <div class="clear"></div>
            </div>      