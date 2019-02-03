$('.card-color-theme').click(function () {
    $('.card-color-theme').each(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        }
    });
    $(this).addClass('active');
    var color = $(this).children('span:last-child').text();
    $('#appbundle_site_theme').val(color);
});

var maxSize = 2000000;

function readURL(input) {
    if (input.files && input.files[0]) {
        if (input.files[0].size > maxSize) {
            activeNotif("L'image doit être inférieur à 2MO [Taille recommandée: 1260x627px | Poids:     2MO Maximum]");
            return false;
        }
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#showImg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#appbundle_site_imageFile_file").change(function () {
    readURL(this);
});
