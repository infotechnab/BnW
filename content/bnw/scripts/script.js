
function setInfo(x1c, y1c, x2c, y2c) {
    var w = x2c - x1c;
    var h = y2c - y1c;
    if(w== 0 || h==0){
        var w = $('img#uploadPreview').width();
        var h = $('img#uploadPreview').height(); 
        x1c=0;
        y1c=0;
    }
    else{
    $('#x').val(x1c);
    $('#y').val(y1c);
    $('#w').val(w);
    $('#h').val(h);
    $('#x1').val(x1c);
    $('#y1').val(y1c);
    $('#w1').val(w);
    $('#h1').val(h);
    }
}
function setVal(i, e) {
    if(e.width == 0 || e.height == 0){
         var w = $('img#uploadPreview').width();
        var h = $('img#uploadPreview').height(); 
      var  x1=0;
       var y1=0;
        $('#x').val(x1);
    $('#y').val(y1);
    $('#w').val(w);
    $('#h').val(h);
      $('#x1').val(x1);
    $('#y1').val(y1);
    $('#w1').val(w);
    $('#h1').val(h);
    }else{
    $('#x').val(e.x1);
    $('#y').val(e.y1);
    $('#w').val(e.width);
    $('#h').val(e.height);
      $('#x1').val(e.x1);
    $('#y1').val(e.y1);
    $('#w1').val(e.width);
    $('#h1').val(e.height);
    }
}

function abc(newas, asp) {

    var p = $("#uploadPreview");
    // var asp = $('input[name=aspestRatio]:checked').val()
    // fadeOut or hide preview
    p.fadeOut();
    // prepare HTML5 FileReader
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
    oFReader.onload = function(oFREvent) {

        p.attr('src', oFREvent.target.result).fadeIn();
        var w = $('img#uploadPreview').width();
        var h = $('img#uploadPreview').height();
        if (w > h) {
            var centre = w / 2;
            var height = h;
            var width = height * asp;
            var deduct = width / 2;
            var x1c = centre - deduct;
            var y1c = 0;
            var x2c = centre + deduct;
            var y2c = height;
        } else {
            var centre = h / 2;
            var nwidth = w;
            var nheight = nwidth * asp;
            var ndeduct = nheight / 2;
            var x1c = 0;
            var y1c = centre - ndeduct;
            var x2c = nwidth;
            var y2c = centre + ndeduct;
        }
        $('img#uploadPreview').imgAreaSelect({x1: x1c, y1: y1c, x2: x2c, y2: y2c, aspectRatio: newas,show:true, handles: true, onload: setInfo(x1c, y1c, x2c, y2c), onSelectEnd: setVal(x1c,y1c,x2c,y2c)});
        
    };
}

$(document).ready(function() { 
     var asp;
    asp = $('input[name=aspestRatio]:checked').val();
    $('.sr-only').on('change', function() {
        asp = $(this).val();
        var newas;
        if (asp == "1.7777777777777777") {
            newas = "16:9";
        }
        if (asp == "1.3333333333333333") {
            newas = "4:3";
        }
        if (asp == "1") {
            newas = "1:1";
        }
        if (asp == "0.6666666666666666") {
            newas = "2:3";
        }
        if (asp == "NaN") {
            var w = $('img#uploadPreview').width();
                          var h = $('img#uploadPreview').height();  
                          asp= w/h;
                          newas = 0;
        }
        abc(newas, asp);
    });

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
              }else{
                  var centre = h/2;
                  var nwidth = w;
                  var nheight = (nwidth*3)/4;
                  var ndeduct = nheight/2;
                  var x1c = 0;
                  var y1c = centre - ndeduct;
                  var x2c = nwidth;
                  var y2c = centre + ndeduct;
              }
        
                        $('img#uploadPreview').imgAreaSelect({ x1: x1c, y1: y1c, x2: x2c, y2: y2c, aspectRatio: '4:3', show:true, handles: true,onload:setInfo(x1c,y1c,x2c,y2c),onSelectEnd: setVal(x1c,y1c,x2c,y2c)  });
		};
	});

        $('img#uploadPreview').imgAreaSelect({
             
            aspectRatio: '4:3',   
          handles: true,
          show : true,
        onSelectEnd: setVal
    });
	 
       
});