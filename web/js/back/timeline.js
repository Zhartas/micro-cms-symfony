$(document).ready(function() {
    $('#no-date').click(function() {
        if ($(this).is(':checked')) {
            $(this).attr('checked', true);
            $('#appbundle_timeline_dateEnd').prop('disabled', true);
            $('#appbundle_timeline_dateEnd').val('');
            $('#appbundle_timeline_status').val('no');
            $('#now-date').prop('checked', false);
        }else{
            $(this).attr('checked', false);
            $('#appbundle_timeline_dateEnd').prop('disabled', false);
            $('#appbundle_timeline_status').val('null');
        }
    });

    $('#now-date').click(function() {
        if ($(this).is(':checked')) {
            $(this).attr('checked', true);
            $('#appbundle_timeline_dateEnd').prop('disabled', true);
            $('#appbundle_timeline_dateEnd').val('');
            $('#appbundle_timeline_status').val('now');
            $('#no-date').prop('checked', false);
        }else{
            $(this).attr('checked', false);
            $('#appbundle_timeline_dateEnd').prop('disabled', false);
            $('#appbundle_timeline_status').val('null');

        }
    });
})