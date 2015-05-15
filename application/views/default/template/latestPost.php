<?php if(!empty($latestPost)){ ?>
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
<?php } ?>