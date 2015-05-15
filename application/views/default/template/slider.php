 <style>

            .contentContainerFooterLeft
            {
                float: left;


            }
            .contentContainerFooterRight
            {

                float: left;
            }
            .sliderTable
            {
                border: 0px solid #000;
               
            }
            .sliderTable img
            {
                height: 500px;
            }
            .slide
            {
                zoom: 1; 
                border:none;
                text-align:left; 
                margin:0;
                padding:0;
                float:left;
                width: 1360px;
                height: 500px;
                position: relative;
            }
            #sliderImage
            {
                position: relative;
                left:0;
                top:0;
                width:100%;
                height:100%;
                overflow:hidden;
            }
            #slideshow
            {
                zoom: 1; 
                position: relative;
                margin:0 auto;
                border:none;
                text-align:left;
                 height: 500px;
            }
            #slideshow #slideshowWindow {
                width:100%;
                margin:0;
                padding:0;
                position:relative;
                overflow:hidden;
                height: 500px;
            }

            #slideshow #slideshowWindow .slide .slideText {
                position: relative;
                margin:0;
                padding:0;
                color:#ffffff;
                font-family:Myriad Pro, Arial, Helvetica, sans-serif;
            }

            #slideshow #slideshowWindow .slide .slideText a:link, 
            #slideshow #slideshowWindow .slide .slideText a:visited {
                color:#ffffff;
                text-decoration:none;
            }

            #slideshow #slideshowWindow .slide .slideText h2, 
            #slideshow #slideshowWindow .slide .slideText p {
                margin:10px 0 0 10px;
                padding:0;
            }

           
            #leftNav h3, #rightNav h3
            {
                margin: 0px;
                padding: 12px 5px 12px 5px;
            }
            
            .sliderTable
            {
                width: 100%;
            }
            .slideContents
            {
                top:-167px;
                background-color: #000;
                color: #fff;
                left:6.5%;
                position:relative;
                margin: 0px;
                padding: 10px;
                width: 25%;
                opacity: 0.5;
                border-radius: 5px;
             
            }
.navSide {display:block;position:relative;cursor:pointer;color: #fff;height: 30px;opacity: 0.5;text-align: center;font-size: 20px;font-weight: bold;overflow: hidden;}
#leftNav {background-color: #000;border-radius: 40px;left: 0.1%;float: left;margin: 5px;position: relative;top: -300px;width: 30px;z-index: 99;}
#rightNav {background-color: #000;border-radius:40px;float:right;margin: 5px;position: relative;top: -300px;width: 30px;z-index: 99;}

           
 
        </style>
         <script src="<?php echo base_url() . 'content/uploads/jquery.js'; ?>"></script>
               <script type="text/javascript"> 
              function hideDiv(){
    if ($(window).width() > 767) {
            $("#slider").css({'display':'block'});
    }else{
        $("#slider").css({'display':'none'});
    }
}     
            $(document).ready(function() {
                hideDiv();
                 $(window).resize(function(){
                    hideDiv();
                });

                slider();
                var currentPosition = 0;
                var slideWidth = 1360;
                var slides = $('.slide');
                var numberOfSlides = slides.length;
                var slideShowInterval;
                var speed = 5000;

                //Assign a timer, so it will run periodically
                slideShowInterval = setInterval(changePosition, speed);

                slides.wrapAll('<div id="slidesHolder"></div>')

                //slides.css({ 'float' : 'left' });

                //set #slidesHolder width equal to the total width of all the slides
                $('#slidesHolder').css('width', slideWidth * numberOfSlides);

               $('#slideshow')
                .append('<div class="navSide" id="leftNav">&lsaquo;</div>')
                .append('<div class="navSide" id="rightNav">&rsaquo;</div>');

                manageNav(currentPosition);

                 //tell the buttons what to do when clicked
                $('.navSide').bind('click', function() {

                    //determine new position
                    currentPosition = ($(this).attr('id') == 'rightNav')
                        ? currentPosition + 1 : currentPosition - 1;

                    //hide/show controls
                    manageNav(currentPosition);
                    clearInterval(slideShowInterval);
                    slideShowInterval = setInterval(changePosition, speed);
                    moveSlide();
                });

                function manageNav(position) {
                    //hide left arrow if position is first slide
                    if (position == 0) {
                        $('#leftNav').hide()
                    }
                    else {
                        $('#leftNav').show()
                    }
                    //hide right arrow is slide position is last slide
                    if (position == numberOfSlides - 1) {
                        $('#rightNav').hide()
                    }
                    else {
                        $('#rightNav').show()
                    }
                }


                /*changePosition: this is called when the slide is moved by the 
                 timer and NOT when the next or previous buttons are clicked*/
                function changePosition() {
                    if (currentPosition == numberOfSlides - 1) {
                        currentPosition = 0;
                        manageNav(currentPosition);
                    } else {
                        currentPosition++;
                        manageNav(currentPosition);
                    }
                    moveSlide();
                }


                //moveSlide: this function moves the slide 
                function moveSlide() {
                    $('#slidesHolder')
                    .animate({'marginLeft': slideWidth * (-currentPosition)});
                }
                
               function slider()
             {
                 var sliderJson;
                 var i = 0;
                var base_url = '<?php echo base_url(); ?>';
            
               sliderJson = <?php echo $slider_json . ';'; ?>;
               slen = sliderJson.length;
                var tbl = "";
                for (i = 0; i < slen; i++)
                {
                    var ftbl = '<div class="slide">';
                    tbl = '<img src=' +
                        base_url + 'content/uploads/sliderImages/' +
                        sliderJson[i].slide_image + ' id="sliderImage" ><div class="slideContents"><h2>' +
                        sliderJson[i].slide_name +
                        '</h2><p>' +
                        sliderJson[i].slide_content + '</p> <div class="sliderContent"><div class="contentContainerFooterLeft"><h4>' +
                        '</h4></div></div></div>';
                    var ltbl = '</div>';
                    $("#slideshowWindow").append(ftbl + tbl + ltbl);
                }
                
            }
            
            }); 
            
        </script>  
        
        
        
                    <!--slider is called here-->
                    <div id="slider" style="background:darkcyan;">
                <div id="slideshow"  style="height:500px;width:100%;margin:0% auto;">
                    <div id="slideshowWindow" style="height:100%;">
                        


                    </div></div>
            
            
            </div>

            <!-- slider div with navigation and header image is closed here-->   
        
        
        
        
        
        
        
        
        