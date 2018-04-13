$(document).ready(function () {

//delete dialog
    $('.is-delete').click(function () {
        $('#delete-modal').modal('show');
        var href = $(this).attr('href');
        $('#save-delete-modal').attr('href', href);

        if($('.delete-info').length >= 1){
            $('.delete-modal-info-show').text($('.delete-info').val());
        } else {
            var index = $('.is-delete').index(this);
            if (index != -1) {
                var info = $('.delete-modal-info').get(index);
                $('.delete-modal-info-show').text($(info).text());
            }
        }

        return false;
    });

    $('#save-delete-modal').click(function(e) {
        $('#delete-modal').modal('hide');
        return true;
    });
//delete dialog end

//contact us form ========
    $("#registerForm").validate();

    $("#dialog_contakt").dialog({
        autoOpen: false,
        width: 400,
        buttons: {
            "Відправити": function () {
                if ($("#registerForm").valid()) {

                    $("#dialog_contakt").dialog("close");
                    $.ajax({
                        method: "GET",
                        url: "/sendemale",
                        data: {call_name: $("#call_name").val(),
                            call_mob: $("#call_mob").val(),
                            call_time_b: $("#call_time_b").val(),
                            call_time_e: $("#call_time_e").val()}
                    })
                        .done(function (msg) {
                            var data = eval('(' + msg + ')');
                            if (data.Result) {
                                $("#dialog_contakt_ok").dialog();

                                //alert(data.Result);
                            }
                        });
                }
            }
        }
    });

    $(".contact_as").click(function () {
        $("#dialog_contakt").dialog("open");
        return false;
    });

    $("#call_mob").mask("(999) 999-9999");
    $("#call_time_b").mask("99:99");
    $("#call_time_e").mask("99:99");

    $("#container").height($(document).height());
//contact us form end========

});