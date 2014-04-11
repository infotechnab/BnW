<?php foreach ($pagequery as $page) {
                    ?>
                    <div class="container">
                        <div class="containerHeader">
                            <h3> <?php echo $page->page_name ; ?> </h3>
                            
                        </div>
                        <div class="content">

                            <p class="paragraph"><?php echo $page->page_content; ?></p>        
                        </div>
                    </div> 

                <?php } ?>
<div style="text-align: center">
<?php $return['rows'] = $this->db->query('SELECT FOUND_ROWS() count;')->row()->count; if($return>700) echo  anchor('view/pages', 'View All Pages') ;  ?>       
</div>
</div>

            <div class="clear"></div>
            <!class full is closed here>