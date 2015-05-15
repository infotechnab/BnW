<section class="news-box" style="background-color: #ddd;">
        <div class="container">
            
            <div class="row">
                <?php if(!empty($latestNews)){ ?> 
                <div class="col-lg-6 col-md-6" style="border-left: 1px solid #fff;border-right: 1px solid #fff;">
                <h2><span>Latest News</span></h2>

                  <?php foreach($latestNews as $news){
                      $id = $news->id;
                      $timestamp = strtotime($news->date);
                      $image = $news->image;
                      $title = $news->title;
                      
                      ?>
                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                       <a href="<?php echo base_url().'index.php/view/news/'.$id ?>">
                    <div class="newsBox">
                        <div class="thumbnail">
                            <figure><time datetime="<?php echo date('Y-m-d', $timestamp); ?>"><?php echo date('Y-m-d', $timestamp); ?></time><?php if(!empty($image)){ ?><img alt="" src="<?php echo base_url().'content/uploads/images/'.$image; ?>"> <?php } ?></figure>
                            <div class="caption maxheight2"><div class="box_inner">
                             <?php echo $title; ?>
                            </div></div>
                        </div>
                    </div>
                       </a>
                </div>
                  <?php } ?> 
                 
                   
                   
                   
               </div>
                <?php } ?>
                
                
                <?php if(!empty($latestEvents)){ ?>  
                <div class="col-lg-6 col-md-6" style="border-right: 1px solid #fff;"> 
                <h2><span>Latest Events</span></h2>
                  <?php foreach($latestEvents as $events){
                      $id = $events->id;
                      $timestamp = strtotime($events->date);
                      $image = $events->image;
                      $title = $events->title;
                      
                      ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <a href="<?php echo base_url().'index.php/view/event/'.$id ?>">
                    <div class="newsBox">
                        <div class="thumbnail">
                             <figure><time datetime="<?php echo date('Y-m-d', $timestamp); ?>"><?php echo date('Y-m-d', $timestamp); ?></time><?php if(!empty($image)){ ?><img alt="" src="<?php echo base_url().'content/uploads/images/'.$image; ?>"> <?php } ?></figure>
                            <div class="caption maxheight2"><div class="box_inner">
                               <?php echo $title; ?>
                            </div></div>
                        </div>
                    </div>
                         </a>
                </div>
                   <?php } ?>   
                    
                   
               </div>
                 <?php } ?>
                
            </div>
        </div>
</section>
                
                
              