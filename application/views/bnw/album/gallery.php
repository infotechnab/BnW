<style type="text/css">
    /* popup_box DIV-Styles*/
    #popup_box { 
        display:none; /* Hide the DIV */
        position:fixed;  
        _position:absolute; /* hack for internet explorer 6 */  
        height:400px;  
        width:500px;  
        background:#FFFFFF;  
        left: 300px;
        top: 50px;
        z-index:100; /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */
        margin-left: 15px;  

        /* additional features, can be omitted */
        border:2px solid #ff0000;  	
        padding:25px;  
        font-size:15px;  
        -moz-box-shadow: 0 0 5px #ff0000;
        -webkit-box-shadow: 0 0 5px #ff0000;
        box-shadow: 0 0 5px #ff0000;

    }
    a{  
        cursor: pointer;  
        text-decoration:none;  
    } 

    /* This is for the positioning of the Close Link */
    #popupBoxClose {
        font-size:20px;  
        line-height:15px;  
        right:5px;  
        top:5px;  
        position:absolute;  
        color:#6fa5e2;  
        font-weight:500;  	
    }</style>
<script type="text/javascript">

    $(document).ready( function() {
        // When site loaded, load the Popupbox First
        $('.srcimage').click(function(){
            $('#popup_box').fadeIn(2500);
            var srcimg = $(this).attr('name');
            var url = "<?php echo base_url().'content/uploads/images/' ?>";
            
            $("#pqr").attr({
                src: url+srcimg
			
            });
            $('#popup_box').css({"display":"Block"});
			
            //$('#pqr').fadeIn(3000);
            $('#photodiv').css({"opacity":".3"});
			
        });
		
        $('#popupBoxClose').click( function() {
            unloadPopupBox();
        });
		
        function unloadPopupBox() {	// TO Unload the Popupbox
            $('#popup_box').fadeOut("slow");
            $("#photodiv").css({ // this is just for style		
                "opacity": "1"  
            }); 
        }		
		
		
		
        /**********************************************************/
		
    });
	
	
</script>
<div class="rightSide">
<h2>Album/ Photos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/album/addalbum'; ?>">View All Albums</a></h2>
<hr class="hr-gradient"/>
<div id="sucessmsg">
<?php echo validation_errors();
echo $this->session->flashdata('message');
if(isset($error))
{
    echo $error;
}    
?> </div>
<?php
if(isset($query))
{
foreach ($query as $data) {
    
    ?>    



<div id="photodiv">
   
    

    <img class="srcimage" src="<?php echo base_url(); ?>content/uploads/images/<?php echo $data->media_type; ?>" name="<?php echo $data->media_type ?>" id="galleryimage" />
        <div id="imagetitle"> <?php echo $data->media_name; ?>
            
        </div>
            <a href="<?php echo base_url();?>index.php/album/delphoto/<?php echo $data->id; ?> " id="<?php echo $id; ?>" class="delbutton">
        <img src="<?php echo base_url();?>content/bnw/images/delete.png" id="close"/></a>
        
    
</div> 
<?php
}
}
else
{  ?>
<div class="xyz" style="width:200px; height:150px; float:left; margin-right:5px;">
 <p>No any photos found</p>   
 </div>
 <?php }
?>
<div id="popup_box">	<!-- OUR PopupBox DIV-->
<img  src="" width="500px" height="400px" id="pqr"  />
 <a id="popupBoxClose">Close</a>	
</div>

<div class="add" style="width:250px; margin: 10px; float: left " >
<?php echo form_open_multipart('album/addphoto'); ?>
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <p class="dashuppe-text-all">Image Title <br/>
    <input type="text" class="input-text-small" name="title" required /> </p>         
    <input id="uploadImage" class="input-text-small" type="file" name="file" />
     <!-- hidden inputs -->
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" /> 
                 <img id="uploadPreview" style="display:none;width:1000px;"/>
    <input type="submit" name="submit" class="submit-button-small" value="add photo"   />
<?php  echo form_close(); ?>
    
</div> 

</div>
<div class="clear"></div>
</div>