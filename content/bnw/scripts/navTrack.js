$(document).ready(function () {
    var locat = '"' + window.location + '"';
    if (locat.contains("dashboard")) {
        $(".dashboard").css("background", "#000");
    }
    if (locat.contains("event")) {
        $(".events").css("background", "#000");
    }
    if (locat.contains("post")) {
        $(".posts").css("background", "#000");
    }
    if (locat.contains("page")) {
        $(".pages").css("background", "#000");
    }
    if (locat.contains("slider")) {
        $(".sliders").css("background", "#000");
    }
    if (locat.contains("album")) {
        $(".albums").css("background", "#000");
    }
    if (locat.contains("media")) {
        $(".media").css("background", "#000");
    }
    if (locat.contains("user")) {
        $(".users").css("background", "#000");
    }
    if (locat.contains("social_share")) {
        $(".social-share").css("background", "#000");
    }
    if (locat.contains("setting")) {
        $(".settings").css("background", "#000");
    }
    if (locat.contains("gadgets")) {
        $(".settings").css("background", "#000");
    }
    if (locat.contains("viewSubscriber")) {
        $(".subscribes").css("background", "#000");
    }
    if (locat.contains("viewContact")) {
        $(".subscribes").css("background", "#000");
    }
    if (locat.contains("contact")) {
        $(".contacts").css("background", "#000");
    }
    
});