
<script>
    $(document).ready(function(){
        
   //slide to top
   $('#top').on('click',function (e) {
	    e.preventDefault();

	    var target = this.hash,
	    $target = $(target);

	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 1200, 'swing', function () {
	        window.location.hash = target;
	    });
	});
   //slide to top
    
    });
    
    
     var yPos; 
        function yScroll(){      
            yPos = window.pageYOffset;
            if(yPos > 500){ 
                $("#img-top").css("display","block");
            } else {
                $("#img-top").css("display","none");
            } 
        }
        window.addEventListener("scroll", yScroll);
</script>



<!--<a href="#top" class="fa-icon fa-arrow-circle-up" id="img-top" style="width: 40px; height: 40px; position: fixed;bottom: 8%;right: 1%;display: none; color: black;"></a>-->
<div class="footer" style="padding: 2% 5% 2% 5%; background-color: #cdcdcd;text-align: center;">
    
    <div class="copyright"> &COPY; 2014 Bharatpur Garden Resort (P). Ltd. All rights reserved.<br>
        Powered by <b>BnW | </b> Design by <b><a href="http://salyani.org">SALYANI</a></b>
    </div>
    
</div> 




 </div>
</body>
</html>