    $(window).resize(function () {
        $('li.dropdown li.active').parents('.dropdown').addClass('active');
        if ($('.right-menu').width() + $('#navbar').width() > $('.check_nav.nav-wrapper').width() - 40) {
            $('.nav-wrapper').addClass('responsive-menu');
        }
        else {
            $('.nav-wrapper').removeClass('responsive-menu');
        }
    })

    $(document).on("click", ".mobile-menu-icon .dropdown-menu ,.drop-control .dropdown-menu, .drop-control .input-drop down", function (e) {
        e.stopPropagation();
    });

    $(function () {
        $('nav#menu-mobile').mmenu();
    });
    
    $(document).ready(function () {
        flagg = true;
        if (flagg) {
            $('.click-menu-mobile a').click(function () {
                $('#menu-mobile').removeClass('hidden');
                flagg = false;
            })
        }
    })