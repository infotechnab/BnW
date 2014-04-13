
//This is to toggle for new gadgets 
  $(document).ready(function() {
        $('#title').click(function() {
                $('#description').slideToggle("fast");
        });
        
        
         //This is to toggle for header
        $('#header_display').click(function() {
                $('.header_gadgets').slideToggle("fast");
        });


        // This is to toggle for sidebar 
        $('#sidebar_display').click(function() {
                $('.sidebar_gadgets').slideToggle("fast");
        });


     //This is to toggle for body
        $('#body_display').click(function() {
                $('.body_gadgets').slideToggle("fast");
        });


    //This is to toggle for footer 
        $('#footer_display').click(function() {
                $('.footer_gadgets').slideToggle("fast");
        });

    });



