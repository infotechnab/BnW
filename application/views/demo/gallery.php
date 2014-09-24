<style>
    ul {         
          padding:0 0 0 0;
          margin:0 0 0 0;
      }
      ul li {     
          list-style:none;
          margin-bottom:25px;           
      }
      ul li img {
          cursor: pointer;
      }
</style>
<div style="padding: 2% 5% 2% 5%; background-color: #f0f1d3;">
    <h1 class="titlebarHeading">Gallery</h1> 
        <div class="container">
     <ul class="row">
         <?php  if($albumquery){
             $arr = array();
foreach ($albumquery as $data)
{	
    $aid = $data->id;	              
	$result = $this->viewmodel->get_media_image($aid); 
        $arr = array_merge($arr, $result);
}
foreach( $arr as $abc){   ?> 
         
         <li class="col-lg-3 col-md-3 col-sm-1 col-xs-4" style="border:1px solid#000; width: 20%; margin-right: 5%; padding-top: 15px;"><img name="<?php echo $abc->media_type; ?>" src="<?php echo base_url(); ?>content/uploads/images/thumb_<?php echo $abc->media_type; ?>" width="100%" height="200" /><p style="font-size:20px;"><?php echo $abc->media_name; ?></p></li>
         <?php }} ?>
     </ul>
            
     </div>
 
      </div>

<div id="fullBodyHide">
<div id="popup_box">	<!-- OUR PopupBox DIV-->
<img  src="" width="500" id="pqr"  />
 <a id="popupBoxClose">Close</a>	
</div>
</div>
<style type="text/css">
    #fullBodyHide
    {
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        height: 800px;
        background-color: #000;
        opacity: 1;
        display: none;
    }
    #popup_box { 
        display:none; 
        position:fixed;  
        _position:absolute;  
        height:auto;  
        width:auto;  
        background:#FFFFFF;  
        left: 300px;
        top: 50px;
        z-index:100;
        margin-left: 15px;  
        border:1px solid #000;  	
        padding:25px;  
        font-size:15px;
        box-shadow: 15px 15px 15px #ooo;

    }
    a{  
        cursor: pointer;  
        text-decoration:none;  
    } 
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
        $('li img').on('click',function(){
            $('#fullBodyHide').css({"display":"Block"});
            $('#popup_box').fadeIn(500);
             var src = $(this).attr('name');
                var img = '<?php echo base_url()."content/uploads/images/" ?>' + src;
			
            $("#pqr").attr({
                src: img
            });
            $('#popup_box').css({"display":"Block"});
			
            //$('#pqr').fadeIn(3000);
            $('#photodiv').css({"opacity":".3"});
			
        });
		
        $('#popupBoxClose').click( function() {
            unloadPopupBox();
        });
		
        function unloadPopupBox() {	// TO Unload the Popupbox
            $('#fullBodyHide').css({"display":"none"});
            $('#popup_box').fadeOut("slow"); 
        }			
    });
	
	
</script>