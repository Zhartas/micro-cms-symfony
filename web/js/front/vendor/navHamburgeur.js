$(window).scroll(function(){
    var wScroll = $(this).scrollTop();
    if(wScroll > 10) {
        $('#navHamburgeur').addClass('bg-dark');
    }else{
        $('#navHamburgeur').removeClass('bg-dark');
    }
});

$('header nav button.btnNavigation').click(function() {
    if($('#mainNavigation').width() === 0) {
        if($(window).width() > 1200) {
            $('#mainNavigation').width(600);
        }else{
            $('#mainNavigation').width($(window).width());
        }
    }else{
        $('#mainNavigation').width(0);
    }
});
