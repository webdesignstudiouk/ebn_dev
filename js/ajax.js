jQuery(function($) {
    $(document).ready(function() {



    });

    if($("#ajax_stored_information_table").length != 0) {
        var type_id = $("#ajax_stored_information_table").data('type');
        console.log(type_id);
        $.ajax({
            url: window.location.origin + "/hosting/ebn_dev/" + "admin/options/ajax/stored-infomation/" + type_id,
            type: 'GET'
        }).done(function (data) {
            console.log(data);
            $("#ajax_stored_information_table").append(data);
        });
    }
});