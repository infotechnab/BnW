
function setInfo(x1c, y1c, x2c, y2c) {
    var w = x2c - x1c;
    var h = y2c - y1c;
    $('#x').val(x1c);
    $('#y').val(y1c);
    $('#w').val(w);
    $('#h').val(h);
}
function setVal(i, e) {
    if (e.width == 0 || e.height == 0) {
        var w = $('img#uploadPreview').width();
        var h = $('img#uploadPreview').height();
        var x1a = 0;
        var y1a = 0;
        $('#x').val(x1a);
        $('#y').val(y1a);
        $('#w').val(w);
        $('#h').val(h);
    }
    else
    {
        $('#x').val(e.x1);
        $('#y').val(e.y1);
        $('#w').val(e.width);
        $('#h').val(e.height);
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
    oFReader.onload = function (oFREvent) {

        p.attr('src', oFREvent.target.result).fadeIn();
        $('#mybutton').css('display', 'inline-block');
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

        $('img#uploadPreview').imgAreaSelect({x1: x1c, y1: y1c, x2: x2c, y2: y2c, aspectRatio: newas, handles: true, onload: setInfo(x1c, y1c, x2c, y2c), onSelectEnd: setVal});

    };
}

$(document).ready(function () {
    var asp;
    asp = $('input[name=aspestRatio]:checked').val();
    $('.sr-only').on('change', function () {
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
            asp = w / h;
            newas = 0;
        }
        abc(newas, asp);
    });

    var p = $("#uploadPreview");
    // prepare instant preview
    $("#uploadImage").change(function () {
        // fadeOut or hide preview
        p.fadeOut();
        // prepare HTML5 FileReader
        var oFReader = new FileReader();
        var file = document.getElementById("uploadImage").files[0];

        //var fileType = file.type;
        //var ValidImageTypes = ["image/gif", "image/jpeg", "image/jpg", "image/png"];
        //if ($.inArray(fileType, ValidImageTypes) < 0) {
         //   alert('invalid file type');
         //   p.hide();
          //  $('.imgareaselect-handle').css("display", "none");
            //$('.imgareaselect-selection').css("display", "none");
          //  $('.imgareaselect-outer').css("display", "none");
            //$('.imgareaselect-border1').css("display", "none");
            //$('.imgareaselect-border2').css("display", "none");
            //$('.imgareaselect-border3').css("display", "none");
            //$('.imgareaselect-border4').css("display", "none");
            //$('.imgareaselect-outer').prev().hide();
        //}
        //else {

            if (file != undefined) {
                oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
                oFReader.onload = function (oFREvent) {
                    p.attr('src', oFREvent.target.result).fadeIn();
                    $('#mybutton').css('display', 'inline-block');
                    var w = $('img#uploadPreview').width();
                    var h = $('img#uploadPreview').height();
                    if (w > h) {
                        var centre = w / 2;
                        var height = h;
                        var width = (height * 4) / 3;
                        var deduct = width / 2;
                        var x1c = centre - deduct;
                        var y1c = 0;
                        var x2c = centre + deduct;
                        var y2c = height;
                    } else {
                        var centre = h / 2;
                        var nwidth = w;
                        var nheight = (nwidth * 3) / 4;
                        var ndeduct = nheight / 2;
                        var x1c = 0;
                        var y1c = centre - ndeduct;
                        var x2c = nwidth;
                        var y2c = centre + ndeduct;
                    }

                    $('img#uploadPreview').imgAreaSelect({x1: x1c, y1: y1c, x2: x2c, y2: y2c, aspectRatio: '4:3', handles: true, onload: setInfo(x1c, y1c, x2c, y2c), onSelectEnd: setVal});
                };
            }
            else {
                p.hide();
                $('.imgareaselect-handle').css("display", "none");
                $('.imgareaselect-selection').css("display", "none");
                $('.imgareaselect-outer').css("display", "none");
                $('.imgareaselect-border1').css("display", "none");
                $('.imgareaselect-border2').css("display", "none");
                $('.imgareaselect-border3').css("display", "none");
                $('.imgareaselect-border4').css("display", "none");
                $('.imgareaselect-outer').prev().hide();
				$('#mybutton').css('display', 'none');
            }
       // }
    });

    $('img#uploadPreview').imgAreaSelect({
        aspectRatio: '4:3',
        handles: true,
        onload: setVal
    });


});