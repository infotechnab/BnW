<html>
    <head>
        <title>BnW - A complete CMS</title>
        <meta name="viewport" content="width-device-width" initial-scale="1.0">
        <link rel="stylesheet" href="<?php echo base_url().'content2/style.css';?>" type="text/css"> 
       
       
        <script src="<?php echo base_url().'content2/jquery.js'; ?>"></script> 
    <script>
        $(document).ready(function(){
           $('.carousal').carousel({
               interval:1000
               
           });
           
           $("#pagetop").mouseover(function(){
              $(this).css("opacity","1");
           });
           
           
        });
        
        
        var pagetop, menu, yPos; 
        function yScroll(){
            pagetop = document.getElementById('pagetop');
            menu = document.getElementById('menu');
            yPos = window.pageYOffset;
            if(yPos > 80){ 
                pagetop.style.height = "36px";
                pagetop.style.paddingTop = "8px";
                pagetop.style.opacity = "0.7";
                pagetop.style.filter  = 'alpha(opacity=50)';  //IE fallback
                menu.style.height = "50px";
            } else {
                 pagetop.style.opacity = "1";
                pagetop.style.filter  = 'alpha(opacity=100)';  //IE fallback
                pagetop.style.height = "100px";
                pagetop.style.paddingTop = "50px";
                menu.style.height = "50px"; 
            } 
        }
        window.addEventListener("scroll", yScroll);
    </script>
    </head>
    <body>
        <div id="full">
            <div id="demo-top-header-logo">
                <div id="left-logo-image-on-header">
                    <?php foreach($headerlogo as $data);{
                        $logo = $data->description;
                    } ?>
                    <img src="<?php echo base_url().'content/uploads/images/'.$logo; ?>" width="50" alt="BnW logo" />
                </div>
                <div id="navigation-items-on-header">
                    
                </div>
                
            </div> 
        </div>
    </body>
</html>