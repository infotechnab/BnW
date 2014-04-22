
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
        
   /*         
        $('#recentpostedit').click(function() {
                $('#edit_recentPost_toggle').slideToggle("fast");
        });
        
        
        
        $('#textedit').click(function() {
                $('edit_text_toggle').slideToggle("fast");
        });
    
         //This is to toggle for header
        $('.arrow').html("˅");
        $('#header_display').click(function() {
        $('#header_diplay .arrow').html("˄");
        $('.header_gadgets').slideToggle("fast");
        }
        });


        // This is to toggle for sidebar 
        $('#arro').html("˅");
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
*/
    });
