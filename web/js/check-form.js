function addClassError(input) {
    input.addClass('error-form');
}

function removeClassError(input) {
 input.removeClass('error-form');
}

$(document).ready(function () {

 $("form").submit(function (e) {
       var errors = 0;
       var firstname = $('#appbundle_message_firstname');
       var lastname = $('#appbundle_message_lastname');
       var email = $('#appbundle_message_email');
       var message = $('#appbundle_message_message');
       if(firstname.val() == '') {
        errors++;
        addClassError(firstname);
    }else{
        removeClassError(firstname);
    }

    if(lastname.val() == '') {
        errors++;
        addClassError(lastname);
    }else{
        removeClassError(lastname);
    }

    if(email.val() == '') {
        errors++;
        addClassError(email);
    }else{
       removeClassError(email);
    }

   if(message.val() == '') {
    errors++;
    addClassError(message);
}else{
   removeClassError(message);
}

if(errors === 0) {
    return true;
}else{
    return false;
}
});
});