        
<div class="rightSide">
    <h2>Dashboard >> Home</h2> 
    <hr class="hr-gradient"/>
    <h1>Welcome to Dashboard</h1>

    <div>

      <a href="<?php echo base_url('page/pages'); ?>">  <div class="wells"><div class="counts"><?php echo $page; ?></div><div class="count-title">PAGE</div></div></a>
      <a href="<?php echo base_url('offers/posts'); ?>">   <div class="wells"><div class="counts"><?php echo $post; ?></div><div class="count-title">POST</div></div></a>
      <a href="<?php echo base_url('events/allevents'); ?>">    <div class="wells"><div class="counts"><?php echo $events; ?></div><div class="count-title">EVENTS</div></div></a>
      <a href="<?php echo base_url('events/allevents'); ?>">   <div class="wells"><div class="counts"><?php echo $news; ?></div><div class="count-title">NEWS</div></div></a>
  </div>


