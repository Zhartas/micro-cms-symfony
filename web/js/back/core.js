var sm = 576;
var md = 768;
var lg = 992;
var xl = 1200;

var loader = "<div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>";

function activeBeforeNotif() {
    $('#notif').height(70);
    $('#notif p').html(loader);
}

function activeNotif(text) {
    $('#notif').height(70);
    $('#notif p').text(text);
    setTimeout(function() {
        $('#notif').height(0);
        $('#notif p').html();
    }, 5000);
}
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#showImage img').removeClass('d-none');
            $('#showImage div').addClass('d-none');
            $('#showImage img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function openNav() {
    var nav = $('body header');
    var wHeight = $(window).innerHeight();

    if (window.innerWidth <= 992) {
        $('#btn-nav').click(function () {
            if (nav.height() < 80) {
                nav.height(wHeight);
                $('#box-nav nav > div').css('height', wHeight-70);

            } else {
                nav.height(70);
            }
        });
    }else{
        nav.height(70);
    }
}


$(document).ready(function () {
    openNav();
    $(window).resize(function () {
        openNav();
    });


    $('.js-scrollTo').on('click', function () {
        var page = $(this).attr('href');
        var speed = 750;
        $('html, body').animate({scrollTop: $(page).offset().top}, speed);
        return false;
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(document).on('click', '[data-submit]', function () {
        var form = $(this).attr('data-submit');
        $('form[name=' + form + ']').submit();
    });


    $('form[name="updateImage"]').submit(function (e) {
        e.preventDefault();
        var url = this.action;
        var method = this.method;
        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            beforeSend: function () {
                activeBeforeNotif();
            },
        }).done(function (res) {
            activeNotif(res);
        });
    });


    $('form[name="appbundle_locale"]').submit(function (e) {
        e.preventDefault();
        var url = this.action;
        var method = this.method;
        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize()
        }).done(function (res) {
            console.log(res);
        });
    });

    $('[type="checkbox"]').click(function () {
        if ($(this).val() === '1') {
            $(this).val(0);
        } else {
            $(this).val(1);
        }
    });





    /*
        init accordian
    */

    $('.collapse').each(function () {
        if (this.id !== 'collapse1') {
            $(this).removeClass('show');
        }
    });

    /*
       click accordian
    */
    $('button.btn-accordian').click(function() {
        var elt = $(this).attr('data-collapse');
        $("button[data-target='"+elt+"']").click();
    });


    jQuery("button[aria-controls]").click(function (e) {
        jQuery('.collapse').collapse('hide');
    });
});


