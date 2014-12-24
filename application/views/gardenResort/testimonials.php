<?php 
$this->load->helper('summary_helper');
?>

<div class="container" style="padding-top:50px;min-height: 520px;">
  <div class="row"> 
    <!-- Testimonials -->
    <?php if(!empty($testimonials)){ ?>
    <section class="testimonials mt100">
      <div class="col-md-6">
        <h2 class="lined-heading bounceInLeft appear" data-start="0"><span style="background:#fff;z-index:2 ">What Our Guests Say</span></h2>
        <div id="owl-reviews" class="owl-carousel">
            <?php foreach ($testimonials as $data){ ?>
            
          
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-2 col-xs-12"> <img src="<?php echo base_url().'content/uploads/images/'.$data->image; ?>" alt="Review 1" class="img-circle" width="100" height="100" /></div>
              <div class="col-lg-9 col-md-8 col-sm-10 col-xs-12">
                  <div class="text-balloon"><?php echo $data->post_content; ?><span><i> - <?php echo $data->post_title; ?></i></span> </div>
              </div>
            </div>
            
         
            <?php } ?>
          <a href="#" class="btn">More</a>
        </div>
        
      </div>
    </section>
    <?php } ?>
    <!-- About -->
    <section class="about mt100">
      <div class="col-md-6">
        <h2 class="lined-heading bounceInRight appear" data-start="800"><span style="background:#fff;z-index:2 ">News & Events</span></h2>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
          <li class="active"><a href="#news" data-toggle="tab">News</a></li>
          <li><a href="#events" data-toggle="tab">Events</a></li>
          
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane fade in active" id="news">
            <ul class="list">
           <?php foreach($news as $allnews){ 
               $id = $allnews->id;
               $date = $allnews->date;
               $title = $allnews->title;
               $details = $allnews->details;
               $timestamp = strtotime($date);
               $fullDate = date('Y-M-d', $timestamp);
               $mth = date('M', $timestamp);
               $day = date('d', $timestamp);
               $year = date('Y', $timestamp);
               ?>
               
           
         <li>
           <span>
             <time datetime="<?php echo $fullDate; ?>"><?php echo $day ?><span><?php echo $mth ?></span></time></span>
             <div class="extra_wrapper">
           <div class="col1"><a href="<?php echo base_url().'index.php/view/news/'.$id; ?>"><?php echo $title; ?></a><br/><time datetime="<?php echo $fullDate; ?>"><?php echo $fullDate; ?></time></div><?php echo custom_echo($details); ?></div>
         </li>
           <?php } ?>
         
       </ul>
       <a href="<?php echo base_url().'index.php/view/allnews'; ?>" class="btn">More</a>
          </div>
            <div class="tab-pane fade" id="events">
                <ul class="list">
           <?php foreach($events as $allnews){ 
               $id = $allnews->id;
               $date = $allnews->date;
               $title = $allnews->title;
               $details = $allnews->details;
               $timestamp = strtotime($date);
               $fullDate = date('Y-M-d', $timestamp);
               $mth = date('M', $timestamp);
               $day = date('d', $timestamp);
               $year = date('Y', $timestamp);
               ?>
               
           
         <li>
           <span>
             <time datetime="<?php echo $fullDate; ?>"><?php echo $day ?><span><?php echo $mth ?></span></time></span>
             <div class="extra_wrapper">
           <div class="col1"><a href="<?php echo base_url().'index.php/view/event/'.$id; ?>"><?php echo $title; ?></a><br/><time datetime="<?php echo $fullDate; ?>"><?php echo $fullDate; ?></time></div><?php echo custom_echo($details); ?></div>
         </li>
           <?php } ?>
         
       </ul>
       <a href="<?php echo base_url().'index.php/view/allevents'; ?>" class="btn">More</a>
                
                
                
            </div>
          
        </div>
      </div>
    </section>
  </div>
</div>

