<div id="pattern-3">
    <?php if (!empty($selectedpagequery)){
foreach ($selectedpagequery as $page){ ?>
<div class="container">
	<div class="row">
            <h3 id="page-heading-top"><?php echo $page->page_name; ?></h3>
	</div>
    <hr>
                
            
                
                    
                        
                        <div class="col-md-12">
                            
                            <div class="lib-row lib-desc">
                                <p><?php echo $page->page_content; ?></p>
                            </div>
                        </div>
                    
                
            
        
</div>
    <?php }} else {
         $this->load->view('gardenResort/errorPage');
    } ?>
</div>
