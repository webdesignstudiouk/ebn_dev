jQuery(function($) {
    $(document).ready(function() {



    });

    if($("#ajax_stored_information_table").length != 0) {
        var type_id = $("#ajax_stored_information_table").data('type');
        if(window.location.href.indexOf("app") > -1) {
            var url = "/";
        }else{
            var url = "/hosting/ebn_dev/";
        }
        $.ajax({
            url: window.location.origin + url + "admin/options/ajax/stored-infomation/" + type_id,
            type: 'GET'
        }).done(function (data) {
            $("#ajax_stored_information_table").append(data);
        });
    }
});