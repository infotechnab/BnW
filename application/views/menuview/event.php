<div class="eventAndDownload">
                    
                    
                    <div class="event">
                        <div class="eventHeader">
                            <h3>News and Events</h3>
                        </div>
                        <?php foreach($pagequery as $summary){
                    ?>
                            <div class="newNews"></div>
                            <p class="paragraph">
                                <?php echo $summary->page_summary ?>
                            </p>
                            <p class="paragraph" > <?php echo anchor('view/index/page/'.$summary->id , 'more'); ?> </p>
                            <hr/> 
                            <?php } ?>
                    </div>
                    
                    <div class="download">
                        <div class="downloadHeader"><h3> Downloads </h3></div>
                        <div>

                            <div class="paragraph">
                                <p><b> Download Files </b> <br/> <a href="downloads/" > Downlaod</a>  </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>      
