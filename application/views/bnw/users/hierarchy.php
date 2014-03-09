<?php
    
    
        if($query){
            foreach ($query as $data){
            ?>
<ul>
    <?php if($data->user_type='1'){
        echo $data->user_name; ?>
</ul>
<?php } ?>
            <?php    
            }
        }
    ?>