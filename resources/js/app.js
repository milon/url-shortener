require('./bootstrap');

$(document).ready(function () {
    if($('#is-private').is(':checked')) {
        $('#allowed-email').removeClass('hidden');
    } else {
        $('#allowed-email').addClass('hidden');
    }

   $('#is-private').click(function () {
        if($(this).is(':checked')) {
            $('#allowed-email').removeClass('hidden');
        } else {
            $('#allowed-email').addClass('hidden');
        }
   });
});
