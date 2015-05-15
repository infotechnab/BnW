<div id="pattern-3">
    <?php if (!empty($selectedpagequery)){
foreach ($selectedpagequery as $page){ ?>
<div class="container">      
                    
                        
                        <div class="col-md-12">
                            
                            <div class="lib-row lib-desc">
                                <p><?php echo $page->page_content; ?></p>
                            </div>
                        </div>
                    
                
            
        
</div>
    <?php }} else {
         $this->load->view('default/template/errorPage');
    } ?>
</div>
