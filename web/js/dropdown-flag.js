$('#dropdown-flag .dropdown-item').click(function () {
    var elt = $(this).html();
    $('#dropdown-flag button').html(elt)
})