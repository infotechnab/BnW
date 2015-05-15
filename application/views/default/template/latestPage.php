<?php if(!empty($latestPage)){ ?>
<div class="container">
    <div class="row">
        <?php foreach ($latestPage as $data){
            $title = $data->page_name;
            $content = $data->page_content;
           
        } ?>
        <div class="col-md-12 text-center">
            <h1><?php echo $title; ?></h1>
        </div>
        <p><?php echo $content; ?></p>
        
    </div>
</div>
<?php } ?>