<?php if(!empty($latestPage)){ ?>
<div style="background-color: #264348;padding: 30px 0px;color: #F2F1EF; font-size: 20px;">
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
</div>
<?php } ?>