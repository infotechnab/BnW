function imgPos()
{
    $(".imageContainer").each(function () {
        var images = $(this).find("#galleryimage");
        var thumbwidth = images.width();
        var thumbheight = images.height();
        if (thumbwidth > thumbheight)
        {
            images.width("100%");
        } else {
            images.height("100%");
        }
    });
}

$(document).ready(function () {

    $('body').prepend('<div id="popup_box"><div style="padding: 1%;"><i class="fa fa-remove" id="popupBoxClose" style="cursor: pointer;"></i><div class="clear"></div></div><img  src="" id="pqr"/></div><div id="fadeDiv"><img src="' + base_url + 'content/bnw/images/loading.gif" id="loading"></div>');

    // When site loaded, load the Popupbox First
    $(document).on('click', '.srcimage', function () {
        var imgwidth = 0;
        var imgheight = 0;
        $("#fadeDiv").width($(document).width());
        $("#fadeDiv").height($(document).height());
        $("#fadeDiv").show();
        $("#loading").show();




        $("#pqr").prop("src", "");
        var srcimg = $(this).attr('name');
        var img = new Image();
        img.src = base_url + "content/uploads/images/" + srcimg; //path of HD image.
        img.onload = function () {
            $("#pqr").prop("src", this.src);
            var w = $(window).width();
            var h = $(window).height();
            var topp = $(window).scrollTop();
            imgwidth = this.width;
            imgheight = this.height;
            if (imgwidth > imgheight)
            {
                var b = w - 700;
                var lr = b / 2;
                var tp = (h - imgheight) / 2;
                var toppos = topp + tp;
                $('#popup_box').css("left", lr);
                $('#popup_box').css("top", "20px");
                $('#popup_box').show();

                $("#pqr").css("width", "600px");
                $("#pqr").css("height", "");
            } else {
                var x = w - imgwidth;
                var lra = x / 2;
                var tp = (h - 600) / 2;
                var toppos = topp + tp;
                $('#popup_box').css("left", lra);
                $('#popup_box').css("top", "20px");
                $('#popup_box').show();

                $("#pqr").css("height", "600px");
                $("#pqr").css("width", "");
            }

            $("#loading").hide();
        };

    });

    $('#popupBoxClose').click(function () {
        $('#popup_box').hide();
        $("#fadeDiv").hide();
    });

    $(document).mouseup(function (e) {
        var container = $("#popup_box");

        if (!container.is(e.target) // if the target of the click isn't the container...
                && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            container.hide();
            $("#fadeDiv").hide();
        }
    });

});