<section class="news-box" style="background-color: #ddd;">
        <div class="container">
            
            <div class="row">
                <?php if(!empty($latestNews)){ ?> 
                <div class="col-lg-6 col-md-6" style="border-left: 1px solid #fff;border-right: 1px solid #fff;">
                <h2><span>Latest News</span></h2>
                  <?php foreach($latestEvents as $events){ ?>
                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="newsBox">
                        <div class="thumbnail">
                            <figure><time datetime="2014-01-01">25 Nov, 2014</time><img alt="" src="http://homnath.com.np/school/content/uploads/basicImages/news1.jpg"></figure>
                            <div class="caption maxheight2"><div class="box_inner">
                              News contents goes here......
                            </div></div>
                        </div>
                    </div>
                </div>
                  <?php } ?> 
                 
                   
                   
                   
               </div>
                <?php } ?>
                
                
                <?php if(!empty($latestEvents)){ ?>  
                <div class="col-lg-6 col-md-6" style="border-right: 1px solid #fff;"> 
                <h2><span>Latest Events</span></h2>
                   <?php foreach($latestEvents as $events){ ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="newsBox">
                        <div class="thumbnail">
                            <figure><time datetime="2014-01-01">25 Nov, 2014</time><img alt="" src="http://homnath.com.np/school/content/uploads/basicImages/news1.jpg"></figure>
                            <div class="caption maxheight2"><div class="box_inner">
                              News contents goes here......
                            </div></div>
                        </div>
                    </div>
                </div>
                   <?php } ?>   
                    
                   
               </div>
                 <?php } ?>
                
            </div>
        </div>
</section>
                
                
              