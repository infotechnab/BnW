    function progressHandler(e) {
    var progress = document.getElementById('progress');
    var status = document.getElementById('status');
    var percent = (e.loaded / e.total) * 100;
    percent = Math.round(percent);
    progress.style.width = Math.round(percent) + '%';
    status.innerHTML = percent + '% completed.';
}

//photo preview using html5
function handleFileSelect(evt) {
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        var files = evt.target.files; // FileList object
        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

            // Only process image files.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();
            // Closure to capture the file information.
            reader.onload = (function (theFile) {
                return function (e) {
                    // Render thumbnail.

                    var span = document.createElement('div');
                    span.style.display = "inline-block";
//                    span.style.position = "relative";
                    span.style.margin = "1%";
                    span.innerHTML = ['<img width="100" class="thumb" src="', e.target.result,
                        '" title="', escape(theFile.name), '"/>'].join('');
                    document.getElementById('list').insertBefore(span, null);
                };
            })(f);

            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
            // $("#list span").append(parseInt(bytetToKb,10));
        }
    }
}

    $(document).ready(function () {
        var win = window.innerHeight;
        var winw = window.innerWidth;
        var mediaPopUp = $(".mediaPopUp").width();
        var mediaPopUpheight = $(".mediaPopUp").height();
        var top = (win - mediaPopUpheight) / 2;
        var left = (winw - mediaPopUp) / 2;
        $(document).on("click", ".mediabtn", function () {
            $(".mediaPopUp").css("left", left);
            $(".mediaPopUp").css("top", top);
            $(".mediaPopUp").show();

            $.ajax({
                type: "POST",
                url: base_url + 'dashboard/get_media',
                data: {
                },
                success: function (dat)
                {
                    var data = JSON.parse(dat);
                    var imageLoaded = function () {
                        // Run onload code.
                        $(this).addClass("mediaImg");
                        $(this).appendTo(".mediaImgContainer").wrap("<div class='some'></div>");

                    };
                    $.each(data, function (i, item) {
                        var medias = data[i].media_type;
                        var singlemedias = medias.split(",");
                        var mediaslen = singlemedias.length;
                        for(var a =  0; a < mediaslen; a++)
                        {
                            var tmpImg = new Image();
                            tmpImg.onload = imageLoaded;
                            tmpImg.alt = data[i].media_name;
                            tmpImg.id = data[i].id;
                            tmpImg.src = base_url + "content/uploads/images/thumbnail/" + singlemedias[a];
                        }
                    });
                }
            });
        });

        $(document).on("click", ".mediaPopUp img", function () {
            var imgname = $(this).attr("alt");
            var imgid = $(this).attr("id");
            var imgsrc = $(this).attr("src");
            $(".mediaDetails").show();
            $(".imgprev img").attr("src", imgsrc);
            $(this).css("border","2px solid #aaa");
//            alert(imgname);
//            alert(imgid);
        });

        $(document).on("change", ".newuploads", function (e) {
            $("#list").html(" ");
            handleFileSelect(e);
            
                var formData = new FormData($("form#mediauploads")[0]);
                $("#progress_bar").show();
                $.ajax({
                    url: base_url + "dashboard/uploads",
                    type: 'POST',
                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    xhr: function () {  // custom xhr
                        var myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload) { // Check if upload property exists
                            myXhr.upload.addEventListener('progress', progressHandler, false);// For handling the progress of the upload
                        }
                        return myXhr;
                    },
                    complete: function () { //     
                        $("#status").html("Completed.");
                    },
                    error: function () {

                        alert("ERROR in sending message");
                    }
                });
        });
        $(document).on("click", ".mediaClose", function(){
            $(".mediaPopUp").hide();
            $(".mediaImgContainer").html("");
        });
    });