jQuery(function($) {
    $(document).ready(function() {

    });

    //admin -> stored information
    if($("#ajax_stored_information_table").length != 0) {
        var type_id = $("#ajax_stored_information_table").data('type');
        if(window.location.href.indexOf("local") > -1) {
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
        if(window.location.href.indexOf("local") > -1) {
            var url = "/";
        }else{
            var url = "/hosting/ebn_dev/";
        }
        $.ajax({
            url: window.location.origin + url + "ajax/mark_notifications_as_read",
            type: 'GET'
        }).done(function (result) {
            var data = $.parseJSON(result);
            $("#notification_list").html(data.html);
            $("#toolbar_notification_count").html(data.count);
            $("#dropdown_notification_count").html(data.count);
        });
    });

    //user -> get ajax notifications
    $('#update_verbal_ced').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();

        var button = $('#update_verbal_ced');
        var prospect_id = $(this).closest("form").find("input[name='prospect_id']").val();
        var verbal_ced = $(this).closest("form").find("input[name='verbal_ced']").val();
        if(window.location.href.indexOf("local") > -1) {
            var url = "/";
        }else{
            var url = "/hosting/ebn_dev/";
        }
        $.ajax({
            url: window.location.origin + url + "ajax/update_verbal_ced",
            type: 'POST',
            data: {
                action: "",
                prospect_id: prospect_id,
                verbal_ced: verbal_ced
            },
            beforeSend: function(){
                button.val('Loading');
            },
            success:function (result) {
                button.val('Update CED');
                toastr.info('Verbal CED updated');
            },
            error: function (errorThrown) {
                console.log(errorThrown);
            }
        });
    });

});