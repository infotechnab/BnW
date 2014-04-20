
//This is to toggle for new gadgets 
  $(document).ready(function() {
      
           
   
      $(".onlyNumerics").keydown(function (event) {
    var num = event.keyCode;
    if ((num > 95 && num < 106) || (num > 36 && num < 41) || num == 9) {
        return;
    }
    if (event.shiftKey || event.ctrlKey || event.altKey) {        
        event.preventDefault();
    } else if (num != 46 && num != 8) {
        if (isNaN(parseInt(String.fromCharCode(event.which)))) {
            event.preventDefault();
        }
    }
});
      
      
        $('#title').click(function() {
                $('#description').slideToggle("fast");
        });
        
        
         //This is to toggle for header
        $('#header_display').click(function() {
        $('.header_gadgets').slideToggle("fast");
        if(!$.trim( $('.header_gadgets').html() ).length) {
        $('.header_gadgets').text("This template has no gadgets.");
        }
        });


        // This is to toggle for sidebar 
        $('#sidebar_display').click(function() {
        $('.sidebar_gadgets').slideToggle("fast");
        if(!$.trim( $('.sidebar_gadgets').html() ).length) {
        $('.sidebar_gadgets').text("This template has no gadgets.");
        }
        });


     //This is to toggle for body
        $('#body_display').click(function() {
        $('.body_gadgets').slideToggle("fast");
        if(!$.trim( $('.body_gadgets').html() ).length) {
        $('.body_gadgets').text("This template has no gadgets.");
        }        
        });


    //This is to toggle for footer 
        $('#footer_display').click(function() {
        $('.footer_gadgets').slideToggle("fast");
        if(!$.trim( $('.footer_gadgets').html() ).length) {
        $('.footer_gadgets').text("This template has no gadgets.");
        }
        });

    });



