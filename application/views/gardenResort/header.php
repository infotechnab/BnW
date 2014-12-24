
<!--==============================header=================================-->
<header style="border-bottom: 1px solid#eee;"> 
    <div class="container" style="width:100%; margin: 0; padding: 0% 0% 0% 5%;">
  
        <?php if(!empty($headerlogo)){
            foreach($headerlogo as $logo){
                $hlogo = $logo->description;
            }
        } ?>
        <?php if(!empty($headertitle)){
            foreach($headertitle as $title){
                $htitle = $title->description;
            }
        } ?>
         <div class="col-lg-5" style="border-right: 1px solid#ccc;background-color: #fcfcfe;">
        <a href="<?php echo base_url(); ?>"><img id="logo-image-header" src="<?php echo base_url().'content/uploads/images/'.$hlogo; ?>" alt="BGR_logo"> <h3 id="header-title-heading"><?php echo $htitle; ?> </h3></a>
       
      </div>
        
        <div class="menu_block">
           <nav  class="nav" >
            <ul class="nav-list">        
                    <?php

            $this->load->helper('testnav_helper');

            fetch_menu (query(0));


        ?>   
                    
            </ul>
              </nav>
             
           </div>
           <div class="clear"></div>
      </div>

</header>
<script>
;(function($) {
	$(function() {

		$('.nav').append($('<div class="nav-mobile"></div>'));

		$('.nav-item').has('ul').prepend('<span class="nav-click"><i class="nav-arrow"></i></span>');

		$('.nav-mobile').click(function(){
			$('.nav-list').toggle();
		});

		$('.nav-list').on('click', '.nav-click', function(){

			$(this).siblings('.nav-submenu').toggle();

			$(this).children('.nav-arrow').toggleClass('nav-rotate');
			
		});
	    
	});
	
})(jQuery);
</script>
<div class="clearfix"></div>  