$(document).ready(function () {
    $('.owl-carousel').owlCarousel({
        loop: true,
        nav: false,
        margin: 15,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            720: {
                items: 2,
                nav: false
            },
            1366: {
                items: 3,
                nav: true,
                loop: false
            }
        }
    });
});
