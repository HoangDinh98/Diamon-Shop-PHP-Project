//var handleSidebarTogglerAnimated = function () {
//
//    $('.sidebar-toggler').click(function () {
//        if ($('#sidebar > ul').is(":visible") == true) {
//            $('#main-content').animate({
//                'margin-left': '25px'
//            });
//
//            $('#sidebar').animate({
//                'margin-left': '-190px'
//            }, {
//                complete: function () {
//                    $('#sidebar > ul').hide();
//                    $("#container").addClass("sidebar-closed");
//                }
//            });
//        } else {
//            $('#main-content').animate({
//                'margin-left': '215px'
//            });
//            $('#sidebar > ul').show();
//            $('#sidebar').animate({
//                'margin-left': '0'
//            }, {
//                complete: function () {
//                    $("#container").removeClass("sidebar-closed");
//                }
//            });
//        }
//    })
//}
//
//// by default used simple show/hide without animation due to the issue with handleSidebarTogglerAnimated.
//var handleSidebarToggler = function () {
//
//    $('.sidebar-toggler').click(function () {
//        if ($('#sidebar > ul').is(":visible") == true) {
//            $('#main-content').css({
//                'margin-left': '25px'
//            });
//            $('#sidebar').css({
//                'margin-left': '-190px'
//            });
//            $('#sidebar > ul').hide();
//            $("#container").addClass("sidebar-closed");
//        } else {
//            $('#main-content').css({
//                'margin-left': '215px'
//            });
//            $('#sidebar > ul').show();
//            $('#sidebar').css({
//                'margin-left': '0'
//            });
//            $("#container").removeClass("sidebar-closed");
//        }
//    })
//}


$('.sidebar-toggler').click(function () {
    if ($('#sidebar > ul').is(":visible") == true) {
        $('#main-content').css({
            'margin-left': '25px'
        });
        $('#sidebar').css({
            'margin-left': '-190px'
        });
        $('#sidebar > ul').hide();
        $("#container").addClass("sidebar-closed");
    } else {
        $('#main-content').css({
            'margin-left': '215px'
        });
        $('#sidebar > ul').show();
        $('#sidebar').css({
            'margin-left': '0'
        });
        $("#container").removeClass("sidebar-closed");
    }
});


jQuery('#theme-change').click(function () {
    if ($(this).attr("opened") && !$(this).attr("opening") && !$(this).attr("closing")) {
        $(this).removeAttr("opened");
        $(this).attr("closing", "1");

        $("#theme-change").css("overflow", "hidden").animate({
            width: '20px',
            height: '22px',
            'padding-top': '3px'
        }, {
            complete: function () {
                $(this).removeAttr("closing");
                $("#theme-change .settings").hide();
            }
        });
    } else if (!$(this).attr("closing") && !$(this).attr("opening")) {
        $(this).attr("opening", "1");
        $("#theme-change").css("overflow", "visible").animate({
            width: '190px',
            height: '30px',
//            height: scrollHeight,
            'padding-top': '3px'
        }, {
            complete: function () {
                $(this).removeAttr("opening");
                $(this).attr("opened", 1);
            }
        });
        $("#theme-change .settings").show();
    }
});

jQuery('#theme-change .colors span').click(function () {
    var color = $(this).attr("data-style");
    setColor(color);
});

jQuery('#theme-change .layout input').change(function () {
    setLayout();
});

var setColor = function (color) {
    $('#style_color').attr("href", "css/style_" + color + ".css");
}

//$(document).ready(function(){
//    $("#notify").delay(5000).fadeOut();
//});