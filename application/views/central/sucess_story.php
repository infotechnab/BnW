<script type="text/javascript">
    function yHandler(){
        var wrap = document.getElementById('wrap');
        // get page content height
        var contentHeight = wrap.offsetHeight; //gets page. how much height of content to load
        var yOffset = window.pageYOffset//get the vertival scroll position
        var y = yOffset + window.innerHeight;
        if(y >=contentHeight){
            wrap.innerHTML += '<div class="sucess-story"></div>';
            // ajax call to get more dynamic data goes here
            //var n += 4;
           $.ajax({
        type: "POST",
        url: "<?php echo base_url().'index.php/view/sucess_story_ajax';?>",
        data: {
           'nor': n
        },
        success: function(msg)
        {

            $(".sucess-story").html(msg);
        },
         complete: function(){
        
      }
    });
        }
    }
window.onscroll = yHandler;
</script>

<style type="text/css">
 
 div#wrap{width:100%;  background: #1c75bc;}
 
</style>


<div id="wrap">



    <div class="sucess-story-title">Sucessful Story</div>
<?php foreach($postqueryall as $sucess) { ?>
 <div class="sucess-story-content">
      
        <div><img src="<?php echo base_url().'content/uploads/images/'.$sucess->image; ?>" height="200" width="150"></div>
        <div style="font-size: 12px;font-weight: bolder;color:#000;text-align: center; "><?php echo $sucess->post_title; ?></div>
        <div style="font-size: 12px;color:#990000;text-align: center;"><?php echo $sucess->post_content; ?></div>
    </div>
 <?php } ?>
    <div class="clear"></div>
   </div> <!-- hit bottom and load content--> 
</div>

