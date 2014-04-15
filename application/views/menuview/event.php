<div class="eventAndDownload">
                    
                    
                    <div class="event">
                        <div class="eventHeader">
                            <h3>News and Events</h3>
                        </div>
                        
                        
                        
                            <div class="newNews"></div>
                            <?php foreach($postquery as $summary){
                    ?>
                            <p class="paragraph">
                                
                                <?php echo $summary->post_summary ?>
                                
                            </p>
                            
                            <p class="paragraph" > <?php echo anchor('view/post/'.$summary->id , 'more'); ?> </p>
                            <hr/> 
                            
                            <?php } ?>
                            <div style="text-align: center">
                     <?php $return['rows'] = $this->db->query('SELECT FOUND_ROWS() count;')->row()->count; if($return>700) echo  anchor('view/posts', 'View All News') ;  ?>       
                    </div>
                    </div>
                    
                    <div class="download">
                        <div class="downloadHeader"><h3> Downloads </h3></div>
                        <div>

                            <div class="paragraph">
                                <p><b> Download Files </b> <br/> <a href="downloads/" > Download</a>  </p>

                            </div>
                        </div>
                    </div>
    
                </div>
                <div class="clear"></div>
            </div>      
