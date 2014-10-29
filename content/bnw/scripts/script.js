/**
 *
 * Crop Image While Uploading With jQuery
 * 
 * Copyright 2013, Resalat Haque
 * http://www.w3bees.com/
 *
 */

// set info for cropping image using hidden fields
function setInfo(x1c,y1c,x2c,y2c) {
   var w= x2c - x1c;
   var h= y2c - y1c;
	$('#x').val(x1c);
	$('#y').val(y1c);
	$('#w').val(w);
	$('#h').val(h);
}
function setVal(i, e) {
	$('#x').val(e.x1);
	$('#y').val(e.y1);
	$('#w').val(e.width);
	$('#h').val(e.height);
}


$(document).ready(function() { 
    
	var p = $("#uploadPreview");
	// prepare instant preview
	$("#uploadImage").change(function(){    
		// fadeOut or hide preview
		p.fadeOut();
		// prepare HTML5 FileReader
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
		oFReader.onload = function (oFREvent) {
	   		p.attr('src', oFREvent.target.result).fadeIn();
                         var w = $('img#uploadPreview').width();
                          var h = $('img#uploadPreview').height();             
              if(w>h){
                  var centre = w/2;
                  var height = h;
                 var width = (height*4)/3;
                  var deduct = width/2;
                  var x1c = centre - deduct;
                  var y1c = 0;
                  var x2c = centre + deduct;
                  var y2c = height;  
                  var coords = { x1: x1c, y1: y1c, x2: x2c, y2: y2c };
                  onSelectEnd: setVal
              }else{
                  var centre = h/2;
                  var nwidth = w;
                  var nheight = (nwidth*3)/4;
                  var ndeduct = nheight/2;
                  var x1c = 0;
                  var y1c = centre - ndeduct;
                  var x2c = nwidth;
                  var y2c = centre + ndeduct;
                  var coords = { x1: x1c, y1: y1c, x2: x2c, y2: y2c };
              }
                        $('img#uploadPreview').imgAreaSelect({ x1: x1c, y1: y1c, x2: x2c, y2: y2c, aspectRatio: '4:3', handles: true,onload:setInfo(x1c,y1c,x2c,y2c)  });
		};
	});

        $('img#uploadPreview').imgAreaSelect({
            
            aspectRatio: '4:3',   
          handles: true,
        onSelectEnd: setVal
    });
	 
       
});