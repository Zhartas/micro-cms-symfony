var $collectionHolder;
var $addTagButton = $('<button type="button" class="btn-dev">Ajouter un avantage</button>');
var $newLinkLi = $('<li></li>').append($addTagButton);

jQuery(document).ready(function() {
    $collectionHolder = $('ul.benefits');
    $collectionHolder.append($newLinkLi);
    $collectionHolder.data('index', $collectionHolder.find(':input').length);
    $addTagButton.on('click', function(e) {
        addTagForm($collectionHolder, $newLinkLi);
    });

});

function addTagForm($collectionHolder, $newLinkLi) {
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);
    $collectionHolder.data('index', index + 1);
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);
    addTagFormDeleteLink($newFormLi);
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormButton = $('<button type="button" class="deleteBenefit float-right mb-4">Supprimer de la liste</button>');
    $tagFormLi.append($removeFormButton);
    $removeFormButton.on('click', function(e) {
        $tagFormLi.remove();
    });
}


$(document).ready(function () {
    $('.content').richText();
    $('.deleteBenefit').on('click', function(e) {
        $(this).prev().remove();
        $(this).remove();

    });

    $(document).on("click", '.select-icon', function(){
        var icon = $(this).children('p').text();
        $('#appbundle_services_icon').val(icon);
        $('#showIc').html('<i class="material-icons">'+icon+'</i>')
    });

    var iconElt = $('#appbundle_services_icon').val();
    $('#showIc').html('<i class="material-icons">'+iconElt+'</i>')

});



