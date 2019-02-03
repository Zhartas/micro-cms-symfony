var flagSubmit = 0;
$('form').submit(function(e) {
    if(flagSubmit === 1) {
        return false;
    }
    flagSubmit = 1;
    setTimeout(function() {
        flagSubmit = 0;
    }, 2000);
});


$('#btnNfo').click(function() {
    $('#nfo').remove();
})



