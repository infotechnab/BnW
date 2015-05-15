  <style>
.thumbnail {
-webkit-transition-property : scale; 
-webkit-transition-duration : 0.2s; 
-webkit-transition-timing-function : ease-in-out; 
-moz-transition : all 0.2s ease-in-out;  
}    
    
.thumbnail:hover {
box-shadow: 0 0 10px rgba(0,0,0,.5);
-moz-box-shadow: 0 0 10px rgba(0,0,0,.5);
-webkit-box-shadow: 0 0 10px rgba(0,0,0,.5);
-webkit-transform: scale(1.05);
-moz-transform: scale(1.05);
}
.box-hover
{
    overflow-y: hidden;
    position: absolute;
    top: 3%;
    text-align: center;
    width: 86%;
    background: rgba(0,0,0,0.15);
    display: none;
    color: #fff;
    height: 87%;
}
.thumbnail:hover > .box-hover
{
    display: block;
    width: 96%;
    height: 15%;
   
}

</style>
<script type="text/javascript">
  $(document).ready(function(){
     // When site loaded, load the Popupbox First
        $(".srcimage").click(function(){
            
            var srcimgs = $(this).attr('name');
            var name = $(this).attr('data-value');
            var srcimg = "<?php echo base_url()."content/uploads/images/"; ?>"+srcimgs;
            $("#popImage").attr({
                src: srcimg
			
            });	
            $('.modal-title').html(name);
        });   
});


</script>

<div id="pattern-3">
            <?php if(!empty($selectedalbumquery)&&($albumName)){ foreach ($albumName as $name){ $aname = $name->album_name; } ?>
    <div class="container">
	

<?php
foreach ($selectedalbumquery as $data) {
    
    ?>    
 
<div class="col-sm-6 col-md-3" data-toggle="modal" data-target="#mypopup">
    <div class="thumbnail">
        <img class="srcimage" data-value="<?php echo $data->media_name; ?>" name="<?php echo $data->media_type; ?>" src="<?php echo base_url(); ?>content/uploads/images/thumb_<?php echo $data->media_type; ?>" style="height:200px;" />
        <div class="box-hover"><h5><?php echo $data->media_name; ?></h5></div>
    </div>
  </div>
 
<?php
}
 } else {
    $this->load->view('default/template/errorPage'); 
 } ?>
</div>
</div>
<div class="modal fade mypopup" id="mypopup" style="width:auto; height: auto;">
    <div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
          <img id='popImage' data-src="holder.js/300x300" alt="..." style="width: 100%;">
      </div>
    </div>
  </div>
</div>
   
            
