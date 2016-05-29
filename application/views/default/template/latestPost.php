<?php if(!empty($latestPost)){ ?>
<div style="background-color: #757D75;padding: 30px 0px;color: #F2F1EF; font-size: 20px;">
<div class="container">
    <div class="row">
        <?php foreach ($latestPost as $data){
            $title = $data->post_title;
             $content = $data->post_content;
        } ?>
        <div class="col-md-12 text-center">
            <h1><?php echo $title; ?></h1>
        </div>
          <p><?php echo $content; ?></p>
    </div>
</div>
</div>
<?php } ?>