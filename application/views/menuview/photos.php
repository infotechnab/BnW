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
            var srcimg = $(this).attr('src');
			
            $("#pqr").attr({
                src: srcimg
			
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


<?php
if(isset($selectedalbumquery))
{
foreach ($selectedalbumquery as $data) {
    
    ?>    


<div id="photodiv">
   
    

    <img class="srcimage" src="<?php echo base_url(); ?>content/uploads/images/<?php echo $data->media_type; //echo $image; ?>" id="galleryimage" />
        <div id="imagetitle"> <?php echo $data->media_name; ?>
            
        </div>
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
<div class="clear"></div>
</div>

            <div class="clear"></div>
            <!class full is closed here>
