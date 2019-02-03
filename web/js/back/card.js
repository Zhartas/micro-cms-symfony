$(document).on("click", '.select-icon', function(){
    var icon = $(this).children('p').text();
    $('#appbundle_card_icon').val(icon);
    $('#showIc').html('<i class="material-icons">'+icon+'</i>');
});