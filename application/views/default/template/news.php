
<?php 
$this->load->helper('summary_helper');
?>
<div id="pattern-3">
    <?php if(!empty($allevents)){ ?>
<div class="container">

    
     <?php foreach($allevents as $eventsData) { ?>
    <div class="col-sm-6 col-md-4">
        <a href="<?php echo base_url().'index.php/view/news/'.$eventsData->id; ?>" style="text-decoration: none;color: #000;"> 
      <div class="thumbnail">
          <h3 style="text-align:center;"><?php echo $eventsData->title; ?></h3>
          <img src="<?php echo base_url().'content/uploads/images/thumb_'.$eventsData->image; ?>" alt="..."  style="height: 200px;width: 250px;">
        <div class="caption">
            <ul class=" list-group">
                <li class=" list-group-item">
                    <b>Date:</b>
                     <?php
                     $timestamp = strtotime($eventsData->date);
                    echo date('Y-m-d', $timestamp);   ?>
                </li>
                 <li class=" list-group-item">
                    <b>Time:</b>
                     <?php
                    echo date('h:i a', $timestamp);   ?>
                </li>
                <li class=" list-group-item">
              <b>Location : </b><?php echo $eventsData->location; ?>
                </li>
                <li class=" list-group-item">
                    <p style="color:#555555;"><?php echo custom_echo($eventsData->details); ?></p>
                </li>
          </ul>
        </div>
      </div>
        </a>
    </div>
     <?php } ?>
              
</div>
    <?php }  else { 
    $this->load->view('default/template/errorPage');
 } ?>
</div>