
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
      
      
     
        
        
        $('#arrow').html("˅");
$('#title').click(function() {
  $(this).toggleClass('active');
  if ($(this).hasClass('active'))
    $('#title #arrow').html("˄");
  else
    $('#title #arrow').html("˅");
  $('#description').slideToggle("fast");
  });   
  
  
  
     $('#arrow1').html("˅");
$('#title1').click(function() {
  $(this).toggleClass('active');
  if ($(this).hasClass('active'))
    $('#title1 #arrow1').html("˄");
  else
    $('#title1 #arrow1').html("˅");
  $('#description_for_gadget1').slideToggle("fast");
  }); 
  
  });
