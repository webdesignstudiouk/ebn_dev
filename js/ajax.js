jQuery(function($) {
    $(document).ready(function() {

    });

    //admin -> stored information
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

    //user -> get ajax notifications
    $('#clear_notifications').on('click', function(e){
        e.stopPropagation();
        $.ajax({
            url: window.location.origin + "/ajax/mark_notifications_as_read",
            type: 'GET'
        }).done(function (result) {
            var data = $.parseJSON(result);
            $("#notification_list").html(data.html);
            $("#toolbar_notification_count").html(data.count);
            $("#dropdown_notification_count").html(data.count);
        });
    });



});