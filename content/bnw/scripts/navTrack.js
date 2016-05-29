$(document).ready(function () {
    var locat = '"' + window.location + '"';
    if (locat.indexOf("dashboard") != "-1") {
        $(".dashboard").css("background", "#000");
        $(".dashboard").children("ul.subMenu").show();
        if (locat.indexOf("category") != "-1") {
            var listItems = $(".dashboard ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Categories") != "-1") {
                    $(".dashboard ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
        if (locat.indexOf("navigation") != "-1") {
            var listItems = $(".dashboard ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Navigation") != "-1") {
                    $(".dashboard ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
        if (locat.indexOf("addmenu") != "-1") {
            var listItems = $(".dashboard ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Add Menu") != "-1") {
                    $(".dashboard ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
        if (locat.indexOf("addmenu") != "-1") {
            var listItems = $(".dashboard ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Add Menu") != "-1") {
                    $(".dashboard ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
    }
    if (locat.indexOf("event") != "-1") {
        $(".events").css("background", "#000");
        $(".events").children("ul.subMenu").show();
        if (locat.indexOf("addevent") != "-1") {
            var listItems = $(".events ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Add") != "-1") {
                    $(".events ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
        if (locat.indexOf("allevents") != "-1") {
            var listItems = $(".events ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("All") != "-1") {
                    $(".events ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
    }
    if (locat.indexOf("post") != "-1") {
        $(".posts").css("background", "#000");
        $(".posts").children("ul.subMenu").show();
        if (locat.indexOf("addpost") != "-1") {
            var listItems = $(".posts ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Add") != "-1") {
                    $(".posts ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
        if (locat.indexOf("posts") != "-1") {
            var listItems = $(".posts ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("All") != "-1") {
                    $(".posts ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
    }
    if (locat.indexOf("page") != "-1") {
        $(".pages").css("background", "#000");
        $(".pages").children("ul.subMenu").show();
        if (locat.indexOf("addpage") != "-1") {
            var listItems = $(".pages ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Add") != "-1") {
                    $(".pages ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
        if (locat.indexOf("pages") != "-1") {
            var listItems = $(".pages ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("All") != "-1") {
                    $(".pages ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
    }
    if (locat.indexOf("slider") != "-1") {
        $(".sliders").css("background", "#000");
        $(".sliders").children("ul.subMenu").show();
        if (locat.indexOf("addslider") != "-1") {
            var listItems = $(".sliders ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Add") != "-1") {
                    $(".sliders ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
        if (locat.indexOf("slider") != "-1") {
            var listItems = $(".sliders ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("All") != "-1") {
                    $(".sliders ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
    }
    if (locat.indexOf("album") != "-1") {
        $(".albums").css("background", "#000");
        $(".albums").children("ul.subMenu").show();
        if (locat.indexOf("addalbum") != "-1") {
            var listItems = $(".albums ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Add") != "-1") {
                    $(".albums ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
    }
    if (locat.indexOf("media") != "-1") {
        $(".media").css("background", "#000");
        $(".media").children("ul.subMenu").show();
        if (locat.indexOf("medias") != "-1") {
            var listItems = $(".media ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Library") != "-1") {
                    $(".media ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
        if (locat.indexOf("addmedia") != "-1") {
            var listItems = $(".media ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Add") != "-1") {
                    $(".media ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
    }
    if (locat.indexOf("user") != "-1") {
        $(".users").css("background", "#000");
        $(".users").children("ul.subMenu").show();
        if (locat.indexOf("adduser") != "-1") {
            var listItems = $(".users ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Add") != "-1") {
                    $(".users ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
        if (locat.indexOf("users") != "-1") {
            var listItems = $(".users ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("All") != "-1") {
                    $(".users ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
        if (locat.indexOf("profile") != "-1") {
            var listItems = $(".users ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Profile") != "-1") {
                    $(".users ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
    }
    if (locat.indexOf("social_share") != "-1") {
        $(".social-share").css("background", "#000");
        $(".social-share").children("ul.subMenu").show();
    }
    if (locat.indexOf("setting") != "-1") {
        $(".settings").css("background", "#000");
        $(".settings").children("ul.subMenu").show();
        if (locat.indexOf("header") != "-1") {
            var listItems = $(".settings ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Header") != "-1") {
                    $(".settings ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
        if (locat.indexOf("sidebar") != "-1") {
            var listItems = $(".settings ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Sidebar") != "-1") {
                    $(".settings ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
        if (locat.indexOf("miscsetting") != "-1") {
            var listItems = $(".settings ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Miscellaneous") != "-1") {
                    $(".settings ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
        
        if (locat.indexOf("setup") != "-1") {
            var listItems = $(".settings ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Setup") != "-1") {
                    $(".settings ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
    }
    if (locat.indexOf("gadgets") != "-1") {
        $(".settings").children("ul.subMenu").show();
            var listItems = $(".settings ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Gadgets") != "-1") {
                    $(".settings ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
        if (locat.indexOf("viewSubscriber") != "-1") {
        $(".subscribes").children("ul.subMenu").show();
            var listItems = $(".subscribes ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Newsletter") != "-1") {
                    $(".subscribes ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
        }
    if (locat.indexOf("viewContact") != "-1") {
        $(".subscribes").css("background", "#000");
        $(".subscribes").children("ul.subMenu").show();
        $(".subscribes").children("ul.subMenu").show();
            var listItems = $(".subscribes ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Contact") != "-1") {
                    $(".subscribes ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
    }
    if (locat.indexOf("contact") != "-1") {
        $(".contacts").css("background", "#000");
        $(".contacts").children("ul.subMenu").show();
        
        if (locat.indexOf("updateContact") != "-1") {
        $(".contacts").css("background", "#000");
        $(".contacts").children("ul.subMenu").show();
        $(".contacts").children("ul.subMenu").show();
            var listItems = $(".contacts ul li");
            listItems.each(function(idx, li) {
                var subnav = $(this).children("a").html();
                if(subnav.indexOf("Form") != "-1") {
                    $(".contacts ul.subMenu li").eq(idx).css("background", "#333");
                }
            });
    }
    }
    
    $("form").submit(function(){
//        e.preventDefault();
        $(":submit").prop("disabled", true);
//        alert("Submitted");
//        $(this).submit();
    }); 

});