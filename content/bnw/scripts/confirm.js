function showFunction() {
    var popup = '<div id="pop" style="text-align: center;position: absolute;height: 100px;width: 400px;background: #fff;display: none;z-index: 999;padding: 1%;box-shadow: 0px 0px 10px #000;">' +
            '<div style="padding: 1%;font-weight: bold;">ARE YOU SURE YOU WANT TO DELETE?<span id="custom_title"></span></div>' +
            '<div style="padding: 1%;margin-top: 4%;"> <button class="btn-yes" id="yes">YES</button> <span style="padding: 0 3%;"></span><button class="btn-no" id="no">NO</button></div>' +
            '</div><div id="fades" style="position: absolute;background: rgba(0,0,0,0.5);z-index:990;display: none;top: 0px; "></div>';
    $("body").prepend(popup);
    var windowH = $(window).height();    //height of the window
    var windowW = $(window).width();     //width of the window
    var popupH = $("#pop").height();    //height of the popup confirmation
    var popupW = $("#pop").width();     //width of the popup confirmation
    
    var left = (windowW - popupW) / 2;
    var docH = $(document).height();    //height of the window
    var docW = $(document).width();     //width of the window
    var scrollT = $(window).scrollTop();
    var top = scrollT + (windowH - popupH) / 2;
    $("#fades").css("height", docH);
    $("#fades").css("width", docW);
    $("#fades").show();
    $("#pop").css("top", top - 100);
    $("#pop").css("left", left);
    $("#pop").show();
}
    
    var id = "";
    var url = "";
    var hideid = "";
    var nav = "";
    function senddata(data)
    {
        id = data.id;
        url = data.url;
        thisss = data.thiss;
        nav = data.nav;
        showFunction();
    }
        
        $(document).on("click", "#no", function () {

            $("#pop").hide();
            $("#fades").hide();
        });
        
        $(document).on("click", "#yes", function () {
//            alert(data);
            
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    id: id
                },
                error: function ()
                {
                    $("#pop").html("Failed!!!. Try again later.<br>");
                    $("#pop").append("<button id='closeError' style='margin-top:5%;'>Close</button>");

                },
                success: function (msg)
                {
                    if (msg.length > 0)
                    {
                        $("#pop").html("Error!!!" + msg + "<br>");
                        $("#pop").append("<button id='closesuccess' style='margin-top:5%;'>Close</button>");
              

                    } else {
                        $("#pop").html("<span class='successDel'>Success!!!</span>");
//                        $("#pop").append("<button id='closesuccess' style='margin-top:5%;'>Close</button>");
                        $("#pop").fadeOut();
                        $("#fades").fadeOut();
                        thisss.parents(".action").hide(1000);
                    }
                    if (nav == "yes")
                    {
                        //refresh latest data.
                        $("#msges").html("Navigation Deleted");
                        var selectBox = document.getElementById("selectBox");
                        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                        var dataString = 'menu_id_next=' + selectedValue;
                        $.ajax({
                            type: "POST",
                            url: base_url + 'index.php/dashboard/manageNavigation',
                            data: dataString,
                            success: function (msg)
                            {
                                $("#cssmenu").html(msg);
                                $("#jobs").html("<option>Make Parent</option>");
                                $("#pop").fadeOut();
                                $("#fades").fadeOut();
                            }
                        });
                    }
                }


            });

        });

        $(document).on("click", "#closeError", function () {
            $("#pop").hide();
            $("#fades").hide();
        });

        $(document).on("click", "#closesuccess", function () {
            $("#pop").hide();
            $("#fades").hide();
        });
        